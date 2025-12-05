
# 1. Navegar até a pasta do projeto
cd /home/u718577294/domains/baitafeiraapp.com.br

# 2. Puxar alterações do Git
echo "Pulling latest changes from Git..."
git fetch origin main
git reset --hard origin/main

# 3. Instalar dependências do Composer
echo "Installing/updating Composer dependencies..."
composer install --no-dev --optimize-autoloader

# 5. Definir permissões corretas para storage e bootstrap/cache
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache
chown -R u718577294:o1008296434 storage bootstrap/cache

# 6. Limpar cache do Laravel
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "Deployment completed successfully!"