<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class med extends Model
{
    protected $table = 'service_med';

    protected $primaryKey = 'med_ID';

    public $timestamps = true;

    protected $fillable = [

'med_applied',
'med_appliedDte',
'med_appliedPlace',
'med_appliedStatus',
'med_comments',


    ];


 } 