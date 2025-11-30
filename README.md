# 🏀 NBA League Administration System

Sistem za kompletan rad sa NBA ligom - Diplomski rad

## 📋 Pregled Projekta

NBA Liga je web aplikacija razvijena u Laravel frameworku za potpuno upravljanje profesionalnom košarkaškom ligom. Sistem omogućava upravljanje timovima, igračima, trenerima, sudijama, ugovorima, utakmicama i detaljnom statistikom.

### Tehnologije

- **Backend:** Laravel 11.x (PHP 8.2.12)
- **Database:** MySQL
- **Frontend:** Blade Templates, Bootstrap 5, Tailwind CSS
- **Authentication:** Laravel Breeze
- **Server:** XAMPP

## ✨ Ključne Funkcionalnosti

### 🔐 Sistem Korisnika (4 Tipa)

1. **Administrator**
   - Upravljanje timovima
   - Kreiranje i ponuda ugovora sudijama
   - Unos rezultata utakmica
   - Pregled svih statistika i ugovora

2. **Tim (Team)**
   - Ponuda ugovora igračima i trenerima
   - Pregled statistike tima
   - Upravljanje poslenim ponudama

3. **Osoba (Person)** - može biti:
   - **Igrač** - statistika (poeni, skokovi, asistencije)
   - **Trener** - statistika (pobede, porazi, procenat)
   - **Sudija** - statistika (prosečna ocena, broj utakmica)

4. **Gost** - pristup registraciji i prijavi

### 📝 Sistem Ugovora

- Kreiranje ponuda za ugovore
- Statusi: Pending, Active, Rejected, Completed, Terminated
- **Poslovna pravila:**
  - Jedna osoba može imati samo jedan aktivan ugovor
  - Admin nudi ugovore samo sudijama
  - Timovi nude ugovore samo igračima i trenerima
  - Kompletan tracking istorije ugovora

### 🏆 Upravljanje Utakmicama

- Izbor dva tima (split-screen interfejs)
- Automatsko učitavanje aktivnih igrača i trenera
- Unos detaljne statistike za svakog igrača:
  - Poeni, skokovi, asistencije
  - Minimum 8 aktivnih igrača po timu
- Izbor i ocenjivanje sudije (1-5 zvezdica)
- **Automatsko ažuriranje svih statistika:**
  - Statistika igrača
  - Statistika trenera (pobede/porazi)
  - Statistika sudija (prosečna ocena)
  - Statistika timova (win rate, poeni)

### 📊 Sistem Statistike

**Igrači:**
- Ukupni poeni, skokovi, asistencije
- Broj odigranih utakmica
- Proseci po utakmici

**Treneri:**
- Pobede i porazi
- Procenat pobeda (automatski obračun)

**Sudije:**
- Broj odsudenih utakmica
- Prosečna ocena (automatski obračun)

**Timovi:**
- Pobede, porazi, odigrane utakmice
- Dati i primljeni poeni
- Procenat pobeda

### 🖼️ Upload Slika

- Profilne slike za igrače, trenere, sudije
- Logo timova
- Preview pre uploada
- Automatski generisani avatari sa inicijalima
- Validacija (max 2MB, JPG/PNG/GIF)

### 🎨 UI/UX Features

- Dark theme navigacija
- Responsive dizajn (desktop & mobile)
- Bootstrap 5 komponente
- Brze akcije na dashboard-u
- Vizuelni feedback i hover efekti

## 🗄️ Struktura Baze Podataka

- `users` - Svi korisnici (admin, team, person)
- `contracts` - Ugovori sa statusima i ulogama
- `player_stats` - Statistika igrača
- `coach_stats` - Statistika trenera (sa automatskim win%)
- `referee_stats` - Statistika sudija (sa automatskom prosečnom ocenom)
- `team_stats` - Statistika timova (sa automatskim win rate-om)
- `games` - Utakmice sa detaljima

## 🚀 Instalacija

### Preduslov

- PHP 8.2 ili noviji
- MySQL 5.7 ili noviji
- Composer
- Node.js & npm
- XAMPP (preporučeno) ili drugi PHP server

### Koraci Instalacije

1. **Kloniranje projekta**
```bash
git clone https://github.com/ivkovicmladen/nba-league-system.git
cd nba-league-system
```

2. **Instalacija PHP dependencies**
```bash
composer install
```

3. **Instalacija Node dependencies**
```bash
npm install
```

4. **Kreiranje i konfigurisanje .env fajla**
```bash
cp .env.example .env
```

Ažurirajte database credentials u `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nba_league_laravel
DB_USERNAME=root
DB_PASSWORD=
```

5. **Generisanje application key**
```bash
php artisan key:generate
```

6. **Kreiranje baze podataka**
- Otvorite phpMyAdmin
- Kreirajte novu bazu: `nba_league_laravel`
- Importujte `database.sql` fajl

7. **Pokretanje migracija (opciono ako koristite database.sql)**
```bash
php artisan migrate
```

8. **Kreiranje storage linka**
```bash
php artisan storage:link
```

9. **Kompilacija frontend assets**
```bash
npm run build
```

Ili za development sa auto-reload:
```bash
npm run dev
```

10. **Pokretanje servera**
```bash
php artisan serve
```

Aplikacija će biti dostupna na: **http://localhost:8000**

## 🔑 Test Kredencijali

### Administrator
- **Email:** admin@nba.com
- **Password:** password

### Timovi
- **LA Clippers:** lakers@nba.com / password
- **Denver Nuggets:** nuggets@nba.com / password

### Igrači
- **Nikola Jokić:** nikola.jokic@nuggets.com / password
- **Jamal Murray:** jamal.murray@nuggets.com / password
- **Kawhi Leonard:** kawhi.leonard@clippers.com / password

### Treneri
- **Michael Malone:** michael.malone@nuggets.com / password
- **Tyronn Lue:** tyronn.lue@clippers.com / password

### Sudije
- **Scott Foster:** scott.foster@nba.com / password
- **Tony Brothers:** tony.brothers@nba.com / password

## 📱 Korišćenje Sistema

### Kao Administrator:
1. Prijavite se sa admin kredencijalima
2. Koristite "Manage Teams" za kreiranje timova
3. Kreirajte ponude za sudije kroz "Create Contract"
4. Unosite rezultate utakmica kroz "Complete Game"
5. Pregledajte sve ugovore kroz "All Contracts"

### Kao Tim:
1. Prijavite se sa team kredencijalima
2. Nudite ugovore igračima i trenerima
3. Pratite statistiku vašeg tima na dashboard-u
4. Pregledajte vaše poslate ponude

### Kao Igrač/Trener/Sudija:
1. Prijavite se sa vašim kredencijalima
2. Pregledajte pending ponude za ugovore
3. Prihvatite ili odbijte ponude
4. Pratite svoju statistiku na dashboard-u

## 🔒 Bezbednosne Mere

- ✅ Laravel Breeze autentifikacija
- ✅ Hashirane lozinke (bcrypt)
- ✅ CSRF zaštita na svim formama
- ✅ SQL Injection zaštita kroz Eloquent ORM
- ✅ XSS zaštita kroz Blade template engine
- ✅ Middleware za role-based autorizaciju
- ✅ Validacija svih user inputa
- ✅ Secure file upload sa validacijom

## 🛠️ Razvoj i Testiranje

### Pokretanje u development modu:
```bash
npm run dev
php artisan serve
```

### Clearing cache:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Database refresh (PAŽNJA: Briše sve podatke):
```bash
php artisan migrate:fresh
```

## 📂 Struktura Projekta

```
nba-league-system/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Game, Contract, Team, Profile controllers
│   │   └── Middleware/       # IsAdmin, AdminOrTeam middleware
│   └── Models/               # User, Contract, PlayerStats, etc.
├── database/
│   └── migrations/           # Database schema
├── resources/
│   └── views/
│       ├── contracts/        # Contract views
│       ├── games/            # Game completion form
│       ├── teams/            # Team management
│       └── profile/          # User profile & image upload
├── routes/
│   └── web.php               # Application routes
└── public/
    └── storage/              # Uploaded images (avatars, logos)
```

## 🎯 Buduća Proširenja

- ⏱️ Sistem za zakazivanje utakmica (82 utakmice limit)
- 🏆 Playoff sistem sa bracket-ima
- 📈 Advanced statistika (PER, TS%, Usage Rate)
- 🔍 Pretraga i filtriranje igrača/timova
- 🎫 Sistem za gledaoce i kupovinu karata
- 📊 Praćenje statistike po utakmicama (game logs)
- 📱 Mobile responsive optimizacije
- 🌐 Public standings page

## 👨‍💻 Autor

**Mladen Ivković**
- GitHub: [@ivkovicmladen](https://github.com/ivkovicmladen)
- Projekat: Diplomski rad
- Datum: Novembar 2025

## 📄 Licenca

Ovaj projekat je razvijen u edukativne svrhe kao diplomski rad.

## 🙏 Zahvalnice

- Laravel framework
- Bootstrap 5
- Tailwind CSS
- NBA za inspiraciju

---

**⭐ Ako Vam se projekat sviđa, ostavite zvezdicu na GitHub-u!**
