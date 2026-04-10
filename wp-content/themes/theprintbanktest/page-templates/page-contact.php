<?php
/*
Template Name: Contact Form Page
*/
get_header();

?>


<main class="pb-contact-content">
  <div class="class-pb-contact-wrapper">

  </div><?php
        if (shortcode_exists('pbform')) {
          echo do_shortcode('[pbform]');
        }
        ?>
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