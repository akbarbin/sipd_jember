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
        'style',
        'login'
    ));
    ?>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <?php echo js(array('html5shiv')) ?>
    <![endif]-->

    <!-- Fav and touch icons -->
    <?php echo link_tag(base_url() . 'webroot/img/favicon.png', 'shortcut icon', 'image/ico'); ?>

    <?php
    echo js(array(
        'jquery.min',
        'bootstrap.min',
        'scripts'
    ));
    ?>
  </head>

  <body>
    <?php $this->load->view('element/content/session_flash_center'); ?>

    <div class="container">

      <?php echo form_open('user/login', array('class' => 'form-signin')) ?>
      <h2 class="form-signin-heading">Please sign in</h2>
      <?php echo form_input('username', NULL, 'placeholder="Username" class="input-block-level"'); ?>
      <?php echo form_password('password', NULL, 'placeholder="Password" class="input-block-level"'); ?>
      <label class="checkbox">
        <?php echo form_checkbox('remember_me', 'remember-me', FALSE); ?>
        Remember me
      </label>
      <?php echo form_button('login', 'Login', 'class="btn btn-large btn-primary"'); ?>
      <?php echo form_close(); ?>

    </div>
  </body>
</html>
