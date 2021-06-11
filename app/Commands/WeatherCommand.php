<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Http;

class WeatherCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'weather';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Search for today weather information';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       
        $KeyWord = $this->addArgument('SearchWord', \Symfony\Component\Console\Input\InputArgument::REQUIRED, 'Input th Word');
        echo $KeyWord;
      //  $response = Http::get('https://api.github.com/search/code?q=cyberhull&access_token=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');
        
        // Parses the response and build a table.
        /** [$headers, $rows] = $this->getTablePayload($response);
        $this->info("Hello Artisan! Today's weather:");
        $this->table($headers, $rows); **/

        // Notify the user on the Operating System that the weather arrived.
       // $this->notify('Weather info!', 'Weather information just arrived!');
    }

    public function getKeyWord()
    {
        
        $KeyWord = $this->argument('SearchWord');
        
        /** $headers = ['Information', 'Value'];
        $todayWeather = collect($response)->first();
        $rows = collect($todayWeather)->map(function ($value, $title) {
            return ['Information' => $title, 'Value' => $value];
        })->toArray(); **/

        return $KeyWord;
    }
    
    
  /**  public function getTablePayload(array $response)
    {
        $headers = ['Information', 'Value'];
        $todayWeather = collect($response)->first();
        $rows = collect($todayWeather)->map(function ($value, $title) {
            return ['Information' => $title, 'Value' => $value];
        })->toArray();

        return [$headers, $rows];
    }
    
   **/ 
    
   
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
