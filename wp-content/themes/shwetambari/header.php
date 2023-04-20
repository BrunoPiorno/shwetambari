<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $favicon = get_field('favicon','option');	?>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon['url']; ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	<?php the_field('analytics','options'); ?>
	<?php if ($header_property_script = get_field('header_property_script')): ?>
		<?php echo $header_property_script; ?>
	<?php endif; ?>
</head>
<?php
if(is_page()) {
	$parent = get_post($post->post_parent); 
	$page_slug = 'page-'.$post->post_name;
	if($parent): $parent_slug = 'parent-'.$parent->post_name; endif;
}
?>
<body <?php body_class($page_slug ." ". $parent_slug ." ". $class); ?>>
<?php
$site_logo = get_field('site_logo','options');
$home_header__logo = get_field('home_header__logo','options');
$home_header_logo_scroll = get_field('home_header_logo_scroll','options');
$close = get_field('close','options'); 
$logo_scroll = get_field('logo_scroll','options');

?>
<?php wp_body_open(); ?>
<?php the_field('analytics_body','options'); ?>
<div id="page" class="site">
	<div class="site-inner">

	<?php if(is_page_template('template-comming.php')):
	
	else: ?>
		<header class="header">
			<div class="container">

				<?php /* <div class="header__menu">
					<div class="header__menu__title">MENU</div>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>

					<div class="header__account__cont--reponsive">
						<?php if ( is_user_logged_in() ) { ?>
							<a href="<?php echo wp_logout_url( home_url( '/' ) ) ?>">Logout</a>
						<?php } else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>my-account">Login / Register</a>
						<?php } ?>
					</div>
				</div> */ ?>

				<div class="header__cont">
					<div class="header__logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $site_logo['sizes']['large']; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					</div> <!--/header__logo -->
					<div class="home_header__logo">
						<a class="header_scroll__hidden	" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $home_header__logo['sizes']['large']; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
						<a class="header_scroll" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $home_header_logo_scroll['sizes']['large']; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					</div> <!--/header__logo -->

					<div class="header_menu">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
					</div>

					<div class="header__account">
						<div class="header__account__cont">
							<?php if ( is_user_logged_in() ) { ?>
								<a href="<?php echo wp_logout_url( home_url( '/' ) ) ?>">Logout / </a>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>my-account">My Account</a>
							<?php } else { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>my-account">Login / Register</a>
							<?php } ?>
						</div>
						
						<?php if ($bag_logo = get_field('bag_logo','options')): ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>cart" class="header__cart"><img src="<?php echo $bag_logo['sizes']['large']; ?>" alt="" /></a>
						<?php endif; ?>
						<?php if ($bag_logo_scroll = get_field('bag_logo_scroll','options')): ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>cart" class="header__cart__scroll"><img src="<?php echo $bag_logo_scroll['sizes']['large']; ?>" alt="" /></a>
						<?php endif; ?>
					</div>	
				</div>
				

						
				<?php  if ($menu_logo = get_field('menu_logo','options')): ?>
					<a href="javascript:void(0);" class="responsive__btn">
						<span></span><span></span><span></span><span></span>
					</a>
				<?php endif;  ?>
				<div class="responsive__menu">
					<div class="menu__cont">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
						<div class="menu__cont__item">
							<div class="header__account__cont">
								<?php if ( is_user_logged_in() ) { ?>
									<a href="<?php echo wp_logout_url( home_url( '/' ) ) ?>">Logout / </a>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>my-account">My Account</a>
								<?php } else { ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>my-account">Login / Register</a>
								<?php } ?>
							</div>
							
							<?php if ($bag_logo = get_field('bag_logo','options')): ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>cart" class="header__cart"><img src="<?php echo $bag_logo['sizes']['large']; ?>" alt="" /></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</header>

	<?php endif; ?>

		<div id="content" class="site-content">
