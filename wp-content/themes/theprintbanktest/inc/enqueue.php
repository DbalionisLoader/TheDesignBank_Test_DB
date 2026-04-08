<?php

function theprintbanktest_styles()
{
  $path = get_template_directory() . '/assets/css/main_style.css';

  wp_enqueue_style(
    'main_style',
    get_template_directory_uri() . '/assets/css/main_style.css',
    [],
    file_exists($path) ? filemtime($path) : null
  );
}

add_action('wp_enqueue_scripts', 'theprintbanktest_styles');
