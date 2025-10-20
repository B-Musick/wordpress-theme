<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div class="footer-container">
  <div class="footer-inner d-flex flex-wrap justify-content-between align-items-start">

    <!-- Left Column -->
    <div class="footer-left">
      <div class="footer-logo">
        <?php the_custom_logo(); ?>
        <p class="footer-site-name"><?php bloginfo('name'); ?></p>
      </div>

      <ul class="footer-social">
        <li><a href="#" class="social-link"><i class="dashicons dashicons-twitter"></i></a></li>
        <li><a href="#" class="social-link"><i class="dashicons dashicons-facebook"></i></a></li>
        <li><a href="#" class="social-link"><i class="dashicons dashicons-instagram"></i></a></li>
        <li><a href="#" class="social-link"><i class="dashicons dashicons-youtube"></i></a></li>
      </ul>

      <ul class="footer-links">
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">Campuses</a></li>
      </ul>
    </div>

    <!-- Right Column (Menus) -->
    <div class="footer-right d-flex flex-wrap w-100 w-md-auto">

      <div class="footer-menu d-flex flex-column">
        <h4>Admissions</h4>
        <?php wp_nav_menu([
        //   'theme_location' => 'footer-admissions',
                'theme_location' => 'dropdown-bottom-menu',

          'container'      => false,
          'menu_class'     => 'footer-stacked',
          'fallback_cb'    => false
        ]); ?>
      </div>

      <!-- <div class="footer-menu d-flex flex-column">
        <h4>Students</h4> -->
        <?php 
        // wp_nav_menu([
        //   'theme_location' => 'footer-students',
        //         'theme_location' => 'dropdown-bottom-menu',

        //   'container'      => false,
        //   'menu_class'     => 'footer-stacked',
        //   'fallback_cb'    => false
        // ]); 
        ?>
      <!-- </div> -->

      <div class="footer-menu d-flex flex-column">
        <h4>Community</h4>
        <?php wp_nav_menu([
        //   'theme_location' => 'footer-community',
                'theme_location' => 'dropdown-bottom-menu',

          'container'      => false,
          'menu_class'     => 'footer-stacked',
          'fallback_cb'    => false
        ]); ?>
      </div>

      <div class="footer-extra ms-auto">
        <div class="footer-tagline">HERE YOU <span class="ms-2"> CAN.</span></div>
        <ul class="footer-policies">
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="#">Website Feedback</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
