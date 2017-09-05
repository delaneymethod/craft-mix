<p align="center">
  <img src="https://cdn.rawgit.com/delaneymethod/craft-mix/master/craft-mix-logo.svg" alt="Craft Mix Logo">
</p>

<p align="center">
  Helper plugin for <a href="https://github.com/JeffreyWay/laravel-mix/">Laravel Mix</a> in <a href="https://github.com/craftcms/cms/">Craft CMS</a> templates.
</p>

<p align="center">
  <a href="https://packagist.org/packages/delaneymethod/craft-mix">
    <img src="https://poser.pugx.org/delaneymethod/craft-mix/d/total.svg" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/delaneymethod/craft-mix">
    <img src="https://poser.pugx.org/delaneymethod/craft-mix/v/stable.svg" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/delaneymethod/craft-mix">
    <img src="https://poser.pugx.org/delaneymethod/craft-mix/license.svg" alt="License">
  </a>
</p>

## Requirements

This plugin requires Craft CMS 3.0.0-beta.20 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        `cd /path/to/project`

2. Then tell Composer to load the plugin:

        `composer require delaneymethod/craft-mix`

3. In the Control Panel, go to Settings → Plugins and click the "Install" button for <strong>Craft Mix</strong>.

4. Create a `package.json` file with the following contents to install Laravel Mix dependencies and configure asset build tasks.

```json
{
	"private": true,
	"scripts": {
		"dev": "npm run development",
		"development": "cross-env NODE_ENV=development node_modules/webpack/bin/webpack.js --progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js",
		"watch": "cross-env NODE_ENV=development node_modules/webpack/bin/webpack.js --watch --progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js",
		"watch-poll": "npm run watch -- --watch-poll",
		"hot": "cross-env NODE_ENV=development node_modules/webpack-dev-server/bin/webpack-dev-server.js --inline --hot --config=node_modules/laravel-mix/setup/webpack.config.js",
		"prod": "npm run production",
		"production": "cross-env NODE_ENV=production node_modules/webpack/bin/webpack.js --progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js"
	},
	"devDependencies": {
		"cross-env": "^3.2.3",
		"laravel-mix": "^0.10.0",
		"node-sass": "^4.5.3"
	}
}
```

Install the Node.js dependencies using `npm` or `yarn`.

```bash
npm install # OR yarn install
```

## Configuration

To demonstrate usage of the plugin, let's imagine a project with the following directory structure.

```
...
assets/
  js/
    global.js
  scss/
    global.scss
web/
  assets/
    js/
    css/
...
```

Create a `webpack.mix.js` file at the root of your project to configure Laravel Mix for building your assets. See the [Laravel Mix](https://laravel.com/docs/5.5/mix) documentation for configuration details and more options. Be sure to configure the `publicPath` option to point at the directory from which you will serve static assets (images, fonts, javascript and CSS). Here's an example configuration as a starting point that would work with the previously described project structure:

```js
const del = require('del');
const { mix } = require('laravel-mix');

del(['web/assets/**', '!web/assets']);

mix.setPublicPath('web');

if (mix.inProduction) {
    mix.disableNotifications();
}

if (!mix.inProduction) {
	mix.sourceMaps();
}

mix.options({
	processCssUrls: false
});

mix.sass('assets/sass/global.scss', 'web/assets/css/global.css');

mix.js('assets/js/global.js', 'web/assets/js/global.js');

mix.copy('assets/fonts', 'web/assets/fonts');

mix.copy('assets/img', 'web/assets/img');

mix.version();
```

## Usage

The primary purpose of this plugin is to provide template helpers that translate between a known path to your build assets and the real path to the assets after they have been built (which varies depending on the build mode). There are three main ways you can use Mix from Twig templates in CraftCMS:

```twig
{# Twig Filter #}
<script type="text/javascript" src="{{ 'assets/js/global.js' | mix }}"></script>

{# Twig Function #}
<script type="text/javascript" src="{{ mix('assets/js/global.js') }}"></script>

{# CraftCMS Variable #}
<script type="text/javascript" src="{{ craft.mix.getAssetPath('assets/js/global.js') }}"></script>

{# Twig Filter #}
<link rel="stylesheet" href="{{ 'assets/css/global.css' | mix }}">

{# Twig Function #}
<link rel="stylesheet" href="{{ mix('assets/css/global.cs') }}">

{# CraftCMS Variable - Lazy load a versioned file and build the tag based on the file extension. #}
{{ '{{ craft.mix.withTag(\'assets/css/global.css\') | raw }}' | e }}

{# CraftCMS Variable - Load the content of a versioned file inline. #}
{{ '{{ craft.mix.withTag(\'assets/css/global.css\', true) | raw }}' | e }}
```

There are a handful of different modes in which you can run Mix and the plugin will work differently in each mode, as described in the following sections.

### Dev Mode

Dev mode will build your assets to target a development environment. Depending on how you've configured Mix, this may bypass certain build instructions intended only for the production environment. In the example `webpack.mix.js` file, we are only versioning assets in production mode for cache busting or similar use cases. You can build the assets for developer mode by using the `npm` script we added in our `package.json` file:

```bash
npm run dev
```

This will generate the following files in our example project structure:

```
web/
  assets/
    mix.js
    mix-manifest.json
    css/
      global.css
    js/
      global.js
```

You can then use the Twig helpers from this plugin in your templates to load the assets from the `mix-manifest.json` file:
 
```twig
<link rel="stylesheet" href="{{ mix('assets/css/global.css') }}">
...
<script type="text/javascript" src="{{ mix('assets/js/global.js') }}"></script>
```

Yields

```twig
<link rel="stylesheet" href="/assets/css/global.css">
...
<script type="text/javascript" src="/assets/js/global.js"></script>
```

### Watch Mode

Functions just like Dev Mode except Mix will continue running as a foreground process through NodeJS and building assets as changes to the source files are detected.

```bash
npm run watch
```

### Hot Module Replacement Mode

Builds your assets and runs the Webpack dev server to allow [Hot Module Replacement](https://webpack.js.org/concepts/hot-module-replacement/). It works very similarly to what is described in the [Laravel Mix](https://github.com/JeffreyWay/laravel-mix/blob/master/docs/hot-module-replacement.md) documentation. To run in HMR mode, run the following command:

```bash
npm run hot
```

You can then use the Twig helpers from this plugin in your templates to load the assets from the Webpack dev server (running at `//localhost:8080`):
 
```twig
<link rel="stylesheet" href="{{ mix('assets/css/global.css') }}">
...
<script type="text/javascript" src="{{ mix('assets/js/global.js') }}"></script>
```

Yields

```twig
<link rel="stylesheet" href="//localhost:8080/assets/css/global.css">
...
<script type="text/javascript" src="//localhost:8080/assets/js/global.js"></script>
```

### Production Mode

or bundle your assets for production

```bash
npm run production
```

This will generate the following files in our example project structure:

```
web/
  assets/
    mix-manifest.json
    css/
      global.css
    js/
      global.js
```

You can then use the Twig helpers from this plugin in your templates to load the assets from the `mix-manifest.json` file:
 
```twig
<link rel="stylesheet" href="{{ mix('assets/css/global.css') }}">
...
<script type="text/javascript" src="{{ mix('assets/js/global.js') }}"></script>
```

Yields

```twig
<link rel="stylesheet" href="/assets/css/global.css?id=3b3bff1760a5005737de">
...
<script type="text/javascript" src="/assets/js/global.js?id=5f474c7493fb1b375dca"></script>
```

## Credits

* [Sean Delaney](https://github.com/seandelaney)

## About DelaneyMethod

DelaneyMethod are a Full-Stack Web Development Agency with a no-nonsense, get it done attitude with a proven track record for delivering their part of a project. Learn more about us on [our website](http://www.delaneymethod.com).

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
