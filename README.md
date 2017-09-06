# Kirby SEO & Open Graph Plugin Readme

![Version](https://img.shields.io/badge/version-1.0.1-green.svg) ![License](https://img.shields.io/badge/license-MIT-green.svg) ![Kirby Version](https://img.shields.io/badge/Kirby-2.5.5%2B-red.svg)

*Version 1.0.1*

Plugin for Kirby CMS to add seo relevant meta- and [open graph](http://ogp.me/) data to templates and blueprints, for easy editing these information via the kirby panel. Also adds the option for a robots.txt which can be altered through the config.

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


### 3. Config

Enable the plugin by adding the following to your `site/config/config.php`:

```php
c::set('seo', true);
```

## Usage

Once the snippets and blueprints are added, and the plugin is enabled in your `config.php`. You can edit the meta- and open graph data easily via the kirby panel for your enabled pages. The following fields can be edited:

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
// En/disable the whole plugin
//  - Disabled by default
c::set('seo', true);

// Show/hide HTML comments around the added snippets
//  - Disabled by default
c::set('seo.debug', false);

// Only en/disable output of the meta data snippet
//  - Enabled by default
c::set('seo.meta.disable', false);

// Only en/disable output of the open graph snippet
//  - Enabled by default
c::set('seo.opengraph.disable', false);

// You can define the og:type for specific templates here
// e.g. og:type=article for blog/newsposts
// leave it out and the default is used
//  - og:type=website by default
c::set('seo.ogtypes', [
    'newspost' => 'article',
    'blogpost' => 'article',
    'userpage' => 'profile'
]);

// En/disable robots.txt
// - Enabled by default
c::set('seo.robots.txt', true);

// You can even set the content yourself
c::set('seo.robots.txt', '
User-agent: *
Disallow: /
Sitemap: http://url.tld/sitemap.xml
');
```


## Changelog

**1.0.1**

- added robots.txt route

**1.0.0**

- Initial release

## Todo

- [ ] add XML Sitemap
- [ ] add support for JSON-LD 
- [x] add robots.txt route
- [x] Basic Meta Data
- [x] Open Graph Data

## Requirements

- [**Kirby**](https://getkirby.com/) 2.5.5+

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/l4ci/kirby-seo-og-plugin/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.
