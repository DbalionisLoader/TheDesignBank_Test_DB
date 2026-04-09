<?php
/*
Template Name: Home Page
*/
get_header();
?>


<main class="pb-main-content">
  <?php get_template_part('template-parts/hero/hero', 'home'); ?>
  <section class="pb-page-content">
    <?php get_template_part('template-parts/about/about', 'home'); ?>
    <?php
    while (have_posts()) :
      the_post();
      the_content();
    endwhile;
    ?>
  </section>
</main>
<?php get_footer(); ?>