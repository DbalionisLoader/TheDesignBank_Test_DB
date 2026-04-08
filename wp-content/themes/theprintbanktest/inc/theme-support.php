<?php

add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('responsive-embeds');
  add_theme_support('align-wide');
  add_theme_support(
    'html5',
    [
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    ]
  );

  register_nav_menus(
    [
      'primary' => __('Primary Menu', 'theprintbanktest'),
      'footer'  => __('Footer Menu', 'theprintbanktest'),
    ]
  );
});
