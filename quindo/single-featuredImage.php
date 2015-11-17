<?php $full_image = get_field('full_sized_featured_image'); ?>
<?php if ($full_image) : ?>
	<div class="insideFeatured">
		<div class="insideFeatured-inner">
			<div class="parallax parallax-<?php echo get_the_ID() ?>" style="background-image: url(<?php echo $full_image['sizes']['quindo-featured-inside'] ?>);">
				<div
					class="parallax-image"
					style="background-image:url(<?php echo $full_image['sizes']['quindo-featured-inside'] ?>);"
					data-anchor-target=".parallax-<?php echo get_the_ID() ?>"
					data-bottom-top="transform: translate3d(0px, -20%, 0px);"
					data-top-bottom="transform: translate3d(0px, 20%, 0px);">
				</div>
			</div>
			<div class="featured_border"></div>
		</div>
	</div>
<?php endif; ?>