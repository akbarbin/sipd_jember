<!DOCTYPE HTML>
<!--[if IE 8]> <html class="ie8 no-js"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta name="description" content="SIPD (Sistem Informasi Profil Daerah) Jember">
    <meta name="author" content="Mahendri Winata (mahen.0112@gmail.com)">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php
    echo css(array(
        'style',
        'responsive',
        'colors/blue',
//        '../style-switcher/style-switcher'
    ));
    ?>

    <!--[if IE]> 
    <?php echo css(array('ie')); ?>
    <![endif]-->

    <?php echo link_tag(base_url() . 'webroot/img/favicon.png', 'shortcut icon', 'image/ico'); ?>

    <?php
    echo js(array(
        'jquery-1.8.2.min',
        'ie',
        'jquery.easing.1.3',
        'modernizr.custom',
//        '../style-switcher/style-switcher',
        'ddlevelsmenu',
        'tinynav.min',
        'jquery.validate.min',
        'jquery.flexslider-min',
        'jquery.jcarousel.min',
        'jquery.ui.totop.min',
        'jquery.fitvids',
        'jquery.tweet',
        'revslider.jquery.themepunch.plugins.min',
        'jquery.tipsy',
        'jquery.fancybox.pack',
        'jquery.fancybox-media',
        'froogaloop.min',
        'custom'
    ));
    ?>
    <!--[if IE 8]>
    <?php
    echo js(array(
        'respond.min',
        'selectivizr-min'
    ));
    ?>
    <![endif]--> 

    <script type="text/javascript">
      ddlevelsmenu.setup("nav", "topbar");
    </script>

    <title><?php echo isset($title) ? 'SIPD Kab. Jember - ' . $title : 'SIPD Kab. Jember'; ?></title>
  </head>

  <body class="boxed">
    <div id="wrap">
      <header id="header" class="container clearfix">
        <?php $this->load->view('element/default/top_menu'); ?>
      </header>

      <section id="page-title">
        <div class="container clearfix">
        </div>
      </section>

      <section id="content" class="container clearfix">
        <?php $this->load->view('element/default/sidebar'); ?>

        <?php $this->load->view(isset($content) ? $content : $this->router->class . '/' . $this->router->method); ?>
      </section>

      <?php $this->load->view('element/default/footer'); ?>

    </div>
  </body>
</html>