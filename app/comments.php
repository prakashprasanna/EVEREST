<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $table = 'sales_comments';

    protected $primaryKey = 'comment_id';

    public $timestamps = true;

    protected $fillable = [
'comment_process_id',
'comment_process_name',
'comment_process_phone',
'comment_user', 
'comment_time', 
'comments', 
    ];    
}
