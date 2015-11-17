<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php get_template_part('content', 'featured') ?>
	<?php endif; ?>
	<div class="row">
		<div class="g">
			<?php set_query_var( 'is_front_page', is_front_page() ); ?>
			<?php set_query_var( 'format', quindo_get_formats() ); ?>
			<?php get_template_part('front-page', 'content') ?>
		</div>
	</div>
<?php get_footer(); ?>