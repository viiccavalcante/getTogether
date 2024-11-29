<b> Get Together</b><br>
is an application to help people organize small events like family BBQs and surprise birthday party.


Installation process <br>
-run composer install<br>
-Set the encryption key in the .env: php artisan key:generate<br>
-and then migrate the tables: php artisan migrate<br>
-and then seed date: php artisan db:seed.<br>

PS.: I created a second branch to deal with the relationship of "participant", instead of the "guests" table. But it's not complete yet.
