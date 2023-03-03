<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Create a WordPress plugin starter kit</title>

  <link rel="stylesheet" href="access/css/bootstrap.min.css" />
  <link rel="stylesheet" href="access/css/style.css" />

</head>

<body>

  <div class="container mt-5">
    <div class="text-center">
      <h2>Create a WordPress plugin starter kit</h2>
      <p class="lead">To create a WordPress plugin starter kit, fill out the fields below.</p>
      <p class="lead">This information will be included in your future plugin.</p>
    </div>

    <div class="row">
      <div class="col-md-12 order-md-1">
        <h4 class="mb-3">Required information</h4>
        <form class="needs-validation" id="mxFormCreateSkeleton">
          <div class="row">
            <div class="col-md-12">
              <label for="pluginName">Plugin name:</label>
              <input type="text" class="form-control" id="pluginName" name="plugin_name" placeholder="" value="" />
              <div class="invalid-feedback">
                Valid plugin name is required.
              </div>
            </div>

            <div class="col-md-12 mt-3">
              <label for="briefDescription">Brief description:</label>
              <textarea class="form-control" rows="5" id="briefDescription" name="brief_description"></textarea>
              <div class="invalid-feedback">
                Valid brief description is required.
              </div>
              <div class="mx-min_length"></div>
            </div>

            <div class="col-md-12 mt-3">
              <label for="longDescription">Long description:</label>
              <textarea class="form-control" rows="5" id="longDescription" name="long_description"></textarea>
              <div class="invalid-feedback">
                Valid long description is required.
              </div>
              <div class="mx-min_length"></div>
            </div>

            <div class="col-md-12 mt-3">
              <label for="contributors">Contributors <span class="text-muted">(this should be a list of wordpress.org userid's)</span>:</label>
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
            </div>

            <div class="col-md-12 mt-3">
              <label for="author">Author <span class="text-muted">(example: Marko Maksym)</span>:</label>
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
            </div>

          </div>

          <hr class="mb-4">

          <button class="btn btn-primary float-right" type="submit">Create a new skeleton of a plugin</button>

        </form>
      </div>
    </div>

    <footer class="mx-footer my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">© 2018 - 2023 WP Plugin Skeleton Generator</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="https://github.com/Maxim-us/wp-plugin-skeleton-generator" target="_blank">Github</a></li>
        <li class="list-inline-item"><a href="https://markomaksym.com.ua/" target="_blank">Marko Maksym</a></li>
      </ul>

      <?php $url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>

      <div class="mx-download-plugin" data-curr-url="<?php echo $url; ?>">
        <a href="<?php echo $url; ?>" style="margin-top: -106px;">Close</a>
        <a href="#" class="mx-download-link" download>Download the <span></span> plugin.</a>
      </div>
    </footer>
  </div>


  <script src="access/js/jquery-3.3.1.min.js"></script>
  <script src="access/js/main.js"></script>

</body>

</html>