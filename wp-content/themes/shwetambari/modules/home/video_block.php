<?php
$block_type = get_sub_field('block_type');
$video = get_sub_field('video');
$video_placeholder = get_sub_field('video_placeholder');
$blockClass=($block_type==0)?'half':'full';
?>
<?php if( is_array($video) && !empty($video['url']) ): ?>
      <?php
      /* calc */
      $placeholderClass='';
      if($blockClass=='half'){ //ver
            $paddingTop=(($video["height"]/$video["width"])*100);
            $placeholderClass='style="padding-top:'.$paddingTop.'%;"';
      }
      ?>
      <div class="home-grid__item <?php echo $blockClass;?>">
            <div class="home-grid__item--video">
                  <video preload playsinline onended="videoEnded(this)">
                        <source src="<?php echo $video['url']; ?>#t=0.1" data-src="<?php echo $video['url']; ?>#t=0.1" type="<?php echo $video['mime_type']; ?>">
                  </video>
                  <div class="controls">
                        <div class="video-controls pause">PAUSE</div>
                  </div>
                  <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="play" class="play-button" role="img" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" height="100px" width="100px" viewBox="0 0 448 512">
                  <path fill="#ffffff" d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path></svg>
                  
                  <?php if($video_placeholder):?>
                        <div class="image_placeholder" <?php //echo $placeholderClass;?>>
                              <div clas="image-background">
                                    <img src="<?php echo esc_url($video_placeholder['sizes']['large']); ?>" alt="<?php echo esc_attr($video_placeholder['alt']); ?>" />
                              </div>
                        </div>
                  <?php endif; ?>
            </div>

      </div>
<?php endif;?>