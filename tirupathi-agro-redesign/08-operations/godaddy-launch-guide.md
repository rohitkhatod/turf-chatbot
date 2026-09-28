# GoDaddy Launch Guide (WordPress)

## 1) Prepare in staging
1. Create a staging site in GoDaddy Managed WordPress.
2. Upload `tirupathi-agro-modern.zip` from `05-development/wordpress-theme/dist/`.
3. Activate theme and set Home page as static front page.
4. Configure menus for Primary and Footer locations.
5. Install and configure plugins:
   - Yoast SEO (or Rank Math)
   - WP Mail SMTP
   - Caching plugin compatible with GoDaddy

## 2) Production launch steps
1. Take full backup (files + DB).
2. Put old website in maintenance mode (short window).
3. Push staging to production (or migrate files/db).
4. Clear caches (plugin/CDN/browser).
5. Verify forms, contact email delivery, menu links, and key pages.

## 3) Post-launch SEO checks
1. Submit XML sitemap in Google Search Console.
2. Validate robots.txt and noindex rules.
3. Crawl top pages for title/meta/H1 issues.
4. Monitor 404s and add 301 redirects from old URLs.

## 4) Minimum acceptance checklist
- Mobile nav works.
- Product filter interaction works.
- Testimonial slider interaction works.
- Enquiry form sends to admin email.
- Homepage passes Lighthouse SEO baseline (>90 preferred).
