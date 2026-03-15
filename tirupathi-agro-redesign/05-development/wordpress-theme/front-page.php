<?php
$lead_status = isset($_GET['lead_status']) ? sanitize_text_field(wp_unslash($_GET['lead_status'])) : '';
get_header();
?>
<section class="hero">
  <div class="container hero-grid">
    <div>
      <p class="eyebrow">Growth-driven agriculture partner</p>
      <h1>High Performance Agriculture Products for Better Yield</h1>
      <p>From seed support to crop nutrition, Tirupathi Agro helps farmers, dealers, and institutions improve output with trusted solutions.</p>
      <div class="hero-actions">
        <a class="btn btn-primary" href="#products">Explore Products</a>
        <a class="btn btn-outline" href="#contact">Get Dealer Support</a>
      </div>
    </div>
    <div class="hero-card">
      <h2>Why choose us?</h2>
      <ul>
        <li>Scientifically-backed crop solutions</li>
        <li>Large dealer and distribution support</li>
        <li>Fast advisory and seasonal recommendations</li>
      </ul>
    </div>
  </div>
</section>

<section id="products" class="section">
  <div class="container">
    <h2>Featured Product Segments</h2>
    <p class="section-intro">Use filters to browse solutions by farm need.</p>
    <div class="filters" role="tablist" aria-label="Product filter">
      <button class="filter-btn is-active" data-filter="all" type="button">All</button>
      <button class="filter-btn" data-filter="nutrition" type="button">Crop Nutrition</button>
      <button class="filter-btn" data-filter="protection" type="button">Crop Protection</button>
      <button class="filter-btn" data-filter="seeds" type="button">Seeds</button>
    </div>
    <div class="cards" id="product-grid">
      <article class="card" data-category="nutrition">
        <h3>Micronutrient Mix</h3>
        <p>Balanced formulation for deficiency correction and yield improvement.</p>
      </article>
      <article class="card" data-category="protection">
        <h3>Fungal Shield</h3>
        <p>Targeted crop protection support against common fungal stress.</p>
      </article>
      <article class="card" data-category="seeds">
        <h3>Premium Hybrid Seeds</h3>
        <p>High-germination seed choices for key crops and climate zones.</p>
      </article>
      <article class="card" data-category="nutrition">
        <h3>Soil Booster Granules</h3>
        <p>Improves root health, nutrient uptake, and plant vigor.</p>
      </article>
    </div>
  </div>
</section>

<section class="section testimonials">
  <div class="container">
    <h2>What Farmers Say</h2>
    <div class="testimonial-wrap" data-testimonial-index="0">
      <blockquote class="testimonial is-active">“Our cotton yield improved after switching to Tirupathi Agro nutrition pack.” — Farmer, Telangana</blockquote>
      <blockquote class="testimonial">“Dealer support is quick and product recommendations are practical.” — Distributor, Andhra Pradesh</blockquote>
      <blockquote class="testimonial">“Good quality and consistent results across two crop seasons.” — Farmer, Karnataka</blockquote>
    </div>
    <button class="btn btn-outline" id="next-testimonial" type="button">Next Testimonial</button>
  </div>
</section>

<section id="contact" class="section cta">
  <div class="container cta-grid">
    <div>
      <h2>Need Product Guidance or Dealership Details?</h2>
      <p>Share your crop, location, and requirement. Our team will contact you with the right product recommendation.</p>
    </div>
    <form class="lead-form" aria-label="Enquiry form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
      <input type="hidden" name="action" value="tirupathi_agro_lead">
      <?php wp_nonce_field('tirupathi_agro_lead_form', 'tirupathi_agro_nonce'); ?>

      <?php if ($lead_status === 'success') : ?>
        <p class="form-alert success">Thanks! Your enquiry was sent successfully.</p>
      <?php elseif ($lead_status === 'mail_failed' || $lead_status === 'invalid_nonce' || $lead_status === 'missing_fields') : ?>
        <p class="form-alert error">Unable to submit right now. Please retry or call us directly.</p>
      <?php endif; ?>

      <label>Name<input type="text" name="name" required></label>
      <label>Phone<input type="tel" name="phone" required></label>
      <label>Requirement<textarea name="message" rows="3" required></textarea></label>
      <button class="btn btn-primary" type="submit">Send Enquiry</button>
    </form>
  </div>
</section>
<?php
get_footer();
