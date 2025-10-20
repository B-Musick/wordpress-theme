<?php $search_id = 'search-field-' . wp_unique_id(); ?>
<form role="search" method="get" class="custom-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label class="visually-hidden" for="<?php echo esc_attr($search_id); ?>">
    <?php esc_html_e('Search for:', 'your-textdomain'); ?>
  </label>

  <div class="input-group rounded-pill bg-white shadow-sm overflow-hidden">
    <input
      type="search"
      id="<?php echo esc_attr($search_id); ?>"
      class="form-control border-0 px-4 bg-white"
      placeholder="Search the website..."
      value="<?php echo esc_attr( get_search_query() ); ?>"
      name="s"
      aria-label="<?php esc_attr_e('Search', 'your-textdomain'); ?>"
    >
    <button class="btn btn-link text-dark pe-4" type="submit" aria-label="<?php esc_attr_e('Search', 'your-textdomain'); ?>">
      <!-- FIXED: height="18" -->
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242 1.156a5 5 0 1 1 0-10 5 5 0 0 1 0 10z"/>
      </svg>
    </button>
  </div>


  <!-- TODO: make these accessible with the keyboard using tab function -->
  <div class="d-flex justify-content-around mt-3">
      <div class="form-check form-check-inline">
    <input class="form-check-input custom-radio" type="radio" name="filter_category" id="all" value="" <?php checked(get_query_var('filter_category'), ''); ?> >
    <label class="form-check-label fw-bold" for="all">All</label>
  </div>
      <div class="form-check form-check-inline">
    <input class="form-check-input custom-radio" type="radio" name="filter_category" id="news" value="news" <?php checked(get_query_var('filter_category'), 'news'); ?>>
    <label class="form-check-label fw-bold" for="news">News</label>
  </div>

  <div class="form-check form-check-inline">
    <input class="form-check-input custom-radio" type="radio" name="filter_category" id="stories" value="stories" <?php checked(get_query_var('filter_category'), 'stories'); ?>>
    <label class="form-check-label fw-bold" for="stories">Stories</label>
  </div>
    <!-- <div class="form-check form-check-inline">
        <input class="form-check-input custom-radio" type="radio" name="post_type" id="programs" value="news" <?php checked(get_query_var('post_type'), 'post'); ?>>
        <label class="form-check-label fw-bold" for="programs">News</label>
    </div>

    <div class="form-check">
      <input class="form-check-input custom-radio" type="radio" name="post_type" id="stories" value="post" <?php checked(get_query_var('post_type'), 'story'); ?>>
      <label class="form-check-label fw-bold" for="stories">Stories</label>
    </div> -->

    <!-- <div class="form-check">
      <input class="form-check-input custom-radio" type="radio" name="post_type" id="people" value="faculty" <?php checked(get_query_var('post_type'), 'faculty'); ?>>
      <label class="form-check-label fw-bold" for="people">People</label>
    </div> -->
  </div>
  
  <div class="d-flex flex-row justify-evenly flex-wrap search-form-menus-container">
    <div class="search-form-menu pb-3">
      <div class="fw-bold text-decoration-underline">Students</div>
        <?php
            wp_nav_menu(
                array(
                    'theme_location'       => 'search-mega-students',
                    'container'            => '',
                    'container_class'      => '',
                    'container_id'         => '',
                    'container_aria_label' => 'Student Search Menu',
                ),
            );
          ?>
    </div>
      <div class="search-form-menu pb-3">
      <div class="fw-bold text-decoration-underline">Students</div>
        <?php
            wp_nav_menu(
                array(
                    'theme_location'       => 'search-mega-students',
                    'container'            => '',
                    'container_class'      => '',
                    'container_id'         => '',
                    'container_aria_label' => 'Student Search Menu',
                ),
            );
          ?>
    </div>
      <div class="search-form-menu pb-3">
      <div class="fw-bold text-decoration-underline">Students</div>
        <?php
            wp_nav_menu(
                array(
                    'theme_location'       => 'search-mega-students',
                    'container'            => '',
                    'container_class'      => '',
                    'container_id'         => '',
                    'container_aria_label' => 'Student Search Menu',
                ),
            );
          ?>
    </div>
  </div>
</form>
