<div class="nav-wrap clearfix">
  <nav id="nav">
    <ul id="navlist" class="clearfix">
      <li>
        <?php echo anchor('', 'Home'); ?>
      </li>
      <li>
        <?php if (!empty($top_menus['umum'])) { ?>
          <a href="#" rel="submenu2">Data Umum</a>
          <ul id="submenu2" class="ddsubmenustyle">
            <?php foreach ($top_menus['umum'] as $key => $value) { ?>
              <li>
                <?php
                echo anchor('tabular/view/' . $value->id, $value->name);
                if (!empty($value->Children) && strtolower($value->name) != 'kemiskinan') {
                  echo '<ul>';
                  foreach ($value->Children as $key2 => $value2) {
                    echo '<li>' . anchor('tabular/view/' . $value2->id, $value2->name) . '</li>';
                  }
                  echo '</ul>';
                }

                if (strtolower($value->name) != 'kemiskinan') {
                  echo '<ul>';
                  foreach ($sub_districts as $sub_district) {
                    echo '<li>' . anchor('tabular/poorness/' . $sub_district->id, $sub_district->name) . '</li>';
                  }
                  echo '</ul>';
                }
                ?>
              </li>
            <?php } ?>
          </ul>
        <?php } else { ?>
          <a href="#">Data Umum</a>
        <?php } ?>
      </li>

      <li>
        <?php if (!empty($top_menus['profil'])) { ?>
          <a href="#" rel="submenu3">Profil Daerah</a>
          <ul id="submenu3" class="ddsubmenustyle">
            <?php foreach ($top_menus['profil'] as $key => $value) { ?>
              <li>
                <?php
                echo anchor('tabular/view/' . $value->id, $value->name);
                if (!empty($value->Children)) {
                  echo '<ul>';
                  foreach ($value->Children as $key2 => $value2) {
                    echo '<li>';
                    echo anchor('tabular/view/' . $value2->id, $value2->name);
                    if (!empty($value2->Children)) {
                      echo '<ul>';
                      foreach ($value2->Children as $key3 => $value3) {
                        echo '<li>' . anchor('tabular/view/' . $value3->id, $value3->name) . '</li>';
                      }
                    }
                    echo '</li>';
                  }
                  echo '</ul>';
                }
                ?>
              </li>
            <?php } ?>
          </ul>
        <?php } else { ?>
          <a href="#">Profil Daerah</a>
        <?php } ?>
      </li>

      <li>
        <?php if (!empty($top_menus['kinerja'])) { ?>
          <a href="#" rel="submenu4">Kinerja</a>
          <ul id="submenu4" class="ddsubmenustyle">
            <?php foreach ($top_menus['kinerja'] as $key => $value) { ?>
              <li>
                <?php
                echo anchor('tabular/view/' . $value->id, $value->name);
                if (!empty($value->Children)) {
                  echo '<ul>';
                  foreach ($value->Children as $key2 => $value2) {
                    echo '<li>' . anchor('tabular/view/' . $value2->id, $value2->name) . '</li>';
                  }
                  echo '</ul>';
                }
                ?>
              </li>
            <?php } ?>
          </ul>
        <?php } else { ?>
          <a href="#">Kinerja</a>
        <?php } ?>
      </li>

      <li>
        <?php echo anchor('contact', 'Kontak'); ?>
      </li>
      <li>
        <?php echo anchor('login', 'Login'); ?>
      </li>
    </ul>
  </nav>

</div>