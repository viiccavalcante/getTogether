Get Together is an application to help people organize small events like family BBQs and surprise birthday party.


Installation process 
-run composer install
-Set the encryption key in the .env: php artisan key:generate
-and then migrate the tables: php artisan migrate
-and then seed date: php artisan db:seed.

PS.: I created a second branch to deal with the relationship of "participant", instead of the "guests" table. But it's not complete yet.
