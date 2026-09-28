<?php
if (! defined('ABSPATH')) {
    exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Tirupathi Agro delivers modern agriculture products, crop guidance, and dealer support across India.">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
  <div class="container header-wrap">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">Tirupathi Agro</a>
    <button class="menu-toggle" aria-expanded="false" aria-controls="primary-menu">Menu</button>
    <nav id="primary-menu" class="primary-nav" aria-label="Primary navigation">
      <?php
      wp_nav_menu([
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'menu',
          'fallback_cb'    => 'wp_page_menu',
      ]);
      ?>
    </nav>
  </div>
</header>
<main>
