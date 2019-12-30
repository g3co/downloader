<?php

namespace App\Console\Commands;

use App\Jobs\Downloader;
use App\Models\DownloaderJob;
use Illuminate\Console\Command;

class CreateDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'downloads:create {resource}';

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
        $resource = $this->argument('resource');

        $job = DownloaderJob::query()->create(['resource' => $resource]);

        Downloader::dispatch($job->id);
    }
}
