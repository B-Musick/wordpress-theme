<?php
if ( function_exists( 'do_blocks' ) ) {
  echo do_blocks( '<!-- wp:template-part {"slug":"header","tagName":"header","className":"site-header"} /-->' );
}
?>
<main class="container py-5">
  <h1 class="mb-4">Search Results for: <?php echo get_search_query(); ?></h1>

  <div class="row">
    <!-- Sidebar Filters -->
    <aside class="col-md-3 mb-4">
      <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="border rounded p-3 bg-light">
        <h5 class="mb-3">Filter by Type</h5>

        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="filter_category" id="all" value=""
            <?php checked(get_query_var('filter_category'), ''); ?>>
          <label class="form-check-label" for="all">All</label>
        </div>

        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="filter_category" id="news" value="news"
            <?php checked(get_query_var('filter_category'), 'news'); ?>>
          <label class="form-check-label" for="news">News</label>
        </div>

        <div class="form-check mb-3">
          <input class="form-check-input" type="radio" name="filter_category" id="stories" value="stories"
            <?php checked(get_query_var('filter_category'), 'stories'); ?>>
          <label class="form-check-label" for="stories">Stories</label>
        </div>

        <!-- Preserve search query -->
        <input type="hidden" name="s" value="<?php echo esc_attr(get_search_query()); ?>">

        <button type="submit" class="btn btn-primary w-100">Apply</button>
      </form>
    </aside>

    <!-- Search Results -->
    <section class="col-md-9">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <article class="custom-search-card d-flex flex-column flex-md-row rounded shadow-sm overflow-hidden mb-4">
            <?php if (has_post_thumbnail()) : ?>
              <div class="custom-search-card-image">
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?>
                </a>
              </div>
            <?php endif; ?>

            <div class="custom-search-card-content p-3 flex-grow-1">
              <h2 class="h5 mb-2">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                  <?php the_title(); ?>
                </a>
              </h2>
              <p class="mb-0"><?php echo get_the_excerpt(); ?></p>
            </div>
          </article>
        <?php endwhile; ?>

        <?php the_posts_pagination(); ?>

      <?php else : ?>
        <p>No results found. Try a different search.</p>
      <?php endif; ?>
    </section>
  </div>
</main>

<?php
echo do_blocks('<!-- wp:template-part {"slug":"footer","tagName":"footer","className":"site-footer"} /-->');
?>
