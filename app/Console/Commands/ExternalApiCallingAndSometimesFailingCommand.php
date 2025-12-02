<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Random\RandomException;

class ExternalApiCallingAndSometimesFailingCommand extends Command
{
    protected $signature = 'api:get-fun-quote';

    protected $description = 'Command description';

    /**
     * @throws RandomException
     * @throws ConnectionException
     * @throws Exception
     */
    public function handle()
    {
        $res = Http::withToken(config('services.fun_quote.token'))
            ->get('https://lott-jonn.com/api/fun-quote');
        Log::info('Res', ['response' => $res]);

        if (random_int(1, 2) === 2) {
            throw new Exception('Random failure occurred while fetching fun quote.');
        }

        Log::info($res->json('quote'));
    }
}
