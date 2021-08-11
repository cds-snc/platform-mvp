<?php

if (!is_admin()) {
    add_filter('gform_field_container', 'my_field_container', 10, 6);

    function my_field_container($field_container, $field, $form, $css_class, $style, $field_content)
    {
        $field_id = 'field_'.$form['id'].'_'.$field['id'];
        $class = 'form-group '.$css_class;
        if ($field->failed_validation) {
            $class .= ' form-group-error';
        }

        return sprintf('<div id="%s" class="%s" style="%s">{FIELD_CONTENT}</div>', $field_id, $class, $style);
    }
}

function outputTextBoxIfOther($content)
{
    $dom = new domDocument();
    $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
    $xpath = new DomXPath($dom);
    $el = $xpath->query('//input[@aria-label="Other" and @type="text"]');

    if($el->length){

        $content = $dom->saveHTML($el->item(0));

        
        $content = str_replace(
            '<input',
            '<input class="ml-4 input focus:shadow-outline w-full"',
            $content
        );

        return  $content;
    }

    return "";
}

if (!is_admin()) {
    function my_field_content($content, $field, $value, $lead_id, $form_id)
    {
        
        global $inc;
        require_once $inc.'log.php';
        
        // Add .form-control to most inputs.
        $exclude_formcontrol = [
            'hidden',
            'post_image',
            'email',
            'fileupload',
            'list',
            'multiselect',
            'select',
            'html',
            'address',
            'post_category',
        ];

        $class = '';

        if (!in_array($field['type'], $exclude_formcontrol, true)) {
            if ($field->failed_validation) {
                $class .= 'form-control-error ';
            }
        }

        // Select.
        if ('select' === $field['type'] || 'multiselect' === $field['type']) {
            $dom = new domDocument();
            $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
            $xpath = new DomXPath($dom);
            $el = $xpath->query('//div[contains(@class, "ginput_container_select")]')->item(0);
            $select = $el->firstChild;
            $select->setAttribute('class', 'input lg:w-3/6');
            $label = $el->previousSibling;
            $label->setAttribute('class', '');
            $content = $dom->saveHTML($label).$dom->saveHTML($select);
        }

        // Text
        if ('text' === $field['type']) {
            $error = '';
            $class .= 'input w-full lg:w-3/6 focus:shadow-outline';
            $dom = new domDocument();
            $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
            $xpath = new DomXPath($dom);
            $label = $xpath->query('//label[contains(@class, "gfield_label")]')->item(0);
            $el = $xpath->query('//div[contains(@class, "ginput_container_text")]')->item(0)->firstChild;
            $el->setAttribute('class', $class);
            $content = $error.$dom->saveHTML($label).$dom->saveHTML($el);
        }

        // Website
        if ('website' === $field['type']) {
            $dom = new domDocument();
            $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
            $xpath = new DomXPath($dom);
            $el = $xpath->query('//div[contains(@class, "ginput_container_website")]//input')->item(0);
            $label = $xpath->query('//label[contains(@class, "gfield_label")]')->item(0);
            $class .= 'input w-full lg:w-3/6';
            $el->setAttribute('class', $class);
            $content = $dom->saveHTML($label).$dom->saveHTML($el);
        }

        // Phone
        if ('phone' === $field['type']) {
            $dom = new domDocument();
            $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
            $xpath = new DomXPath($dom);
            $el = $xpath->query('//div[contains(@class, "ginput_container_phone")]//input')->item(0);
            $label = $xpath->query('//label[contains(@class, "gfield_label")]')->item(0);
            $class .= 'input w-full lg:w-3/6';
            $el->setAttribute('class', $class);
            $content = $dom->saveHTML($label).$dom->saveHTML($el);
        }

        // Number i.e. extension
        if ('number' === $field['type']) {
            $dom = new domDocument();
            $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
            $xpath = new DomXPath($dom);
            $el = $xpath->query('//div[contains(@class, "ginput_container_number")]//input')->item(0);
            $label = $xpath->query('//label[contains(@class, "gfield_label")]')->item(0);
            $class .= 'input w-full lg:w-3/6';
            $el->setAttribute('class', $class);
            $content = $dom->saveHTML($label).$dom->saveHTML($el);
        }

        // Phone
        if ('email' === $field['type']) {
            $dom = new domDocument();
            $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
            $xpath = new DomXPath($dom);
            $el = $xpath->query('//div[contains(@class, "ginput_container_email")]//input')->item(0);
            $label = $xpath->query('//label[contains(@class, "gfield_label")]')->item(0);
            $class .= 'input w-full lg:w-3/6';
            $el->setAttribute('class', $class);
            $content = $dom->saveHTML($label).$dom->saveHTML($el);
        }

        // Textarea.
        if ('textarea' === $field['type']) {
            $dom = new domDocument();
            $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
            $xpath = new DomXPath($dom);
            $label = $xpath->query('//label[contains(@class, "gfield_label")]')->item(0);
            $el = $xpath->query('//div[contains(@class, "ginput_container_textarea")]')->item(0)->firstChild;
            $class .= 'input focus:shadow-outline w-full lg:w-3/6';
            $el->setAttribute('class', $class);
            $content = $dom->saveHTML($label).$dom->saveHTML($el);
        }

        // Checkbox.
        if ('checkbox' === $field['type']) {
            $dom = new domDocument();
            $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
            $xpath = new DomXPath($dom);
            $checkboxes = $xpath->query('//ul[contains(@class, "gfield_checkbox")]//li//input[@type="checkbox"]');
            $checkboxes_out = '';
            $label = $xpath->query('//label', $checkboxes->item(0));
            $checkboxes_out = '<label>'.$label->item(0)->nodeValue.'</label>';

            foreach ($checkboxes as $checkboxItem) {
                $checkboxes_out .= '<div>';
                $checkboxes_out .= "<label class='inline-flex items-center'>";
                $label = $checkboxItem->nextSibling->nodeValue;
                $checkboxItem->setAttribute('class', 'text-blue form-checkbox h-6 w-6');
                $checkboxes_out .= $dom->saveHTML($checkboxItem);
                $checkboxes_out .= "<span class='ml-3 text-lg'>".$label.'</span>';
                $checkboxes_out .= '</label>';
                $checkboxes_out .= '</div>';
            }

            $content = $checkboxes_out;
        }

        // Radio.
        if ('radio' === $field['type']) {

            $dom = new domDocument();
            $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content);
            $xpath = new DomXPath($dom);

            $radios = $xpath->query('//ul[contains(@class, "gfield_radio")]//li');
            $radio_out = '';
            $label = $xpath->query('//label', $radios->item(0));
            $radio_out = '<label>'.$label->item(0)->nodeValue.'</label>';

            foreach ($radios as $radioItem) {

                $class = "text-blue form-radio h-6 w-6";
                $other = outputTextBoxIfOther($dom->saveHTML($radioItem));

                if($other){
                    // add some margin between the input and the text box
                    $class .=" mr-10";
                }

                $radio_out .= '<div>';
                $radio_out .= "<label class='inline-flex items-center'>";
                $label = $radioItem->lastChild;
                $radio = $radioItem->firstChild;
                $radio->setAttribute('class', $class);
                $radio_out .= $dom->saveHTML($radio);
                
                $radio_out .= $other;

                if(!$other){
                    $radio_out .= "<span class='ml-3 text-lg'>".$label->nodeValue.'</span>';
                }
                
                $radio_out .= '</label>';
                $radio_out .= '</div>';
            }

            $content = $radio_out;
            
        }

        // Date
        if ('date' === $field['type']) {
            $content = str_replace(
                '<input',
                '<input class="input focus:shadow-outline w-full lg:w-3/6"',
                $content
            );
        }

        return $content;
    }

    add_filter('gform_field_content', 'my_field_content', 10, 5);
}

add_filter('gform_validation_message', function ($message, $form) {
    if (gf_upgrade()->get_submissions_block()) {
        return $message;
    }

    $message = "<div class='border-l-4 border-solid border-red bg-red-100 p-5 mb-10' role='alert'><h3>Please correct the errors on the page</h3>";
    $message .= "<ol class='list-decimal list-inside ml-2 py-3' id='formErrors'>";

    foreach ($form['fields'] as $field) {
        if ($field->failed_validation) {
            $field_id = 'input_'.$form['id'].'_'.$field['id'];
            $message .= sprintf('<li><a href="#%s">%s - %s</a></li>', $field_id, GFCommon::get_label($field), $field->validation_message);
        }
    }

    $message .= '</ol></div>';

    return $message;
}, 10, 2);
