<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php get_template_part('content', 'featured') ?>
	<?php endif; ?>
	<div class="row">
		<div class="g">
			<?php set_query_var( 'is_archive', is_archive() ); ?>
			<?php set_query_var( 'format', quindo_get_formats(true) ); ?>
			<?php get_template_part('front-page', 'content') ?>
		</div>
	</div>
<?php get_footer(); ?>