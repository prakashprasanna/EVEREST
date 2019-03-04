<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class followup extends Model
{
    protected $table = 'sales_followup';

    protected $primaryKey = 'sales_followup_id';

    public $timestamps = true;

    protected $fillable = [
'sales_followup_type',
'sales_followup_notes', 
'sales_followup_status'
    ];


}
