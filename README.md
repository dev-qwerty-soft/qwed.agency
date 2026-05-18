# CustomBaseTheme

My WordPress starter for custom client projects. Class-based PHP, Webpack 5, SCSS, TypeScript. No page builders, no bloat.

## Getting started

```bash
npm install
npm run watch   # dev
npm run build   # production
```

Node version is in `.nvmrc` — run `nvm use` before anything.

---

## Structure

```
CustomBaseTheme/
├── functions.php                    # Entry point — just loads classes, nothing else
├── includes/
│   ├── helpers.php                  # Global helpers used across templates
│   ├── classes/
│   │   ├── theme-setup.php          # Theme support, image sizes, ACF options page
│   │   ├── assets-manager.php       # Enqueue, critical CSS inline, defer/preload
│   │   ├── ajax-controller.php      # AJAX with nonce verification + rate limiting
│   │   ├── acf-settings.php         # Saves ACF JSON to /acf-json/ for git versioning
│   │   ├── security-enhancer.php    # Security headers, CSP, Permissions-Policy
│   │   ├── seo-enhancer.php         # Open Graph, Schema.org JSON-LD, Twitter Cards
│   │   └── performance-enhancer.php # Auto lazy-load images, font preloading
│   ├── setup/
│   │   ├── menus.php                # Nav menu registration
│   │   ├── clean-head.php           # Strips wp_head garbage (emoji, generator, etc.)
│   │   └── disable-comments.php     # Turns off comments everywhere
│   ├── Custom_Post_Type.php         # Drop-in class to register a CPT
│   └── Custom_Taxonomy.php          # Drop-in class to register a taxonomy
├── flexible-content-parts/          # One file per ACF flexible content layout
├── parts/                           # Shared template partials
├── src/
│   ├── js/
│   │   ├── client/
│   │   │   ├── gsap.ts              # GSAP + ScrollTrigger, registered globally
│   │   │   └── swiper.js            # Swiper with Navigation — uncomment to use
│   │   ├── admin/                   # Admin panel JS
│   │   ├── login/                   # Login page styles only
│   │   ├── fonts/                   # Font preload entry
│   │   └── utils/function.ts        # DOM, scroll, responsive, formatting utils
│   └── scss/
│       ├── general/
│       │   ├── mixins.scss          # Breakpoints, color vars, SCSS functions
│       │   ├── global.scss          # Full reset + container + base html/body
│       │   ├── layout.scss          # Starter layout — delete when designing from scratch
│       │   ├── typography.scss      # Font family, sizes, weights
│       │   ├── animations.scss      # Keyframes
│       │   ├── semantic.scss        # Defaults for semantic HTML elements
│       │   └── ui.scss              # Buttons, inputs, form elements
│       └── pages/                   # Per-page style files
├── acf-json/                        # ACF fields in git — always commit this folder
├── dist/                            # Build output — do not commit
├── tests/                           # PHPUnit tests for PHP helpers
├── webpack.config.js
└── package.json
```

---

## layout.scss

This file gives the theme a usable look out of the box — header, mobile menu, footer, post cards grid. It's a starting point, not a final design.

**When you start a real project — just delete `src/scss/general/layout.scss`.** Webpack auto-discovers SCSS files, so nothing else needs updating. Next build and it's gone.

What's in it: `.header` (sticky, 72px), `.burger` (animates to ×), `.mobile-menu` (full-screen overlay), `.footer` (two rows), `.posts-grid` (3→2→1 col), `.post-card`, `.container` (1280px centered).

---

## PHP helpers

| Function | What it does |
|---|---|
| `getUrl($path)` | URL to a theme file with `?v=` cache-busting |
| `displaySvg($path)` | Inlines SVG by relative path from theme root |
| `getPosts($post_type, $args)` | Clean wrapper around `WP_Query` |
| `clsx(...$args)` | Conditional class names, same API as the JS library |
| `cleanContent($content)` | Strips Visual Composer / Divi markup from old content |
| `preload_fonts()` | Adds `<link rel="preload">` for every font in `/dist/fonts/` |
| `dump($var)` | Pretty-prints a variable in a fixed overlay for debugging |
| `console($data)` | Passes PHP data to browser console |

---

## Adding a CPT

```php
// functions.php
require_once THEME_PATH . '/includes/Custom_Post_Type.php';

new Custom_Post_Type('projects', [
  'label'       => 'Projects',
  'labels'      => ['singular_name' => 'Project'],
  'supports'    => ['title', 'editor', 'thumbnail'],
  'has_archive' => true,
  'rewrite'     => ['slug' => 'projects'],
]);
```

## Adding a taxonomy

```php
require_once THEME_PATH . '/includes/Custom_Taxonomy.php';

new Custom_Taxonomy('project-category', ['projects'], [
  'label'        => 'Project Categories',
  'hierarchical' => true,
  'rewrite'      => ['slug' => 'project-category'],
]);
```

## Adding an AJAX endpoint

Open `includes/classes/ajax-controller.php` and add to `__construct()`:

```php
add_action('wp_ajax_my_action', [$this, 'my_action']);
add_action('wp_ajax_nopriv_my_action', [$this, 'my_action']);
```

Then add the method:

```php
public function my_action() {
  if (!wp_verify_nonce($_POST['nonce'], 'theme_nonce')) {
    wp_die('Security check failed');
  }
  $data = sanitize_text_field($_POST['data'] ?? '');
  wp_send_json_success(['result' => $data]);
}
```

Nonce and ajaxurl are already on the frontend: `themeAjax.nonce`, `themeAjax.ajaxurl`.

## Adding a Flexible Content section

1. Create `flexible-content-parts/my-section.php`
2. Use `get_sub_field()` to pull ACF data
3. In the template, loop like this:

```php
if (have_rows('flexible_content')) {
  while (have_rows('flexible_content')) {
    the_row();
    get_template_part('flexible-content-parts/' . get_row_layout());
  }
}
```

---

## SCSS breakpoints

```scss
@include respond(xs)  { } // max 480px
@include respond(sm)  { } // max 640px
@include respond(md)  { } // max 768px
@include respond(lg)  { } // max 1024px
@include respond(xl)  { } // max 1280px
@include respond(2xl) { } // min 1536px
```

## JS utils

```js
import { g, toggle, screen, scroll } from '@utils/function';

g('.selector')      // querySelector or querySelectorAll depending on matches
toggle(el, 'cls')   // classList.toggle
screen('phone')     // returns true if viewport >= 640px
scroll()            // scroll progress 0–100%
```

---

## Tests

```bash
composer install
composer test
```

Covers `clsx()` and `cleanContent()` — pure PHP, no WordPress needed to run. Add more to `tests/HelpersTest.php`.

---

## Build commands

| Command | What it does |
|---|---|
| `npm run watch` | Dev mode, watches for changes |
| `npm run build` | Production — minified, no console.log |
| `npm run format` | Runs Prettier on everything |
| `npm run format:check` | Prettier check without writing (used in CI) |
| `npm run images` | Compresses images in `/assets/` with Sharp |
| `npm run zip` | Zips the theme for deployment |

## Webpack bundles

| Output | Source | Used for |
|---|---|---|
| `dist/js/index.min.js` | `src/js/client/client.js` | Frontend |
| `dist/css/index.min.css` | All SCSS files auto-discovered | Styles |
| `dist/js/admin.min.js` | `src/js/admin/index.ts` | WP admin |
| `dist/js/login.min.js` | `src/js/login/index.ts` | Login page |

SCSS files are auto-imported — just drop a new `.scss` file in `src/scss/` and it's picked up on the next build. `mixins.scss` is always loaded first.

---

## ACF

Field groups live in `/acf-json/` and are versioned in git. Any time you add or change a field in the WP admin — commit the `acf-json/` folder.

Options page is at **Theme settings → General theme settings** in the WP admin sidebar.

---

## CI/CD

Push to `staging` → deploys automatically in ~10 sec.

Branch naming: `type/QI-123`
PR title: `QI-123: TYPE: Summary`
Commit: `QI-123: short summary`
