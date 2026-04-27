# Copilot Instructions — جسر (Jisr)

## Project Overview

**Jisr (جسر)** is a hackathon fintech PWA that enables instant cross-border money transfers between Arab countries by auto-detecting and bridging local digital wallets (e.g. InstaPay in Egypt → STC Pay in Saudi Arabia).

The sole focus is the **golden flow**: a sender in one Arab country sends money to a receiver in another Arab country, the app auto-detects both parties' local wallets, and the transaction completes instantly.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 10+ (PHP 8.1+), domain-driven architecture |
| Frontend | Vue 3 (Composition API) + Vite + Tailwind CSS v4 |
| PWA | Vite PWA plugin (`vite-plugin-pwa`) — installable, mobile-first |
| HTTP Client | Axios |
| Styling | Tailwind CSS v4, RTL layout |
| Backend build | Laravel Vite Plugin |

---

## Language & UI

- **Arabic only** — all UI text, labels, placeholders, and messages are in Arabic (العربية).
- Layout direction is **RTL** (`dir="rtl"`, `lang="ar"`).  Always set `dir="rtl"` on the root element or `<html>`.
- Use Arabic numerals where appropriate (٠١٢٣٤٥٦٧٨٩) for display, but keep internal values as standard digits.
- Font: prefer a clean Arabic web font (e.g. Cairo, Tajawal from Google Fonts).

---

## Golden Flow — Screens

These are the **only** screens to implement. Do not implement login/register/auth.

1. **شاشة الترحيب (Welcome / Splash)** — Logo + "ابدأ التحويل" button.
2. **إدخال بيانات المرسل (Sender Info)** — Phone number field → auto-detects wallet (e.g. InstaPay for 🇪🇬, STC Pay for 🇸🇦, etc.) based on country code.
3. **إدخال بيانات المستقبل (Receiver Info)** — Receiver name + phone → auto-detects receiver wallet.
4. **إدخال المبلغ (Amount)** — Amount input with currency selector (source currency).
5. **مراجعة وتأكيد (Review & Confirm)** — Summary card: sender wallet, receiver wallet, amount, fees, exchange rate. "تأكيد التحويل" CTA.
6. **التحويل جارٍ (Processing)** — Animated loading/progress screen.
7. **تم التحويل (Success)** — Confirmation with transaction reference and a share button.

---

## Wallet Detection Logic

Map country dial code → wallet name + logo:

| Country | Dial code | Default wallet |
|---|---|---|
| مصر (Egypt) | +20 | InstaPay |
| السعودية (Saudi Arabia) | +966 | STC Pay |
| الإمارات (UAE) | +971 | Apple Pay / تحويل |
| الكويت (Kuwait) | +965 | K-Net / Tap |
| الأردن (Jordan) | +962 | eFAWATEERcom |
| المغرب (Morocco) | +212 | CIH Pay |

Detection is client-side based on the leading dial-code digits entered by the user. Show the wallet badge immediately once the country is identified.

---

## Frontend Architecture (Vue 3 PWA)

```
resources/
├── js/
│   ├── app.js               # Vue app entry, mounts #app
│   ├── router/
│   │   └── index.js         # Vue Router (history mode)
│   ├── stores/
│   │   └── transfer.js      # Pinia store for the active transfer flow
│   ├── composables/
│   │   └── useWalletDetector.js
│   ├── views/               # One component per golden-flow screen
│   │   ├── WelcomeView.vue
│   │   ├── SenderInfoView.vue
│   │   ├── ReceiverInfoView.vue
│   │   ├── AmountView.vue
│   │   ├── ReviewView.vue
│   │   ├── ProcessingView.vue
│   │   └── SuccessView.vue
│   └── components/          # Shared UI atoms
│       ├── WalletBadge.vue
│       ├── PhoneInput.vue
│       └── AppButton.vue
├── css/
│   └── app.css              # Tailwind CSS v4 entry
└── views/
    └── app.blade.php        # Single Blade view — mounts the Vue SPA
```

- Use **Vue Router** with named routes matching the flow above.
- Use **Pinia** for state (transfer store holds sender/receiver/amount/wallets).
- Keep each view component focused on a single screen; extract reusable atoms to `components/`.

---

## Backend Architecture (Laravel)

The backend is domain-driven. Follow the existing structure:

```
app/
├── Domains/
│   ├── Transfer/
│   │   ├── Actions/        # e.g. DetectWalletAction, ProcessTransferAction
│   │   ├── Models/         # Transfer model
│   │   ├── Services/       # TransferService
│   │   └── Enums/          # TransferStatus, SupportedWallet, ArabCountry
│   └── User/               # existing
├── Http/Api/V1/
│   └── Controllers/
│       └── Transfer/       # TransferController (thin, delegates to Actions)
└── Support/                # existing
```

- Use `php artisan make:api-controller`, `make:domain-model`, `make:domain-service` (see README) to scaffold files.
- API prefix: `/api/v1/transfer/...`
- Return JSON responses using the existing `app/Support/Http/Responses/` utilities.
- No authentication is required for the hackathon golden flow.

---

## PWA Setup

- Install `vite-plugin-pwa` and configure a `manifest.webmanifest` with:
  - `name`: جسر, `short_name`: جسر
  - `dir`: rtl, `lang`: ar
  - `display`: standalone
  - `theme_color` and `background_color` matching the brand palette
- Register a service worker for offline shell caching.

---

## Code Conventions

- **Vue**: Composition API (`<script setup>`), TypeScript is optional but welcome.
- **Naming**: PascalCase for components, camelCase for composables/stores.
- **Tailwind**: utility-first; do not write custom CSS unless truly necessary.
- **Arabic strings**: keep all Arabic strings directly in the template (no i18n library needed for this hackathon).
- **PHP**: PSR-12, type hints everywhere, short closures, match expressions preferred over switch.
- **No auth**: do not add `auth:sanctum` middleware to golden-flow routes.
- **Commit messages**: short imperative English, e.g. `add sender-info screen`.

---

## What NOT to implement

- Auth screens (login, register, OTP)
- User profile / settings
- Transaction history
- Admin panel
- Push notifications
- Real payment gateway integration (mock/stub is fine for the hackathon)
