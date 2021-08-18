<?php

declare(strict_types=1);

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package cds-default
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function cds_body_classes(array $classes): array
{
    // Adds a class of hfeed to non-singular pages.
    if (! is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (! is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'cds_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function cds_pingback_header(): void
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'cds_pingback_header');

function cds_prev_next_links() : void
{
    $prev_post = get_previous_post();
    $prev_id = $prev_post->ID;
    $prev_permalink = get_permalink($prev_id);
    $next_post = get_next_post();
    $next_id = $next_post->ID;
    $next_permalink = get_permalink($next_id);
    ?>

    <nav class="mrgn-tp-xl">
        <h2 class="wb-inv"> <?php _e('Document navigation', 'cds'); ?> </h2>
        <ul class="pager">
            <li class="next">
                <a href="<?php echo $next_permalink; ?>"><?php _e('Next blog post', 'cds'); ?> &nbsp;»</a>
            </li>
            <li class="previous">
                <a  href="<?php echo $prev_permalink; ?>" rel="prev">«&nbsp;<?php  _e('Previous blog post', 'cds'); ?></a>
            </li>
        </ul>
    </nav>

    <?php
}

function cds_category_links($post_id, $separator = ",") : string
{
    global $wp_rewrite;
    $categories = apply_filters( 'the_category_list', get_the_category( $post_id ), $post_id );

    $rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

    $list = '';

    $i = 0;
    /* https://wet-boew.github.io/GCWeb/templates/legislation/regulations-en.html */
    foreach ( $categories as $category ) {
        if ( 0 < $i )
            $list .= $separator;
            $list .= '<li><a href="' . get_category_link( $category->term_id ) . ' " class="'.$category->class. '" ' . $rel . '>[' . $category->name.']</a></li>';
            ++$i;
    }

    return  $list;

}
