<?php
$error = $this->session->flashdata('message');
if (!empty($error)) {
  ?>
  <div id="error-message" style="display: none;">
    <div class="container-fluid">
      <div class="span3"></div>
      <div class="span6">
        <div class="alert alert-error">
          <span class="close" data-dismiss="alert">&times;</span>
          <strong>Error</strong>
          <?php echo $this->session->flashdata('message'); ?>
        </div>
      </div>
      <div class="span3"></div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#error-message").slideDown(800).delay(8000).slideUp(800);
    })
  </script>
  <?php
}
?>