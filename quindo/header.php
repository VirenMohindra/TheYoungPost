<!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<?php // Force latest IE rendering engine and chrome fram ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<?php if (is_search()) { ?><meta name="robots" content="noindex, nofollow" /> <?php } ?>
	
	<title><?php echo (wp_title("",false)) ? wp_title("",false) :  get_bloginfo('name'); ?></title>
	
	<?php // Meta SEO Information ?>
	<meta name="title" content="<?php echo is_single() ? get_the_title() : get_bloginfo('name') . ' ' . wp_title("", false); ?>">
	<meta name="description" content="<?php echo is_single() ? quindo_excerpt() :  bloginfo('description'); ?>">
	<meta name="author" content="<?php global $post; echo get_the_author_meta('display_name', $post->post_author); ?>">

	<?php $full_image = get_field('full_sized_featured_image'); ?>
	<?php if ($full_image) : ?>
		<meta property="og:image" content="<?php echo $full_image['url']; ?>" />
	<?php endif; ?>
	
	<?php // Mobile Friendly ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	
	<?php // Favicon ?>
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/_/img/pro/icons/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/_/img/pro/icons/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/_/img/pro/icons/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/_/img/pro/icons/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/_/img/pro/icons/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/_/img/pro/icons/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/_/img/pro/icons/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/_/img/pro/icons/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/_/img/pro/icons/apple-touch-icon-152x152.png" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory');?>/_/js/pro/typ.js"></script>
	<?php // Pingback URL ?>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php wp_head(); ?>

<!-- Hotjar Tracking Code for theyoungpost.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:79400,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>

</head>

<body <?php body_class(); ?>>
	<div class="wrapper">
		<?php get_template_part('header', 'bar') ?>