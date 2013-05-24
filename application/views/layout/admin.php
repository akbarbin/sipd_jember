<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo isset($title) ? $title : 'SIPD Jember'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php
    $this->minify->css_file = 'application.min.css';
    $this->minify->assets_dir = 'webroot';
    $this->minify->css(array(
        'bootstrap.min',
        'bootstrap-responsive.min',
        'style',
        'admin'));
    echo $this->minify->deploy_css(false);
    ?>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <?php echo js(array('html5shiv')) ?>
    <![endif]-->

    <!-- Fav and touch icons -->
    <?php echo link_tag(base_url() . 'webroot/img/favicon.png', 'shortcut icon', 'image/ico'); ?>

    <?php
    $this->minify->js_file = 'application.min.css';
    $this->minify->assets_dir = 'webroot';
    $this->minify->js(array(
        'jquery.min',
        'bootstrap.min',
        'scripts'));
    echo $this->minify->deploy_js(false);
    ?>
  </head>

  <body>
    <?php $this->load->view('element/content/session_flash_right'); ?>

    <?php $this->load->view('element/admin/top_menu'); ?>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3 well">
          <?php $this->load->view('element/admin/sidebar'); ?>
        </div>
        <div class="span9 well">
          <?php $this->load->view(isset($content) ? $content : $this->router->directory . '/' . $this->router->class . '/' . $this->router->method); ?>
        </div>
      </div>

      <?php $this->load->view('element/admin/footer'); ?>
    </div>

  </body>
</html>
