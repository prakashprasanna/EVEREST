<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class visa extends Model
{
    protected $table = 'service_visa';

    protected $primaryKey = 'visa_ID';

    public $timestamps = true;

    protected $fillable = [
'visa_rejection',
'visa_rejNotes',
'visa_fees',
'visa_course',
'visa_gap',
'visa_gapNotes',
'visa_martial',
'visa_spouse',
'visa_familyFee',
'visa_otherCountry',
'visa_countryDocs',
'visa_oldPassport',
'visa_oldPassScan',
'addedBy',

    ];


 } 