# Example Storefront — Agent Rules

This repository is the **storefront module** for Adobe Commerce Cloud (Magento 2.4.7).
It contains **only** custom module code under `app/code/Example/`. Magento core lives on the
ACC environment, not in this repo.

## Non-negotiables
- Follow Magento 2 coding standards. Every PHP file: `declare(strict_types=1)`,
  full parameter/return type hints, PHPDoc on every class and method, constructor dependency
  injection only — **never** use the ObjectManager directly.
- **Before pushing**, run local validation and make it pass:
  - `composer install`
  - `vendor/bin/phpcs --standard=phpcs.xml.dist`
  - `vendor/bin/phpunit --configuration phpunit.xml.dist`
- A push or PR triggers CI:
  - **Layer 1 — Code validation** (GitHub runner): PHP lint, PHPCS (Magento2), unit tests.
  - **Layer 2 — ACC build** (real Magento on the ACC environment): `setup:upgrade` +
    `setup:di:compile`. This catches build-only errors that local lint does not.
  - Both layers must be green before merge.

## When CI fails
Invoke the **`/acc-standards`** skill. It documents the coding standards in detail and
explains how to diagnose and fix **ACC build (di:compile) failures** — the class of errors that
pass local linting but break the Adobe Commerce build.
