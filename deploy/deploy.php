<?php

/**
 * GitHub Webhook — Auto-deploy for qwed.agency (Stage)
 *
 * Webhook URL : https://stage.qwed.agency/deploy/deploy.php
 * GitHub event: push → branch "stage"
 *
 * Setup on server:
 *   1. Fill in CONFIG below
 *   2. Add webhook in GitHub → Settings → Webhooks
 *      - Payload URL : https://stage.qwed.agency/deploy/deploy.php
 *      - Content type: application/json
 *      - Secret      : same value as $secret below
 *      - Events      : Just the push event
 */

// ─── CONFIG ──────────────────────────────────────────────────────────────────
$secret    = 'qwed-stage-secret';                                          // webhook secret (set same in GitHub)
$token = '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';                                     // Personal Access Token (repo read)
$repoDir   = '/home/SERVER_USER/stage.qwed.agency/wp-content/themes/CustomBaseTheme';
$logFile   = '/home/SERVER_USER/stage.qwed.agency/deploy/theme-stage.log';
$npmPath   = '/home/SERVER_USER/.nvm/versions/node/NODE_VERSION/bin/npm';
$nodePath  = '/home/SERVER_USER/.nvm/versions/node/NODE_VERSION/bin/node';
$nodeDir   = '/home/SERVER_USER/.nvm/versions/node/NODE_VERSION/bin';
$branch    = 'stage';
// ─────────────────────────────────────────────────────────────────────────────

putenv("PATH={$nodeDir}:" . getenv('PATH'));

// ── Helpers ──────────────────────────────────────────────────────────────────
function writeLog(string $msg, bool $ok = true): void
{
    global $logFile;
    $icon   = $ok ? '✅' : '❌';
    $logDir = dirname($logFile);
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    file_put_contents($logFile, date('c') . " {$icon} {$msg}\n", FILE_APPEND);
}

function runCmd(string $cmd): array
{
    exec($cmd . ' 2>&1', $output, $code);
    return [$output, $code];
}
// ─────────────────────────────────────────────────────────────────────────────

// 1. Verify GitHub signature
$headers = getallheaders();
$sig     = $headers['X-Hub-Signature-256'] ?? ($headers['X-Hub-Signature'] ?? '');
$payload = file_get_contents('php://input');

if (strpos($sig, 'sha256=') === 0) {
    $expected = 'sha256=' . hash_hmac('sha256', $payload, $secret);
} else {
    $expected = 'sha1=' . hash_hmac('sha1', $payload, $secret);
}

if (!hash_equals($expected, $sig)) {
    writeLog('Signature verification failed', false);
    http_response_code(403);
    exit('Forbidden');
}

// 2. Parse branch from payload
$data          = json_decode($payload, true);
$pushedBranch  = str_replace('refs/heads/', '', $data['ref'] ?? '');

if ($pushedBranch !== $branch) {
    http_response_code(200);
    exit("Ignoring branch '{$pushedBranch}'");
}

writeLog("=== Deployment started from branch: {$branch} ===");

// 3. Git fetch + reset
$repoUrl = "https://x-access-token:{$token}@github.com/dev-qwerty-soft/qwed.agency.git";

[$fetchOut, $fetchCode] = runCmd("git -C {$repoDir} fetch -v {$repoUrl} {$branch}");
[$resetOut, $resetCode] = runCmd("git -C {$repoDir} reset --hard FETCH_HEAD");

writeLog("FETCH [{$fetchCode}]: " . implode(' | ', array_slice($fetchOut, -3)));
writeLog("RESET [{$resetCode}]: " . implode(' | ', array_slice($resetOut, -2)));

if ($fetchCode !== 0 || $resetCode !== 0) {
    writeLog('Git pull failed', false);
    http_response_code(500);
    exit('❌ Git pull failed');
}

// 4. npm ci
writeLog('Installing dependencies…');
[$npmOut, $npmCode] = runCmd("cd {$repoDir} && {$npmPath} ci");
writeLog("NPM CI [{$npmCode}]: " . implode(' | ', array_slice($npmOut, -3)), $npmCode === 0);

if ($npmCode !== 0) {
    writeLog('npm ci failed', false);
    http_response_code(500);
    exit('❌ NPM install failed — check logs');
}

// 5. npm run build
writeLog('Building assets…');
[$buildOut, $buildCode] = runCmd("cd {$repoDir} && {$npmPath} run build");
writeLog("BUILD [{$buildCode}]: " . implode(' | ', array_slice($buildOut, -3)), $buildCode === 0);

if ($buildCode === 0) {
    $commit = trim((string) shell_exec("git -C {$repoDir} log -1 --format='%h — %s'"));
    writeLog("=== ✅ Deployed successfully: {$commit} ===");
    http_response_code(200);
    echo "✅ Deployed successfully!\n";
    echo "Commit : {$commit}\n";
    echo "Branch : {$branch}\n";
} else {
    writeLog('Build failed', false);
    http_response_code(500);
    echo "❌ Build failed — check {$logFile}";
}
