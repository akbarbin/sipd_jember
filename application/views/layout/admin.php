<!DOCTYPE HTML>
<!--[if lt IE 7 ]><html class="no-js ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="no-js ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title><?php echo isset($title) ? 'SIPD Kab. Jember - ' . $title : 'SIPD Kab. Jember'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="description" content="SIPD (Sistem Informasi Profil Daerah) Jember">
    <meta name="author" content="Mahendri Winata (mahen.0112@gmail.com)">

    <?php
    echo css(array(
        'bootstrap.min',
        'bootstrap-responsive.min',
        'style',
        'admin',
        'docs',
        'jquery.jqplot.min',
        '../js/syntaxhighlighter/styles/shCoreDefault.min',
        '../js/syntaxhighlighter/styles/shThemejqPlot.min',
        'colorbox/colorbox',
    ));
    ?>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <?php echo js(array('html5shiv')); ?>
    <?php echo css(array('ie')); ?>
    <![endif]-->

    <!-- Fav and touch icons -->
    <?php echo link_tag(base_url() . 'webroot/img/favicon.png', 'shortcut icon', 'image/ico'); ?>

    <?php
    echo js(array(
        'modernizr.custom',
        'jquery-1.10.1.min',
//        'jquery-ui-1.8.16.custom.min',
        'bootstrap.min',
        'jquery.cleditor.min',
        'jquery.jqplot.min',
        'syntaxhighlighter/scripts/shCore.min',
        'syntaxhighlighter/scripts/shBrushJScript.min',
        'syntaxhighlighter/scripts/shBrushXml.min',
        'chart/jqplot.barRenderer.min',
        'chart/jqplot.highlighter.min',
        'chart/jqplot.cursor.min',
        'chart/jqplot.pointLabels.min',
//        'ckeditor/ckeditor',
        'jquery.colorbox-min',
        'uniform.jquery',
        'custom-script',
    ));
    ?>
  </head>

  <body>
    <?php echo bootstrap_alert($this->session->flashdata('message'), 'right'); ?>

    <?php $this->load->view('element/admin/top_menu'); ?>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3 well">
          <?php $this->load->view('element/admin/sidebar'); ?>
        </div>
        <div class="span9 well">
          <?php echo bootstrap_breadcrumb($controller, $action); ?>
          <?php $this->load->view(isset($content) ? $content : $this->router->directory . '/' . $this->router->class . '/' . $this->router->method); ?>
        </div>
      </div>

    </div>
    <?php $this->load->view('element/content/footer'); ?>

  </body>
</html>
