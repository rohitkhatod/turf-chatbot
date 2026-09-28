<?php
get_header();
?>
<section class="section">
  <div class="container page-content">
    <?php while (have_posts()) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
    <?php endwhile; ?>
  </div>
</section>
<?php
get_footer();
