1. Download the project (or clone using GIT)

2. Copy .env.example into .env and configure your database credentials

3. Go to the project's root directory using terminal window/command prompt

4. Run composer install

5. Set the application key by running php artisan key:generate --ansi

6. Run migrations php artisan migrate

7. npm install

8. npm run dev

9. Start local server by executing php artisan serve

10. Visit here http://127.0.0.1:8000/admin or dev to test the application

php artisan migrate --path=database/migrations/landlord --database=landlord
php artisan tenants:artisan "migrate --database=tenant"

- Multi Tenant
- Login
- Register
- dashboard admin/developer
- dashboard tenant
    - buat database baru -> ada link menuju halaman company dan aplikasi erpnya

Aplikasi erp 
- awal dan sekali update data company