<?php

declare(strict_types=1);

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cds-default
 */

get_header();
?>

    <main property="mainContentOfPage" class="container" resource="#wb-main" typeof="WebPageElement">

        <?php
        while (have_posts()) {
            the_post();

            get_template_part('template-parts/content', get_post_type());

            the_post_navigation(
                [
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'cds') . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'cds') . '</span> <span class="nav-title">%title</span>',
                ]
            );

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
        } // End of the loop.
        ?>

    </main><!-- #main -->

<?php
get_footer();
