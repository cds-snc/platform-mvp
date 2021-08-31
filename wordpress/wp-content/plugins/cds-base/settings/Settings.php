<?php
add_action( 'admin_menu', 'cds_add_admin_menu' );
add_action( 'admin_init', 'cds_settings_init' );


function cds_add_admin_menu(  ) {

    add_menu_page( 'cds-settings', 'cds-settings', 'manage_options', 'cds-settings', 'cds_options_page' );

}


function cds_settings_init(  ) {

    register_setting( 'pluginPage', 'cds_settings' );

    add_settings_section(
        'cds_pluginPage_section',
        __( 'Your section description', 'cds' ),
        'cds_settings_section_callback',
        'pluginPage'
    );

    add_settings_field(
        'cds_text_field_0',
        __( 'Settings field description', 'cds' ),
        'cds_text_field_0_render',
        'pluginPage',
        'cds_pluginPage_section'
    );

    add_settings_field(
        'cds_radio_field_1',
        __( 'Settings field description', 'cds' ),
        'cds_radio_field_1_render',
        'pluginPage',
        'cds_pluginPage_section'
    );

    add_settings_field(
        'cds_checkbox_field_2',
        __( 'Settings field description', 'cds' ),
        'cds_checkbox_field_2_render',
        'pluginPage',
        'cds_pluginPage_section'
    );

    add_settings_field(
        'cds_select_field_3',
        __( 'Settings field description', 'cds' ),
        'cds_select_field_3_render',
        'pluginPage',
        'cds_pluginPage_section'
    );


}


function cds_text_field_0_render(  ) {

    $options = get_option( 'cds_settings' );
    ?>
    <input type='text' name='cds_settings[cds_text_field_0]' value='<?php echo $options['cds_text_field_0']; ?>'>
    <?php

}


function cds_radio_field_1_render(  ) {

    $options = get_option( 'cds_settings' );
    ?>
    <input type='radio' name='cds_settings[cds_radio_field_1]' <?php checked( $options['cds_radio_field_1'], 1 ); ?> value='1'>
    <?php

}


function cds_checkbox_field_2_render(  ) {

    $options = get_option( 'cds_settings' );
    ?>
    <input type='checkbox' name='cds_settings[cds_checkbox_field_2]' <?php checked( $options['cds_checkbox_field_2'], 1 ); ?> value='1'>
    <?php

}


function cds_select_field_3_render(  ) {

    $options = get_option( 'cds_settings' );
    ?>
    <select name='cds_settings[cds_select_field_3]'>
        <option value='1' <?php selected( $options['cds_select_field_3'], 1 ); ?>>Option 1</option>
        <option value='2' <?php selected( $options['cds_select_field_3'], 2 ); ?>>Option 2</option>
    </select>

    <?php

}


function cds_settings_section_callback(  ) {

    echo __( 'This section description', 'cds' );

}


function cds_options_page(  ) {

    ?>
    <form action='options.php' method='post'>

        <h2>cds-settings</h2>

        <?php
        settings_fields( 'pluginPage' );
        do_settings_sections( 'pluginPage' );
        submit_button();
        ?>

    </form>
    <?php

}