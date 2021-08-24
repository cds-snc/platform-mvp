<?php

declare(strict_types=1);

/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cds-default
 */

?>

<section class="no-results not-found template-part-content-none">
    <header class="page-header">
        <h1 class="gc-thickline"><?php esc_html_e('Nothing Found', THEME_NAMESPACE); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php
        if (is_home() && current_user_can('publish_posts')) {
            printf(
                '<p>' . wp_kses(
                    /* translators: 1: link to WP admin new post page. */
                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', THEME_NAMESPACE),
                    [
                        'a' => [
                            'href' => [],
                        ],
                    ]
                ) . '</p>',
                esc_url(admin_url('post-new.php'))
            );
        } elseif (is_search()) {
            ?>

            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', THEME_NAMESPACE); ?></p>
            <?php
            get_search_form();
        } else {
            ?>

            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', THEME_NAMESPACE); ?></p>
            <?php
            get_search_form();
        }
        ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
