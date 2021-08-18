<?php

declare(strict_types=1);

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cds-default
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php the_title('<h1 id="wb-cont" property="name" class="gc-thickline">', '</h1>'); ?>

    <?php cds_post_thumbnail(); ?>

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(
            [
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'cds'),
                'after' => '</div>',
            ]
        );
        ?>
    </div><!-- .entry-content -->

    <?php if (get_edit_post_link()) { ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
            sprintf(
                wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'cds'),
                        [
                            'span' => [
                                'class' => [],
                            ],
                        ]
                    ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
            ?>
        </footer><!-- .entry-footer -->
    <?php } ?>
</article><!-- #post-<?php the_ID(); ?> -->
