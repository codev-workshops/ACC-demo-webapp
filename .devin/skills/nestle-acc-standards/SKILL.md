---
name: nestle-acc-standards
description: Nestlé/Magento coding standards and how to fix Adobe Commerce (ACC) build failures
triggers:
  - user
  - model
allowed-tools:
  - read
  - grep
  - glob
  - exec
---

You are working on the **Nestlé webapp module** for Adobe Commerce Cloud (Magento 2.4.7).
Apply the standards below to every change, validate locally before pushing, and when CI fails,
use the diagnosis guide to fix it and re-push.

---

## 1. Coding standards

> REPLACE THIS SECTION with Nestlé's official coding-standards document when provided.
> The rules below are the Magento 2 baseline (enforced by `phpcs --standard=Magento2`) and are a
> safe default until Nestlé's file is dropped in.

**PHP**
- Start every PHP class file with `declare(strict_types=1);` after the file docblock.
- Full type hints on all parameters and return types. Type all class properties.
- A PHPDoc block on every class and every method (`@param`, `@return`, `@throws` as applicable).
- Constructor **dependency injection** only. Never call `ObjectManager::getInstance()` in app code.
- Prefer **service contracts** (`Api/` interfaces) over concrete classes for public APIs; wire
  implementations with a `<preference>` in `etc/di.xml`.
- Use plugins (interceptors) or `before/after/around` rather than class rewrites/preferences when
  modifying core behaviour.
- Lines ≤ 120 chars. No unused `use` statements. No `private`/`protected` members prefixed with `_`.

**Module structure**
- All code under `app/code/Nestle/<Module>/`. `registration.php` + `etc/module.xml` are required.
- Configuration in `etc/` (`di.xml`, `events.xml`, `acl.xml`, …) using the correct XSD `schemaLocation`.
- Tests under `Test/Unit/` (PHPUnit, no Magento bootstrap) — keep domain logic unit-testable.

**Copyright** — every source file begins with the Nestlé copyright docblock.

---

## 2. Validate locally BEFORE pushing

Run these from the repo root and make them green:

```bash
composer install
find app/code -name '*.php' -print0 | xargs -0 -n1 php -l   # syntax
vendor/bin/phpcs --standard=phpcs.xml.dist                  # coding standards
vendor/bin/phpunit --configuration phpunit.xml.dist         # unit tests
```

These are the same checks CI Layer 1 runs. Fix everything here first — it is far cheaper than a
failed ACC build.

---

## 3. The ACC build (Layer 2) and how to fix failures

After Layer 1 passes, CI deploys the module into the **real Magento** on the ACC environment and runs:

```
bin/magento setup:upgrade --keep-generated
bin/magento setup:di:compile
```

`di:compile` analyses the entire dependency-injection graph. It catches a class of errors that
**pass PHP lint and PHPCS but break the build** — exactly the failures that cause painful
push→fail→fix round-trips. When CI Layer 2 is red, read the build log and match the error:

**`Class "Nestle\Demo\...\X" does not exist`**
- A constructor type-hint, an `etc/di.xml` `<preference type="...">`, or an `<argument xsi:type="object">`
  references a class/interface that doesn't exist (typo, wrong namespace, or the class was never created).
- Fix: correct the fully-qualified name, or create the missing class/interface.

**`Circular dependency: A depends on B depends on A`**
- Two classes inject each other (directly or transitively).
- Fix: inject a `\Proxy` for one dependency (declare it in `di.xml`), or extract the shared logic
  into a third class so the cycle is broken.

**`Incompatible argument type` / `Missing required argument $x`**
- An `etc/di.xml` `<arguments>` entry doesn't match the constructor signature.
- Fix: align the argument name/type in `di.xml` with the constructor, or correct the constructor.

**`setup:upgrade` failures**
- Usually malformed XML (`module.xml`, `di.xml`) or a declared module dependency that isn't enabled.
- Fix: validate the XML against its XSD `schemaLocation`; add missing deps to `<sequence>` in `module.xml`.

### Fix loop
1. Read the failed CI log and identify the exact class/file/line.
2. Reproduce locally if possible (`vendor/bin/phpcs`, and reason about the DI graph).
3. Make the minimal correct fix that satisfies the standards in section 1.
4. Re-run local validation, commit, and push. CI re-runs both layers automatically.

Always prefer the smallest change that fixes the root cause while keeping the code standards-compliant.
