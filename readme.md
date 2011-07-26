# Sass for Wordpress

"Sass for Wordpress" enables you to use Sass (Syntactically Awesome StyleSheets) in your Wordpress project.

## What does it do?

"Sass for Wordpress" enables you to use Sass ([Syntactically Awesome StyleSheets](http://sass-lang.com/)) in your Wordpress project. It has support for Sass and Scss.

## Installation

First, you need to have the Sass gem installed on your server to use the plugin. Please have a look at the Sass website for [installation instructions for Sass](http://sass-lang.com/download.html).

Second, your PHP version needs to be 5+ and shouldn't run in safe mode. We need to use the exec() function to run the command line tool to transform Sass into CSS (don't worry, we escape malicious input).

If you're sure you have done the above, you are ready to go (syntax below)!

Thanks to Marcus Cobde (https://github.com/leth) for his input.

## Changelog

### 1.1

After not maintaining this plugin for about two years I made it work on the latest Sass version (3.1.5) and WordPress version (3.2.1). It may still work on older versions, but this is what I tested with.

### 1.0

* Initial release.

## Usage/syntax

Simply refer to your Sass/Scss file by using the sass('filename') function. For instance, to use a style.sass file in your theme directory (which will be transformed into style.css), put this in your head:

`<link rel="stylesheet" href="<?php echo sass('style.sass'); ?>" type="text/css" media="screen" />`

This new version can handle sub-directories for your Sass, like:

`<link rel="stylesheet" href="<?php echo sass('stylesheets/style.scss'); ?>" type="text/css" media="screen" />`

The path should always be relative from your template directory. No matter the path, the generated CSS-file will always reside at `template_path/style.css`.