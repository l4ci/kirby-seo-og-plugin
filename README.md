# Kirby SEO & Open Graph Plugin Readme

![Version](https://img.shields.io/badge/version-1.0.0-green.svg) ![License](https://img.shields.io/badge/license-MIT-green.svg) ![Kirby Version](https://img.shields.io/badge/Kirby-2.5.5%2B-red.svg)

*Version 1.0.0*

Plugin for Kirby CMS to add seo relevant meta- and [open graph](http://ogp.me/) data to templates and blueprints, for easy editing these information via the kirby panel.

## Installation

Use one of the alternatives below.

### 1. Kirby CLI

If you are using the [Kirby CLI](https://github.com/getkirby/cli) you can install this plugin by running the following commands in your shell:

```
$ cd path/to/kirby
$ kirby plugin:install l4ci/kirby-seo-og-plugin
```

### 2. Clone or download

1. [Clone](https://github.com/l4ci/kirby-seo-og-plugin.git) or [download](https://github.com/l4ci/kirby-seo-og-plugin/archive/master.zip)  this repository.
2. Unzip the archive if needed and rename the folder to `plugin-name`.

**Make sure that the plugin folder structure looks like this:**

```
site/plugins/seo/
```

### 3. Git Submodule

If you know your way around Git, you can download this plugin as a submodule:

```
$ cd path/to/kirby
$ git submodule add https://github.com/l4ci/kirby-seo-og-plugin site/plugins/seo
```

## Setup

### 1. Blueprint

To make it work as expected, add the following code to your blueprints, where you want the meta and open graph data fields to show up in the panel.

```
fields:
  metadata:
    extends: metadata
  opengraph:
    extends: opengraph
```

### 2. Template

Add  `prefix="og: http://ogp.me/ns#"` to your `<html>` element. So it will look like this:

```
<html lang="en" prefix="og: http://ogp.me/ns#"
```

### 2. Snippet

Add the following code to your `header.php` snippet (or the fitting one) within your `<head>`.

```php
snippet('seo.meta');
snippet('seo.opengraph');
```

## Usage

Once the snippets and blueprints are added. You can edit meta- and open graph data easily via the kirby panel. The following fields can be edited:

**Meta fields:**

- Meta title
- Meta description
- Meta robots index/noindex
- Meta robots follow/nofollow

**Open Graph fields:**
- Open Graph title
- Open Graph description
- Open Graph image


## Options

The following options can be set in your `/site/config/config.php` file:

```php
// Show/hide HTML comments around the added snippets
c::set('seo.debug', false);

// En/disable output of the metadata snippet
c::set('seo.meta.disable', false);

// En/disable output of the opengraph snippet
c::set('seo.opengraph.disable', false);

// You can define the og:type for specific templates here
// where you dont want og:type=website to show
// e.g. og:type=article for blog/newsposts
// you can always just leave it out as well.
c::set('seo.ogtypes', [
    'newspost' => 'article',
    'blogpost' => 'article',
    'userpage' => 'profile'
]);
```


## Changelog

**1.0.0**

- Initial release

## Todo

- [ ] add XML Sitemap
- [x] Basic Meta Data
- [x] Open Graph Data

## Requirements

- [**Kirby**](https://getkirby.com/) 2.5.5

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/l4ci/kirby-seo-og-plugin/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.
