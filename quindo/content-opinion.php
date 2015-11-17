<div class="g-b  dn--m frontObj">
	<a href="<?php echo get_category_link(3) ?>" class="btn"  <?php if (get_option("category_color_" . 3)) : ?>style="background-color: <?php echo get_option( "category_color_" . 3); ?>"<?php endif; ?>>Opinion</a>
	<div class="g">
		<?php $authors = quindo_get_opinion_authors(); ?>
		<?php $k = 0; ?>
		<?php foreach ($authors as $author_id) : ?>
			<div class="g-b g-b--1of4">
				<div class="opinion">
					<div class="opinion-image"><?php echo get_avatar($author_id, 50) ?></div>
					<p class="opinion-author">
						<a href="<?php echo get_author_posts_url($author_id) ?>"><?php echo get_the_author_meta('display_name', $author_id) ?></a>
					</p>
					<?php $author_posts = get_posts(array('posts_per_page' => 5, 'author' => $author_id)) ?>
					<ul>
						<?php foreach ($author_posts as $author_post) : ?>
							<li class="opinion-title">
								<a href="<?php echo get_the_permalink($author_post->ID); ?>"><?php echo get_the_title($author_post->ID); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<?php $k++; ?>
		<?php endforeach; ?>
	</div>
	<a href="<?php echo get_category_link(3) ?>" class="btn fr">More</a>
</div>