<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DownloaderJob
 * @package App\Models
 *
 * @property integer id
 * @property string status
 * @property string filename
 * @property string resource
 * @property Carbon updated_at
 * @property Carbon created_at
 */
class DownloaderJob extends Model
{
    const STATUS_COMPLETE = 'complete';
    const STATUS_PENDING = 'pending';
    const STATUS_DOWNLOADING = 'downloading';
    const STATUS_ERROR = 'error';

    protected $table = 'downloads';
    protected $primaryKey = 'id';

    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];

    protected $fillable = [
        'resource'
    ];
}
