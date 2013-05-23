<ul class="nav nav-list">
  <li class="nav-header">
    Quick Link
  </li>
  <li>
    <?php echo anchor('admin/dashboard', '<i class="icon-home"></i> Dashboard'); ?>
  </li>
  <li>
    <?php echo anchor('admin/history', '<i class="icon-list"></i> Histories'); ?>
  </li>
  <li class="nav-header">
    Kelompok Data
  </li>
  <li>
    <a href="#">Data Umum</a>
    <ul class="nav nav-list">
      <li><a href="">Geografi</a></li>
      <li><a href="">Budaya</a></li>
      <li><a href="">Pendidikan</a></li>
    </ul>
  </li>
  <li>
    <?php echo anchor('admin/user/account', 'Data Profile'); ?>
  </li>
  <li class="divider">
  </li>
  <li>
    <?php echo anchor('user/logout', '<i class="icon-off"></i> Keluar'); ?>
  </li>
</ul>