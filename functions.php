<?php
require_once get_template_directory() . '/inc/class-bootstrap-5-navwalker.php';

/***
 * LOAD STYLES AND SCRIPTS
 */
function load_css() {
    // Minified version of Bootstrap
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap');

    // Main stylesheet - put this after so bootstrap doesnt overwrite main.css styles
    wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all');
    wp_enqueue_style('main');

     // Load style.css (the default theme stylesheet)
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array('main'), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'load_css');

// Load JS
function load_js(){
    wp_enqueue_script('jquery'); // jQuery comes bundled with WordPress

    // wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), false, true);
    // wp_enqueue_script('bootstrap');
    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), false, true);
wp_enqueue_script('bootstrap');

}
add_action('wp_enqueue_scripts', 'load_js');

function mytheme_enqueue_scripts() {
    // Enqueue your main CSS (if not already)
    wp_enqueue_style('main-css', get_template_directory_uri() . '/main.css');

    // Enqueue the search toggle script
    wp_enqueue_script(
        'search-toggle', // Handle name
        get_template_directory_uri() . '/js/search-toggle.js', // Path to JS file
        array(), // No dependencies
        null, // No specific version
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

/************************************************
 * REGISTER BLOCKS IN /SRC
 ***********************************************/
function create_block_ucn_blocks_block_init() {
	if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
		wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
		return;
	}

	if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
		wp_register_block_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
	}

	$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
	foreach ( array_keys( $manifest_data ) as $block_type ) {
		register_block_type( __DIR__ . "/build/{$block_type}" );
	}
}
add_action( 'init', 'create_block_ucn_blocks_block_init' );

/**
 * REGISTER MENUS
 */
add_action('after_setup_theme', function () {
    register_nav_menus([
        'top-menu' => __('Top Menu', 'ucn-theme'),
        'footer-menu' => __('Footer Menu', 'ucn-theme'),
        'header-top-menu' => __('Header Top Menu', 'ucn-theme'),
        'sign-in-menu' => __('Sign In Menu', 'ucn-theme'),
        'dropdown-bottom-menu' => __('Dropdown Bottom Menu', 'ucn-theme'),
    ]);
});


/**
 * Search filter (check ucn files to see what previously had)
 */

// function filter_query_by_category_or_post_type($query) {
//   if (!is_admin() && $query->is_main_query()) {

//     // Category filter for 'news' or 'stories'
//     if (!empty($_GET['filter_category'])) {
//       $query->set('post_type', 'post'); // default WP post type
//       $query->set('category_name', sanitize_text_field($_GET['filter_category']));
//     }

//     // Custom post type filter for 'faculty'
//     if (!empty($_GET['post_type']) && $_GET['post_type'] === 'faculty') {
//       $query->set('post_type', 'faculty');
//     }
//   }
// }
// add_action('pre_get_posts', 'filter_query_by_category_or_post_type');

/**
 * Icons
 */
function mytheme_enqueue_dashicons_frontend() {
    wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_dashicons_frontend' );




/**
 * Search filter
 */

add_filter('query_vars', function ($vars) {
    $vars[] = 'filter-program-faculty';
    $vars[] = 'filter-department';
    $vars[] = 'filter-category'; // still the built-in category
    return $vars;
});

add_action('pre_get_posts', function ($q) {
    if (is_admin() || !$q->is_main_query() || !$q->is_search()) return;

    // Helper to normalize and sanitize incoming values
    $normalize_filter = function ($input) {
        if (empty($input)) return [];
        // Flatten possible nested arrays and cast everything to string
        $flat = [];
        foreach ((array) $input as $val) {
            if (is_array($val)) {
                $flat = array_merge($flat, array_map('sanitize_title', $val));
            } else {
                $flat[] = sanitize_title($val);
            }
        }
        // Remove duplicates and blanks
        return array_filter(array_unique($flat));
    };

    $tax_filters = [];

    // Program / Faculty
    $program_faculty = $normalize_filter($q->get('filter-program-faculty'));
    if ($program_faculty) {
        $tax_filters[] = [
            'taxonomy' => 'program-faculty',
            'field'    => 'slug',
            'terms'    => $program_faculty,
        ];
    }

    // Department
    $department = $normalize_filter($q->get('filter-department'));
    if ($department) {
        $tax_filters[] = [
            'taxonomy' => 'department',
            'field'    => 'slug',
            'terms'    => $department,
        ];
    }

    // Built-in Categories
    $category = $normalize_filter($q->get('filter-category'));
    if ($category) {
        $tax_filters[] = [
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $category,
        ];
    }

    if ($tax_filters) {
        $q->set('tax_query', [
            'relation' => 'AND',
            ...$tax_filters
        ]);
    }
});


add_shortcode('search_filters', function () {
    $current_search = get_search_query();

    $selected_program_faculty = (array) get_query_var('filter-program-faculty');
    $selected_department      = (array) get_query_var('filter-department');
    $selected_category        = (array) get_query_var('filter-category');

    ob_start(); ?>
    <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-filters">

        <input type="hidden" name="s" value="<?php echo esc_attr($current_search); ?>">

        <!-- Program / Faculty -->
        <fieldset class="mb-4">
            <legend class="fw-bold h6 mb-2">Program / Faculty</legend>
            <?php
            $terms = get_terms(['taxonomy' => 'program-faculty', 'hide_empty' => false]);
            foreach ($terms as $term):
                $id = 'pf-' . esc_attr($term->slug);
                $checked = in_array($term->slug, $selected_program_faculty, true);
            ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                        name="filter-program-faculty[]"
                        id="<?php echo $id; ?>"
                        value="<?php echo esc_attr($term->slug); ?>"
                        <?php checked($checked); ?>>
                    <label class="form-check-label" for="<?php echo $id; ?>">
                        <?php echo esc_html($term->name); ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </fieldset>

        <!-- Department -->
        <fieldset class="mb-4">
            <legend class="fw-bold h6 mb-2">Department</legend>
            <?php
            $terms = get_terms(['taxonomy' => 'department', 'hide_empty' => false]);
            foreach ($terms as $term):
                $id = 'dept-' . esc_attr($term->slug);
                $checked = in_array($term->slug, $selected_department, true);
            ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                        name="filter-department[]"
                        id="<?php echo $id; ?>"
                        value="<?php echo esc_attr($term->slug); ?>"
                        <?php checked($checked); ?>>
                    <label class="form-check-label" for="<?php echo $id; ?>">
                        <?php echo esc_html($term->name); ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </fieldset>

        <!-- Built-in Categories -->
        <fieldset class="mb-4">
            <legend class="fw-bold h6 mb-2">Category</legend>
            <?php
            $terms = get_terms(['taxonomy' => 'category', 'hide_empty' => false]);
            foreach ($terms as $term):
                $id = 'cat-' . esc_attr($term->slug);
                $checked = in_array($term->slug, $selected_category, true);
            ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                        name="filter-category[]"
                        id="<?php echo $id; ?>"
                        value="<?php echo esc_attr($term->slug); ?>"
                        <?php checked($checked); ?>>
                    <label class="form-check-label" for="<?php echo $id; ?>">
                        <?php echo esc_html($term->name); ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </fieldset>

        <!-- <button class="btn btn-primary" type="submit">Apply Filters</button> -->
        <a href="<?php echo esc_url(add_query_arg(['s' => $current_search], home_url('/'))); ?>" class="btn btn-link p-0 ms-3">Clear</a>
    </form>
    <!-- <script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('.search-filters');
  if (!form) return;

  // Attach change event to all checkboxes
  form.querySelectorAll('input[type="checkbox"]').forEach(input => {
    input.addEventListener('change', function() {
      form.submit(); // auto-submit on change
    });
  });
});
</script> -->
    <?php
    return ob_get_clean();
});
add_action('wp_enqueue_scripts', function() {
  wp_add_inline_script('jquery', "
    jQuery(function($) {
      const form = $('.search-filters');
      if (!form.length) return;
      let timer;
      form.find('input[type=\"checkbox\"]').on('change', function() {
        clearTimeout(timer);
        timer = setTimeout(() => form.submit(), 300);
      });
    });
  ");
});
