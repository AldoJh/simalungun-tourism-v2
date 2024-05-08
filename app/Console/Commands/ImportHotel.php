<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportHotel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:hotel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Hotels';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::unprepared(file_get_contents(resource_path('data/hotel.sql')));
            $this->info('Hotel data has been imported successfully');
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
