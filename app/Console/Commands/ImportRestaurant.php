<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportRestaurant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:restaurant';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Restaurant';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::unprepared(file_get_contents(resource_path('data/restaurant.sql')));
            $this->info('Restaurant data has been imported successfully');
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
