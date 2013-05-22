<ul class="nav nav-list">
  <li class="nav-header">
    Quick Link
  </li>
  <li>
    <?php echo anchor('', 'Dashboard'); ?>
    <a href="#">Dashboard</a>
  </li>
  <li>
    <?php echo anchor('history', 'Histories'); ?>
  </li>
  <li class="nav-header">
    Kelompok Data
  </li>
  <li>
    <a href="#">Data Umum</a>
    <ul>
      <li><a href="">Geografi</a></li>
      <li><a href="">Budaya</a></li>
      <li><a href="">Pendidikan</a></li>
    </ul>
  </li>
  <li>
    <?php echo anchor('user/account', 'Data Profile'); ?>
  </li>
  <li class="divider">
  </li>
  <li>
    <?php echo anchor('user/logout', 'Keluar'); ?>
  </li>
</ul>