<div class="g-b g-b--1of3 g-b--m--1of2 g-b--s--1of1">
	<div class="latest frontObj has-center">
		<div class="frontObj-content">
			<h3 class="latest-header"><?php the_field('latest_news_section_header', 'option') ?></h3>
			<?php $latest_posts = get_posts(array('offset' => $latest_offset, 'posts_per_page' => get_field('latest_posts_per_page', 'option'))); ?>
			<?php foreach ($latest_posts as $latest_post) : ?>
				<div class="latest-story">
					<h4 class="latest-title"><a href="<?php echo get_the_permalink($latest_post->ID); ?>"><?php echo get_the_title($latest_post->ID); ?></a></h4>
					<p class="latest-time"><?php echo human_time_diff(get_the_time( 'U', $latest_post->ID )) . ' ago' ?></p>
				</div>
			<?php endforeach; ?>
			<p class="latest-more"><a href="#">More</a></p>
		</div>
	</div>
</div>