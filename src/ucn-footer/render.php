<?php
/**
 * Server-side render for Footer block
 *
 * @var array $attributes
 */

$menus    = $attributes['menus']    ?? [];
$policies = $attributes['policies'] ?? [];

$current_year = date('Y'); // [variable for current year]

// Example ACF options (adjust field names to match your setup)
$footer_logo    = get_field('footer_logo', 'option');
$social_links   = get_field('social_links', 'option');
$footer_tagline = get_field('footer_tagline', 'option');
?>

<div class="footer-container">
  <div class="footer-inner d-flex flex-wrap justify-content-between align-items-start">
    
    <!-- Left Column -->
    <div class="footer-left">
      <div class="footer-logo">
        <?php if ($footer_logo): ?>
          <img src="<?php echo esc_url($footer_logo['url']); ?>" alt="<?php echo esc_attr($footer_logo['alt']); ?>" />
        <?php else: ?>
          <?php the_custom_logo(); ?>
        <?php endif; ?>
        <p class="footer-site-name"><?php bloginfo('name'); ?></p>
      </div>

      <?php if (!empty($social_links)): ?>
      <ul class="footer-social">
        <?php foreach ($social_links as $social): ?>
          <li>
            <a href="<?php echo esc_url($social['url']); ?>" class="social-link">
              <i class="<?php echo esc_attr($social['icon']); ?>"></i>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>

      <ul class="footer-links">
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">Campuses</a></li>
      </ul>
    </div>

    <!-- Right Column (Menus) -->
     <div class="footer-right d-flex flex-wrap w-100 w-md-auto">

      <?php foreach ($menus as $menu): ?>
        <div class="footer-menu d-flex flex-column">
          <h4><?php echo esc_html($menu['label'] ?? ''); ?></h4>
          <?php
            if ( ! empty($menu['themeLocation']) ) {
              wp_nav_menu([
                'theme_location' => $menu['themeLocation'],
                'container'      => false,
                'menu_class'     => 'footer-stacked',
                'fallback_cb'    => false
              ]);
            }
          ?>
        </div>
      <?php endforeach; ?>

      <div class="footer-extra ms-auto">
        <div class="footer-tagline">
          HERE YOU <span class="ms-2"> CAN.</span>
        </div>

        <?php if ( ! empty($policies) ): ?>
          <ul class="footer-policies">
            <?php foreach ($policies as $p):
              $text = isset($p['text']) ? trim($p['text']) : '';
              $url  = isset($p['url']) ? trim($p['url']) : '';
              if ( $text === '' ) { continue; }
            ?>
              <li>
                <?php if ( $url !== '' ): ?>
                  <a href="<?php echo esc_url($url); ?>">
                    <?php echo esc_html($text); ?>
                  </a>
                <?php else: ?>
                  <?php echo esc_html($text); ?>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

     
      </div>
         <div class="footer-copy">
          &copy; <?php echo esc_html($current_year); ?> <?php bloginfo('name'); ?>
        </div>
    </div>
  </div>
</div>
