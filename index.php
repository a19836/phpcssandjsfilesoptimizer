<?php
/*
 * Copyright (c) 2025 Bloxtor (http://bloxtor.com) and Joao Pinto (http://jplpinto.com)
 * 
 * Multi-licensed: BSD 3-Clause | Apache 2.0 | GNU LGPL v3 | HLNC License (http://bloxtor.com/LICENSE_HLNC.md)
 * Choose one license that best fits your needs.
 *
 * Original PHP CSS and JS Files Optimizer Repo: https://github.com/a19836/phpcssandjsfilesoptimizer/
 * Original Bloxtor Repo: https://github.com/a19836/bloxtor
 *
 * YOU ARE NOT AUTHORIZED TO MODIFY OR REMOVE ANY PART OF THIS NOTICE!
 */
?>
<style>
h1 {margin-bottom:0; text-align:center;}
h5 {font-size:1em; margin:40px 0 10px; font-weight:bold;}
p {margin:0 0 20px; text-align:center;}

.note {text-align:center;}
.note span {text-align:center; margin:0 20px 20px; padding:10px; color:#aaa; border:1px solid #ccc; background:#eee; display:inline-block; border-radius:3px;}
.note li {margin-bottom:5px;}

.code {display:block; margin:10px 0; padding:0; background:#eee; border:1px solid #ccc; border-radius:3px; position:relative;}
.code:before {content:"php"; position:absolute; top:5px; left:5px; display:block; font-size:80%; opacity:.5;}
.code textarea {width:100%; height:300px; padding:30px 10px 10px; display:inline-block; background:transparent; border:0; resize:vertical; font-family:monospace;}
</style>
<h1>PHP CSS and JS Files Optimizer</h1>
<p>Group and minify css and js files before sending them to browser</p>
<div class="note">
		<span>
		This library improves frontend performance by automatically optimizing, grouping, and minimizing CSS and JavaScript files in your HTML output.<br/>
		<br/>
		This library analyzes HTML content, detects locally referenced CSS and JavaScript files, and combines them into optimized bundles. By reducing the number of HTTP requests and minimizing file sizes, it significantly improves page load times and overall application performance.<br/>
		<br/>
		With this library, you can:<br/>
		<ul style="display:inline-block; text-align:left;">
			<li>Parse HTML content and automatically detect `&lt;link>` and `&lt;script>` tags.</li>
			<li>Identify **local CSS and JS files** and exclude external or unwanted URLs.</li>
			<li>Combine multiple CSS files into a single optimized stylesheet.</li>
			<li>Combine multiple JavaScript files into a single optimized script.</li>
			<li>Minify CSS and JavaScript content to reduce file size.</li>
			<li>Generate cached optimized files inside a web-accessible cache directory.</li>
			<li>Automatically inject optimized CSS and JS references back into the HTML.</li>
			<li>Allow fine-grained control over which URLs should be optimized or ignored.</li>
			<li>Reuse cached optimized files to avoid unnecessary recomputation.</li>
		</ul>
		<br/>
		This process drastically reduces the number of requests the browser needs to make, improving load speed and performance.
		</span>
</div>

<div>
	<h5>Usage</h5>
	<div class="code">
		<textarea readonly>
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
		</textarea>
	</div>
</div>
