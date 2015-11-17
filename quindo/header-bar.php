	<header class="row row--invert header is-fixed">
		<a class="header-logo" href="<?php echo site_url(); ?>"></a>
		<div class="cell well well--s">
			<div class="g">
				<div class="g-b g-b--center">
					<ul class="header-iconWrap">
						<li class="header-icon"><a href="#" class="menu-open"><?php quindo_svg_icon('menu'); ?></a></li>
						<li class="header-icon"><a href="#" class="searchBar-icon"><?php quindo_svg_icon('search'); ?></a></li>
						<?php if (is_single()) : ?>
							<li class="header-icon comment"><a href="#" class="comment-icon"><?php quindo_svg_icon('pencil-square-o'); ?> <span class="comment-count disqus-comment-count" data-disqus-url="<?php the_permalink() ?>">&nbsp;</span></a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</header>

	<div class="searchBar">
		<div class="row row--alt">
			<div class="cell">
				<div class="g">
					<div class="g-b">
						<form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
							<div class="searchBar-float">
								<input type="searc" class="searchBar-input" placeholder="Search" id="s" name="s">
							</div>
							<input type="submit" class="searchBar-submit" value="Enter">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="searchBar-bg"></div>
	</div>

	<div class="menu">
		<div class="row">
			<div class="cell">
				<div class="g">
					<div class="g-b">
						<a class="menu-close" href="#"><li><?php quindo_svg_icon('close'); ?></li></a>
						<a class="menu-logo" href="<?php echo site_url(); ?>"></a>
						<?php //quindo_breadcrumb_nav() ?>
						<div class="g">
							<div class="g-b g-b--10of12 g-b--m--1of1 g-b--center por">
								<div class="map">
									<?php include(dirname(__FILE__) . '/_/img/pro/map.svg'); ?>
								</div>
								<?php $cats = get_categories(array('parent' => get_cat_ID('world'), 'hide_empty' => false)); ?>
								<div>
									<?php foreach ($cats as $cat) : ?>
										<div class="menuArt menuArt--<?php echo $cat->slug ?>">
											<?php $cat_posts = get_posts(array('posts_per_page' => 3, 'category' => $cat->cat_ID)) ?>
											<?php $i = 0; ?>
											<a href="<?php echo $cat_posts ? get_category_link($cat->cat_ID) : get_site_url() . '/careers' ?>" class="menuArt-heading" style="<?php echo !$cat_posts ? 'opacity: 0 !important; pointer-events: none !important' : ''; ?>"><?php echo $cat->name ?></a>
											<div class="g">
												<?php foreach ($cat_posts as $cat_post) : ?>
													<div class="g-b g-b--1of3 g-b--m--1of2 <?php if ($i > 1) echo 'dn--m'; ?> g-b--s--1of1 <?php if ($i > 0) echo 'dn--s'; ?>">
														<a href="<?php echo get_the_permalink($cat_post->ID) ?>">
															<div class="menuArt-image">
																<?php $image = get_field('full_sized_featured_image', $cat_post->ID); ?>
																<img src="<?php echo $image['sizes']['quindo-menuArt'] ?>" alt="">
															</div>
															<div class="menuArt-title"><?php echo get_the_title($cat_post->ID); ?></div>	
														</a>
													</div>
													<?php $i++; ?>
												<?php endforeach; ?>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>