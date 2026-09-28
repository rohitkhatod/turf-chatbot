# Tirupathi Agro Website Replacement Plan

This workspace is a **planning + implementation starter kit** to replace `www.tirupathiagro.com` with a modern, SEO-compliant, interactive WordPress website hosted on GoDaddy.

## Project Goals
- Build a fast, mobile-first website aligned to agriculture buyers, dealers, and distributors.
- Improve search visibility with technical SEO + keyword-driven content architecture.
- Keep deployment compatible with WordPress on GoDaddy.
- Create an implementation path that supports staged rollout with minimal downtime.

## Recommended Delivery Approach
1. **Discovery & audit** of current website pages, performance, metadata, and rankings.
2. **Information architecture + content mapping** (old URL to new URL).
3. **Design system + responsive templates** (homepage, product detail, contact, blog).
4. **WordPress development** using a custom theme and reusable blocks.
5. **SEO implementation** (schema, metadata, sitemap, robots, redirects, CWV).
6. **UAT, migration, and go-live** using a launch checklist.

## Folder Structure Overview
- `01-discovery/` — business requirements, audience, and competitor research.
- `02-seo/` — keyword clusters, metadata plan, schema map, technical SEO checklist.
- `03-content/` — page copy drafts, content calendar, image/video asset list.
- `04-design/` — UI direction, components, wireframe specs, brand guidelines.
- `05-development/` — WordPress theme/plugin development workspace.
- `06-migration/` — URL redirects, content import plan, launch playbook.
- `07-analytics/` — GA4, GSC, conversion goals, dashboard notes.
- `08-operations/` — maintenance SOPs, backup policy, and security checklist.

## Suggested Next Actions
- Complete all templates in `01-discovery` and `02-seo` first.
- Confirm final sitemap in `03-content/sitemap.md`.
- Start theme development in `05-development/wordpress-theme`.
- Use staging subdomain on GoDaddy (example: `staging.tirupathiagro.com`) before production cutover.

## Run Locally
- Use `05-development/local-launch/` for one-command local startup.
- Start with: `cd 05-development/local-launch && ./launch-local.sh`.
- If Docker is installed, it runs full WordPress on `http://localhost:8080`.
- If Docker is missing, it automatically serves the implemented preview on `http://localhost:8080`.
