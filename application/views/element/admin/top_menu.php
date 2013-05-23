<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php echo anchor('admin/dashboard', 'SIPD Jember', array('class' => 'brand')); ?>
      <div class="nav-collapse collapse">
        <ul class="nav">
          <li>
            <?php echo anchor('admin/dashboard', 'Dashboard'); ?>
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Nilai Profil <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                <?php echo anchor('admin/tabular', 'Data Tabular'); ?>
              </li>
              <li>
                <?php echo anchor('admin/sub_district_tabular', 'Data Tabular Kecamatan'); ?>
              </li>
            </ul>
          </li>
          <li>
            <?php echo anchor('admin/user', 'Data User'); ?>
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Data Master <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                <?php echo anchor('admin/unit', 'Data Satuan'); ?>
              </li>
              <li>
                <?php echo anchor('admin/sub_district', 'Data Kecamatan'); ?>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="nav pull-right">
          <li class="divider-vertical">
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Administrator <strong class="caret"></strong></a>
            <ul class="dropdown-menu">
              <li>
                <?php echo anchor('admin/user/edit_account', 'Edit Kontak'); ?>
              </li>
              <li>
                <?php echo anchor('admin/user/change_password', 'Ganti Password'); ?>
              </li>
              <li class="divider">
              </li>
              <li>
                <?php echo anchor('user/logout', 'Keluar'); ?>
              </li>
            </ul>
          </li>
        </ul>

      </div>
    </div>
  </div>
</div>
