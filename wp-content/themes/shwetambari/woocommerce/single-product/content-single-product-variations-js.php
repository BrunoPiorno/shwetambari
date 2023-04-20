<?php foreach( $args['variation_gallery'] as $order => $image ):
    if($image['type'] == 'video'):?>
        <div class="product__single__gallery__item product__single__gallery__item--video">
            <div>
                <video id="product__video__js"  playsinline onended="videoEnded(this)">
                    <source data-src="<?php echo $image['url']; ?>#t=0.1" src="" type="video/mp4">
                </video>
                <div class="controls">
                    <div class="video-controls pause">PAUSE</div>
                </div>
                <svg class="play-button" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="100px" width="100px" viewBox="0 0 320.001 320.001" style="enable-background:new 0 0 320.001 320.001;" xml:space="preserve">
                    <path fill="#ffffff"  d="M295.84,146.049l-256-144c-4.96-2.784-11.008-2.72-15.904,0.128C19.008,5.057,16,10.305,16,16.001v288 c0,5.696,3.008,10.944,7.936,13.824c2.496,1.44,5.28,2.176,8.064,2.176c2.688,0,5.408-0.672,7.84-2.048l256-144 c5.024-2.848,8.16-8.16,8.16-13.952S300.864,148.897,295.84,146.049z"/>
                </svg>

                <?php if($args['video_thumbnail']):?>
                    <div class="image_placeholder">
                        <div class="image-background">
                            <img src="<?php echo esc_url($args['video_thumbnail']['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($args['video_thumbnail']	['alt']); ?>" />
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="product__single__gallery__item">
            <img src="<?php echo esc_url($image['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        </div>
    <?php endif; ?>
<?php endforeach; ?>