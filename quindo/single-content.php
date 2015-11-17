<div class="clearfix">
<article <?php post_class() ?> id="post-<?php the_ID(); ?>" data-permalink="<?php the_permalink() ?>" data-slug="<?php global $post; echo $post_slug=$post->post_name; ?>" data-title="<?php echo the_title() ?>">
	<?php $category = get_the_category(); ?>
	<?php if ($category = $category[0]) : ?>
		<a href="<?php echo get_category_link($category->cat_ID); ?>" class="btn btn--highlight featured-btn"  <?php if (get_option("category_color_" . $category->term_id)) : ?> style="background-color: <?php echo get_option( "category_color_" . $category->term_id); ?>"<?php endif; ?>>
			<?php echo $category->name ?>
		</a>
	<?php endif; ?>
	<div class="content">
		<h1 class="articleInfo-title"><?php the_title(); ?></h1>
	</div>
	<?php if (get_field('sub_title')) : ?>
		<p class="articleInfo-subtitle"><?php the_field('sub_title'); ?></p>
	<?php endif; ?>

	<?php get_template_part('single', 'featuredImage') ?>
	
	<div class="g">
		<div class="g-b g-b--4of12 g-b--m--1of1 fr">
			<ul class="social fr" style="display:none;">
				<li class="social-icon"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ?>" target="_blank"><?php quindo_svg_icon('facebook'); ?></a></li>
				<li class="social-icon"><a href="https://twitter.com/home?status=<?php echo get_permalink() ?>" target="_blank"><?php quindo_svg_icon('twitter'); ?></a></li>
				<li class="social-icon"><a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank"><?php quindo_svg_icon('gplus'); ?></a></li>
			</ul>
		</div>
		<div class="g-b g-b--8of12 g-b--m--1of1">

			<p class="articleInfo-author">By <?php the_author_posts_link(); ?>, <?php echo get_the_date(); ?></p>
			<div class="content">
				<?php echo apply_filters('quindo_blockquote_to_grid', get_field('content')); ?>
			</div>
			
			<style type="text/css">ul.related_post{width: 1100px;}</style>
			<br />
			<center>
										<?php //wp_related_posts(); ?>
									</center>
			<div class="disqus-wrap">
				<?php comments_template(); ?>
			</div>
		</div>
	</div>
	<div class="left_box">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
</article>
<div class="side"><?php echo get_field("side-text"); ?></div>
</div>