<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php echo anchor('admin/dashboard', 'SIPD Jember', array('class' => 'brand')); ?>
      <div class="nav-collapse collapse">
        <ul class="nav">
          <li>
            <?php echo anchor('sub_district/dashboard', '<i class="icon-home icon-white"></i> Dashboard'); ?>
          </li>
          <li class="dropdown">
            <?php echo anchor('#', '<i class="icon-align-left icon-white"></i> Tabular <b class="caret"></b>', 'data-toggle="dropdown" class="dropdown-toggle"'); ?>
            <ul class="dropdown-menu">
              <li>
                <?php echo anchor('sub_district/tabular_general', '<i class="icon-hdd"></i> Data Umum'); ?>
              </li>
              <li>
                <?php echo anchor('sub_district/tabular', '<i class="icon-list-alt"></i> Profil'); ?>
              </li>
              <li>
                <?php echo anchor('sub_district/tabular_performance', '<i class="icon-tasks"></i> Kinerja'); ?>
              </li>
            </ul>
          </li>
          <li>
            <?php echo anchor('sub_district/data_source', '<i class="icon-folder-open icon-white"></i> Sumber Data'); ?>
          </li>
        </ul>
        <ul class="nav pull-right">
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-lock icon-white"></i> <?php echo $user_full_name; ?> <strong class="caret"></strong></a>
            <ul class="dropdown-menu">
              <li>
                <?php echo anchor('sub_district/user/edit_account', '<i class="icon-edit"></i> Edit Kontak'); ?>
              </li>
              <li>
                <?php echo anchor('sub_district/user/change_password', '<i class="icon-random"></i> Ganti Password'); ?>
              </li>
              <li class="divider">
              </li>
              <li>
                <?php echo anchor('user/logout', '<i class="icon-off"></i> Keluar'); ?>
              </li>
            </ul>
          </li>
        </ul>

      </div>
    </div>
  </div>
</div>
