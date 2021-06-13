<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Log;

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

        ['total_count' => $count] = $search_response->json();
        if ($count == 0) {
            $this->warn('EMPTY!!!!!');
            return;
        }

        $page_number = ceil($count / 100);
        $this->info("The number of {$username} is {$count} ");

        for ($page = 0; $page <= $page_number - 1; $page++) {
            $current_page = $page + 1;
            $search_response = Http::get("https://api.github.com/search/code?q={$username}&access_token=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&per_page=100&page={$current_page}");

//            if (!$search_response[$page]->successful()) {
//                $this->warn('Nope!!!!!!!!!!!!!!!!!');
//                return;
//            }

            $searchArray = json_decode($search_response, true);
            $how_many = 100-(100-$count);

            for ($item = 0; $item < $how_many; $item++) {
                $this->info($searchArray['items'][$item]['name']);
                $this->info('');
                $this->info($searchArray['items'][$item]['html_url']);
                $this->info('');
            }
        }
    }

    /**
     * Define the command's schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public
    function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
