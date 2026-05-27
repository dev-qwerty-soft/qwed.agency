const path = require('path');
const styles = require('./webpack/styles.js');
const TerserPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ImageMinimizerPlugin = require('image-minimizer-webpack-plugin');

module.exports = (_, env) => {
  styles();

  const isDev = env.mode !== 'production';

  const babel = {
    loader: 'babel-loader',

    options: {
      presets: ['@babel/preset-env', '@babel/preset-typescript'],
    },
  };

  return {
    entry: {
      index: './src/js/client/client.js',
      login: './src/js/login/index.ts',
      fonts: './src/js/fonts/index.ts',
      admin: './src/js/admin/index.ts',
      'case-ezk': './src/js/client/case-ezk/index.ts',
      'case-hashira-labs': './src/js/client/case-hashira-labs/index.ts',
      'case-part-pilot': './src/js/client/case-part-pilot/index.ts',
      'case-blue-jay': './src/js/client/case-blue-jay/index.ts',
      'case-imagine': './src/js/client/case-imagine/index.ts',
      'case-voipx3': './src/js/client/case-voipx3/index.ts',
      'case-cobble': './src/js/client/case-cobble/index.ts',
    },
    output: {
      filename: 'js/[name].min.js',
      path: path.resolve(__dirname, 'dist'),
      clean: true,
    },
    resolve: {
      alias: {
        '@utils': path.resolve(__dirname, 'src', 'js', 'utils'),
        '@client': path.resolve(__dirname, 'src', 'js', 'client'),
      },
      extensions: ['.tsx', '.ts', '.js', '.jsx', '.json'],
    },
    module: {
      rules: [
        {
          test: /\.tsx?$/,
          exclude: /node_modules/,
          use: [
            {
              loader: 'ts-loader',

              options: {
                configFile: 'tsconfig.json',

                transpileOnly: true,
              },
            },
            babel,
          ],
        },
        {
          test: /\.jsx?$/,
          exclude: /node_modules/,
          use: babel,
        },
        {
          test: /\.s[ac]ss$/i,
          exclude: /node_modules/,
          use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'sass-loader'],
        },
        {
          test: /\.css$/i,
          use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader'],
        },
        {
          test: /\.(woff(2)?|eot|ttf|otf|)$/,
          type: 'asset/resource',

          generator: {
            filename: 'fonts/font-[hash][ext]',
          },
        },
        {
          test: /\.(jpe?g|png|gif|svg|webp)$/i,
          type: 'asset/resource',

          generator: {
            filename: 'images/image-[hash][ext]',
          },
        },
      ],
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: 'css/[name].min.css',
      }),
    ],
    optimization: {
      minimize: true,
      minimizer: [
        new TerserPlugin({
          test: /\.[jt]sx?(\?.*)?$/i,
          terserOptions: {
            compress: {
              drop_console: !isDev,
              unused: true,
              dead_code: true,
              arguments: true,
              conditionals: true,
              evaluate: true,
            },
            mangle: {
              reserved: ['$', 'exports', 'require', 'module'],
            },
            format: {
              comments: false,
              beautify: false,
            },
          },
        }),
        new ImageMinimizerPlugin({
          minimizer: {
            implementation: ImageMinimizerPlugin.imageminGenerate,
            options: {
              plugins: [
                ['mozjpeg', { quality: 75, progressive: true }],
                ['pngquant', { quality: [0.65, 0.9], speed: 4 }],
                [
                  'svgo',
                  {
                    plugins: [
                      { name: 'removeViewBox', active: false },
                      { name: 'removeUselessStrokeAndFill', active: true },
                      { name: 'removeUnusedNS', active: true },

                      { name: 'collapseGroups', active: true },
                      { name: 'mergePaths', active: true },
                      {
                        name: 'addAttributesToSVGElement',
                        params: {
                          attributes: [{ xmlns: 'http://www.w3.org/2000/svg' }],
                        },
                      },
                    ],
                  },
                ],
              ],
            },
          },
        }),
      ],
    },
    devtool: isDev ? 'source-map' : false,
    performance: {
      hints: false,
    },
    watch: isDev,
  };
};
