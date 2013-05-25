<?php echo bootstrap_alert($this->session->flashdata('message'), 'center'); ?>

<div class="container">

  <?php echo form_open('user/login', array('class' => 'form-signin')) ?>
  <h2 class="form-signin-heading">Please sign in</h2>
  <?php echo form_input('username', NULL, 'placeholder="Username" class="input-block-level"'); ?>
  <?php echo form_password('password', NULL, 'placeholder="Password" class="input-block-level"'); ?>
  <label class="checkbox">
    <?php echo form_checkbox('remember_me', 'remember-me', FALSE); ?>
    Remember me
  </label>
  <?php echo form_submit('login', 'Login', 'class="btn btn-large btn-primary"'); ?>
  <?php echo form_close(); ?>

</div>
