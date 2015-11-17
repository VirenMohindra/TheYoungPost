<?php get_header(); ?>

	<div class="well--l">
		<div class="row">
			<div class="cell pos">
				<div class="g">
					<div class="g-b g-b--center">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<div class="alm-preloaded">
								<?php get_template_part('single', 'content'); ?>
									
							</div>
						<?php endwhile; endif; ?>
						
						
						<?php echo do_shortcode('[ajax_load_more ' . quindo_get_alm_options_single() . ']'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var disqus_api_key = '<?php the_field('api_key', 'option') ?>';
	</script>
<?php get_footer(); ?>