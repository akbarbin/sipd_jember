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
            <?php echo anchor('admin/dashboard', '<i class="icon-home icon-white"></i> Dashboard'); ?>
          </li>
          <li class="dropdown">
            <?php echo anchor('#', '<i class="icon-th-list icon-white"></i> Nilai Profil <b class="caret"></b>', 'data-toggle="dropdown" class="dropdown-toggle"'); ?>
            <ul class="dropdown-menu">
              <li>
                <?php echo anchor('admin/master_tabular', '<i class="icon-hdd"></i> Data Tabular'); ?> 
              </li>
              <li>
                <?php echo anchor('admin/tabular', '<i class="icon-list-alt"></i> Data Tabular Kecamatan'); ?>
              </li>
            </ul>
          </li>
          <li>
            <?php echo anchor('admin/user', '<i class="icon-user icon-white"></i> Data User'); ?>
          </li>
          <li class="dropdown">
            <?php echo anchor('#', '<i class="icon-tasks icon-white"></i> Data Master <b class="caret"></b>', 'data-toggle="dropdown" class="dropdown-toggle"'); ?>
            <ul class="dropdown-menu">
              <li>
                <?php echo anchor('admin/unit', '<i class="icon-tag"></i> Data Satuan'); ?>
              </li>
              <li>
                <?php echo anchor('admin/sub_district', '<i class="icon-align-justify"></i> Data Kecamatan'); ?>
              </li>
              <li>
                <?php echo anchor('admin/data_source', '<i class="icon-folder-open"></i> Sumber Data'); ?>
              </li>
              <li>
                <?php echo anchor('admin/role', '<i class="icon-share"></i> Data Role User'); ?>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="nav pull-right">
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-lock icon-white"></i> <?php echo $user_full_name;?> <strong class="caret"></strong></a>
            <ul class="dropdown-menu">
              <li>
                <?php echo anchor('admin/user/edit_account', '<i class="icon-edit"></i> Edit Kontak'); ?>
              </li>
              <li>
                <?php echo anchor('admin/user/change_password', '<i class="icon-random"></i> Ganti Password'); ?>
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
