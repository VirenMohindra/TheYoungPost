<?php
$i = 0;
$posts_per_page = quindo_get_posts_first_land($format);
if ($is_front_page || $is_archive){
	global $wp_query;
	$args = array_merge($wp_query->query_vars, array('offset' => 1, 'posts_per_page' => $posts_per_page));
	query_posts( $args );
}
while (have_posts()) : the_post();
	if ($latest_break){
		$latest_break--;
		continue;
	}

	$opt = isset($format[$i]) ? $format[$i] : array('part' => 'card', 'width' => 1);
	quindo_get_template_part($opt);
	$i++;

	$opt = isset($format[$i]) ? $format[$i] : array('part' => 'card', 'width' => 1);
	while ($opt['part'] == 'opinion' || $opt['part'] == 'latest') :
		set_query_var( 'latest_offset', $i + 1 );
		// Don't show opinion section on archive
		if (!($opt['part'] == 'opinion' && $is_archive)){
			quindo_get_template_part($opt);
		}
		if ($opt['part'] == 'latest'){
			$latest_break = get_field('latest_posts_per_page', 'option');
		}
		$i++;
		$opt = isset($format[$i]) ? $format[$i] : array('part' => 'card', 'width' => 1);
	endwhile;

endwhile;
if (!have_posts()) :
	?>
	<div class="content">
		<h1 style="margin-top: 100px">No posts found</h1>
	</div>
	<?php
endif;
wp_reset_query();
?>
<?php echo do_shortcode('[ajax_load_more' . quindo_get_alm_options_front($posts_per_page + 1) . ']'); ?>