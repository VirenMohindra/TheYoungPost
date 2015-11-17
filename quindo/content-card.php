<?php if (!isset($width)) $width = 1; ?>
<div class="g-b g-b--<?php echo $width ?>of3 g-b--m--1of2 g-b--s--1of1">
	<?php $image = $width > 1 || !get_field('single_card_sized_featured_image') ? get_field('full_sized_featured_image') : get_field('single_card_sized_featured_image'); ?>
	<a href="<?php the_permalink(); ?>" class="card frontObj" style="background-image: url(<?php echo $image['sizes']['quindo-card' . $width] ?>);">
		<span class="card-content is-default">
			<h2 class="card-title"><?php the_title(); ?></h2>
			<p class="card-byline">By <?php echo get_the_author(); ?></p>
		</span>
		<span class="card-content is-hover">
			<h2 class="card-title"><?php the_title(); ?></h2>
			<p class="card-byline">By <?php echo get_the_author(); ?></p>
			<p class="card-excerpt"><?php echo quindo_excerpt(); ?></p>
			<p class="card-more">More</p>
		</span>
	</a>
</div>

<?php // Unset width ?>
<?php set_query_var('width', NULL); ?>