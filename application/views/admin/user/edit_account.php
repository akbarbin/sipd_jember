<?php echo form_open('user/edit_account', array('class' => 'form-horizontal')) ?>
<div class="control-group">
  <label class="control-label" for="name">Nama</label>
  <div class="controls">
    <input type="text" class="span6" id="name" name="name" placeholder="Nama" value="<?php echo set_value('name', $user->name); ?>">
    <?php echo form_error('name', '<p class="field_error">', '</p>'); ?>
  </div>
</div>
<div class="control-group">
  <label class="control-label" for="address">Alamat</label>
  <div class="controls">
    <textarea class="span8" id="address" rows="6" name="address"><?php echo set_value('address', $user->address); ?></textarea>
    <?php echo form_error('name', '<p class="field_error">', '</p>'); ?>
  </div>
</div>
<div class="control-group">
  <label class="control-label" for="phone">Telepon</label>
  <div class="controls">
    <input type="text" class="span6" id="phone" name="phone" placeholder="Telepon" value="<?php echo set_value('phone', $user->phone); ?>">
    <?php echo form_error('phone', '<p class="field_error">', '</p>'); ?>
  </div>
</div>
<div class="control-group">
  <label class="control-label" for="fax">Faximile</label>
  <div class="controls">
    <input type="text" class="span6" id="fax" name="fax" placeholder="Faximile" value="<?php echo set_value('fax', $user->fax); ?>">
    <?php echo form_error('fax', '<p class="field_error">', '</p>'); ?>
  </div>
</div>
<div class="control-group">
  <label class="control-label" for="email">Email</label>
  <div class="controls">
    <input type="email" class="span6" id="name" name="email" placeholder="Email" value="<?php echo set_value('email', $user->email); ?>">
    <?php echo form_error('email', '<p class="field_error">', '</p>'); ?>
  </div>
</div>
<div class="control-group">
  <label class="control-label" for="website">Website</label>
  <div class="controls">
    <input type="text" class="span6" id="name" name="website" placeholder="Website" value="<?php echo set_value('website', $user->website); ?>">
    <?php echo form_error('website', '<p class="field_error">', '</p>'); ?>
  </div>
</div>
<div class="control-group">
  <div class="controls">
    <button type="submit" class="btn">Simpan</button>
  </div>
</div>
<?php echo form_close(); ?>