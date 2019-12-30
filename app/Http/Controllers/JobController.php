<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewDownload;
use App\Jobs\Downloader;
use App\Models\DownloaderJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the jobs
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $jobs = DownloaderJob::all();

        return view('index', [
            'jobs' => $jobs
        ]);
    }

    /**
     * Page for create new job
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createPage()
    {
        return view('create');
    }

    /**
     * Handler for creating new download task
     *
     * @param CreateNewDownload $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createHandler(CreateNewDownload $request)
    {
        $data = $request->validated();

        $job = DownloaderJob::query()->create(['resource' => $data['link']]);

        if ($job) {
            return redirect()->route('createPage')->with('flash_message', 'Job creating error');
        }

        Downloader::dispatch($job->id);

        return redirect()->route('indexPage')->with('flash_message', 'New download has created');
    }
}
