<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('backup:clean')->dailyAt('22:00')->timezone('Europe/Madrid');
Schedule::command('backup:run --only-db')->dailyAt('23:00')->timezone('Europe/Madrid');
Schedule::command('backup:run')->weeklyOn(0, '23:30')->timezone('Europe/Madrid');
