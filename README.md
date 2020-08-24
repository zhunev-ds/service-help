
1. Extract the archive and put it in the folder you want
2. Run <b>cp .env.example .env</b> file to copy example file to .env 
Then edit your .env file with DB credentials and other settings.
3. Run <b>composer install command</b>
4. Run <b>php artisan migrate --seed</b> command. 
Notice: seed is important, because it will create the first admin user for you.
5. Run <b>php artisan key:generate</b> command.
If you have file/photo fields, run php artisan storage:link command.

Username:	admin@admin.com
Password:	password
