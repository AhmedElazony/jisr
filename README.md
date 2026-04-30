Jisr — Instant Cross-Border Wallet Bridge

Description
- Jisr is a fintech that enables instant cross-border money transfers between Arab countries by auto-detecting local digital wallets and routing transfers between them.

Live URL
- https://jisr.ahmedelazony.com

Tech Stack
- Backend: Laravel 12 (PHP 8.4+), domain-driven structure
- WebSockets: Laravel Reverb (Reverb server bundled)
- Frontend: Vue 3 (Composition API) + Vite + Tailwind CSS (RTL)
- PWA: vite-plugin-pwa
- Database: PostgreSQL
- Dev & Deploy: Docker

Test Data (Seeded users)

| Name | Email | Phone | Country |
|---|---|---|---|
| Ahmed Tamer | ahmed@jisr | 1001234567 | مصر (EG) 🇪🇬 |
| Mona Ibrahim | mona@jisr | 1009876543 | مصر (EG) 🇪🇬 |
| Fahad Al-Otaibi | fahad@jisr | 501234567 | السعودية (SA) 🇸🇦 | STC Pay |
| Noura Al-Ghamdi | noura@jisr | 509876543 | السعودية (SA) 🇸🇦 | STC Pay |
| Omar Al-Mansouri | omar@jisr | 501234567 | الإمارات (AE) 🇦🇪 |
| Omar Al-Mansouri | omar@jisr | 501234567 | الإمارات (AE) 🇦🇪 |
| Layla Al-Harbi | layla@jisr | 791234567 | الأردن (JO) 🇯🇴 |
| Layla Al-Harbi | layla@jisr | 791234567 | الأردن (JO) 🇯🇴 |


>Notes
>- **All seeded users' password: `password`.**

Quick start (development)
1. Copy env and install:

```bash
cp .env.example .env
make images
```

2. Start services:

```bash
make dev
make install
make artisan migrate
make artisan db:seed
```

3. Frontend (if running locally):

```bash
cd frontend
npm install
npm run dev
```
Support
- Repo: https://github.com/AhmedElazony/jisr
- Live: https://jisr.ahmedelazony.com
