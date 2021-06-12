<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use LaravelZero\Framework\Commands\Command;

class SecondCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'SecondCommand';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Trying make 2nd command';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Hello World22222222222');
        $response = Http::get("https://public.ecologi.com/users/laravel/impact");



        ['trees' => $trees, 'carbonOffset' => $carbonOffset] = $response->json();

        $this->info("@laravel has planted {$trees} trees, and offset {$carbonOffset} tonnes of CO2");




    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
