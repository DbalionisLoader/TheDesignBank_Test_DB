<?php

//Custom walker class to add tailwind css to nav menu
class Walker_Basic_Nav extends Walker_Nav_Menu
{

  //Code for the submenu wrapper (child ul start)
  function start_lvl(&$output, $depth = 0, $args = null) {}

  //Code for the end of submenu wrapper (child ul end)
  function end_lvl(&$output, $depth = 0, $args = null) {}

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    //$classes = implode(' ', $item->classes);

    $class_names = implode(' ', array_filter($item->classes));
    $url  = ! empty($item->url) ? $item->url : '';
    $title = ! empty($item->title) ? $item->title : '';

    $output .= '<a class="' . esc_attr($class_names) . '" href="' . esc_url($url)  . '">';
    $output .= esc_html($title);
    $output .= '</a>';
  }

  function end_el(&$output, $item, $depth = 0, $args = null) {}
};
