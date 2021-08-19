<?php

declare(strict_types=1);

use PHPHtmlParser\Dom;

add_filter('render_block', 'cds_date_block', 10, 3);

function cds_date_block($block_content, $block)
{
    if ($block['blockName'] !== 'core/post-date') {
        return $block_content;
    }

    try {
        $dom = new Dom();
        $dom->loadStr($block_content);
        $time = $dom->find('time')[0];
        return str_replace($time, '['.$time.']', $block_content);
    } catch (Exception $e) {
        return $block_content;
    }
}
