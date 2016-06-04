<?php

namespace App\Console;

use App\Models\Episode;
use App\Models\Feed;
use App\Services\Filter;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule
            ->call(function(){
                (new Episode())->getNew();
                (new Feed())->updateLastEpisodeAt();
            })
            ->hourly()->withoutOverlapping();
    }
}
