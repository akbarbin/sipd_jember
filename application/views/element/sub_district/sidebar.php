<ul class="nav nav-list">
  <li class="nav-header">
    Quick Link
  </li>
  <li>
    <?php echo anchor('sub_district/dashboard', '<i class="icon-home"></i> Dashboard', 'title="Dashboard"'); ?>
  </li>
  <li>
    <?php echo anchor('sub_district/history', '<i class="icon-list"></i> Histories', 'title="Histories"'); ?>
  </li>
  <li class="nav-header">
    Kelompok Data
  </li>
  <?php
  foreach ($sidebar_menus as $key => $menu) {
    if ($menu->ancestry_depth == 0) {
      echo '<li>' . anchor('admin/master_tabular/view/' . $menu->id, '<i class="icon-chevron-down"></i> ' . $menu->name, 'title="' . $menu->name . '" class="text-overflow"') . '</li>';
    } else {
      echo '<li>' . anchor('admin/master_tabular/view/' . $menu->id, '<i class="icon-chevron-left"></i> ' . $menu->name, 'title="' . $menu->name . '" class="text-overflow" style="padding-left:30px;"') . '</li>';
    }
  }
  ?>
  <li class="divider">
  </li>
  <li>
    <?php echo anchor('user/logout', '<i class="icon-off"></i> Keluar', 'title="Keluar"'); ?>
  </li>
</ul>

<script type="text/javascript">
  $('.nav-list li a').tooltip({
    placement: 'right'
  });
</script>