cd /var/www/html/lara-finance
php artisan serve --host 192.168.1.107 --port 8006


php artisan crud:generate Users --fields='full_name#string; email#email; phone#string' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --route-group=admin --form-helper=html

php artisan crud:generate Expense --fields='user_id#integer; date#date; amount#integer; description#string' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --route-group=admin --form-helper=html

php artisan crud:generate Groups --fields='name#string; description#string' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --route-group=admin --form-helper=html


php artisan make:migration create_slip_records_table --create=slip_records

php artisan make:migration create_articles_table --create=articles

php artisan make:seeder ArticlesTableSeeder
php artisan make:factory ArticleFactory
php artisan make:model Article
php artisan db:seed

ssh -i ~/Desktop/example-app.pem ec2-user@ec2-18-134-17-173.eu-west-2.compute.amazonaws.com