<?php

namespace App\Jobs;

use App\Models\DownloaderJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class Downloader implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var DownloaderJob
     */
    private $jobObj;

    /**
     * Downloader constructor.
     * @param int $jobId
     */
    public function __construct(int $jobId)
    {
        /** @var DownloaderJob $job */
        $job = DownloaderJob::query()->find($jobId);
        $this->jobObj = $job;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        try {
            $this->jobObj->status = DownloaderJob::STATUS_DOWNLOADING;
            $this->jobObj->update();

            $ext = pathinfo($this->jobObj->resource, PATHINFO_EXTENSION);
            $contents = file_get_contents($this->jobObj->resource);

            if (!$contents) {
                throw new \Exception('Data downloading error');
            }

            $filename = Uuid::uuid4()->toString() . '.' . $ext;

            if (!Storage::disk('public')->put($filename, $contents, 'public')) {
                throw new \Exception('Data saving error');
            }

            $this->jobObj->filename = $filename;
            $this->jobObj->status = DownloaderJob::STATUS_COMPLETE;
            $this->jobObj->update();
        } catch (\Exception $e) {
            $this->jobObj->failJob();
        }
    }
}
