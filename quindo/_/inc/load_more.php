<?php

function quindo_get_alm_options(){
    return array(
        'posts_per_page' => get_field('posts_per_page', 'option'),
        'pause' => get_field('pause', 'option') ? 'true' : 'false',
        'scroll' => get_field('scroll', 'option') ? 'true' : 'false',
        'scroll_distance' => get_field('scroll_distance', 'option'),
        'max_pages' => get_field('max_pages', 'option'),
        'transition' => get_field('transition', 'option'),
        'button_label' => get_field('button_label', 'option'),
        'post_type' => 'post'
    );
}

function quindo_get_alm_options_front($offset){
    $alm_options = quindo_get_alm_options();

    if ($offset){
        $alm_options['offset'] = $offset;
    }
    if (is_category()){
        $alm_options['category'] = get_category(get_query_var('cat'))->slug;
    }
    if (is_year() || is_month() || is_day()){
        $alm_options['year'] = get_the_time('Y');
    }
    if (is_month() || is_day()){
        $alm_options['month'] = get_the_time('n');
    }
    if (is_day()){
        $alm_options['day'] = get_the_time('j');
    }
    if (is_author()){
        $alm_options['author'] = get_user_by( 'slug', get_query_var( 'author_name' ) )->ID;
    }
    if (is_search()){
        $alm_options['search'] = get_query_var('s');
    }
    $alm_options_imploded = '';
    foreach ($alm_options as $option => $value) {
        $alm_options_imploded .= ' ' . $option . '="' . $value .'"';
    }
    return $alm_options_imploded;
}  

function quindo_get_alm_options_single(){
    $alm_options = quindo_get_alm_options();

    $next_posts = get_posts(array(
        'posts_per_page' => -1,
    ));
    $next_posts = array_map(function($value){return $value->ID;}, $next_posts);
    $next_posts = array_slice($next_posts, 1+ array_search(get_the_ID(), $next_posts));
    $post_ids = implode(',', $next_posts);

    $alm_options['post__in'] = $post_ids;
    $alm_options['posts_per_page'] = 1;
    $alm_options['scroll'] = "false";
    $alm_options['pause'] = "true";
    $alm_options['repeater'] = "template_1";

    $alm_options_imploded = '';
    foreach ($alm_options as $option => $value) {
        $alm_options_imploded .= ' ' . $option . '="' . $value .'"';
    }

    return $alm_options_imploded;
}

function quindo_get_posts_first_land($format){
    $posts_per_page = 0;
    if ($format) {
        foreach ($format as $form) {
            if ($form['part'] == 'card'){
                $posts_per_page += 1;
            }elseif ($form['part'] == 'latest'){
                $posts_per_page += 5;
            }
        }
    }
    return $posts_per_page;
}

function quindo_get_formats($is_archive = NULL){
    $format = get_field('post_template', 'option');
    foreach ($format as &$value) :
        if ($is_archive){
            if ($value['acf_fc_layout'] == 'latest'){
                $value['acf_fc_layout'] = 'card';
                $value['card_width'] = 1;
            }else if ($value['acf_fc_layout'] == 'opinion'){
                continue;
            }
        }
        $value['part'] = $value['acf_fc_layout'];
        $value['width'] = $value['card_width'];
        unset($value['acf_fc_layout']);
        unset($value['card_width']);
    endforeach;
    return $format;
}