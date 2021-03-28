<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'site_id',
        'call_id',
        'date',
        'channel_id',
        'crm_client_id',
        'source',
        'is_lid',
        'email',
        'region',
        'name_type',
        'comment',
        'query',
        'traffic_type',
        'landing_page',
        'lid_landing',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'link_download',
        'conversations_number',
        'duration',
        'billsec',
        'responsible_manager',
        'name',
        'phone',
        'status',
        'call_status',
        'accurately',
        'ym_uid'
    ];
}
