<?php
/** @var \App\Models\DownloaderJob[]|\Illuminate\Database\Eloquent\Collection $jobs */
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }


            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .content table tr:nth-child(2) {
                background: aliceblue;
            }
            .content table td {
                padding: 10px 20px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Downloader
                </div>
                <table>
                    <tr>
                        <th></th>
                        <th>resource</th>
                        <th>status</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                    </tr>
                    @foreach($jobs as $job)
                        <tr>
                            <td>@if($job->filename)
                                    <a href="{{\Illuminate\Support\Facades\Storage::url($job->filename)}}">download</a>
                                @endif
                            </td>
                            <td>{{$job->resource}}</td>
                            <td>{{$job->status}}</td>
                            <td>{{$job->created_at}}</td>
                            <td>{{$job->updated_at}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </body>
</html>
