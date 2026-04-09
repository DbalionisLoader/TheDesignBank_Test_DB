	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
	  <?php wp_body_open(); ?>


	  <header class="site-header">
	    <div class="pb-heading-wrap">

	      <div class="pb-header_menu">
	        <?php
          wp_nav_menu(
            [
              'theme_location' => 'primary',
              'container'      => false,
              'menu_class' => 'header_menu',
              'walker' => new Walker_Basic_Nav(),
              'items_wrap' => '%3$s',
              'fallback_cb'        => false,
            ]
          );
          ?>
	      </div>
	      <section class="pb-hero-section">
	        <div class="pb-hero-background">
	          <img srcset="<?php echo get_template_directory_uri(); ?>/assets/images/Header-Image.jpg, <?php echo get_template_directory_uri(); ?>/assets/images/Header-Image-Mobile.jpg 400w"
	            sizes="(max-width: 600px) 480px, 800px"
	            alt="Stack of leaflets of 3 different colours" src="<?php echo get_template_directory_uri(); ?>/assets/images/Header-Image.jpg">
	        </div>
	        <div class="pb-hero-container">
	          <div class="pb-hero-content">

	          </div>
	        </div>
	      </section>
	    </div>
	  </header>