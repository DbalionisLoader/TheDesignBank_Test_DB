<?php
/*
Template Name: Contact Form Page
*/
get_header();

?>


<main class="pb-contact-content">
  <div class="pb-contact-wrapper">
    <?php get_template_part('template-parts/contact/contact', 'details'); ?>
    <?php
    if (shortcode_exists('pbform')) {
      echo do_shortcode('[pbform]');
    }
    ?>
    <?php get_template_part('template-parts/contact/contact', 'map'); ?>
  </div>
  <section class="pb-page-content">

    <?php
    while (have_posts()) :
      the_post();
      the_content();
    endwhile;
    ?>
  </section>
</main>
<?php get_footer(); ?>