<?php

use \Wa72\HtmlPageDom\HtmlPage;

add_action('personal_options', array('hide_user_bio', 'start'));
// add_action( 'show_user_profile', array ( 'hide_user_bio', 'start' ), 10, 1 );
//add_action( 'edit_user_profile', array ( 'hide_user_bio', 'start' ), 10, 1 );

/**
 * Captures the part with the biobox in an output buffer and removes it.
 */
class hide_user_bio
{
    /**
     * Called on 'personal_options'.
     * @return void
     */
    public static function start()
    {
        $action = (IS_PROFILE_PAGE ? 'show' : 'edit') . '_user_profile';
        add_action($action, array(__CLASS__, 'stop'));
        ob_start();
    }

    /**
     * Strips the bio box from the buffered content.
     * @return void
     */
    public static function stop()
    {
        $html = ob_get_contents();
        ob_end_clean();

        $crawler = @new HtmlPage($html);


        $headings = $crawler->filter('h2')->reduce(
            function ($c, $j) {
                $remove = array("Personal Options", "Name","Contact Info" , "About Yourself", "Yoast SEO settings");
                $id = strtolower(str_replace(' ', '_', $c->html()));

                if (in_array($c->html(), $remove)) {
                    $c->setAttribute('id', $id);
                    //$crawler->filter("#".$id. "table")->remove();
                    return true;
                }

                return false;
            }
        );

        //$headings->remove();


        print $crawler->save();


        // Personal Options
        /*
        $personal_options_table = $dom->find('table')[0];
        $personal_options_table->delete();
        unset($personal_options_table);
        print $dom;
        */

        // remove the headline
        //$headline = __( IS_PROFILE_PAGE ? 'About Yourself' : 'About the user' );
        //$html = str_replace( '<h2>' . $headline . '</h2>', '', $html );

        // remove the table row
        //$html = preg_replace( '~<tr class="user-description-wrap">\s*<th><label for="description".*</tr>~imsUu', '', $html );
        //print $html;
    }
}

if (is_admin()) {
    remove_action("admin_color_scheme_picker", "admin_color_scheme_picker");
    remove_action('personal_options', 'wpml_show_user_options');

}
