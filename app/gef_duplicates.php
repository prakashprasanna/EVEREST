<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gef_duplicates extends Model
{
    protected $table = 'gef_duplicates';

    protected $primaryKey = 'gef_duplicates_id';

    public $timestamps = true;

    protected $fillable = [

'gef_duplicates_phone',
'gef_duplicates_email',
'gef_duplicates_name',

    ];


 } 