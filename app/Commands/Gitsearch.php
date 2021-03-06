<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use LaravelZero\Framework\Commands\Command;

class Gitsearch extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'gitsearch {search_word} {token}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Retrieve the GitSearch101';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $search_word = $this->Argument('search_word');
        $token = $this->Argument('token');

        $search_response = Http::get("https://api.github.com/search/code?q={$search_word}&access_token={$token}");

        if (!$search_response->successful()) {
            $this->warn('Nope!!!!!!!!!!!!!!!!!');
            return;
        }

        ['total_count' => $count] = $search_response->json();

        if ($count == 0) {
            $this->warn('EMPTY!!!!!');
            return;
        }

        $page_number = ceil($count / 100);
        $this->info("The number of {$search_word} is {$count} ");

        for ($page = 0; $page < $page_number; $page++) {
            $current_page = $page + 1;
            $search_response = Http::get("https://api.github.com/search/code?q={$search_word}&access_token={$token}&per_page=100&page={$current_page}");

            $searchArray = json_decode($search_response, true);

            $how_many = 100;

            if ($count < 100)
                $how_many = $count % 100;

            $count = $count - 100;

            for ($item = 0; $item < $how_many; $item++) {
                $this->info("********************************************************** {$item}");
                $this->info($searchArray['items'][$item]['name']);
                $this->info('');
                $this->info($searchArray['items'][$item]['html_url']);

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
