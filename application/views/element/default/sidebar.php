<aside id="sidebar" class="one-fourth">
  <div class="widget">
    <h3>Profil Daerah</h3>
    <nav>
      <ul class="menu">
        <li><?php echo anchor('tabular', 'Semua Data'); ?></li>
        <?php foreach ($sidebar_menus as $menu) { ?>
          <li><?php echo anchor('tabular/index/' . $menu->id, $menu->name); ?></li>
        <?php } ?>
      </ul>
    </nav>
  </div>
  <div class="widget">
    <h3>Data Internal</h3>
    <nav>
      <ul class="menu">
        <li><?php echo anchor('instance', 'Daftar Instansi'); ?></li>
        <li><?php echo anchor('tabular/export_excel', 'Download Data Excel'); ?></li>
      </ul>
    </nav>
  </div>
  <div class="widget">
    <h3>Ganti Bahasa</h3>
    <div id="google_translate_element"></div>
    <script>
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({
          pageLanguage: 'id'
        }, 'google_translate_element');
      }
    </script>
    <script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  </div>
  <div class="widget">
    <h3>Polling</h3>
    <p>Bagaimana Tampilan website SIPD Kab. Jember menurut anda:</p>
    <nav>
      <form action="#" method="post">				
        <ul>
          <li><input type="radio" name="pil" value="1"/> Sangat Baik</li>
          <li><input type="radio" name="pil" value="2"/> Baik</li>
          <li><input type="radio" name="pil" value="3"/> Kurang</li>
          <li><input type="radio" name="pil" value="4"/> Kurang Sekali</li>
        </ul>			
      </form>
    </nav>
  </div>
</aside>
