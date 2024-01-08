<?php

namespace App\Console\Commands;

use App\Http\Services\CakeService;
use App\Jobs\SendEmailsJob;
use App\Models\Client;
use App\Notifications\SendEmailClientCake;
use Illuminate\Console\Command;
use App\Http\Services\ClientService;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SendEmailsJob $sendEmailsJob): void
    {

    }
}
