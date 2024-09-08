<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Models\Employer;

class RedisFillAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:redis-fill-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Redis intial fill';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $employers = Employer::all()->each(function($employer) {
            Cache::put('employers:' . $employer->id, $employer);
        });
    }
}
