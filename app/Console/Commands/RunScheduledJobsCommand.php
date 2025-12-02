<?php

namespace App\Console\Commands;

use App\Jobs\ExternalApiCallingAndSometimesFailingJob;
use Illuminate\Console\Command;

class RunScheduledJobsCommand extends Command
{
    protected $signature = 'app:run-scheduled-jobs';

    protected $description = 'Simulate a user configured scheduled job execution';

    public function handle()
    {
        if (random_int(1, 2) === 1) {
            $this->info('Simulating exectution of scheduled jobs...');
            ExternalApiCallingAndSometimesFailingJob::dispatch();
        } else {
            $this->info('Nothing happening here...');
        }

    }
}
