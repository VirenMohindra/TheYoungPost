<?php $full_image = get_field('full_sized_featured_image'); ?>
<div class="featured" style="background-image: url(<?php echo $full_image['sizes']['quindo-featured-front'] ?>);">
	<a href="<?php the_permalink() ?>" class="featured-link"></a>
	<div class="row featured-row">
		<div class="cell featured-cell">
			<div class="g featured-g">
				<?php /*
				<div class="g-b g-b--1of2">
					<a href="<?php echo site_url() ?>" class="featured-logo"></a>
				</div>
				*/ ?>
				<div class="g-b featured-contentGrid">
					<div class="featured-content">
						<?php $category = get_the_category(); ?>
						<?php if ($category = $category[0]) : ?>
							<span class="btn btn--highlight featured-btn" <?php if (get_option("category_color_" . $category->term_id)) : ?>style="background-color: <?php echo get_option( "category_color_" . $category->term_id); ?>"<?php endif; ?>>
								<?php echo $category->name ?>
							</span>
						<?php endif; ?>
						<h2 class="featured-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="#" class="featured-arrow">
		<?php quindo_svg_icon('arrow'); ?>
	</a>
</div>