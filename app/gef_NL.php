<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class gef_NL extends Model
{
	protected $table = 'gef_NL';
    //
	protected $primaryKey = 'gef_id';

	public $incrementing = 'false';

    public $timestamps = true;

    protected $fillable = [
        'gef_id',
        'gef_phone',
'gef_f_name',
'gef_l_name',
'gef_email',
'gef_skype',
'gef_nationality',
'gef_location',
'gef_destination',
'gef_pathway',
'gef_subject',
'gef_institute',
'gef_source',
'gef_cv',
'gef_comments',
'gef_assigned_to',
'gef_service_assigned_to',
'gef_salesApproval',
'gef_serviceApproval'

    ];
}