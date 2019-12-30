<?php

namespace App\Console\Commands;

use App\Models\DownloaderJob;
use Illuminate\Console\Command;

class ShowDownloads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'downloads:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show list of downloads';

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
        $headers = ['id', 'status', 'resource'];

        $data = DownloaderJob::all(['id', 'status', 'resource']);

        $this->table($headers, $data);
    }
}
