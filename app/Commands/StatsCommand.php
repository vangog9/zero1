<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use LaravelZero\Framework\Commands\Command;

class StatsCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'stats {username}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Retrieve the Ecologi statistics for a user';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $username = $this->argument('username');

        $search_response = Http::get("https://api.github.com/search/code?q={$username}&access_token=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");

//        if (!$search_response->ok()) {
//            $this->warn('Nope!!!!!!!!!!!!!!!!!');
//            return;
//        }
        //      , 'name'=>$name    and name is {$name}
        ['total_count' => $count] = $search_response->json();
        //$search = $search_response->json();
        $searchArray = json_decode($search_response, false);
        $this->info("The number of {$username} is {$count} ");

        dd(array_count_values($searchArray));



        //$names[] = $searchArray['items']['name'];

        //dd($names);

    }

    /**
     * Define the command's schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
