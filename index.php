<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>WPP generator (version - 5.4.1) - boilerplate for your best WordPress plugin</title>

  <meta property="og:title" content="WPP generator - boilerplate for your best WordPress plugin" />
  <meta name="twitter:title" content="WPP generator - boilerplate for your best WordPress plugin" />

  <meta name="description" content="When I want to create a new WordPress plugin I always use a WPP generator (wordpress empty plugin) to start with. This saves a lot of time and allows me to avoid a large part of the routine work." />
  <meta property="og:description" content="When I want to create a new WordPress plugin I always use a WPP generator (wordpress empty plugin) to start with. This saves a lot of time and allows me to avoid a large part of the routine work." />
  <meta name="twitter:description" content="When I want to create a new WordPress plugin I always use a WPP generator (wordpress empty plugin) to start with. This saves a lot of time and allows me to avoid a large part of the routine work." />

  <meta name="keywords" content="skeleton plugin in wordpress,wordpress blank plugin,wordpress empty plugin,WordPress Starter plugin,boilerplate plugin,starter plugin,plugin template,WordPress Plugin Creator" />

  <link rel="stylesheet" href="access/css/bootstrap.min.css" />
  <link rel="stylesheet" href="access/css/style.css?v=2" />

</head>

<body>

  <div class="container border border-left-0 border-top-0 border-right-0 border-primary">
    <div class="row">
      <div class="col-md-12">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">

          <a class="navbar-brand" href="https://markomaksym.com.ua/wp-plugin-skeleton-generator/"><b>WPP generator</b> version - 5.4.1 <small>(12/2/2023)</small></a>

        </nav>

      </div>
    </div>
  </div>

  <div class="container mt-5">

    <div class="text-center mb-5">
      <h1><span class="text-primary">WPP generator</span> - boilerplate for your best WordPress plugin</h1>
      <p>To create a WordPress Plugin Boilerplate, fill out the fields below</p>
    </div>

    <div class="row">
      <div class="col-md-12 order-md-1">
        <h4 class="mb-3">Required Fields</h4>
        <form class="needs-validation" id="mxFormCreateSkeleton">
          <div class="row">
            <div class="col-md-12">
              <label for="pluginName">Plugin name:</label>
              <input type="text" class="form-control" id="pluginName" name="plugin_name" placeholder="" value="" />

              <div class="invalid-feedback">
                Valid plugin name is required.
              </div>

              <small>This is a very important field. <b>Use only English words!</b> Using the "plugin name" WPP generator will create a unique string for all the PHP classes and functions. It is recommended to fill in at least 3 words. (eg. Super Car Plugin - the unique string in this case will be scp_...). You can change the plugin name later in your main plugin file and readme.txt file.</small>
            </div>

            <div class="col-md-12 mt-3">
              <label for="briefDescription">Brief description:</label>
              <textarea class="form-control" rows="5" id="briefDescription" name="brief_description">This is my extremely useful plugin</textarea>
              <div class="invalid-feedback">
                Valid brief description is required.
              </div>
              <div class="mx-min_length"></div>
            </div>

            <div class="col-md-12 mt-3">
              <label for="longDescription">Long description:</label>
              <textarea class="form-control" rows="5" id="longDescription" name="long_description">This is my extremely useful WordPress plugin. It will make a lot of people happy</textarea>
              <div class="invalid-feedback">
                Valid long description is required.
              </div>
              <div class="mx-min_length"></div>
            </div>

            <div class="col-md-12 mt-3">
              <label for="contributors">Contributors <span class="text-muted">(this should be a list of wordpress.org user id's)</span>:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="contributors" name="contributors" placeholder="Contributors" />
                <div class="invalid-feedback" style="width: 100%;">
                  Your contributors is required.
                </div>
              </div>
            </div>

            <div class="col-md-12 mt-3">
              <label for="pluginURI">Plugin URI <span class="text-muted">(example: https://github.com/Maxim-us/wp-plugin-skeleton)</span>:</label>
              <input type="url" class="form-control" id="pluginURI" name="plugin_uri" placeholder="" value="" />
              <div class="invalid-feedback">
                Valid plugin URI is required.
              </div>
              <small>Plugin URI is a URL of a web page with detailed information about your plugin. If you don't have a website with your plugin, please provide any URL (you can always change it in the future).</small>
            </div>

            <div class="col-md-12 mt-3">
              <label for="author">Author <span class="text-muted">(example: Maksym Marko)</span>:</label>
              <input type="text" class="form-control" id="author" name="author" placeholder="" value="" />
              <div class="invalid-feedback">
                Valid Author is required.
              </div>
            </div>

            <div class="col-md-12 mt-3">
              <label for="authorURI">Author URI <span class="text-muted">(example: https://github.com/Maxim-us)</span>:</label>
              <input type="url" class="form-control" id="authorURI" name="author_uri" placeholder="" value="" />
              <div class="invalid-feedback">
                Valid Author URI is required.
              </div>
              <small>Author URI is a URL of your website, Github profile or social media profile.</small>
            </div>

          </div>

          <hr class="mb-4">

          <button class="btn btn-primary float-right mx-submit-button" type="submit">Create Plugin Boilerplate</button>

          <div class="btn btn-primary float-right mx-spinner-wrapper" style="display:none;">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>


        </form>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-md-12">

        <h2 class="mb-4">About WPP generator</h2>

        <p>
          Stable version: <b>5.4.1</b> <br>
          Tested up to WordPress: <b>6.4</b>
        </p>

        <p>
          When I want to create a new WordPress plugin I always use the <b>WPP generator</b> (wordpress starter kit plugin) to start with. This saves a lot of time and allows me to avoid a large part of the routine work.
        </p>
        <p>
          To quickly get a starter set for any WordPress plugin, I created the <b>WPP generator - Wordpress plugin skeleton generator</b>.
        </p>
        <p>
          This framework gives a much wider starter functionality and a set of necessary files to start working then most of existing starter kits.
        </p>

      </div>
    </div>

    <div class="row mt-5">
      <div class="col-md-12">

        <h2 class="mb-4">How to use the WPP generator</h2>

        <p>
          <i><b>1. Generate plugin skeleton</b></i> <br>
          WPP generator will generate the skeleton files needed for any WordPress plugin. The full functionality of the plugin can be accessed either via a web interface.
          <br>
          To generate a plugin skeleton for WordPress go to <a href="https://markomaksym.com.ua/wp-plugin-skeleton-generator/#top">https://markomaksym.com.ua/wp-plugin-skeleton-generator/</a>. Fill in all the fields and click the "Create Plugin Boilerplate" button.
        </p>
        <p>
          <i><b>2. Installation</b></i> <br>
          This starter plugin has been tested to work with WordPress 5.9 and newer.
          <br>
          General installation procedures are those common for all WordPress plugins:
        <ul>
          <li>
            download the plugin template zip archive;
          </li>
          <li>
            upload the archive to the "Plugins" section of your website;
          </li>
          <li>
            click the "Activate" button.
          </li>
        </ul>
        </p>
        <p>
          <i><b>3. Features</b></i> <br>
          Your boilerplate plugin will included:
        <ul>
          <li>
            Basic install and uninstall, activate and deactivate plugin hooks;
          </li>
          <li>
            During the generation of a new WordPress Plugin boilerplate, all the PHP classes and functions will be rewritten with a unique string created using your plugin name;
          </li>
          <li>
            Ability to separate your code to admin and frontend folders;
          </li>
          <li>
            Admin menu items and ability to create unlimited number of admin pages;
          </li>
          <li>
            Custom Post Type (ability to create a new post type and add new posts);
          </li>
          <li>
            Metaboxes examples (text, number, select, checkboxes, radio buttons, textarea, image upload);
          </li>
          <li>
            Custom database table creation;
          </li>
          <li>
            AJAX request examples;
          </li>
          <li>
            admin_enqueue_scripts, wp_enqueue_scripts and wp_localize_script examples;
          </li>
          <li>
            Custom table with search box, bulk actions, sorting, editing, remove, restore features (example how to extend WP_List_Table basic WordPress table framework);
          </li>
          <li>
            A set of examples of banners, icons, screenshots, readme.txt and license.txt files needed for uploading your plugin to the WordPress.org directory;
          </li>
          <li>
            The plugin boilerplate template has been designed to be easily expanded by adding new features;
          </li>
          <li>
            Gutenberg blocks:
            <ul>              
              <li> Server Side Rendering</li>
              <li> Simple Text</li>
              <li> Simple Image</li>
              <li> Image Section</li>
              <li> Nested blocks</li>
              <li> Counter Section</li>
              <li> Content Slider</li>
              <li> Full width section</li>
              <li> Responsive spacer</li>
            </ul>
          </li>
          <li>
            Added Vue.js v2.7.14 and example;
          </li>
          <li>
            Added shortcode example;
          </li>
          <li>
            You can easily minify your JS code for production.
          </li>
          <li>
            Added an example of block expansion. Now you can add metadata to paragraph, title and button.
          </li>

        </ul>
        </p>

      </div>
    </div>

    <div class="row mt-5">
      <div class="col-md-12">

        <p class="lead">
          Here you can find a list of plugins created using the WPP generator and hosted in the WordPress.org plugin directory:
          <a href="https://profiles.wordpress.org/markomaksym/#content-plugins" target="_blank">https://profiles.wordpress.org/markomaksym/#content-plugins</a>
        </p>

      </div>
    </div>

    <div class="row mt-5">
      <div class="col-md-12">

        <p class="lead">
          WPP Generator Video Guide:
          <a href="https://www.youtube.com/watch?v=6PZbXBhxtN0&list=PLqb2a5jr0z4XRwroV3nA9nAe4596lPjxr" target="_blank">https://www.youtube.com/watch?v=6PZbXBhxtN0&list=PLqb2a5jr0z4XRwroV3nA9nAe4596lPjxr</a>
        </p>

      </div>
    </div>



    <footer class="mx-footer my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">© 2018 - 2023 WPP Generator</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="https://github.com/Maxim-us/wp-plugin-skeleton-generator" target="_blank">Github</a></li>
        <li class="list-inline-item"><a href="https://markomaksym.com.ua/" target="_blank">Marko Maksym</a></li>
      </ul>

      <?php $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>

      <div class="mx-download-plugin" data-curr-url="<?php echo $url; ?>">
        <a href="<?php echo $url; ?>" style="margin-top: -106px;">Close</a>
        <a href="#" class="mx-download-link" download>Download the <span></span> plugin.</a>
      </div>
    </footer>
  </div>


  <script src="access/js/jquery-3.3.1.min.js"></script>
  <script src="access/js/main.js?v=2"></script>

</body>

</html>