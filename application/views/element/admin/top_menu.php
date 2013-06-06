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
            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-th-list icon-white"></i> Master Tabular <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                <?php echo anchor('admin/master_tabular_general', '<i class="icon-hdd"></i> Data Umum'); ?> 
              </li>
              <li>
                <?php echo anchor('admin/master_tabular', '<i class="icon-list-alt"></i> Data Profil'); ?>
              </li>
              <li class="dropdown-submenu">
                <a href="#"><i class="icon-tasks"></i> Data Kinerja</a>
                <ul class="dropdown-menu">
                  <li>
                    <?php echo anchor('admin/master_tabular_performance/kesejahteraan-masyarakat', '<i class="icon-retweet"></i> Aspek Kesejahteraan Masyarakat'); ?>
                  </li>
                  <li>
                    <?php echo anchor('admin/master_tabular_performance/pelayanan-umum', '<i class="icon-magnet"></i> Aspek Pelayanan Umum'); ?>
                  </li>
                  <li>
                    <?php echo anchor('admin/master_tabular_performance/daya-saing', '<i class="icon-share"></i> Aspek Daya Saing'); ?>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-align-left icon-white"></i> Tabular <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                <?php echo anchor('admin/tabular_general', '<i class="icon-hdd"></i> Data Umum Kecamatan'); ?> 
              </li>
              <li>
                <?php echo anchor('admin/tabular', '<i class="icon-list-alt"></i> Data Profil Kecamatan'); ?>
              </li>
              <li class="dropdown-submenu">
                <a href="#"><i class="icon-tasks"></i> Data Kinerja Kecamatan</a>
                <ul class="dropdown-menu">
                  <li>
                    <?php echo anchor('admin/tabular_performance/kesejahteraan-masyarakat', '<i class="icon-retweet"></i> Aspek Kesejahteraan Masyarakat'); ?>
                  </li>
                  <li>
                    <?php echo anchor('admin/tabular_performance/pelayanan-umum', '<i class="icon-magnet"></i> Aspek Pelayanan Umum'); ?>
                  </li>
                  <li>
                    <?php echo anchor('admin/tabular_performance/daya-saing', '<i class="icon-share"></i> Aspek Daya Saing'); ?>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-tasks icon-white"></i> Data Master <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="dropdown-submenu">
                <a href="#"><i class="icon-briefcase"></i> Data Government</a>
                <ul class="dropdown-menu">
                  <li>
                    <?php echo anchor('admin/data_source', '<i class="icon-folder-open"></i> Sumber Data'); ?>
                  </li>
                  <li>
                    <?php echo anchor('admin/instance', '<i class="icon-briefcase"></i> Data Instansi'); ?>
                  </li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#"><i class="icon-user"></i> Manajemen User</a>
                <ul class="dropdown-menu">
                  <li>
                    <?php echo anchor('admin/user', '<i class="icon-user"></i> Data User'); ?>
                  </li>
                  <li>
                    <?php echo anchor('admin/role', '<i class="icon-share"></i> Data Role User'); ?>
                  </li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#"><i class="icon-comment"></i> Profile SIPD</a>
                <ul class="dropdown-menu">
                  <li>
                    <?php echo anchor('admin/profile', '<i class="icon-edit"></i> Data Profil Info'); ?>
                  </li>
                  <li>
                    <?php echo anchor('admin/image', '<i class="icon-picture"></i> Slide Gambar'); ?>
                  </li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#"><i class="icon-wrench"></i> Settings</a>
                <ul class="dropdown-menu">
                  <li>
                    <?php echo anchor('admin/sub_district', '<i class="icon-align-justify"></i> Data Kecamatan'); ?>
                  </li>
                  <li>
                    <?php echo anchor('admin/unit', '<i class="icon-tag"></i> Data Satuan'); ?>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="nav pull-right">
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-lock icon-white"></i> <?php echo $user_full_name; ?> <strong class="caret"></strong></a>
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
