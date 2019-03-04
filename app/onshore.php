<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class onshore extends Model
{
    protected $table = 'service_onshore';

    protected $primaryKey = 'onshore_ID';

    public $timestamps = true;

    protected $fillable = [

'onshore_ajvKitSent',
'onshore_kitContents',
'onshore_courier',
'onshore_bookedOn',
'onshore_clientAddress',
'onshore_arrivalDte',
'onshore_introDte',
'onshore_comments',


    ];


 } 