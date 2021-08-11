<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @see https://codex.wordpress.org/Creating_an_Error_404_Page
 */
get_header();
?>
<div class="container mx-auto mb-10">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'canadian-digital-service'); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<p><?php esc_html_e('It looks like nothing was found at this location.', 'canadian-digital-service'); ?></p>
	</div><!-- .page-content -->		
</div>
<?php
get_footer();
