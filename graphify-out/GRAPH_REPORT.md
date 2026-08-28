# Graph Report - .  (2026-08-28)

## Corpus Check
- Corpus is ~19,155 words - fits in a single context window. You may not need a graph.

## Summary
- 509 nodes · 584 edges · 65 communities (63 shown, 2 thin omitted)
- Extraction: 98% EXTRACTED · 2% INFERRED · 0% AMBIGUOUS · INFERRED: 13 edges (avg confidence: 0.8)
- Token cost: 44,201 input · 0 output

## Community Hubs (Navigation)
- Root Composer Config
- Base Controller & Eloquent Layer
- App Service Provider
- Auth Config & User Factory/Seeders
- GraphQL Mutator → Controller Bridge
- Composer Scripts
- Menu Migration & Requests
- CLAUDE.md / README Project Docs
- Root Package.json (Vite/Tailwind)
- Composer PSR-4 Autoload Map
- Module Route Service Providers
- Cart Module Package.json
- Menu Module Composer.json
- Menu Module Package.json
- User Module Package.json
- Cart Module Composer.json
- User Module Composer.json
- User Service Provider
- Module Event Service Providers
- Lighthouse Json Scalar
- Feature Test Bootstrap
- Unit Test Bootstrap

## God Nodes (most connected - your core abstractions)
1. `psr-4` - 19 edges
2. `CartServiceProvider` - 13 edges
3. `MenuServiceProvider` - 13 edges
4. `UserServiceProvider` - 13 edges
5. `Menu` - 10 edges
6. `User` - 10 edges
7. `Mutator` - 10 edges
8. `require` - 10 edges
9. `scripts` - 9 edges
10. `CartController` - 8 edges

## Surprising Connections (you probably didn't know these)
- `robots.txt Disallow-All Rule` --conceptually_related_to--> `Duwa Delights Backend`  [AMBIGUOUS]
  public/robots.txt → CLAUDE.md
- `UserController` --inherits--> `Controller`  [EXTRACTED]
  Modules/User/app/Http/Controllers/UserController.php → app/Http/Controllers/Controller.php
- `CartMutator` --inherits--> `Mutator`  [EXTRACTED]
  Modules/Cart/GraphQL/Mutations/CartMutator.php → app/GraphQL/Mutations/Mutator.php
- `CartQuery` --inherits--> `Mutator`  [EXTRACTED]
  Modules/Cart/GraphQL/Queries/CartQuery.php → app/GraphQL/Mutations/Mutator.php
- `CartController` --inherits--> `Controller`  [EXTRACTED]
  Modules/Cart/app/Http/Controllers/CartController.php → app/Http/Controllers/Controller.php

## Import Cycles
- None detected.

## Hyperedges (group relationships)
- **GraphQL Resolver Wiring Flow** — claude_mutator, claude_usermutator, claude_menuquery, claude_schema_graphql [INFERRED 0.80]

## Communities (65 total, 2 thin omitted)

### Community 0 - "Root Composer Config"
Cohesion: 0.05
Nodes (43): pestphp/pest-plugin, php-http/discovery, wikimedia/composer-merge-plugin, autoload, autoload-dev, psr-4, config, allow-plugins (+35 more)

### Community 1 - "Base Controller & Eloquent Layer"
Cohesion: 0.08
Nodes (9): Controller, Illuminate\Database\Eloquent\Model, Illuminate\Http\Request, CartController, Cart, CartMenu, MenuController, MenuQuery (+1 more)

### Community 2 - "App Service Provider"
Cohesion: 0.10
Nodes (5): AppServiceProvider, Illuminate\Support\ServiceProvider, CartServiceProvider, MenuServiceProvider, Nwidart\Modules\Traits\PathNamespace

### Community 3 - "Auth Config & User Factory/Seeders"
Cohesion: 0.09
Nodes (14): UserFactory, DatabaseSeeder, Illuminate\Database\Console\Seeds\WithoutModelEvents, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Seeder, Illuminate\Foundation\Auth\User, Illuminate\Notifications\Notifiable (+6 more)

### Community 4 - "GraphQL Mutator → Controller Bridge"
Cohesion: 0.15
Nodes (8): Mutator, Mutator, GraphQL\Type\Definition\ResolveInfo, CartMutator, CartQuery, MenuMutator, UserMutator, Nuwave\Lighthouse\Support\Contracts\GraphQLContext

### Community 5 - "Composer Scripts"
Cohesion: 0.08
Nodes (26): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+18 more)

### Community 6 - "Menu Migration & Requests"
Cohesion: 0.10
Nodes (6): Illuminate\Foundation\Http\FormRequest, CreateMenuRequest, UpdateMenuRequest, UserController, LoginRequest, RegisterRequest

### Community 7 - "CLAUDE.md / README Project Docs"
Cohesion: 0.10
Nodes (22): Why auth.php must point at Modules\User\Models\User, Controllers Do The Work, Resolvers Just Forward, Duwa Delights Backend, GraphiQL, GraphQL API (Lighthouse), laravel-graphql-playground (abandoned), Herd Local Dev Server, laravel-modules (nwidart) (+14 more)

### Community 8 - "Root Package.json (Vite/Tailwind)"
Cohesion: 0.10
Nodes (19): concurrently, devDependencies, axios, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite (+11 more)

### Community 9 - "Composer PSR-4 Autoload Map"
Cohesion: 0.11
Nodes (19): psr-4, App\\, Database\\Factories\\, Database\\Seeders\\, Modules\\Cart\\, Modules\\Cart\\Database\\Factories\\, Modules\\Cart\\Database\\Seeders\\, Modules\\Cart\\GraphQL\\ (+11 more)

### Community 10 - "Module Route Service Providers"
Cohesion: 0.14
Nodes (4): Illuminate\Foundation\Support\Providers\RouteServiceProvider, RouteServiceProvider, RouteServiceProvider, RouteServiceProvider

### Community 11 - "Cart Module Package.json"
Cohesion: 0.12
Nodes (16): devDependencies, axios, laravel-vite-plugin, postcss, sass, vite, axios, laravel-vite-plugin (+8 more)

### Community 12 - "Menu Module Composer.json"
Cohesion: 0.12
Nodes (16): authors, autoload, autoload-dev, psr-4, psr-4, description, extra, laravel (+8 more)

### Community 13 - "Menu Module Package.json"
Cohesion: 0.12
Nodes (16): devDependencies, axios, laravel-vite-plugin, postcss, sass, vite, axios, laravel-vite-plugin (+8 more)

### Community 14 - "User Module Package.json"
Cohesion: 0.12
Nodes (16): devDependencies, axios, laravel-vite-plugin, postcss, sass, vite, axios, laravel-vite-plugin (+8 more)

### Community 15 - "Cart Module Composer.json"
Cohesion: 0.12
Nodes (15): authors, autoload, autoload-dev, psr-4, psr-4, description, extra, laravel (+7 more)

### Community 16 - "User Module Composer.json"
Cohesion: 0.12
Nodes (15): authors, autoload, autoload-dev, psr-4, psr-4, description, extra, laravel (+7 more)

### Community 18 - "Module Event Service Providers"
Cohesion: 0.20
Nodes (4): Illuminate\Foundation\Support\Providers\EventServiceProvider, EventServiceProvider, EventServiceProvider, EventServiceProvider

### Community 19 - "Lighthouse Json Scalar"
Cohesion: 0.38
Nodes (3): Json, GraphQL\Language\AST\Node, GraphQL\Type\Definition\ScalarType

### Community 20 - "Feature Test Bootstrap"
Cohesion: 0.40
Nodes (3): Illuminate\Foundation\Testing\TestCase, ExampleTest, TestCase

## Ambiguous Edges - Review These
- `Duwa Delights Backend` → `robots.txt Disallow-All Rule`  [AMBIGUOUS]
  public/robots.txt · relation: conceptually_related_to

## Knowledge Gaps
- **141 isolated node(s):** `name`, `description`, `authors`, `providers`, `aliases` (+136 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **2 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **What is the exact relationship between `Duwa Delights Backend` and `robots.txt Disallow-All Rule`?**
  _Edge tagged AMBIGUOUS (relation: conceptually_related_to) - confidence is low._
- **Why does `scripts` connect `Composer Scripts` to `Root Composer Config`?**
  _High betweenness centrality (0.014) - this node is a cross-community bridge._
- **Why does `psr-4` connect `Composer PSR-4 Autoload Map` to `Root Composer Config`?**
  _High betweenness centrality (0.011) - this node is a cross-community bridge._
- **Why does `autoload` connect `Root Composer Config` to `Composer PSR-4 Autoload Map`?**
  _High betweenness centrality (0.010) - this node is a cross-community bridge._
- **What connects `name`, `description`, `authors` to the rest of the system?**
  _141 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Root Composer Config` be split into smaller, more focused modules?**
  _Cohesion score 0.045454545454545456 - nodes in this community are weakly interconnected._
- **Should `Base Controller & Eloquent Layer` be split into smaller, more focused modules?**
  _Cohesion score 0.08076923076923077 - nodes in this community are weakly interconnected._