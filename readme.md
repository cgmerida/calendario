# Laradminator
**_[Laravel](https://laravel.com/) PHP Framework with [Adminator](https://github.com/puikinsh/Adminator-admin-dashboard)_**  as admin dash


## Setup:
All you need is to run these commands:
```bash
git clone https://github.com/cgmerida/calendario.git
cd laradminator 
composer install                   # Install backend dependencies
sudo chmod 777 storage/ -R         # Permisos para almacenamiento en Linux
cp .env.example .env               # Update database credentials configuration
php artisan key:generate           # Generate new keys for Laravel
php artisan migrate:fresh --seed   # Run migration and seed users and categories for testing
yarn install                       # or npm i to Install node dependencies(>= node 9.x)
npm run production                 # To compile assets for prod
```