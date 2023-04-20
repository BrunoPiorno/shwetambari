<?php

/**

 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

if(!is_page_template('template-comming.php')): 

$footer_logo = get_field('footer_logo','options');
$copyright = get_field('copyright','options');
?>
			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="container">
					<div class="site-footer__logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $footer_logo['sizes']['large']; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					</div>	<!--/header__logo -->
					<div class="site-footer__bottom">
						<?php wp_nav_menu( array('menu' => 'Menu Footer', 'menu_class' => 'site-footer__menu')); ?>
						<?php if ($copyright): ?>
							<p class="copyright"><?php echo $copyright ?></p>
						<?php endif; ?>
					</div>
				</div>
			</footer><!-- .site-footer -->
<?php endif; ?>

		<?php /*if ($terms_conditions = get_field('terms_conditions', 'options')):?>
			<div class="footer__popup--terms js-popup">
				<a href="javascript:void(0)" class="close_popup"></a>
				<div class="footer__popup--faqs--inner">
					<div class="footer__popup--terms__text"><?php echo $terms_conditions ?></div>
				</div>
			</div> 
		<?php endif;*/ ?>

		<?php /*if( have_rows('faqs', 'options') ): ?>
			<div class="footer__popup--faqs js-popup">
				
				<?php if ($faqs_title = get_field('faqs_title','options')): ?>
					<div class="faqs_title"><?php echo $faqs_title ?></div>
				<?php endif; ?>
				<a href="javascript:void(0)" class="close_popup"></a>
				<?php while( have_rows('faqs', 'options') ) : the_row();
					$faq_question = get_sub_field('faq_question', 'options');
					$faqs_answer = get_sub_field('faqs_answer', 'options'); ?>
					<div class="footer__popup__text__cont">
						<button class="footer__popup__text__cont--faqs"><?php echo $faq_question ?><i class="fas fa-plus"></i></button>
						<div class="panel"><?php echo $faqs_answer ?></div>
					</div>
				<?php endwhile; ?>
			
			</div>
		<?php endif;*/ ?>	

		<?php if ($newsletter_signup = get_field('newsletter_signup', 'options')):?>
			<div class="comming-soon__cont__form js-popup">
				<div class="comming-soon__cont__form--text-cont">
				<a href="javascript:void(0)" class="close_popup"></a>

					<?php echo $newsletter_signup ?>
				</div>
			</div>
		<?php endif; ?>

		</div><!-- .site-content -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
