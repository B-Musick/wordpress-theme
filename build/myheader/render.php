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
$top_menu_full   = $attributes['topMenuFull'] ?? '';
$top_menu_mobile = $attributes['topMenuMobile'] ?? '';
$main_menu       = $attributes['mainMenu'] ?? '';

$icons = [
  'Twitter'   => 'dashicons-twitter',
  'Facebook'  => 'dashicons-facebook',
  'Instagram' => 'dashicons-instagram',
  'LinkedIn'  => 'dashicons-linkedin',
  'YouTube'   => 'dashicons-video-alt3',
];

?>


<div class="top-logo-bar">
        <?php
            wp_nav_menu(array(
                'theme_location' => $top_menu_full,
                'container' => false,
                'menu_class' => 'sign-in-dropdown',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto flex-row w-100 justify-content-end gap-5 flex-1 d-none d-md-flex %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
        ?>
        <?php
            wp_nav_menu(array(
                'theme_location' => 'sign-in-menu',
                'container' => false,
                'menu_class' => 'sign-in-dropdown',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto flex-row w-100 justify-content-end gap-5 flex-1 d-md-none %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
        ?>
        <div class="ms-3">
          
            <button type="submit" class="search-button" onclick="toggleSearchDropdown()" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18e" fill="currentColor" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 
                1.415-1.414l-3.85-3.85zm-5.242 1.156a5 5 0 1 1 
                0-10 5 5 0 0 1 0 10z"/>
            </svg>
        </button>
        </div>
</div>

<nav class="navbar navbar-expand-md main-navigation d-flex">
    <div class="d-flex justify-content-between md-w-100">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo-link">
            <?php
                // $logo = get_field('logo', 'option');
                $logo = true;
                if ( $logo ) :
            ?>
            <!-- Revert this to use a site option logo -->
                <img 
                    src="http://brendan-musick-portfolio.local/wp-content/uploads/2025/10/Screenshot-2025-10-18-at-9.54.57-AM.png" 
                    alt="test" 
                    style="height: 50px; width: auto;" 
                />
            <?php endif; ?>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger-line"></div>
            <div class="hamburger-line"></div>
            <div class="hamburger-line"></div>
        </button>
        

    </div>
            <div class="collapse navbar-collapse" id="main-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => $top_menu_mobile,
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 flex-1 %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>
                  <?php
            wp_nav_menu(array(
                'theme_location' => $main_menu,
                'container' => false,
                'menu_class' => 'dropdown-bottom-items',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto flex-row w-100 justify-content-center gap-5 mb-md-0 flex-1 flex-1 d-md-none font-sm %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
        ?>
        </div>
</nav>
<section class="search has-primary-light-background-color collapsed position-relative" id="search-dropdown">
    <button onclick="toggleSearchDropdown()"
            class="close-search bg-transparent border-0 p-0 m-0 text-white">
        <!-- Inline X so it works even without Font Awesome -->
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            aria-hidden="true" focusable="false">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
        <span class="visually-hidden">Close</span>
    </button>

    <div class="d-flex flex-row justify-content-center pt-5">
        <?php get_search_form(); ?>
    </div>
</section>


<script>
function toggleSearchDropdown() {
  const dropdown = document.getElementById('search-dropdown');
  dropdown.classList.toggle('expanded');
}

</script>

