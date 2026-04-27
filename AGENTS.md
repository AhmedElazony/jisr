# AGENTS.md — جسر (Jisr)

This file gives AI coding agents (GitHub Copilot coding agent, Claude, etc.) the context they need to work effectively on this repository.

## What is this project?

**Jisr (جسر — "bridge")** is a hackathon fintech PWA for instant cross-border money transfers across Arab countries. It bridges local digital wallets: a user in Egypt (InstaPay) can instantly send money to a user in Saudi Arabia (STC Pay).

The primary language of the UI is **Arabic (RTL)**.

## Repository layout at a glance

```
/
├── .github/
│   ├── copilot-instructions.md   ← Full Copilot instructions (read this first)
│   └── workflows/                ← CI/CD (ci.yml, deploy-dev.yml, deploy-production.yml)
├── app/
│   ├── Domains/                  ← Business domains (User, Transfer, …)
│   ├── Http/Api/V1/Controllers/  ← Thin API controllers
│   └── Support/                  ← Shared helpers, traits, response utilities
├── frontend/                     ← Standalone Vue 3 PWA (Vite project)
│   ├── index.html
│   ├── package.json
│   ├── vite.config.js
│   └── src/
│       ├── main.js
│       ├── App.vue
│       ├── router/
│       ├── stores/
│       ├── composables/
│       ├── views/
│       └── components/
├── routes/
│   ├── api.php
│   └── v1/                       ← Versioned route files
├── Makefile                      ← Docker convenience targets
├── docker-compose.yml
└── README.md                     ← Laravel backend setup guide
```

## Copilot Instructions

The canonical instructions for this project live in **`.github/copilot-instructions.md`**. Read that file before making any changes. It covers:

- Full screen list with detailed per-screen UI spec
- Design system (colors, typography, button styles, cards, navigation)
- Wallet detection logic per Arab country
- Frontend architecture (Vue 3, Pinia, Vue Router, PWA) in `frontend/`
- Backend domain structure
- Code conventions
- What is explicitly out of scope

## Quick-start commands

```bash
# Backend (Docker)
make images          # build Docker images
docker compose up -d # start services
make install         # composer install + .env + app key
docker compose exec app php artisan migrate --seed

# Frontend (standalone Vite project)
cd frontend
npm install
npm run dev          # Vite dev server (hot reload)
npm run build        # production build
```

## Scaffolding commands (Laravel custom artisan commands)

```bash
php artisan make:api-controller  Transfer TransferController --invokable
php artisan make:domain-model    Transfer Transfer --migration
php artisan make:domain-service  Transfer TransferService --bind
php artisan make:api-resource    Transfer TransferResource
```

## Key constraints for agents

1. **Arabic only** — every UI string must be in Arabic; no English visible to users.
2. **RTL layout** — always set `dir="rtl"` on the root element.
3. **No auth** — do not add authentication to golden-flow routes or screens.
4. **Frontend in `frontend/`** — the Vue app is a standalone project at repo root, not inside `resources/`.
5. **Domain-driven backend** — new business logic goes in `app/Domains/<Domain>/`, not directly in controllers.
6. **Thin controllers** — controllers delegate to Actions/Services; no business logic in HTTP layer.
7. **Vue 3 Composition API** — use `<script setup>` syntax; Pinia for state.

## Where things live

| Concern | Location |
|---|---|
| Vue entry point | `frontend/src/main.js` |
| Vue root component | `frontend/src/App.vue` |
| Vue views (screens) | `frontend/src/views/` |
| Shared Vue components | `frontend/src/components/` |
| Pinia stores | `frontend/src/stores/` |
| Vue Router | `frontend/src/router/index.js` |
| Wallet detection composable | `frontend/src/composables/useWalletDetector.js` |
| SPA shell HTML | `frontend/index.html` |
| Vite config + PWA | `frontend/vite.config.js` |
| API routes (v1) | `routes/v1/` |
| Transfer domain | `app/Domains/Transfer/` |
| Response helpers | `app/Support/Http/Responses/` |
