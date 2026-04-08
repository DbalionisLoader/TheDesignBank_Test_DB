	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
	  <?php wp_body_open(); ?>


	  <header class="site-header">
	    <div class="heading">
	      <h1>Hello New Theme</h1>
	    </div>
	    <div class="header_menu">
	      <?php
        wp_nav_menu(
          [
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class' => 'header_menu',
            //'walker' => new Walker_Basic_Nav(),
            'items_wrap' => '%3$s',
            'fallback_cb'        => false,
          ]
        );
        ?>
	    </div>
	  </header>