<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    protected $table = 'subjects';

    protected $primaryKey = 'subject_id';

    public function gef()
    {
        return $this->hasMany('App\enquiry', 'gef_subject','subject_id');
    }
}
