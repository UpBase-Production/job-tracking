<?php

namespace Upbase\Jobtracking\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * Class JobTracking
 * @package Upbase\Jobtracking\Models
 * @property string $type
 * @property integer $sme_id
 * @property integer $store_id
 * @property integer $total_job
 * @property integer $processed_job
 * @property integer $success_job
 * @property integer $failed_job
 */
class JobTracking extends Model
{
    public function getTable()
    {
        return config('jobtracking.table_name', parent::getTable());
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'sme_id',
        'store_id',
        'total_job',
        'processed_job',
        'success_job',
        'failed_job',
    ];

    public static function createJobTracking($type, $params) {
        return JobTracking::create(array('type'=> $type), $params);
    }
    public static function incrementProcessedJob($tracking_id,$insert_result = true, $is_success = true) {
        DB::table(config('jobtracking.table_name'))->where('id', '=', $tracking_id)->lockForUpdate()->increment('processed_job');
        if ($insert_result) {
            if($is_success) {
                self::incrementSuccessProccesed($tracking_id);
            }else {
                self::incrementFailProccesed($tracking_id);
            }
        }

    }
    public static function incrementSuccessProccesed($tracking_id) {
        DB::table(config('jobtracking.table_name'))->where('id', '=', $tracking_id)->lockForUpdate()->increment('success_job');
    }

    public static function incrementFailProccesed($tracking_id) {
        DB::table(config('jobtracking.table_name'))->where('id', '=', $tracking_id)->lockForUpdate()->increment('failed_job');
    }

}
