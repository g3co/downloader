<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewDownload;
use App\Jobs\Downloader;
use App\Models\DownloaderJob;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{
    /**
     * Display a listing of the jobs
     *
     * @return string
     */
    public function index()
    {
        $jobs = DownloaderJob::all();

        return $jobs->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateNewDownload $request
     * @return JsonResponse
     */
    public function create(CreateNewDownload $request)
    {
        $data = $request->validated();

        $job = DownloaderJob::query()->create(['resource' => $data['link']]);

        if (!$job) {
            JsonResponse::create(['status' => 'error']);
        }

        Downloader::dispatch($job->id);

        return JsonResponse::create(['status' => 'ok']);
    }
}
