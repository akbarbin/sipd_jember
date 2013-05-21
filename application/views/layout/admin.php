<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo isset($title) ? $title : 'SIPD Jember'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php
      echo css(array(
          'bootstrap.min',
          'bootstrap-responsive.min',
          'style'
      ));
    ?>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="img/favicon.png">

    <?php
    echo js(array(
        'jquery.min',
        'bootstrap.min',
        'scripts'
    ));
    ?>
  </head>

  <body>
    <div class="container-fluid">
      <?php $this->load->view('element/admin/header'); ?>

      <?php $this->load->view('element/admin/top_menu'); ?>

      <div class="row-fluid">
        <div class="span2 well">
          <?php $this->load->view('element/admin/sidebar'); ?>
        </div>
        <div class="span10 well">
          <?php $this->load->view(isset($content) ? $content : $this->router->class . '/' . $this->router->method); ?>
        </div>
      </div>

      <?php $this->load->view('element/admin/footer'); ?>

    </div>
  </body>
</html>
