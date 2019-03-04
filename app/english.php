<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class english extends Model
{
    protected $table = 'sales_english';

    protected $primaryKey = 'english_ID';

    public $timestamps = true;

    protected $fillable = [
'english_testTaken',
'english_testWithin_2years',
'english_IELTS_listening',
'english_IELTS_read',
'english_IELTS_write',
'english_IELTS_speaking', 
'english_IELTS_overall',
'english_PTE_listening',
'english_PTE_read',
'english_PTE_write',
'english_PTE_speaking',
'english_PTE_overall',
'english_test_plan_dte',
'english_IELTS_rewrite',
'english_PTE_rewrite',
'english_comments'  
    ];


 }   