# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

Laravel 12 backend for Duwa Delights (a café/menu ordering app), built as a **GraphQL API** (Lighthouse) with feature code split into **modules** (`nwidart/laravel-modules`). There is no `routes/api.php` at the app root — all client-facing traffic goes through the single GraphQL endpoint.

## Commands

Runs on Herd (`duwa-cafe-backend.test`), so `php artisan serve` isn't required day-to-day. If invoking `php`/`composer`/`artisan` from a shell where Herd isn't isolating the site's PHP version, check `herd isolated` first — the site can be pinned to a different PHP version than the CLI's `php`.

- Run tests: `php artisan test` (or `composer test`, which also clears config first)
- Run a single test: `php artisan test --filter=TestName` or `php artisan test path/to/Test.php`
- Migrate: `php artisan migrate`
- Lint/format PHP: `vendor/bin/pint`
- Front-end asset build: `npm run dev` / `npm run build` (Vite; minimal — this app is API-first)
- Full local dev stack (server + queue listener + logs + vite): `composer dev`

### Module scaffolding (nwidart/laravel-modules)

Use `module:*` artisan commands to scaffold inside a module instead of hand-rolling paths, e.g.:
```
php artisan module:make-request RegisterRequest User
php artisan module:make-controller SomeController Menu
```
`php artisan list module` shows all available `module:*` generators. `modules_statuses.json` at the repo root tracks which modules are enabled.

### GraphiQL

`mll-lab/laravel-graphiql` is installed and enabled by default — visit `/graphiql` (endpoint `/graphql`) to explore/run the schema interactively. `mll-lab/laravel-graphql-playground` is also present but abandoned upstream; prefer GraphiQL.

## Architecture

### Modules

Feature code lives under `Modules/<Name>/` (currently `User`, `Menu`, `Cart`), not under `app/`. Each module has its own `app/Http/Controllers`, `app/Http/Requests`, `Models/`, `database/migrations`, `routes/`, and `GraphQL/`. Namespaces map per `composer.json` PSR-4 (e.g. `Modules\User\` → `Modules/User/app/`, `Modules\User\Models\` → `Modules/User/Models/`, `Modules\User\GraphQL\` → `Modules/User/GraphQL/`).

Each module also has `routes/web.php` and `routes/api.php` registering a REST resource controller (`Route::apiResource(...)`) — these exist from module scaffolding but are **not** the primary way the API is consumed; GraphQL is.

### GraphQL wiring — controllers do the work, mutators/queries just forward

The actual request handling (validation, business logic) lives in each module's Controller, using FormRequest classes for validation. GraphQL resolvers do not reimplement that logic — they forward into the controller:

- `graphql/Schema/Mutations/Mutator.php` (`App\GraphQL\Mutations\Mutator`) is the base class mutation resolvers extend. Its `resolve()` calls `$controller@$method` via `app()->call(...)`, injecting `$context->request()->merge($args)` so a type-hinted `FormRequest` on the controller method gets validated automatically.
- Each module has its own `Mutator` subclass (e.g. `Modules\User\GraphQL\Mutations\UserMutator`) that sets `protected $controller` and defines one method per mutation, each just calling `$this->resolve(__FUNCTION__, $args, $context)`. `Modules\User\GraphQL\Mutations\UserMutator` overrides `resolve()` itself to also promote any `*_id` arg to a plain `id` param.
- Query resolvers (e.g. `Modules\Menu\GraphQL\Queries\MenuQuery`) call the controller directly via `app()->call('Controller@method', ['_' => null, 'args' => $args])` rather than going through a shared base class.
- Because of this indirection, a controller method's signature (which FormRequest it type-hints, its param names) is what actually drives GraphQL input validation — check the controller, not just the `.graphql` schema, when tracing behavior.

### GraphQL schema files

Root schema is `graphql/schema.graphql`, which imports shared components (`graphql/Schema/Components/SuccessResponse.graphql` — the common `SuccessResponse { status, message, data, error }` type used across mutations) and every module's schema via `#import ../Modules/*/GraphQL/Schema.graphql`.

Each module's `GraphQL/Schema.graphql` in turn imports its own `Schema/Queries/*.graphql`, `Schema/Mutations/*.graphql`, and `Schema/Components/*.graphql`. Follow this import chain when looking for where a type or field is defined — it's rarely in one file.

### Auth

`laravel/sanctum` issues API tokens (`$user->createToken(...)->plainTextToken`) returned from GraphQL `register`/`login` mutations. `config/auth.php`'s `providers.users.model` must point at `Modules\User\Models\User` (not the default `App\Models\User`, which doesn't exist in this codebase) — check this first if auth ever throws a "class not found" error.

### Permissions

`spatie/laravel-permission` is installed for role/permission handling.
