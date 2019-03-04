<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pcc extends Model
{
    protected $table = 'service_pcc';

    protected $primaryKey = 'pcc_ID';

    public $timestamps = true;

    protected $fillable = [

'pcc_applied',
'pcc_appliedDte',
'pcc_appliedPlace',
'pcc_appliedStatus',
'pcc_comments',


    ];


 } 