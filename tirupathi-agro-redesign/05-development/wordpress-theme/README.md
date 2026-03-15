# WordPress Theme: Tirupathi Agro Modern

## Install
1. Run `./build-theme-zip.sh` to create deployable zip.
2. In WordPress Admin -> Appearance -> Themes -> Add New -> Upload Theme.
3. Upload `dist/tirupathi-agro-modern.zip` and activate it.
4. Set a static homepage and assign menu locations (Primary/Footer).

## Included
- Responsive homepage template (`front-page.php`).
- Interactive product filtering and testimonial switching.
- Secure enquiry form handler using WordPress `admin-post` + nonce checks.
- SEO baseline with homepage Organization schema.
- Clean stylesheet and script asset pipeline.

## Launch notes
- Configure admin email and SMTP so enquiry notifications deliver correctly.
- Update placeholder contact details in `footer.php` and schema fields in `functions.php`.
- Follow `../../08-operations/godaddy-launch-guide.md` for GoDaddy rollout.
