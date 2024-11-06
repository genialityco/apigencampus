<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendEmailForCertificationExpirationJob;
use Log;

class SendNotificationForCertificationExpirationForWeeklyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'certificationExpiration:check_weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email for certification expiration for weekly';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        Log::debug("Certification expiration notification weekly command called");
        // Call this
        (new SendEmailForCertificationExpirationJob(false, true))->handle();
    }
}
