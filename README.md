# PHP CSS and JS Files Optimizer

> Original Repos:   
> - PHP CSS and JS Files Optimizer: https://github.com/a19836/phpcssandjsfilesoptimizer/   
> - Bloxtor: https://github.com/a19836/bloxtor/

## Overview

**PHP CSS and JS Files Optimizer** is a PHP library designed to improve frontend performance by automatically optimizing, grouping, and minimizing CSS and JavaScript files in your HTML output.

This library analyzes HTML content, detects locally referenced CSS and JavaScript files, and combines them into optimized bundles. By reducing the number of HTTP requests and minimizing file sizes, it significantly improves page load times and overall application performance.

With this library, you can:
- Parse HTML content and automatically detect `<link>` and `<script>` tags.
- Identify **local CSS and JS files** and exclude external or unwanted URLs.
- Combine multiple CSS files into a single optimized stylesheet.
- Combine multiple JavaScript files into a single optimized script.
- Minify CSS and JavaScript content to reduce file size.
- Generate cached optimized files inside a web-accessible cache directory.
- Automatically inject optimized CSS and JS references back into the HTML.
- Allow fine-grained control over which URLs should be optimized or ignored.
- Reuse cached optimized files to avoid unnecessary recomputation.

To see a working example, open [index.php](index.php) on your server.

## How It Works

1. The optimizer scans the provided HTML content.
2. Local CSS and JS files are collected and filtered based on the configuration.
3. The contents of those files are merged and minified.
4. The optimized files are stored in a cache folder accessible by the browser.
5. The original HTML is updated to reference the optimized files instead of multiple individual assets.

This process drastically reduces the number of requests the browser needs to make, improving load speed and performance.

## Usage

```php
include __DIR__ . "/lib/CssAndJSFilesOptimizer.php";

//init optimizer
$webroot_cache_folder_path = __DIR__ . "/cache/"; //this folder must be accessible via browser
$webroot_cache_folder_url = "cache/"; //this is the correspondent url to access the $webroot_cache_folder_path via browser
$settings = array( //optional
	"urls_prefix" => "",
	"url_strings_to_avoid" => array("foo", "bar"),
);
$CssAndJSFilesOptimizer = new CssAndJSFilesOptimizer($webroot_cache_folder_path, $webroot_cache_folder_url, $settings = null);

//parse html and get all styles and scripts. then check if they are call local files and if they are, group them into 1 file, so the browser only needs to execute one request to the server.
$optimized_html = $CssAndJSFilesOptimizer->prepareHtmlWithOptimizedCssAndJSFiles($html, false);

//based on a array of css and js files, group them to only 1 file and return the correspondent html with that file. It minimizes the css and js contents too...
$css_files = array(
	"local file path" => "correspondent file url",
	//...
);
$js_files = array(
	"local file path" => "correspondent file url",
	//...
);
$optimized_css_js_html = $CssAndJSFilesOptimizer->getCssAndJSFilesHtml($css_files, $js_files);
$optimized_html = str_replace("</head>", "$optimized_css_js_html</head>", $optimized_html);

//print optimized html
echo $optimized_html;
```

