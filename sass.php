<?php
/*
MIT-LICENSE

Copyright (c) 2009-2011 Roy Tomeij

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

/**
 * @package Sass
 * @author Roy Tomeij
 * @version 1.2
 */
/*
Plugin Name: Sass for Wordpress
Plugin URI: http://www.roytomeij.com/
Description: "Sass for Wordpress" enables you to use Sass (Syntactically Awesome StyleSheets, http://sass-lang.com/) and Compass in your Wordpress project.
Author: Roy Tomeij
Version: 1.1
Author URI: http://www.roytomeij.com/
*/

function sass($path)
{
  // Determine filenames and paths.
  $parts = explode('/', $path);
  $filename = str_replace(array('.sass', '.scss'), '.css', $parts[count($parts)-1]);
  $path = TEMPLATEPATH . '/' . $path;
  $config_filename = TEMPLATEPATH . '/config.rb';

  if (!file_exists($path))
  {
    output_error($filename, 'File ' . $path . ' does not exist.');
    return get_bloginfo('template_directory') . '/' . $filename;
  }

  // Create config.rb for Compass if it doesn't exist yet.
  if (!file_exists($config_filename)) {
    exec('compass config ' . escapeshellarg($config_filename) . ' --sass-dir=. --css-dir=.');
  }

  // If the CSS doesn't exist or is too old, compile.
  if (!file_exists(TEMPLATEPATH . '/' . $filename) || filemtime(TEMPLATEPATH . '/' . $filename) < filemtime($path))
  {
    @unlink($filename);
    exec('compass compile ' . escapeshellarg($path));
  }

  return get_bloginfo('template_directory') . '/' . $filename;
}

// This function throws an error by using the CSS ':before' pseudo-element.
function output_error($filename, $error)
{
  @unlink($filename);
  file_put_contents(TEMPLATEPATH . '/' . $filename, 'body:before { white-space: pre; font-family: monospace; content: "Sass for Wordpress error: ' . str_replace('"','\"', $error) . '"; }');
}

?>