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
  <?php
  foreach ($sidebar_menus as $key => $menu) {
    if ($menu->ancestry_depth == 0) {
      echo '<li>' . anchor('admin/master_tabular/index/' . $menu->id, '<i class="icon-chevron-down"></i> ' . $menu->name, 'title="' . $menu->name . '" class="text-overflow"') . '</li>';
    } else {
      echo '<li>' . anchor('admin/master_tabular/index/' . $menu->id, '<i class="icon-chevron-left"></i> ' . $menu->name, 'title="' . $menu->name . '" class="text-overflow" style="padding-left:30px;"') . '</li>';
    }
  }
  ?>
  <li class="divider">
  </li>
  <li>
    <?php echo anchor('user/logout', '<i class="icon-off"></i> Keluar'); ?>
  </li>
</ul>