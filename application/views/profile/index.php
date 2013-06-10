<section id="main" class="three-fourths column-last">
  <section id="slider-home">
    <div id="flexslider-home" class="flex-container">
      <div class="flexslider">
        <ul class="slides">
          <?php foreach ($images as $image) { ?>
            <li>
              <img src="<?php echo base_url(); ?>webroot/content/images/large_<?php echo $image->image; ?>" alt="Modern Skyscraper">
              <div class="flex-caption">
                <h2><?php echo $image->title; ?></h2>
              </div>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </section>

  <hr>
  
  <section style="margin-bottom: 0">
    <div class="iconbox-wrap clearfix">
      <div class="one-half half-inner">
        <div class="iconbox applications">
          <a href="<?php echo base_url().'profile/view/'.$profile['pendahuluan']['slug']; ?>">
            <h3 class="iconbox-title">
              <span class="iconbox-icon"></span>
              <?php echo $profile['pendahuluan']['title'] ?>
            </h3>
            <p>
              <?php echo $profile['pendahuluan']['content'] ?>
            </p>
          </a>
        </div>
      </div>
      
      <div class="one-half half-inner">
        <div class="iconbox chemical">
          <a href="<?php echo base_url().'profile/view/'.$profile['visi-misi']['slug']; ?>">
            <h3 class="iconbox-title">
              <span class="iconbox-icon"></span>
              <?php echo $profile['visi-misi']['title'] ?>
            </h3>
            <p>
              <?php echo $profile['visi-misi']['content'] ?>
            </p>
          </a>
        </div>
      </div>
      
  </section>

  <section>
    <div class="iconbox-wrap clearfix">
      <div class="one one-inner">
        <div class="iconbox write">
          <a href="<?php echo base_url().'profile/view/'.$profile['tentang-sipd']['slug']; ?>">
            <h3 class="iconbox-title">
              <span class="iconbox-icon"></span>
              <?php echo $profile['tentang-sipd']['title'] ?>
            </h3>
            <p>
              <?php echo $profile['tentang-sipd']['content'] ?>
            </p>
          </a>
        </div>
      </div>
    </div>
  </section>
</section>