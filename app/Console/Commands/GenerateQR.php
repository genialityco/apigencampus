<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use QRCode;
use Storage;

class GenerateQR extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qr:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        echo "generando";
        $file = "eventos" . '_qr.png';
        $fullpath = storage_path('app/public/' . $file);
        $text ="milyunanoches";

        $image = QRCode::text($text)
        ->setSize(8)
        ->setMargin(4)
        ->setOutfile($fullpath)
        ->png();
    }
}
