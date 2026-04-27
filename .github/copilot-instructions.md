# Copilot Instructions — جسر (Jisr)

## Project Overview

**Jisr (جسر)** is a hackathon fintech PWA that enables instant cross-border money transfers between Arab countries by auto-detecting and bridging local digital wallets (e.g. InstaPay in Egypt → STC Pay in Saudi Arabia).

The sole focus is the **golden flow**: a sender in one Arab country sends money to a receiver in another Arab country, the app auto-detects both parties' local wallets, and the transaction completes instantly.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 10+ (PHP 8.1+), domain-driven architecture |
| Frontend | Vue 3 (Composition API) + Vite + Tailwind CSS v4 — lives in `frontend/` at repo root |
| PWA | Vite PWA plugin (`vite-plugin-pwa`) — installable, mobile-first |
| HTTP Client | Axios |
| Styling | Tailwind CSS v4, RTL layout |
| State | Pinia |
| Routing | Vue Router (history mode) |

The frontend is a **standalone Vite project** in the `frontend/` directory. It has its own `package.json`, `vite.config.js`, and `index.html`. It is **not** served through Laravel's Vite pipeline.

---

## Language & UI

- **Arabic only** — all UI text, labels, placeholders, and messages are in Arabic (العربية).
- Layout direction is **RTL** (`dir="rtl"`, `lang="ar"`). Always set `dir="rtl"` on the root element or `<html>`.
- Use Arabic numerals where appropriate (٠١٢٣٤٥٦٧٨٩) for display, but keep internal values as standard digits.
- Font: **Cairo** (Google Fonts) — the design uses this clean Arabic sans-serif throughout.

---

## Design System

### Color Palette

| Token | Value | Usage |
|---|---|---|
| `primary` | `#0CAB9A` (teal) | Brand color, active nav items, links, badges |
| `primary-dark` | `#0A8F7F` | Hover states |
| `gradient-start` | `#0CAB9A` | Button/card gradient left/top |
| `gradient-end` | `#2563EB` (blue) | Button/card gradient right/bottom |
| `bg-app` | `#EEF4F5` | App background (light mint-gray) |
| `surface` | `#FFFFFF` | Cards, modals |
| `text-primary` | `#111827` | Main text |
| `text-muted` | `#6B7280` | Labels, secondary text |
| `success` | `#10B981` | "مكتمل" status, positive amounts |

### Typography

- Font family: `'Cairo', sans-serif` (import from Google Fonts)
- Amount displays: `font-bold text-4xl` (large hero numbers)
- Section headings: `font-semibold text-xl`
- Body / labels: `text-sm text-muted`

### Buttons

- **Primary CTA** (e.g. "استمرار", "تأكيد التحويل", "إرسال أموال"):
  - Full-width, rounded-full, `py-4`
  - Background: linear gradient from `#0CAB9A` (right) to `#2563EB` (left) — RTL aware
  - White bold text, arrow icon on the right side (← in RTL)
- **Ghost / back button**: white circle, border, arrow icon

### Cards

- Background: white, `rounded-2xl`, `shadow-sm`
- Exchange rate / fee summary card: has a **left border accent** (gradient teal → blue, 4px wide)

### Navigation

- **Mobile**: fixed bottom tab bar — tabs: الرئيسية, التحويلات, المحافظ, الملف الشخصي
- **Desktop**: fixed right sidebar — items: Home, Transfers, Wallets, Profile, Sign Out (English labels visible in desktop mockup, use Arabic for the actual implementation)
- Active tab/item highlighted with `primary` teal background

### Wallet Badges

- Pill shape, white background, subtle shadow
- Shows wallet logo icon + "تم اكتشاف محفظة {WalletName}" text
- Appears immediately after country code is detected

---

## Screens to Implement

Implement **all** of the following screens. Do not implement auth.

### 1. الرئيسية — Home / Dashboard
- Top bar: user avatar (right), "Jisr" logo (center, teal), hamburger menu (left)
- **Balance card** (white, rounded): "الرصيد المتاح" label + eye toggle icon + balance amount (e.g. `EGP 45,230.50`)
- **"إرسال أموال ◄"** — gradient CTA button, full width, launches the transfer flow
- **"المعاملات الأخيرة"** section header + "عرض الكل" link
- Transaction list rows: recipient avatar/icon | recipient name + date/time | amount (negative = red/gray, positive = teal) | status badge ("مكتمل" in teal)
- Bottom navigation bar (mobile) / right sidebar (desktop ≥ 1024 px)

### 2. إدخال بيانات المرسل — Sender Info
- Phone number input with country code picker → auto-detects wallet on country selection
- Wallet badge appears once wallet is detected

### 3. إدخال بيانات المستقبل — Receiver Info
- Receiver name input
- Receiver phone with country code picker → auto-detects receiver wallet
- Wallet badge for receiver

### 4. إدخال المبلغ — Amount Entry
- Header: "إرسال إلى {CountryName}" + back button
- Wallet badge: "تم اكتشاف محفظة {WalletName}"
- "أنت ترسل" label + large editable amount + source currency (e.g. EGP)
- **Exchange summary card** (white, with left gradient border):
  - سعر الصرف: `1 {DEST_CCY} = {rate} {SRC_CCY}`
  - الرسوم: `{fee} {SRC_CCY}`
  - Divider
  - **المستلم يستلم**: large teal amount in dest currency
- "⚡ يصل خلال ثوانٍ" hint text
- Gradient "استمرار ←" CTA button (fixed bottom)

### 5. مراجعة التحويل — Review & Confirm
- Header: "Jisr" logo + back arrow
- Title: "مراجعة التحويل" / subtitle: "يرجى تأكيد التفاصيل أدناه قبل الإرسال"
- **Transfer visualization**: sender avatar (right) — Jisr transfer icon (center) — receiver avatar (left), names below
- **"المبلغ المرسل"**: `{DEST_CCY} {amount}` (large)
- **Details card** (white, rounded):
  - المستلم | recipient name
  - المحفظة | wallet badge (e.g. STC Pay)
  - سعر الصرف | `{DEST_CCY} = {rate} {SRC_CCY} 1`
  - سيستلم | `{SRC_CCY} {amount}` (highlighted row)
  - رسوم التحويل | `{SRC_CCY} {fee}`
- **Info note** (light teal bg): brief note about typical transfer timing for the destination wallet
- Gradient "تأكيد التحويل ←" CTA button (fixed bottom)

### 6. التحويل جارٍ — Processing
- Animated logo / spinner
- "جارٍ تنفيذ التحويل..." message

### 7. تم التحويل — Success
- Success icon (checkmark)
- "تم التحويل بنجاح" message
- Transaction reference number
- Share / "إرسال إيصال" button
- Back to home button

---

## Wallet Detection Logic

Client-side only. Map leading dial-code digits → wallet:

| Country | Dial code | Default wallet | Badge color |
|---|---|---|---|
| مصر (Egypt) | +20 | InstaPay | Green |
| السعودية (Saudi Arabia) | +966 | STC Pay | Purple |
| الإمارات (UAE) | +971 | Apple Pay / تحويل | Black |
| الكويت (Kuwait) | +965 | K-Net / Tap | Blue |
| الأردن (Jordan) | +962 | eFAWATEERcom | Orange |
| المغرب (Morocco) | +212 | CIH Pay | Red |

Show the wallet badge pill immediately once the country code prefix is matched.

---

## Frontend Architecture (Vue 3 PWA)

The frontend lives in **`frontend/`** at the repository root as a standalone Vite + Vue 3 project.

```
frontend/
├── index.html               # SPA shell, sets dir="rtl" lang="ar"
├── package.json
├── vite.config.js           # Vite + vite-plugin-pwa config
├── public/
│   └── icons/               # PWA icons (192, 512 px)
└── src/
    ├── main.js              # Creates Vue app, registers router + pinia, mounts #app
    ├── App.vue              # Root component — RouterView + bottom nav
    ├── router/
    │   └── index.js         # Vue Router (history mode), named routes
    ├── stores/
    │   └── transfer.js      # Pinia store: sender, receiver, amount, wallets, status
    ├── composables/
    │   └── useWalletDetector.js  # Maps dial-code → wallet object
    ├── views/
    │   ├── HomeView.vue          # الرئيسية — dashboard + balance + send CTA
    │   ├── SenderInfoView.vue    # Sender phone + wallet detection
    │   ├── ReceiverInfoView.vue  # Receiver name + phone + wallet detection
    │   ├── AmountView.vue        # Amount input + exchange summary card
    │   ├── ReviewView.vue        # Full transfer summary + confirm
    │   ├── ProcessingView.vue    # Animated processing state
    │   └── SuccessView.vue       # Success confirmation + reference
    └── components/
        ├── AppButton.vue         # Gradient CTA button (full-width, rounded-full)
        ├── AppCard.vue           # White rounded-2xl shadow-sm card
        ├── BottomNav.vue         # Mobile fixed bottom tab bar
        ├── SidebarNav.vue        # Desktop fixed right sidebar
        ├── WalletBadge.vue       # Pill badge: logo + "تم اكتشاف محفظة X"
        ├── PhoneInput.vue        # Country code picker + phone field
        └── ExchangeCard.vue      # Rate / fee / receiver-amount summary card
```

- Use **Vue Router** with named routes: `home`, `sender`, `receiver`, `amount`, `review`, `processing`, `success`.
- Use **Pinia** `transfer` store throughout the flow; persist nothing to localStorage.
- Keep each view focused on a single screen. Extract all repeated UI into `components/`.

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

Configure `vite-plugin-pwa` in `frontend/vite.config.js`:

- `name`: جسر, `short_name`: جسر
- `dir`: rtl, `lang`: ar
- `display`: standalone
- `theme_color`: `#0CAB9A`
- `background_color`: `#EEF4F5`
- Register a service worker for offline shell caching.

---

## Code Conventions

- **Vue**: Composition API (`<script setup>`), TypeScript is optional but welcome.
- **Naming**: PascalCase for components, camelCase for composables/stores.
- **Tailwind**: utility-first; do not write custom CSS unless truly necessary.
- **Arabic strings**: keep all Arabic strings directly in the template (no i18n library needed for this hackathon).
- **PHP**: PSR-12, type hints everywhere, short closures, match expressions preferred over switch.
- **No auth**: do not add `auth:sanctum` middleware to golden-flow routes.
- **Commit messages**: short imperative English, e.g. `add amount-entry screen`.

---

## What NOT to implement

- Auth screens (login, register, OTP)
- User profile / settings edit
- Admin panel
- Push notifications
- Real payment gateway integration (mock/stub is fine for the hackathon)
