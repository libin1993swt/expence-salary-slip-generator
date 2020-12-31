cd /var/www/html/lara-finance
php artisan serve --host 192.168.1.107 --port 8006


php artisan crud:generate Users --fields='full_name#string; email#email; phone#string' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --route-group=admin --form-helper=html

php artisan crud:generate Expense --fields='user_id#integer; date#date; amount#integer; description#string' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --route-group=admin --form-helper=html

php artisan crud:generate Groups --fields='name#string; description#string' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --route-group=admin --form-helper=html


php artisan make:migration create_slip_records_table --create=slip_records
