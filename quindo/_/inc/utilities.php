<?php

function quindo_svg_icon($id, $title = NULL){
    ?>
    <svg viewBox="0 0 100 100" class="icon icon-<?php echo $id; ?>">
      <use xlink:href="#<?php echo $id; ?>"></use>
      <?php if ($title) : ?><title><?php echo $title; ?></title><?php endif; ?>
    </svg>
    <?php
}

// Add pattern page
if (isset($_GET['activated']) && is_admin()){
    $new_page_title = 'Theme Patterns';
    $new_page_template = 'page-patterns.php';
    $page_check = get_page_by_title($new_page_title);
    $new_page = array(
        'post_type' => 'page',
        'post_title' => $new_page_title,
        'post_status' => 'private',
        'post_author' => 1,
    );
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
                update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        }
    }
}

function quindo_span_inserter($content){
    $array = explode(' ', strip_tags($content));
    return "<span>".implode('</span><span> ', $array)."</span>";
}
add_filter('quindo_span_inserter', 'quindo_span_inserter');

function quindo_blockquote_to_grid($content){
    $i = 1;
    while (1) {
        if (strposX($content, '<blockquote>', $i) !== false) {
            $b_start_position = strposX($content, '<blockquote>', $i);
        }else{
            break;
        }

        $b_end_position = strposX($content, '</blockquote>', $i) + 13;
        $b_length = $b_end_position - $b_start_position;

        $first_half = substr($content, 0, $b_start_position);
        $content_array = array();
        $content_array[0] = substr($content, 0, strrpos($first_half, '<p>'));
        $content_array[1] = substr($first_half, strrpos($first_half, '<p>'));
        $content_array[2] = substr($content, $b_start_position, $b_length);
        $content_array[3] = substr($content, $b_end_position);

        $html = $content_array[0];
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="g-b g-b--5of12 g-b--m--1of1">';
        $html .= '<div class="blockquote-side">';
        $html .= $content_array[1];
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="g-b g-b--7of12 g-b--m--1of1 blockk">';
        $html .= '<blockquote>';
        $html .= apply_filters('quindo_span_inserter', $content_array[2]);;
        $html .= '</blockquote>';
        $html .= '</div>';
        $html .= '<div class="g-b g-b--8of12 g-b--m--1of1">';
        $html .= '<div class="content">';
        $html .= $content_array[3];
        $content = $html;
        $i++;
    }
    return $content;
}
add_filter('quindo_blockquote_to_grid', 'quindo_blockquote_to_grid');

function strposX($haystack, $needle, $number){
    if($number == '1'){
        return strpos($haystack, $needle);
    }elseif($number > '1'){
        return strpos($haystack, $needle, strposX($haystack, $needle, $number - 1) + strlen($needle));
    }else{
        return false;
    }
}

function quindo_excerpt(){
    $content = strip_tags(get_field('content'));
    if (get_the_excerpt()) :
        return get_the_excerpt();
    elseif (strlen($content) > 200) : 
        // Return first 200 words of content
        return strpos($content, ' ', 200) ? substr($content,0,strpos($content, ' ', 200)) . '...' : $content;
    else: 
        return $content;
    endif; 
}

function quindo_get_template_part($format){
    if ($format['part'] == 'card')
        set_query_var( 'width', $format['width'] );

    get_template_part( 'content', $format['part'] );
}

function quindo_get_opinion_authors(){
    global $wpdb;
    $posts_needed = WP_ENV == 'development' ? 1 : 4;
    return $wpdb->get_col("
        SELECT post_author 
        FROM $wpdb->posts 
        WHERE post_type = 'post'
        AND post_status = 'publish' 
        GROUP BY post_author 
        HAVING COUNT(*) > $posts_needed
        ORDER BY post_date DESC 
        LIMIT 4
    ");
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array('page_title' => 'Options','menu_title' => '','menu_slug' => '','capability' => 'manage_categories','position' => false,'parent_slug' => '','icon_url' => false,'redirect' => true,'post_id' => 'options','autoload' => false));   
}