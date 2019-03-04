<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class funds extends Model
{
    protected $table = 'service_funds';

    protected $primaryKey = 'funds_ID';

    public $timestamps = true;

    protected $fillable = [

'funds_ID',
'funds_insFinal',
'funds_courseFee',
'funds_paymentStatus',
'funds_fundsArranged',
'funds_comments',

    ];


 } 