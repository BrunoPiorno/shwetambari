<section class="image_banner">
<?php if( get_sub_field('banner_options') == 'image' ):
   if($image = get_sub_field('image')):?>
      <div class="image_banner__image">
        <div class="image-background">
          <img src="<?php echo $image['sizes']['large']; ?>" />
        </div>
      </div>

    <div class="image_banner__text-cont">
      <?php if ($text = get_sub_field('text')): ?>
        <div class="home__hero__title"><?php echo $text; ?></div>
      <?php endif; ?>
    </div>
    <?php endif; 

   else :

   $video_banner = get_sub_field('video_banner');
   $image_placeholder = get_sub_field('image_placeholder');
   if( is_array($video_banner) && !empty($video_banner['url']) ): ?>
      <div class="image_banner__video">
        <video preload playsinline onended="videoEnded(this)">
          <source src="" data-src="<?php echo $video_banner['url']; ?>#t=0.1" type="video/mp4">
        </video>
        <div class="controls">
          <div class="video-controls pause">PAUSE</div>
        </div>
        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="play" class="play-button" role="img" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" height="100px" width="100px" viewBox="0 0 448 512">
        <path fill="#ffffff" d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path></svg>
          <?php if($image_placeholder):?>
            <div class="image_placeholder">
              <div clas="image-background">
                <img src="<?php echo esc_url($image_placeholder['sizes']['large']); ?>" alt="<?php echo esc_attr($image_placeholder	['alt']); ?>" />
              </div>
            </div>
          <?php endif; ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</section>
