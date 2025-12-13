Repository: Adzquare CRM (Laravel 9, PHP 8+)

Summary
- This is a Laravel-based CRM with an admin UI under `public/admin`/`public/admin_new` and an API/website in `routes/`.
- Key integrations: WhatsApp Cloud API (via `netflie/whatsapp-cloud-api`), Maatwebsite Excel for import/exports, DomPDF for PDFs, Meta/Facebook OAuth + Graph SDK.

Key Areas (quick links)
- Entry point & routes: [routes/web.php](routes/web.php#L1-L40)
- Controllers: [app/Http/Controllers](app/Http/Controllers)
- Models: [app/Models](app/Models)
- Jobs (queues): [app/Jobs/SendWhatsAppCampaignMessage.php](app/Jobs/SendWhatsAppCampaignMessage.php#L1-L40)
- Import/Export patterns: [app/Imports/LeadsImport.php](app/Imports/LeadsImport.php#L1-L60) and [app/Exports/GlobalExport.php](app/Exports/GlobalExport.php#L1-L60)
- Config for WhatsApp: [config/whatsapp-cloud-api.php](config/whatsapp-cloud-api.php#L1-L40)

Developer Workflows
- Setup developer environment:
  1. `composer install`
  2. `cp .env.example .env` and set DB and 3rd-party keys (see .env for `WHATSAPP_CLOUD_API_ACCESS_TOKEN` etc.)
  3. `php artisan key:generate`
  4. `php artisan migrate --seed`
  5. `php artisan storage:link`
  6. `npm install` and `npm run dev`

- Common Artisan commands:
  - Run tests: `vendor/bin/phpunit` or `php artisan test`
  - Run queue worker: `php artisan queue:work`
  - Trigger scheduler manually: `php artisan schedule:run`
  - Clear caches: `php artisan route:clear && php artisan config:clear && php artisan cache:clear`

Project-Specific Patterns & Examples
- Excel imports use Maatwebsite: `app/Imports/LeadsImport.php`. Note it reads `request()->all()` inside `model()` to get extra context like `group_id`. When running imports programmatically, ensure the request variables exist or pass them via controller (see `AdminCreateController@handleLeadImport`).
- Generic export route: `global.export.excel` at [routes/web.php](routes/web.php#L100-L130) uses `GlobalExport` to download arbitrary models; keep `fields` and `model` sanitized before sending to this route in production.
- WhatsApp integration:
  - Config: `config/whatsapp-cloud-api.php` uses env vars `WHATSAPP_CLOUD_API_ACCESS_TOKEN`, `WHATSAPP_CLOUD_API_FROM_PHONE_NUMBER_ID`, `WHATSAPP_BUSINESS_ACCOUNT_ID`.
  - Sending is implemented in a queued job: [app/Jobs/SendWhatsAppCampaignMessage.php](app/Jobs/SendWhatsAppCampaignMessage.php#L1-L100). The job expects the CampaignLead, eager-loads relationships, builds components and calls the `netflie` client.
  - Controller example: `LeadRemarkController@sendMessage` demonstrates how to construct components and call `WhatsAppCloudApi` without a queued job for one-off sends.
- Token storage: Admin model stores `whatsapp_access_token` encrypted (use `encrypt()`/`decrypt()`), and there's a dev-route `super-secret-token-fix` to quickly inject a token; remove/disable before committing to production.

Tests & External Integrations
- `phpunit.xml` sets `QUEUE_CONNECTION=sync`, `CACHE_DRIVER=array`, and `MAIL_MAILER=array` for tests. Use these overrides when writing tests to make jobs run immediately and avoid sending real emails.
- For HTTP/Graph API calls, prefer using `Http::fake()` or Mockery to stub network I/O; check [app/Http/Controllers/MetaIntegrationController.php](app/Http/Controllers/MetaIntegrationController.php) and [app/Jobs/SendWhatsAppCampaignMessage.php](app/Jobs/SendWhatsAppCampaignMessage.php#L1-L60) for example usages.

Conventions & Gotchas
- Models use `$fillable` to declare mass-assignable attributes; check files under `app/Models` for fields; use `->create()` patterns instead of `new Model([...])` unless intentionally bypassing mass-assignment.
- Controller convention: `Admin` and `Employee` specific actions live under `app/Http/Controllers/Admin` and `app/Http/Controllers/Employee`.
- Avoid committing any credentials or tokens to code. Encrypted tokens are stored on the `Admin` model; use env variables locally.
- Be mindful of the direct `request()` usage in the import class — tests or scripts should populate request data before invoking import operations.

Debugging & Local Testing Tips
- To test WhatsApp: set `QUEUE_CONNECTION=sync` in `.env.testing` and `WHATSAPP_CLOUD_API_ACCESS_TOKEN` in `.env` (or use `Http::fake()` in tests).
- To simulate the webhooks and OAuth callbacks, use `ngrok` or set proper callback URLs in Meta dev console and point env `APP_URL`.
- Use `php artisan tinker` to call `Excel::import(new LeadsImport, $file)` with a faked request to replicate the upload workflow.

Where to Look Next
- Business logic: `app/Services`, `app/Jobs`, and of course `app/Http/Controllers/*` for request handling.
- Views: `resources/views/admin` and `public/admin_new` for front-end markup.
- Background rules and dispatch logic: `app/Jobs` and `app/Console/Commands`.

If anything is unclear or you want more examples (e.g., how to mock the netflie client or test a queued job), tell me which area you'd like expanded and I will add concise examples and test stubs.
