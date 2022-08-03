<?php

return [
  'komo_api_key' => env('KOMO_API_KEY', false),
  'komo_endpoint' => env('KOMO_ENDPOINT', false),
  'pg_api_key' => env('PG_API_KEY', false),
  'pg_account_id' => env('PG_ACCOUNT_ID', false),
  'pg_endpoint' => env('PG_ENDPOINT', false),
  'pg_bank_id' => env('PG_VA_BANK_ID', 'demo'),
  'g_recaptcha_site_key' => env('G_RECAPTCHA_SITE_KEY', false),
  'g_recaptcha_secret_key' => env('G_RECAPTCHA_SECRET_KEY', false),
];