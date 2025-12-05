
# 1. Navegar até a pasta do projeto
cd /home/u718577294/domains/baitafeiraapp.com.br

# 2. Puxar alterações do Git
echo "Pulling latest changes from Git..."
git fetch origin main
git reset --hard origin/main

# 6. Limpar cache do Laravel
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "Deployment completed successfully!"