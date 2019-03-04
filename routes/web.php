<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::auth();

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});


Route::get('dashboard', 'App\Http\Controllers\Auth\LoginController@dashboard')->name('dashboard');

Route::get('TLdashboard', 'App\Http\Controllers\Auth\TestController@TLdashboard')->name('TLdashboard');


Route::post('select-ajax', 'App\Http\Controllers\Auth\LoginController@selectAjax')->name('select-ajax');

Route::post('subjectVal', 'App\Http\Controllers\Auth\LoginController@subjectVal')->name('subjectVal');


Route::get('servicedashboard', 'App\Http\Controllers\Auth\LoginController@servicedashboard')->name('servicedashboard');

Route::get('dashboard/{product_id?}',function($product_id){
    $product = App\employee::where('AJV_EMP_ID', '=', $product_id)->first();
    return response()->json($product);
});	

Route::patch('dashboard/{product_id?}',function(Request $request,$product_id){
	$product = App\employee::where('AJV_EMP_ID', '=', $product_id)->first();
    $product->AJV_EMP_MonthlyTarget = $request->AJV_EMP_MonthlyTarget;
    $product->AJV_EMP_workAssigned = $request->AJV_EMP_workAssigned;
    $product->AJV_EMP_workCompleted = $request->AJV_EMP_workCompleted;
    $product->save();
    return response()->json($product);
});
Route::delete('dashboard/{product_id?}',function($product_id){
    $product = App\employee::destroy($product_id);
    return response()->json($product);
});

Route::get('servicedashboard/{product_id?}',function($product_id){
    $product = App\employee::where('AJV_EMP_ID', '=', $product_id)->first();
    return response()->json($product);
});	

Route::patch('servicedashboard/{product_id?}',function(Request $request,$product_id){
	$product = App\employee::where('AJV_EMP_ID', '=', $product_id)->first();
    $product->AJV_EMP_MonthlyTarget = $request->AJV_EMP_MonthlyTarget;
    $product->AJV_EMP_workAssigned = $request->AJV_EMP_workAssigned;
    $product->AJV_EMP_workCompleted = $request->AJV_EMP_workCompleted;
    $product->save();
    return response()->json($product);
});
Route::delete('servicedashboard/{product_id?}',function($product_id){
    $product = App\employee::destroy($product_id);
    return response()->json($product);
});

use Illuminate\Http\Request1;

Route::get('/leadView/{gef_phone}', 'App\Http\Controllers\EnquiryController@leadView')->name('leadView');

Route::get('/leadDetails/{gef_phone}', 'App\Http\Controllers\SalesController@leadDetails')->name('leadDetails');

Route::get('/serviceView/{gef_phone}', 'App\Http\Controllers\EnquiryController@serviceView')->name('serviceView');


Route::get('/leadView/edit/{product_id?}',function($product_id){
    $product = App\gonogo::where('gef_phone', '=', $product_id)->first();
    return response()->json($product);
});	

Route::patch('leadView/edit/{product_id?}',function(Request $request,$product_id){
	$product = App\gonogo::where('gef_phone', '=', $product_id)->first();
    $product->gonogo_comments = $request->gonogo_comments;
    $product->save();
    return response()->json($product);
});


Route::get('/leadView/edit/gonogo/gonogo/{gonogo1_id?}',function($gonogo1_id){
    $gonogo1 = App\gonogo::where('gef_phone', '=', $gonogo1_id)->first();
    return response()->json($gonogo1);
}); 

Route::patch('leadView/edit/gonogo/gonogo/{gonogo1_id?}',function(Request $request,$gonogo1_id){
    $gonogo1 = App\gonogo::where('gef_phone', '=', $gonogo1_id)->first();
    $gonogo1->gonogo_dob  = $request->gonogo_dob;
    $gonogo1->gonogo_spokenEnglish = $request->gonogo_spokenEnglish;
    $gonogo1->gonogo_prevNzVisa  = $request->gonogo_prevNzVisa;
    $gonogo1->gonogo_prevInsAgentOrSelf = $request->gonogo_prevInsAgentOrSelf;
    $gonogo1->gonogo_intakePlan = $request->gonogo_intakePlan;
    $gonogo1->gonogo_priorVisaRejection = $request->gonogo_priorVisaRejection;
    $gonogo1->gonogo_friend = $request->gonogo_friend;
    $gonogo1->gonogo_group = $request->gonogo_group;
    $gonogo1->gonogo_skilled = $request->gonogo_skilled;
    $gonogo1->gonogo_characterIssue = $request->gonogo_characterIssue;
    $gonogo1->gonogo_healthIssue = $request->gonogo_healthIssue;

    $gonogo1->save();
    return response()->json($gonogo1);
});


Route::patch('gonogo_store/{gef_phone}','App\Http\Controllers\SalesController@store')->name('gonogo_store');

use Illuminate\Http\Request2;


Route::get('/leadView/edit/english/pte/{pte_id?}',function($pte_id){
    $pte = App\english::where('gef_phone', '=', $pte_id)->first();
    return response()->json($pte);
});	

Route::patch('/leadView/edit/english/pte/{pte_id?}',function(Request $request,$pte_id){
	$pte = App\english::where('gef_phone', '=', $pte_id)->first();
    $pte->english_PTE_listening = $request->english_PTE_listening;
	$pte->english_PTE_read = $request->english_PTE_read;
	$pte->english_PTE_write = $request->english_PTE_write;
	$pte->english_PTE_speaking = $request->english_PTE_speaking;
	$pte->english_PTE_overall = $request->english_PTE_overall;

    $pte->save();
    return response()->json($pte);
});

Route::get('/leadView/edit/english/plan/{plan_id?}',function($plan_id){
    $plan = App\english::where('gef_phone', '=', $plan_id)->first();
    return response()->json($plan);
});	

Route::patch('/leadView/edit/english/plan/{plan_id?}',function(Request $request,$plan_id){
	$plan = App\english::where('gef_phone', '=', $plan_id)->first();
    $plan->english_test_plan_dte = $request->english_test_plan_dte;
	$plan->english_plan_comments = $request->english_plan_comments;

    $plan->save();
    return response()->json($plan);
});

Route::get('/leadView/edit/english/comments/{english_comments_id?}',function($english_comments_id){
    $englishcomments = App\english::where('gef_phone', '=', $english_comments_id)->first();
    return response()->json($englishcomments);
});	

Route::patch('/leadView/edit/english/comments/{english_comments_id?}',function(Request $request,$english_comments_id){
	$englishcomments = App\english::where('gef_phone', '=', $english_comments_id)->first();
	$englishcomments->english_comments = $request->english_comments;

    $englishcomments->save();
    return response()->json($englishcomments);
});

Route::get('/leadView/edit/english/ielts/{ielts_id?}',function($ielts_id){
    $ielts = App\english::where('gef_phone', '=', $ielts_id)->first();
    return response()->json($ielts);
});	

Route::patch('/leadView/edit/english/ielts/{ielts_id?}',function(Request $request,$ielts_id){
	$ielts = App\english::where('gef_phone', '=', $ielts_id)->first();
    $ielts->english_IELTS_listening = $request->english_IELTS_listening;
	$ielts->english_IELTS_read = $request->english_IELTS_read;
	$ielts->english_IELTS_write = $request->english_IELTS_write;
	$ielts->english_IELTS_speaking = $request->english_IELTS_speaking;
	$ielts->english_IELTS_overall = $request->english_IELTS_overall;

    $ielts->save();
    return response()->json($ielts);
});

Route::patch('english_store/{gef_phone}','App\Http\Controllers\SalesController@storeEnglish')->name('english_store');

Route::post('followup_store/{gef_phone}','App\Http\Controllers\SalesController@storeFollowup')->name('followup_store');

Route::patch('academics_store/{gef_phone}','App\Http\Controllers\SalesController@storeAcademics')->name('academics_store');

Route::patch('work_store/{gef_phone}','App\Http\Controllers\SalesController@storeWork')->name('work_store');

Route::patch('finance_store/{gef_phone}','App\Http\Controllers\SalesController@storeFinance')->name('finance_store');

Route::patch('outcome_store/{gef_phone}','App\Http\Controllers\SalesController@storeOutcome')->name('outcome_store');

Route::get('/leadView/edit/academics/qualification1/{qualification1_id?}',function($qualification1_id){
    $qualification1 = App\academics::where('gef_phone', '=', $qualification1_id)->first();
    return response()->json($qualification1);
});	

Route::patch('/leadView/edit/academics/qualification1/{qualification1_id?}',function(Request $request,$qualification1_id){
	$qualification1 = App\academics::where('gef_phone', '=', $qualification1_id)->first();
    $qualification1->academics_higestDegree1 = $request->academics_higestDegree1;
	$qualification1->academics_yearOfPassing1 = $request->academics_yearOfPassing1;
	$qualification1->academics_university1 = $request->academics_university1;
	$qualification1->academics_uni_city1 = $request->academics_uni_city1;
	$qualification1->academics_final_result1 = $request->academics_final_result1;

    $qualification1->save();
    return response()->json($qualification1);
});

Route::get('/leadView/edit/academics/qualification2/{qualification2_id?}',function($qualification2_id){
    $qualification2 = App\academics::where('gef_phone', '=', $qualification2_id)->first();
    return response()->json($qualification2);
});	

Route::patch('/leadView/edit/academics/qualification2/{qualification2_id?}',function(Request $request,$qualification2_id){
	$qualification2 = App\academics::where('gef_phone', '=', $qualification2_id)->first();
    $qualification2->academics_higestDegree2 = $request->academics_higestDegree2;
	$qualification2->academics_yearOfPassing2 = $request->academics_yearOfPassing2;
	$qualification2->academics_university2 = $request->academics_university2;
	$qualification2->academics_uni_city2 = $request->academics_uni_city2;
	$qualification2->academics_final_result2 = $request->academics_final_result2;

    $qualification2->save();
    return response()->json($qualification2);
});

Route::get('/leadView/edit/academics/qualification3/{qualification3_id?}',function($qualification3_id){
    $qualification3 = App\academics::where('gef_phone', '=', $qualification3_id)->first();
    return response()->json($qualification3);
});	

Route::patch('/leadView/edit/academics/qualification3/{qualification3_id?}',function(Request $request,$qualification3_id){
	$qualification3 = App\academics::where('gef_phone', '=', $qualification3_id)->first();
    $qualification3->academics_higestDegree3 = $request->academics_higestDegree3;
	$qualification3->academics_yearOfPassing3 = $request->academics_yearOfPassing3;
	$qualification3->academics_university3 = $request->academics_university3;
	$qualification3->academics_uni_city3 = $request->academics_uni_city3;
	$qualification3->academics_final_result3 = $request->academics_final_result3;

    $qualification3->save();
    return response()->json($qualification3);
});

Route::get('/leadView/edit/academics/qualification4/{qualification4_id?}',function($qualification4_id){
    $qualification4 = App\academics::where('gef_phone', '=', $qualification4_id)->first();
    return response()->json($qualification4);
});	

Route::patch('/leadView/edit/academics/qualification4/{qualification4_id?}',function(Request $request,$qualification4_id){
	$qualification4 = App\academics::where('gef_phone', '=', $qualification4_id)->first();
    $qualification4->academics_higestDegree4 = $request->academics_higestDegree4;
	$qualification4->academics_yearOfPassing4 = $request->academics_yearOfPassing4;
	$qualification4->academics_university4 = $request->academics_university4;
	$qualification4->academics_uni_city4 = $request->academics_uni_city4;
	$qualification4->academics_final_result4 = $request->academics_final_result4;

    $qualification4->save();
    return response()->json($qualification4);
});


Route::get('/leadView/edit/academics/comments/{academics_comments_id?}',function($academics_comments_id){
    $academicscomments = App\academics::where('gef_phone', '=', $academics_comments_id)->first();
    return response()->json($academicscomments);
});	

Route::patch('/leadView/edit/academics/comments/{academics_comments_id?}',function(Request $request,$academics_comments_id){
	$academicscomments = App\academics::where('gef_phone', '=', $academics_comments_id)->first();
	$academicscomments->academics_gap_reason = $request->academics_gap_reason;

    $academicscomments->save();
    return response()->json($academicscomments);
});

Route::get('/leadView/edit/work/work1/{work1_id?}',function($work1_id){
    $work1 = App\work::where('gef_phone', '=', $work1_id)->first();
    return response()->json($work1);
});	

Route::patch('/leadView/edit/work/work1/{work1_id?}',function(Request $request,$work1_id){
	$work1 = App\work::where('gef_phone', '=', $work1_id)->first();
    $work1->work_exp_company1 = $request->work_exp_company1;
	$work1->work_exp_designation1 = $request->work_exp_designation1;
	$work1->work_exp_employmentPeriod1 = $request->work_exp_employmentPeriod1;
	$work1->work_exp_employmentTo1 = $request->work_exp_employmentTo1;
	$work1->work_exp_location1 = $request->work_exp_location1;

    $work1->save();
    return response()->json($work1);
});

Route::get('/leadView/edit/work/work2/{work2_id?}',function($work2_id){
    $work2 = App\work::where('gef_phone', '=', $work2_id)->first();
    return response()->json($work2);
});	

Route::patch('/leadView/edit/work/work2/{work2_id?}',function(Request $request,$work2_id){
	$work2 = App\work::where('gef_phone', '=', $work2_id)->first();
    $work2->work_exp_company2 = $request->work_exp_company2;
	$work2->work_exp_designation2 = $request->work_exp_designation2;
	$work2->work_exp_employmentPeriod2 = $request->work_exp_employmentPeriod2;
	$work2->work_exp_employmentTo2 = $request->work_exp_employmentTo2;
	$work2->work_exp_location2 = $request->work_exp_location2;

    $work2->save();
    return response()->json($work2);
});

Route::get('/leadView/edit/work/comments/{work_comments_id?}',function($work_comments_id){
    $workcomments = App\work::where('gef_phone', '=', $work_comments_id)->first();
    return response()->json($workcomments);
});	

Route::patch('/leadView/edit/work/comments/{work_comments_id?}',function(Request $request,$work_comments_id){
	$workcomments = App\work::where('gef_phone', '=', $work_comments_id)->first();
	$workcomments->work_gap_reason = $request->work_gap_reason;

    $workcomments->save();
    return response()->json($workcomments);
});

Route::get('/leadView/edit/finance/finance/{finance_id?}',function($finance_id){
    $finance = App\finance::where('gef_phone', '=', $finance_id)->first();
    return response()->json($finance);
}); 

Route::patch('leadView/edit/finance/finance/{finance_id?}',function(Request $request,$finance_id){
    $finance = App\finance::where('gef_phone', '=', $finance_id)->first();
    $finance->sales_fin_maritalStatus  = $request->sales_fin_maritalStatus;
    $finance->sales_fin_35To45k = $request->sales_fin_35To45k;
    $finance->sales_fin_fundSource  = $request->sales_fin_fundSource;
    $finance->save();
    return response()->json($finance);
});



Route::get('/leadView/edit/outcome/outcome1/{outcome1_id?}',function($outcome1_id){
    $outcome1 = App\outcome::where('gef_phone', '=', $outcome1_id)->first();
    return response()->json($outcome1);
});	

Route::patch('/leadView/edit/outcome/outcome1/{outcome1_id?}',function(Request $request,$outcome1_id){
	$outcome1 = App\outcome::where('gef_phone', '=', $outcome1_id)->first();
    $outcome1->outcome_inst1 = $request->outcome_inst1;
	$outcome1->outcome_inst1_campus = $request->outcome_inst1_campus;
        $outcome1->outcome_inst1_intake = $request->outcome_inst1_intake;
	$outcome1->outcome_course1 = $request->outcome_course1;
	$outcome1->outcome_course1_startDate = $request->outcome_course1_startDate;
        $outcome1->outcome_course1_link = $request->outcome_course1_link;
    $outcome1->save();

    return response()->json($outcome1);
});


Route::get('/leadView/edit/outcome/outcome2/{outcome2_id?}',function($outcome2_id){
    $outcome2 = App\outcome::where('gef_phone', '=', $outcome2_id)->first();
    return response()->json($outcome2);
});	

Route::patch('/leadView/edit/outcome/outcome2/{outcome2_id?}',function(Request $request,$outcome2_id){
	$outcome2 = App\outcome::where('gef_phone', '=', $outcome2_id)->first();
 	$outcome2->outcome_inst2 = $request->outcome_inst2;
        $outcome2->outcome_inst2_intake = $request->outcome_inst2_intake;
	$outcome2->outcome_inst2_campus = $request->outcome_inst2_campus;
	$outcome2->outcome_course2 = $request->outcome_course2;
	$outcome2->outcome_course2_startDate = $request->outcome_course2_startDate;
        $outcome2->outcome_course2_link = $request->outcome_course2_link;
    $outcome2->save();
   
    return response()->json($outcome2);
});

Route::get('/leadView/edit/outcome/outcome3/{outcome3_id?}',function($outcome3_id){
    $outcome3 = App\outcome::where('gef_phone', '=', $outcome3_id)->first();
    return response()->json($outcome3);
});	

Route::patch('/leadView/edit/outcome/outcome3/{outcome3_id?}',function(Request $request,$outcome3_id){
	$outcome3 = App\outcome::where('gef_phone', '=', $outcome3_id)->first();
    $outcome3->outcome_inst3 = $request->outcome_inst3;
        $outcome3->outcome_inst3_intake = $request->outcome_inst3_intake;
	$outcome3->outcome_inst3_campus = $request->outcome_inst3_campus;
	$outcome3->outcome_course3 = $request->outcome_course3;
	$outcome3->outcome_course3_startDate = $request->outcome_course3_startDate;
        $outcome3->outcome_course3_link = $request->outcome_course3_link;

    $outcome3->save();

    return response()->json($outcome3);
});

Route::get('/leadView/edit/outcome/comments/{outcome_comments_id?}',function($outcome_comments_id){
    $outcomecomments = App\outcome::where('gef_phone', '=', $outcome_comments_id)->first();
    return response()->json($outcomecomments);
});	

Route::patch('/leadView/edit/outcome/comments/{outcome_comments_id?}',function(Request $request,$outcome_comments_id){
	$outcomecomments = App\outcome::where('gef_phone', '=', $outcome_comments_id)->first();
	$outcomecomments->outcome_comments = $request->outcome_comments;

    $outcomecomments->save();
    return response()->json($outcomecomments);
});


Route::patch('updateServiceAssignTo/{gef_id}', 'App\Http\Controllers\EnquiryController@updateServiceAssignTo')->name('updateServiceAssignTo');

Route::get('enquiry','App\Http\Controllers\EnquiryController@create')->name('enquiry');

Route::get('enquiryOnshore','App\Http\Controllers\EnquiryController@onshore')->name('enquiryOnshore');

Route::get('addEnquiry','App\Http\Controllers\EnquiryController@addEnquiry')->name('addEnquiry');

Route::post('enquiry_store','App\Http\Controllers\EnquiryController@store')->name('enquiry_store');

Route::post('storeOnshore','App\Http\Controllers\EnquiryController@storeOnshore')->name('storeOnshore');

Route::patch('updateAssignTo/{gef_id}', 'App\Http\Controllers\EnquiryController@updateAssignTo')->name('updateAssignTo');

Route::patch('forApproval/{gef_phone}', 'App\Http\Controllers\EnquiryController@forApproval')->name('forApproval');

Route::get('/destinations', 'App\Http\Controllers\Auth\LoginController@destinations')->name('destinations');

Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginPage')->name('login');


//Route::get('dashboard', 'App\Http\Controllers\Auth\LoginController@showDashBoard')->name('dashboard');
 
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
 
Route::get('login/{provider}', 'App\Http\Controllers\Auth\LoginController@auth')
    ->where(['provider' => 'facebook|google|twitter']);
 
Route::get('login/{provider}/callback', 'App\Http\Controllers\Auth\LoginController@login')
    ->where(['provider' => 'facebook|google|twitter']);

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/gefAfterSubmit', 'App\Http\Controllers\EnquiryController@gefAfterSubmit')->name('gefAfterSubmit');

Route::get('/onshoreSubmit', 'App\Http\Controllers\EnquiryController@onshoreSubmit')->name('onshoreSubmit');

Route::patch('admission_store/{gef_phone}','App\Http\Controllers\ServiceController@storeAdmission')->name('admission_store');

Route::patch('funds_store/{gef_phone}','App\Http\Controllers\ServiceController@storeFunds')->name('funds_store');

Route::patch('pcc_store/{gef_phone}','App\Http\Controllers\ServiceController@storePcc')->name('pcc_store');

Route::patch('med_store/{gef_phone}','App\Http\Controllers\ServiceController@storeMed')->name('med_store');

Route::patch('visa_store/{gef_phone}','App\Http\Controllers\ServiceController@storeVisa')->name('visa_store');

Route::patch('onshore_store/{gef_phone}','App\Http\Controllers\ServiceController@storeOnshore')->name('onshore_store');

Route::get('/serviceView/edit/admission/admission1/{admission1_id?}',function($admission1_id){
    $admission1 = App\admission::where('gef_phone', '=', $admission1_id)->first();
    return response()->json($admission1);
});	

Route::patch('/serviceView/edit/admission/admission1/{admission1_id?}',function(Request $request,$admission1_id){
	$admission1 = App\admission::where('gef_phone', '=', $admission1_id)->first();
    $admission1->admission_outcome_inst1 = $request->admission_outcome_inst1;
    $admission1->admission_outcome_course1 = $request->admission_outcome_course1;
    $admission1->admission_appliedDate1 = $request->admission_appliedDate1;
	$admission1->admission_appliedStatus1 = $request->admission_appliedStatus1;
	
    $admission1->save();
    return response()->json($admission1);
});

Route::get('/serviceView/edit/admission/admission2/{admission2_id?}',function($admission2_id){
    $admission2 = App\admission::where('gef_phone', '=', $admission2_id)->first();
    return response()->json($admission2);
});	

Route::patch('/serviceView/edit/admission/admission2/{admission2_id?}',function(Request $request,$admission2_id){
	$admission2 = App\admission::where('gef_phone', '=', $admission2_id)->first();
    $admission2->admission_outcome_inst2 = $request->admission_outcome_inst2;
    $admission2->admission_outcome_course2 = $request->admission_outcome_course2;
    $admission2->admission_appliedDate2 = $request->admission_appliedDate2;
	$admission2->admission_appliedStatus2 = $request->admission_appliedStatus2;
	
    $admission2->save();
    return response()->json($admission2);
});

Route::get('/serviceView/edit/admission/admission3/{admission3_id?}',function($admission3_id){
    $admission3 = App\admission::where('gef_phone', '=', $admission3_id)->first();
    return response()->json($admission3);
});	

Route::patch('/serviceView/edit/admission/admission3/{admission3_id?}',function(Request $request,$admission3_id){
	$admission3 = App\admission::where('gef_phone', '=', $admission3_id)->first();
    $admission3->admission_outcome_inst3 = $request->admission_outcome_inst3;
    $admission3->admission_outcome_course3 = $request->admission_outcome_course3;
    $admission3->admission_appliedDate3 = $request->admission_appliedDate3;
	$admission3->admission_appliedStatus3 = $request->admission_appliedStatus3;
	
    $admission3->save();
    return response()->json($admission3);
});

Route::get('/serviceView/edit/admission/finalIns/{finalIns_id?}',function($finalIns_id){
    $finalIns = App\admission::where('gef_phone', '=', $finalIns_id)->first();
    return response()->json($finalIns);
});	

Route::patch('/serviceView/edit/admission/finalIns/{finalIns_id?}',function(Request $request,$finalIns_id){
	$finalIns = App\admission::where('gef_phone', '=', $finalIns_id)->first();
	$funds = App\funds::where('gef_phone', '=', $finalIns_id)->first();

    $finalIns->admission_finalIns = $request->admission_finalIns;
	$finalIns->admission_finalCampus = $request->admission_finalCampus;
	$finalIns->admission_finalCourse = $request->admission_finalCourse;	
    $finalIns->save();


    $funds->funds_admission_finalIns = $request->admission_finalIns;
	$funds->funds_admission_finalCourse = $request->admission_finalCourse;
    $funds->save();

    return response()->json($finalIns);
});

Route::get('/serviceView/edit/admission/insDates/{insDates_id?}',function($insDates_id){
    $insDates = App\admission::where('gef_phone', '=', $insDates_id)->first();
    return response()->json($insDates);
});	

Route::patch('/serviceView/edit/admission/insDates/{insDates_id?}',function(Request $request,$insDates_id){
	$insDates = App\admission::where('gef_phone', '=', $insDates_id)->first();
    $insDates->admission_insStartDte = $request->admission_insStartDte;
	$insDates->admission_insExtDte = $request->admission_insExtDte;
	$insDates->admission_insBkpDte = $request->admission_insBkpDte;
	
    $insDates->save();
    return response()->json($insDates);
});

Route::get('/serviceView/edit/admission/comments/{admission_comments_id?}',function($admission_comments_id){
    $admissioncomments = App\admission::where('gef_phone', '=', $admission_comments_id)->first();
    return response()->json($admissioncomments);
});	

Route::patch('/serviceView/edit/admission/comments/{admission_comments_id?}',function(Request $request,$admission_comments_id){
	$admissioncomments = App\admission::where('gef_phone', '=', $admission_comments_id)->first();
	$admissioncomments->admission_comments = $request->admission_comments;

    $admissioncomments->save();
    return response()->json($admissioncomments);
});

Route::get('/serviceView/edit/funds/courseFee/{courseFee_id?}',function($courseFee_id){
    $courseFee = App\funds::where('gef_phone', '=', $courseFee_id)->first();
    return response()->json($courseFee);
});	

Route::patch('/serviceView/edit/funds/courseFee/{courseFee_id?}',function(Request $request,$courseFee_id){
	$courseFee = App\funds::where('gef_phone', '=', $courseFee_id)->first();
    $courseFee->funds_courseFee = $request->funds_courseFee;
	$courseFee->funds_paymentStatus = $request->funds_paymentStatus;
	
    $courseFee->save();
    return response()->json($courseFee);
});

Route::get('/serviceView/edit/funds/comments/{funds_comments_id?}',function($funds_comments_id){
    $fundscomments = App\funds::where('gef_phone', '=', $funds_comments_id)->first();
    return response()->json($fundscomments);
});	

Route::patch('/serviceView/edit/funds/comments/{funds_comments_id?}',function(Request $request,$funds_comments_id){
	$fundscomments = App\funds::where('gef_phone', '=', $funds_comments_id)->first();
	$fundscomments->funds_comments = $request->funds_comments;

    $fundscomments->save();
    return response()->json($fundscomments);
});

Route::get('/serviceView/edit/pcc/pcc/{pcc_id?}',function($pcc_id){
    $pcc = App\pcc::where('gef_phone', '=', $pcc_id)->first();
    return response()->json($pcc);
});	

Route::patch('/serviceView/edit/pcc/pcc/{pcc_id?}',function(Request $request,$pcc_id){
	$pcc = App\pcc::where('gef_phone', '=', $pcc_id)->first();
    $pcc->pcc_appliedDte = $request->pcc_appliedDte;
	$pcc->pcc_appliedPlace = $request->pcc_appliedPlace;
	$pcc->pcc_appliedStatus = $request->pcc_appliedStatus;
	
    $pcc->save();
    return response()->json($pcc);
});

Route::get('/serviceView/edit/pcc/comments/{pcc_comments_id?}',function($pcc_comments_id){
    $pcccomments = App\pcc::where('gef_phone', '=', $pcc_comments_id)->first();
    return response()->json($pcccomments);
});	

Route::patch('/serviceView/edit/pcc/comments/{pcc_comments_id?}',function(Request $request,$pcc_comments_id){
	$pcccomments = App\pcc::where('gef_phone', '=', $pcc_comments_id)->first();
	$pcccomments->pcc_comments = $request->pcc_comments;

    $pcccomments->save();
    return response()->json($pcccomments);
});

Route::get('/serviceView/edit/med/med/{med_id?}',function($med_id){
    $med = App\med::where('gef_phone', '=', $med_id)->first();
    return response()->json($med);
});	

Route::patch('/serviceView/edit/med/med/{med_id?}',function(Request $request,$med_id){
	$med = App\med::where('gef_phone', '=', $med_id)->first();
    $med->med_appliedDte = $request->med_appliedDte;
	$med->med_appliedPlace = $request->med_appliedPlace;
	$med->med_appliedStatus = $request->med_appliedStatus;
	
    $med->save();
    return response()->json($med);
});

Route::get('/serviceView/edit/med/comments/{med_comments_id?}',function($med_comments_id){
    $medcomments = App\med::where('gef_phone', '=', $med_comments_id)->first();
    return response()->json($medcomments);
});	

Route::patch('/serviceView/edit/med/comments/{med_comments_id?}',function(Request $request,$med_comments_id){
	$medcomments = App\med::where('gef_phone', '=', $med_comments_id)->first();
	$medcomments->med_comments = $request->med_comments;

    $medcomments->save();
    return response()->json($medcomments);
});

Route::get('/serviceView/edit/onshore/onshore/{onshore_id?}',function($onshore_id){
    $onshore = App\onshore::where('gef_phone', '=', $onshore_id)->first();
    return response()->json($onshore);
});	

Route::patch('/serviceView/edit/onshore/onshore/{onshore_id?}',function(Request $request,$onshore_id){
	$onshore = App\onshore::where('gef_phone', '=', $onshore_id)->first();
    $onshore->onshore_kitContents = $request->onshore_kitContents;
	$onshore->onshore_courier = $request->onshore_courier;
	$onshore->onshore_bookedOn = $request->onshore_bookedOn;
	$onshore->onshore_clientAddress = $request->onshore_clientAddress;
	
    $onshore->save();
    return response()->json($onshore);
});

Route::get('/serviceView/edit/onshore/comments/{onshore_comments_id?}',function($onshore_comments_id){
    $onshorecomments = App\onshore::where('gef_phone', '=', $onshore_comments_id)->first();
    return response()->json($onshorecomments);
});	

Route::patch('/serviceView/edit/onshore/comments/{onshore_comments_id?}',function(Request $request,$onshore_comments_id){
	$onshorecomments = App\onshore::where('gef_phone', '=', $onshore_comments_id)->first();
	$onshorecomments->onshore_comments = $request->onshore_comments;

    $onshorecomments->save();
    return response()->json($onshorecomments);
});

Route::get('/serviceView/edit/visa/visa/{visa_id?}',function($visa_id){
    $visa = App\visa::where('gef_phone', '=', $visa_id)->first();
    return response()->json($visa);
});	

Route::patch('/serviceView/edit/visa/visa/{visa_id?}',function(Request $request,$visa_id){
	$visa = App\visa::where('gef_phone', '=', $visa_id)->first();
    $visa->visa_ajvProcessDte = $request->visa_ajvProcessDte;
	$visa->visa_ajvPaidAmt = $request->visa_ajvPaidAmt;
	$visa->visa_docsCol = $request->visa_docsCol;
	$visa->visa_appExpectDte = $request->visa_appExpectDte;
	$visa->visa_aipDeadlineDte = $request->visa_aipDeadlineDte;
	$visa->visa_aipUploadDte = $request->visa_aipUploadDte;
	$visa->visa_mockAdvisor = $request->visa_mockAdvisor;
	$visa->visa_qcTL = $request->visa_qcTL;
	$visa->visa_mockTL = $request->visa_mockTL;
	$visa->visa_visaAppliedDte = $request->visa_visaAppliedDte;
	$visa->visa_appApprovedBy = $request->visa_appApprovedBy;
	$visa->visa_evisaDte = $request->visa_evisaDte;

    $visa->save();
    return response()->json($visa);
});

Route::get('/ajveverest/dashboard/markAsRead',function(){
    auth()->user()->unreadNotifications->markAsRead();
});

Route::patch('updateStatus/{gef_phone}', 'App\Http\Controllers\EnquiryController@updateStatus')->name('updateStatus');


Route::get('leadApprovals', function () {
    $user = Auth::user();   
    $reviews = App\gef_DL::where('gef_salesApproval', '=', 'Drop Pending')->where('assigned_lead', '=', $user->email)->get();
    $approvals = App\gef_DL::where('gef_salesApproval', '=', 'Approval Pending')->where('assigned_lead', '=', $user->email)->get();

    return view('leadApprovals', compact('reviews','approvals'));
})->name('leadApprovals');

Route::get('appApprovals', function () {
    $reviews = App\enquiry::where('gef_serviceApproval', '=', 'Drop Pending')->get();
    $approvals = App\enquiry::where('gef_serviceApproval', '=', 'Approval Pending')->get();
    
    return view('appApprovals', compact('reviews','approvals'));
})->name('appApprovals');

Route::patch('forAppApproval/{gef_phone}', 'App\Http\Controllers\EnquiryController@forAppApproval')->name('forAppApproval');

Route::patch('updateAppStatus/{gef_phone}', 'App\Http\Controllers\EnquiryController@updateAppStatus')->name('updateAppStatus');

Route::post('comments_store','App\Http\Controllers\SalesController@storeComments')->name('comments_store');

Route::get('dashTab','App\Http\Controllers\EnquiryController@dashTab')->name('dashTab');

Route::get('/leadView/edit/outcome/mchecks/{mchecks_id?}',function($mchecks_id){
    $mchecks = App\outcome::where('gef_phone', '=', $mchecks_id)->first();
    return response()->json($mchecks);
});

Route::patch('/leadView/edit/outcome/mchecks/{mchecks_id?}',function(Request $request,$mchecks_id){
	$mchecks = App\outcome::where('gef_phone', '=', $mchecks_id)->first();
    $mchecks->outcome_ARM_CBA = $request->outcome_ARM_CBA;
        $mchecks->outcome_ARM_ACO = $request->outcome_ARM_ACO;

        if($mchecks->outcome_ARM_ACO === null){
           $mchecks->outcome_ARM_ACO = ' ';
        }

    $mchecks->save();

    return response()->json($mchecks);
});


Route::get('/leadView/edit/outcome/english1/{english1_id?}',function($english1_id){
    $english1 = App\outcome::where('gef_phone', '=', $english1_id)->first();
    return response()->json($english1);
});

Route::patch('/leadView/edit/outcome/english1/{english1_id?}',function(Request $request,$english1_id){
	$english1 = App\outcome::where('gef_phone', '=', $english1_id)->first();
    $english1->outcome_ERM_CBA = $request->outcome_ERM_CBA;
        $english1->outcome_ERM_ACO = $request->outcome_ERM_ACO;

        if($english1->outcome_ERM_ACO === null){
           $english1->outcome_ERM_ACO = ' ';
        }

    $english1->save();

    return response()->json($english1);
});

Route::get('/leadView/edit/outcome/english1S/{english1S_id?}',function($english1S_id){
    $english1S = App\outcome::where('gef_phone', '=', $english1S_id)->first();
    return response()->json($english1S);
});

Route::patch('/leadView/edit/outcome/english1S/{english1S_id?}',function(Request $request,$english1S_id){
	$english1S = App\outcome::where('gef_phone', '=', $english1S_id)->first();
    $english1S->outcome_ERM_CBA = $request->outcome_ERM_CBA;
        $english1S->outcome_ERM_ACO = $request->outcome_ERM_ACO;

    $english1S->save();

    return response()->json($english1S);
});

Route::get('/leadView/edit/outcome/files/{files_id?}',function($files_id){
    $files = App\outcome::where('gef_phone', '=', $files_id)->first();
    return response()->json($files);
});

Route::patch('/leadView/edit/outcome/files/{files_id?}',function(Request $request,$files_id){
	$files = App\outcome::where('gef_phone', '=', $files_id)->first();
    $files->outcome_FNC_CBA = $request->outcome_FNC_CBA;
        $files->outcome_FNC_ACO = $request->outcome_FNC_ACO;

        if($files->outcome_FNC_ACO === null){
           $files->outcome_FNC_ACO = ' ';
        }

    $files->save();

    return response()->json($files);
});


Route::get('/leadView/edit/outcome/filesS/{filesS_id?}',function($filesS_id){
    $filesS = App\outcome::where('gef_phone', '=', $filesS_id)->first();
    return response()->json($filesS);
});

Route::patch('/leadView/edit/outcome/filesS/{filesS_id?}',function(Request $request,$filesS_id){
	$filesS = App\outcome::where('gef_phone', '=', $filesS_id)->first();
    $filesS->outcome_FNC_CBA = $request->outcome_FNC_CBA;
        $filesS->outcome_FNC_ACO = $request->outcome_FNC_ACO;

    $filesS->save();

    return response()->json($filesS);
});

Route::get('/leadView/edit/outcome/scan/{scan_id?}',function($scan_id){
    $scan = App\outcome::where('gef_phone', '=', $scan_id)->first();
    return response()->json($scan);
});

Route::patch('/leadView/edit/outcome/scan/{scan_id?}',function(Request $request,$scan_id){
	$scan= App\outcome::where('gef_phone', '=', $scan_id)->first();
    $scan->outcome_FSP_CBA = $request->outcome_FSP_CBA;
        $scan->outcome_FSP_ACO = $request->outcome_FSP_ACO;

        if($scan->outcome_FSP_ACO === null){
           $scan->outcome_FSP_ACO = ' ';
        }-

    $scan->save();

    return response()->json($scan);
});

Route::get('/leadView/edit/outcome/scanS/{scanS_id?}',function($scanS_id){
    $scan = App\outcome::where('gef_phone', '=', $scanS_id)->first();
    return response()->json($scanS);
});

Route::patch('/leadView/edit/outcome/scanS/{scanS_id?}',function(Request $request,$scanS_id){
	$scanS= App\outcome::where('gef_phone', '=', $scanS_id)->first();
    $scanS->outcome_FSP_CBA = $request->outcome_FSP_CBA;
        $scanS->outcome_FSP_ACO = $request->outcome_FSP_ACO;

    $scanS->save();

    return response()->json($scanS);
});

Route::get('/leadView/edit/outcome/passport/{passport_id?}',function($passport_id){
    $passport = App\outcome::where('gef_phone', '=', $passport_id)->first();
    return response()->json($passport);
});

Route::patch('/leadView/edit/outcome/passport/{passport_id?}',function(Request $request,$passport_id){
	$passport= App\outcome::where('gef_phone', '=', $passport_id)->first();
        $passport->outcome_passport_PBA = $request->outcome_passport_PBA;
        $passport->outcome_passport_scan = $request->outcome_passport_scan;
        $passport->outcome_passport_ACO = $request->outcome_passport_ACO;

        if($passport->outcome_passport_ACO === null){
           $passport->outcome_passport_ACO = ' ';
        }
            
    $passport->save();

    return response()->json($passport);
});

Route::get('/leadView/edit/outcome/class10/{class10_id?}',function($class10_id){
    $class10 = App\outcome::where('gef_phone', '=', $class10_id)->first();
    return response()->json($class10);
});

Route::patch('/leadView/edit/outcome/class10/{class10_id?}',function(Request $request,$class10_id){
	$class10 = App\outcome::where('gef_phone', '=', $class10_id)->first();
        $class10->outcome_class10_PBA = $request->outcome_class10_PBA;
        $class10->outcome_class10_scan = $request->outcome_class10_scan;
        $class10->outcome_class10_ACO = $request->outcome_class10_ACO;

        if($class10->outcome_class10_ACO === null){
           $class10->outcome_class10_ACO = ' ';
        }
            
    $class10->save();

    return response()->json($class10);
});

Route::get('/leadView/edit/outcome/class12/{class12_id?}',function($class12_id){
    $class12 = App\outcome::where('gef_phone', '=', $class12_id)->first();
    return response()->json($class12);
});

Route::patch('/leadView/edit/outcome/class12/{class12_id?}',function(Request $request,$class12_id){
	$class12 = App\outcome::where('gef_phone', '=', $class12_id)->first();
        $class12->outcome_class12_PBA = $request->outcome_class12_PBA;
        $class12->outcome_class12_scan = $request->outcome_class12_scan;
        $class12->outcome_class12_ACO = $request->outcome_class12_ACO;

        if($class12->outcome_class12_ACO === null){
           $class12->outcome_class12_ACO = ' ';
        }
            
    $class12->save();

    return response()->json($class12);
});

Route::get('/leadView/edit/outcome/BC/{BC_id?}',function($BC_id){
    $BC = App\outcome::where('gef_phone', '=', $BC_id)->first();
    return response()->json($BC);
});

Route::patch('/leadView/edit/outcome/BC/{BC_id?}',function(Request $request,$BC_id){
	$BC = App\outcome::where('gef_phone', '=', $BC_id)->first();
        $BC->outcome_BC_PBA = $request->outcome_BC_PBA;
        $BC->outcome_BC_scan = $request->outcome_BC_scan;
        $BC->outcome_BC_ACO = $request->outcome_BC_ACO;

        if($BC->outcome_BC_ACO === null){
           $BC->outcome_BC_ACO = ' ';
        }
            
    $BC->save();

    return response()->json($BC);
});

Route::get('/leadView/edit/outcome/BSWM/{BSWM_id?}',function($BSWM_id){
    $BSWM = App\outcome::where('gef_phone', '=', $BSWM_id)->first();
    return response()->json($BSWM);
});

Route::patch('/leadView/edit/outcome/BSWM/{BSWM_id?}',function(Request $request,$BSWM_id){
	$BSWM = App\outcome::where('gef_phone', '=', $BSWM_id)->first();
        $BSWM->outcome_BSWM_PBA = $request->outcome_BSWM_PBA;
        $BSWM->outcome_BSWM_scan = $request->outcome_BSWM_scan;
        $BSWM->outcome_BSWM_ACO = $request->outcome_BSWM_ACO;

        if($BSWM->outcome_BSWM_ACO === null){
           $BSWM->outcome_BSWM_ACO = ' ';
        }
            
    $BSWM->save();

    return response()->json($BSWM);
});

Route::get('/leadView/edit/outcome/BPC/{BPC_id?}',function($BPC_id){
    $BPC = App\outcome::where('gef_phone', '=', $BPC_id)->first();
    return response()->json($BPC);
});

Route::patch('/leadView/edit/outcome/BPC/{BPC_id?}',function(Request $request,$BPC_id){
	$BPC = App\outcome::where('gef_phone', '=', $BPC_id)->first();
        $BPC->outcome_BPC_PBA = $request->outcome_BPC_PBA;
        $BPC->outcome_BPC_scan = $request->outcome_BPC_scan;
        $BPC->outcome_BPC_ACO = $request->outcome_BPC_ACO;

        if($BPC->outcome_BPC_ACO === null){
           $BPC->outcome_BPC_ACO = ' ';
        }
            
    $BPC->save();

    return response()->json($BPC);
});

Route::get('/leadView/edit/outcome/BDC/{BDC_id?}',function($BDC_id){
    $BDC = App\outcome::where('gef_phone', '=', $BDC_id)->first();
    return response()->json($BDC);
});

Route::patch('/leadView/edit/outcome/BDC/{BDC_id?}',function(Request $request,$BDC_id){
	$BDC = App\outcome::where('gef_phone', '=', $BDC_id)->first();
        $BDC->outcome_BDC_PBA = $request->outcome_BDC_PBA;
        $BDC->outcome_BDC_scan = $request->outcome_BDC_scan;
        $BDC->outcome_BDC_ACO = $request->outcome_BDC_ACO;

        if($BDC->outcome_BDC_ACO === null){
           $BDC->outcome_BDC_ACO = ' ';
        }
            
    $BDC->save();

    return response()->json($BDC);
});

Route::get('/leadView/edit/outcome/CV/{CV_id?}',function($CV_id){
    $CV = App\outcome::where('gef_phone', '=', $CV_id)->first();
    return response()->json($CV);
});

Route::patch('/leadView/edit/outcome/CV/{CV_id?}',function(Request $request,$CV_id){
	$CV = App\outcome::where('gef_phone', '=', $CV_id)->first();
        $CV->outcome_CV_PBA = $request->outcome_CV_PBA;
        $CV->outcome_CV_scan = $request->outcome_CV_scan;
        $CV->outcome_CV_ACO = $request->outcome_CV_ACO;

        if($CV->outcome_CV_ACO === null){
           $CV->outcome_CV_ACO = ' ';
        }
            
    $CV->save();

    return response()->json($CV);
});

Route::patch('/leadView/edit/gef/mChecks',function(Request $request){
    $gef= App\enquiry::where('gef_phone', '=', $request->id)->first();
    $outcome = App\outcome::where('gef_phone', '=', $request->id)->first();
    $admission = App\admission::where('gef_phone', '=', $request->id)->first();
    

    if($request->index === '0'){
       $gef->gef_altPhone = $request->val;
    }
    if($request->index === '1'){
       $gef->gef_altEmail = $request->val;
    }
    if($request->index === '2'){
       $gef->gef_skype= $request->val;
    }
    if($request->index === '13'){
       $outcome->outcome_linktodoc = $request->val;
       $gef->tab = 'finance';                
    }
    if($request->index === '4'){
       $outcome->outcome_feeAgreed = $request->val;
       $gef->tab = 'finance';                
    }
    if($request->index === '7'){
       $gef->gef_nationality = $request->val;
    }    
       $gef->save();
       $outcome->save();
       $admission->save();
       

       return response()->json($outcome);

});

Route::get('/searchLead', 'App\Http\Controllers\EnquiryController@searchLead')->name('searchLead');

Route::get('/export', 'App\Http\Controllers\EnquiryController@export')->name('export');

Route::get('exportLead', 'App\Http\Controllers\EnquiryController@exportLead')->name('exportLead');

Route::get('/uploadLead', 'App\Http\Controllers\EnquiryController@uploadLead')->name('uploadLead');

Route::post('import', 'App\Http\Controllers\EnquiryController@import')->name('import');

Route::get('/delDuplicates', 'App\Http\Controllers\EnquiryController@delDuplicates')->name('depDuplicates');

Route::get('/pdfview','App\Http\Controllers\SalesController@pdfview')->name('pdfview');

Route::patch('/edit/assign/assign',function(Request $request){


        $user = Auth::user();   
        $emp = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();

        if($request->ids != null){ 
           $ids = $request->ids;
        } else {
           $ids = 'request empty';  
        }

        if($emp->AJV_DEP_ID === '1'){
           $enquiry = App\enquiry::whereIn('gef_phone',explode(',',$ids))->get();
        } else {
           $enquiry = App\gef_service::whereIn('gef_phone',explode(',',$ids))->get();
        }
        if($enquiry != null){
          $gef= count($enquiry);
        } else {
          $gef = 'query not successful';
        }
        $count = 0;
        foreach ($enquiry as $gefids) 
        {
              $phone = $gefids->gef_phone; 
            if($emp->AJV_DEP_ID === '1'){
               $gef1= App\enquiry::where('gef_phone', '=', $phone)->first();
            } else {
               $gef1= App\gef_service::where('gef_phone', '=', $phone)->first();
            }
          if($gef1->gef_salesApproval != 'Approval Pending'){
              $gef1->gef_salesApproval = 'New Leads';
              $gef1->gef_up_lead_status = 'New Leads';

              if($request->assign_to != null){
                  $gef1->gef_assigned_to = $request->assign_to;  
                  $emp = App\employee::where('AJV_EMP_Email', '=', $request->assign_to)->first();
                if($emp->AJV_EMP_Lead != null){
                   $lead = App\sales_leads::where('sales_lead_id', '=', $emp->AJV_EMP_Lead)->first(); 
                } else {
                  $lead = null;
                }
                if($lead != null){
                   $gef1->assigned_lead = $lead->sales_lead_email;
                } else {
                   $gef1->assigned_lead = null;
                } 
             } else {
               $gef1->gef_assigned_to = $request->assign3_to;  
               $gef1->assigned_lead = $request->assign3_to;
             }

              $gef1->save();
              $count++;
          } else {
              $gef1->gef_serviceApproval = 'New Leads';

            if($request->assign_to != null){
              $gef1->gef_service_assigned_to = $request->assign_to;  
              $emp = App\employee::where('AJV_EMP_Email', '=', $request->assign_to)->first();
              if($emp->AJV_EMP_Lead != null){
                 $lead = App\service_leads::where('sales_lead_id', '=', $emp->AJV_EMP_Lead)->first(); 
              } else {
                $lead = null;
              }
              if($lead != null){
                 $gef1->service_assigned_lead = $lead->sales_lead_email;
              } else {
                 $gef1->service_assigned_lead = null;
              } 
            } else {
              $gef1->gef_service_assigned_to = $request->assign3_to;  
              $gef1->service_assigned_lead = $request->assign3_to;
            }

              $gef1->save();
              $count++;
              $empTL = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();
              $SATL = App\employee::where('AJV_EMP_Email', '=', $gef1->assigned_lead)->first(); 
              $advisor = App\employee::where('AJV_EMP_Email', '=', $gef1->gef_assigned_to)->first();     



    	         $data = array(
    			'firstname' => $gef1->gef_f_name,
    			'lastname' => $gef1->gef_l_name,
    			'deal_phone' => $gef1->gef_phone,
    			'email' => $gef1->gef_email,
    			'nationality' => $gef1->gef_nationality,
    			'city' => $gef1->gef_location,
    			'advisor' => $advisor->AJV_EMP_Fname,
    			'serviceTL' => $empTL->AJV_EMP_Fname,
    			'CO' => $emp->AJV_EMP_Fname,
    			'subject' => 'New Deal!!! - '.$gef1->gef_f_name,
    			'STL' => $empTL->AJV_EMP_emailAlias,
    			'SAR' => $emp->AJV_EMP_emailAlias,
    			'SATL' => $SATL->AJV_EMP_emailAlias,
    			'SA' => $advisor->AJV_EMP_emailAlias,

    	       );

    	        Mail::send('dealAssignTemplate', $data, function ($message) use($data) {
    	        	$message->from($data['STL'])->subject($data['firstname']);
    	
    	        	$message->to($data['SAR'])->cc('dev.ops@ajv.kiwi',$data['SA'],$data['SATL'])->subject($data['subject']);
    	        });

          }
        }

            
        return response()->json($count);
            
});

Route::patch('/edit/assign1/assign1',function(Request $request){

        if($request->ids != null){ 
           $ids = $request->ids;
        } else {
           $ids = 'request empty';  
        }

           $enquiry = App\enquiry::whereIn('gef_phone',explode(',',$ids))->get();
        if($enquiry != null){
          $gef= count($enquiry);
        } else {
          $gef = 'query not successful';
        }
        $count = 0;
        foreach ($enquiry as $gefids) 
        {
              $phone = $gefids->gef_phone; 
              $gef1= App\enquiry::where('gef_phone', '=', $phone)->first();
              $gef1->gef_salesApproval = 'New Leads';
              $gef1->gef_up_lead_status = 'New Leads';

            if($request->assign1_to != null){
              $gef1->gef_assigned_to = $request->assign1_to;  
              $emp = App\employee::where('AJV_EMP_Email', '=', $request->assign1_to)->first();
              if($emp->AJV_EMP_Lead != null){
                 $lead = App\sales_leads::where('sales_lead_id', '=', $emp->AJV_EMP_Lead)->first(); 
              } else {
                $lead = null;
              }

              if($lead != null){
                 $gef1->assigned_lead = $lead->sales_lead_email;
              } else {
                 $gef1->assigned_lead = null;
              } 
            } else {
              $gef1->gef_assigned_to = $request->assign4_to;  
              $gef1->assigned_lead = $request->assign4_to;
            }
              $gef1->save();
              $count++;
        }

            
        return response()->json($count);
            
});

Route::patch('/edit/assign2/assign2',function(Request $request){

        if($request->ids != null){ 
           $ids = $request->ids;
        } else {
           $ids = 'request empty';  
        }

           $enquiry = App\enquiry::whereIn('gef_phone',explode(',',$ids))->get();
        if($enquiry != null){
          $gef= count($enquiry);
        } else {
          $gef = 'query not successful';
        }
        $count = 0;
        foreach ($enquiry as $gefids) 
        {
              $phone = $gefids->gef_phone;
              $gef1= App\enquiry::where('gef_phone', '=', $phone)->first();
              $gef1->gef_salesApproval = 'New Leads';
              $gef1->gef_up_lead_status = 'New Leads'; 

            if($request->assign2_to != null){
              $gef1->gef_assigned_to = $request->assign2_to;  
              $emp = App\employee::where('AJV_EMP_Email', '=', $request->assign2_to)->first();
              if($emp->AJV_EMP_Lead != null){
                 $lead = App\sales_leads::where('sales_lead_id', '=', $emp->AJV_EMP_Lead)->first(); 
              } else {
                $lead = null;
              }
              if($lead != null){
                 $gef1->assigned_lead = $lead->sales_lead_email;
              } else {
                 $gef1->assigned_lead = null;
              } 
            } else {
              $gef1->gef_assigned_to = $request->assign5_to;  
              $gef1->assigned_lead = $request->assign5_to;
            }
              $gef1->save();
              $count++;
        }

            
        return response()->json($count);
            
});

Route::get('sendemail', 'App\Http\Controllers\SendEmail@sendmail')->name('sendemail');

Route::get('mailtemplate', 'App\Http\Controllers\SendEmail@mail')->name('mailtemplate');

Route::get('bar-chart', 'App\Http\Controllers\ChartController@index')->name('bar-chart');

Route::get('dailyReport', 'App\Http\Controllers\SalesController@dailyReport')->name('dailyReport');

Route::get('dailySTA', 'App\Http\Controllers\SalesController@dailySTA')->name('dailySTA');

Route::get('monthlyReport', 'App\Http\Controllers\SalesController@monthlyReport')->name('monthlyReport');

Route::post('admission_store/{gef_phone}','App\Http\Controllers\ServiceController@storeAdmission')->name('admission_store');

Route::post('visa_store/{gef_phone}','App\Http\Controllers\ServiceController@storeVisa')->name('visa_store');

Route::patch('visa_update/{gef_phone}','App\Http\Controllers\ServiceController@updateVisa')->name('visa_update');

Route::patch('admission_update/{gef_phone}','App\Http\Controllers\ServiceController@updateAdmission')->name('admission_update');

Route::get('/empDetails', 'App\Http\Controllers\EnquiryController@empDetails')->name('empDetails');

Route::patch('storeEmpDetails/{AJV_EMP_Email}','App\Http\Controllers\SalesController@storeEmpDetails')->name('storeEmpDetails');

Route::post('followup_store_service/{gef_phone}','App\Http\Controllers\ServiceController@storeServiceFollowup')->name('followup_store_service');

Route::patch('serviceView/update/final_course',function(Request $request){
     $outcome = App\outcome::where('gef_phone', '=', $request->final_id)->first();
     $gef = App\gef_service::where('gef_phone', '=', $request->final_id)->first();

     $outcome->outcome_course1_final = $request->final;
     $gef->tab = 'admissions';

     $outcome->save();
     $gef->save(); 

    return response()->json();
});

Route::patch('serviceView/update/final_course41',function(Request $request){
     $outcome = App\outcome::where('gef_phone', '=', $request->final41_id)->first();
     $gef = App\gef_service::where('gef_phone', '=', $request->final41_id)->first();

     $outcome->outcome_course2_final = $request->final41;
     $gef->tab = 'admissions';

     $gef->save(); 
     $outcome->save();

    return response()->json();
});

Route::patch('serviceView/update/final_course3',function(Request $request){
     $outcome = App\outcome::where('gef_phone', '=', $request->final3_id)->first();
     $gef = App\gef_service::where('gef_phone', '=', $request->final3_id)->first();

     $outcome->outcome_course3_final = $request->final3;
     $gef->tab = 'admissions';

     $gef->save(); 

     $outcome->save();

    return response()->json();
});

Route::patch('serviceView/update/applied_date',function(Request $request){
     $outcome = App\outcome::where('gef_phone', '=', $request->applied_id)->first();
     $outcome->outcome_course1_appliedDate = $request->appliedDte;
     $outcome->outcome_course1_status = $request->courseStatus;

     $gef = App\gef_service::where('gef_phone', '=', $request->applied_id)->first();

     $gef->tab = 'admissions';

     $gef->save(); 

     $outcome->save();

    return response()->json();
});


Route::patch('serviceView/update/applied3_date',function(Request $request){
     $outcome = App\outcome::where('gef_phone', '=', $request->applied3_id)->first();
     $outcome->outcome_course3_appliedDate = $request->appliedDte3;
     $outcome->outcome_course3_status = $request->courseStatus3;

     $gef = App\gef_service::where('gef_phone', '=', $request->applied3_id)->first();

     $gef->tab = 'admissions';

     $gef->save(); 

     $outcome->save();

    return response()->json();
});

Route::patch('serviceView/update/applied2_date',function(Request $request){
     $outcome = App\outcome::where('gef_phone', '=', $request->applied_id2)->first();
     $outcome->outcome_course2_appliedDate = $request->appliedDte2;
     $outcome->outcome_course2_status = $request->courseStatus2;

     $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/edit/gef/mChecks1',function(Request $request){
    $gef= App\gef_service::where('gef_phone', '=', $request->id)->first();
    $outcome= App\outcome::where('gef_phone', '=', $request->id)->first();
    $admission= App\admission::where('gef_phone', '=', $request->id)->first();


    if($request->index === '00'){
       $gef->gef_passport = $request->val;
    }
    if($request->index === '0'){
       $gef->gef_altPhone = $request->val;
    }
    if($request->index === '1'){
       $gef->gef_altEmail = $request->val;
    }
    if($request->index === '2'){
       $gef->gef_skype= $request->val;
    }    
    if($request->index === '13'){
       $outcome->outcome_linktodoc = $request->val;
       $gef->tab = 'admissions';                
    }
    if($request->index === '5'){
       $outcome->emergency_contactDetails = $request->val;
    } 
    if($request->index === '6'){
       $admission->admission_comments = $request->val;
       $gef->tab = 'admissions';                
    }    
    if($request->index === '7'){
       $gef->gef_nationality = $request->val;
    } 
    
       $gef->save();
       $outcome->save();
       $admission->save();

       return response()->json($outcome);

});

Route::patch('/serviceView/update/dob0',function(Request $request){
     $enquiry = App\gef_service::where('gef_phone', '=', $request->dob_id)->first();
     $enquiry->gef_dob = $request->dob0;

     $enquiry->tab = 'admissions';

     $enquiry->save();

    return response()->json();

});

Route::get('/serviceView/edit/admissions/course1/{course1_id?}',function($course1_id){
    $outcome = App\outcome::where('gef_phone', '=', $course1_id)->first();
    return response()->json($outcome);
});

Route::get('/serviceView/edit/admissions/course2/{course2_id?}',function($course2_id){
    $outcome = App\outcome::where('gef_phone', '=', $course2_id)->first();
    return response()->json($outcome);
});

Route::get('/serviceView/edit/admissions/course3/{course3_id?}',function($course3_id){
    $outcome = App\outcome::where('gef_phone', '=', $course3_id)->first();
    return response()->json($outcome);
});

Route::patch('/serviceView/update/ins_details',function(Request $request){
     $outcome= App\outcome::where('gef_phone', '=', $request->course1_id)->first();
     $outcome->outcome_course1_offRecDate = $request->outcome_course1_offRecDate;
     $outcome->outcome_course1_studentID = $request->outcome_course1_studentID;
     $outcome->outcome_course1_fees = $request->outcome_course1_fees;
     $outcome->outcome_course1_startDate = $request->outcome_course1_startDate1;

     $gef = App\gef_service::where('gef_phone', '=', $request->course1_id)->first();

     $gef->tab = 'admissions';

     $gef->save(); 

     $outcome->save();

    return response()->json();

});

Route::patch('/serviceView/update/ins2_details',function(Request $request){
     $outcome= App\outcome::where('gef_phone', '=', $request->course2_id)->first();
     $outcome->outcome_course2_offRecDate = $request->outcome_course2_offRecDate;
     $outcome->outcome_course2_studentID = $request->outcome_course2_studentID;
     $outcome->outcome_course2_fees = $request->outcome_course2_fees;
     $outcome->outcome_course2_startDate = $request->outcome_course2_startDate2;

     $gef = App\gef_service::where('gef_phone', '=', $request->course2_id)->first();

     $gef->tab = 'admissions';

     $gef->save(); 

     $outcome->save();

    return response()->json();

});

Route::patch('/serviceView/update/ins3_details',function(Request $request){
     $outcome= App\outcome::where('gef_phone', '=', $request->course3_id)->first();
     $outcome->outcome_course3_offRecDate = $request->outcome_course3_offRecDate;
     $outcome->outcome_course3_studentID = $request->outcome_course3_studentID;
     $outcome->outcome_course3_fees = $request->outcome_course3_fees;
     $outcome->outcome_course3_startDate = $request->outcome_course3_startDate3;

     $gef = App\gef_service::where('gef_phone', '=', $request->course3_id)->first();

     $gef->tab = 'admissions';

     $gef->save(); 

     $outcome->save();

    return response()->json();

});

Route::patch('/serviceView/update/visa_details',function(Request $request){
     $outcome= App\outcome::where('gef_phone', '=', $request->visa_id)->first();
     $outcome->outcome_visa_country = $request->visaCountry;
     $outcome->outcome_visa_appliedDate = $request->visaAppliedDate;
     $outcome->outcome_visa_expApprovalDate = $request->expApprovalDate;
     $outcome->outcome_visa_status = $request->visaStatus;

     $gef = App\gef_service::where('gef_phone', '=', $request->visa_id)->first();

     $gef->tab = 'visa';

     $gef->save(); 

     $outcome->save();

    return response()->json();

});

Route::patch('/serviceView/update/AIP_details',function(Request $request){
     $outcome= App\outcome::where('gef_phone', '=', $request->AIP_id)->first();
     $outcome->outcome_visa_AIPDate = $request->AIPDate;
     $outcome->outcome_visa_AIPDocsDate = $request->AIPDocsDate;
     $outcome->outcome_visa_EVisaDate = $request->EVisaDate;

     $gef = App\gef_service::where('gef_phone', '=', $request->AIP_id)->first();

     $gef->tab = 'visa';

     $gef->save(); 

     $outcome->save();

    return response()->json();

});

Route::patch('/serviceView/edit/outcome/ARM',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->ARM_id)->first();
        $outcome->outcome_ARM_ACO = $request->ARM_ACO;

    $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/edit/outcome/ERM',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->ERM_id)->first();
        $outcome->outcome_ERM_ACO = $request->ERM_ACO;

    $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/edit/outcome/FNC',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->FNC_id)->first();
        $outcome->outcome_FNC_ACO = $request->FNC_ACO;

    $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/edit/outcome/FSP',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->FSP_id)->first();
        $outcome->outcome_FSP_ACO = $request->FSP_ACO;

    $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/edit/outcome/PASSPORT',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->passport_id)->first();
        $outcome->outcome_passport_ACO = $request->passport_ACO;

    $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/edit/outcome/class10',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->class10_id)->first();
        $outcome->outcome_class10_ACO = $request->class10_ACO;

    $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/edit/outcome/class12',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->class12_id)->first();
        $outcome->outcome_class12_ACO = $request->class12_ACO;

    $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/edit/outcome/BC',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->BC_id)->first();
        $outcome->outcome_BC_ACO = $request->BC_ACO;

    $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/edit/outcome/BSWM',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->BSWM_id)->first();
        $outcome->outcome_BSWM_ACO = $request->BSWM_ACO;

    $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/edit/outcome/BPC',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->BPC_id)->first();
        $outcome->outcome_BPC_ACO = $request->BPC_ACO;

    $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/edit/outcome/BDC',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->BDC_id)->first();
        $outcome->outcome_BDC_ACO = $request->BDC_ACO;

    $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/edit/outcome/CV',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->CV_id)->first();
        $outcome->outcome_CV_ACO = $request->CV_ACO;

    $outcome->save();

    return response()->json();
});

Route::patch('/leadView/edit/outcome/ARMS',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->ARM_S_id)->first();
        $outcome->outcome_ARM_CBA = $request->ARM_CBA;

        $outcome->save();

        $user = Auth::user();   
	$gef = App\enquiry::where('gef_phone', '=', $request->ARM_S_id)->first();
        $emp = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();

            $followup = new followup;
            $followup->gef_phone = $gef->gef_phone;                  
            $followup->gef_assigned_to = $gef->gef_assigned_to;    
            $followup->added_by = $emp->AJV_EMP_Fname . ' ' . $emp->AJV_EMP_Lname . ', ' . $emp->AJV_EMP_designation; 
            $followup->tab = 'covernote';
            $followup->save();


    return response()->json();
});

Route::patch('/leadView/edit/outcome/ERMS',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->ERM_S_id)->first();
        $outcome->outcome_ERM_CBA = $request->ERM_CBA;

    $outcome->save();

        $user = Auth::user();   
	$gef = App\enquiry::where('gef_phone', '=', $request->ERM_S_id)->first();
        $emp = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();

            $followup = new followup;
            $followup->gef_phone = $gef->gef_phone;                  
            $followup->gef_assigned_to = $gef->gef_assigned_to;    
            $followup->added_by = $emp->AJV_EMP_Fname . ' ' . $emp->AJV_EMP_Lname . ', ' . $emp->AJV_EMP_designation; 
            $followup->tab = 'covernote';
            $followup->save();

    return response()->json();
});

Route::patch('/leadView/edit/outcome/FNCS',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->FNC_S_id)->first();
        $outcome->outcome_FNC_CBA = $request->FNC_CBA;

    $outcome->save();

        $user = Auth::user();   
	$gef = App\enquiry::where('gef_phone', '=', $request->FNC_S_id)->first();
        $emp = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();

            $followup = new followup;
            $followup->gef_phone = $gef->gef_phone;                  
            $followup->gef_assigned_to = $gef->gef_assigned_to;    
            $followup->added_by = $emp->AJV_EMP_Fname . ' ' . $emp->AJV_EMP_Lname . ', ' . $emp->AJV_EMP_designation; 
            $followup->tab = 'covernote';
            $followup->save();

    return response()->json();
});

Route::patch('/leadView/edit/outcome/FSPS',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->FSP_S_id)->first();
        $outcome->outcome_FSP_CBA = $request->FSP_CBA;

    $outcome->save();


    return response()->json();
});

Route::patch('/leadView/edit/outcome/PASSPORTS',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->passport_S_id)->first();
        $outcome->outcome_passport_PBA = $request->passport_PBA;
        $outcome->outcome_passport_scan = $request->passport_scan;

    $outcome->save();

 

    return response()->json();
});

Route::patch('/leadView/edit/outcome/CLASS10S',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->class10_S_id)->first();
        $outcome->outcome_class10_PBA = $request->class10_PBA;
        $outcome->outcome_class10_scan = $request->class10_scan;

    $outcome->save();

    return response()->json();
});

Route::patch('/leadView/edit/outcome/CLASS12S',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->class12_S_id)->first();
        $outcome->outcome_class12_PBA = $request->class12_PBA;
        $outcome->outcome_class12_scan = $request->class12_scan;

    $outcome->save();

    return response()->json();
});

Route::patch('/leadView/edit/outcome/BCS',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->BC_S_id)->first();
        $outcome->outcome_BC_PBA = $request->BC_PBA;
        $outcome->outcome_BC_scan = $request->BC_scan;
    $outcome->save();

    return response()->json();
});

Route::patch('/leadView/edit/outcome/BSWMS',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->BSWM_S_id)->first();
        $outcome->outcome_BSWM_PBA = $request->BSWM_PBA;
        $outcome->outcome_BSWM_scan = $request->BSWM_scan;
    $outcome->save();

    return response()->json();
});

Route::patch('/leadView/edit/outcome/BPCS',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->BPC_S_id)->first();
        $outcome->outcome_BPC_PBA = $request->BPC_PBA;
        $outcome->outcome_BPC_scan = $request->BPC_scan;
    $outcome->save();

    return response()->json();
});

Route::patch('/leadView/edit/outcome/BDCS',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->BDC_S_id)->first();
        $outcome->outcome_BDC_PBA = $request->BDC_PBA;
        $outcome->outcome_BDC_scan = $request->BDC_scan;
    $outcome->save();

    return response()->json();
});

Route::patch('/leadView/edit/outcome/CVS',function(Request $request){
	$outcome = App\outcome::where('gef_phone', '=', $request->CV_S_id)->first();
        $outcome->outcome_CV_PBA = $request->CV_PBA;
        $outcome->outcome_CV_scan = $request->CV_scan;
    $outcome->save();

    return response()->json();
});

Route::patch('/serviceView/update/sendToAdmissions',function(Request $request){

        $gef = App\gef_service::where('gef_phone', '=', $request->admi_id)->first();

        $gef->tab = 'admissions';

            $assign = App\employee::where('admissions_assign_flag', '=', 'assign')->first();
            if($assign != null) {
               $assign->admissions_assign_flag = 'skip';
               $gef->admissions_assigned_to = $assign->AJV_EMP_Email;
               $gef->admissions_assigned_lead = $assign->AJV_EMP_Email;
               $skip = App\employee::where('admissions_assign_flag', '=', 'skip')->first();
               if($skip != null){
                  $skip->admissions_assign_flag = 'assign';
                  $skip->save();
               }   
               $assign->save();
            }


        $gef->admissions_sendToAdmissions = $request->admi;

        $gef->save(); 
        
                $user = Auth::user();   
              $CO = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();
              $COTL = App\employee::where('AJV_EMP_Email', '=', $gef->assigned_lead)->first(); 

        
    	         $data = array(
    			'firstname' => $gef->gef_f_name,
    			'lastname' => $gef->gef_l_name,
    			'deal_phone' => $gef->gef_phone,
    			'email' => $gef->gef_email,
    			'nationality' => $gef->gef_nationality,
    			'city' => $gef->gef_location,
    			'CO' => $CO->AJV_EMP_Fname,
    			'adOfficer' => $assign->AJV_EMP_Fname,
    			'subject' => 'New Deal for Admission!!! - '.$gef->gef_f_name,
    			'caseOfficer' => $CO->AJV_EMP_emailAlias,
    			'caseOfficerTL' => $COTL->AJV_EMP_emailAlias,
    			'AO' => $assign->AJV_EMP_emailAlias,

    	       );

    	        Mail::send('dealAdmission', $data, function ($message) use($data) {
    	        	$message->from($data['caseOfficer'])->subject($data['firstname']);
    	
    	        	$message->to($data['AO'])->cc('dev.ops@ajv.kiwi',$data['caseOfficerTL'])->subject($data['subject']);
    	        });        


    return response()->json();
});

Route::patch('/serviceView/update/admissionsToService',function(Request $request){
        $gef = App\gef_service::where('gef_phone', '=', $request->admi1_id)->first();

        $gef->tab = 'admissions';

        $gef->admissions_sendToAdmissions = $request->admi1;
        
        $gef->save();
        
        $outcome = App\outcome::where('gef_phone', '=', $request->admi1_id)->first();
        
              $user = Auth::user();   
              $ADCO = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();
              $CO = App\employee::where('AJV_EMP_Email', '=', $gef->gef_service_assigned_to)->first(); 

    	         $data = array(
    			'firstname' => $gef->gef_f_name,
    			'outcome_inst1' => $outcome->outcome_inst1,
    			'outcome_course1' => $outcome->outcome_course1,
    			'outcome_inst1_intake' => $outcome->outcome_inst1_intake,
    			'outcome_inst1_campus' => $outcome->outcome_inst1_campus,
    			'outcome_course1_startDate' => $outcome->outcome_course1_startDate,
    			'outcome_inst2' => $outcome->outcome_inst2,
    			'outcome_course2' => $outcome->outcome_course2,
    			'outcome_inst2_intake' => $outcome->outcome_inst2_intake,
    			'outcome_inst2_campus' => $outcome->outcome_inst2_campus,
    			'outcome_course2_startDate' => $outcome->outcome_course2_startDate,
    			'outcome_inst3' => $outcome->outcome_inst3,
    			'outcome_course3' => $outcome->outcome_course3,
    			'outcome_inst3_intake' => $outcome->outcome_inst3_intake,
    			'outcome_inst3_campus' => $outcome->outcome_inst3_campus,
    			'outcome_course3_startDate' => $outcome->outcome_course3_startDate,    			
    			'CO' => $CO->AJV_EMP_Fname,
    			'ADCO' => $ADCO->AJV_EMP_Fname,
    			'subject' => 'Admission Process Complete ,Client - '.$gef->gef_f_name,
    			'caseOfficer' => $CO->AJV_EMP_emailAlias,
    			'admiCO' => $ADCO->AJV_EMP_emailAlias,

    	       );

    	        Mail::send('admissionDone', $data, function ($message) use($data) {
    	        	$message->from($data['admiCO'])->subject($data['firstname']);
    	
    	        	$message->to($data['caseOfficer'])->cc('dev.ops@ajv.kiwi')->subject($data['subject']);
    	        });                

    return response()->json();
});


Route::patch('/dashboard/update/NLrows',function(Request $request){

        $user = Auth::user();   
        $emp = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();

    if($emp != null){
      if($request->NLrows != null){  
         $emp->NL_row = $request->NLrows;
      } else {
         $emp->NL_row = '200';
      }
    } else {
      $emp->NL_row = '200';
    }

        $emp->save();

    return response()->json();
});

Route::get('/serviceView/edit/outcome/outcome1/{outcome1_id?}',function($outcome1_id){
    $outcome1 = App\outcome::where('gef_phone', '=', $outcome1_id)->first();
    return response()->json($outcome1);
});	

Route::patch('/serviceView/edit/outcome/outcome1/{outcome1_id?}',function(Request $request,$outcome1_id){
	$outcome1 = App\outcome::where('gef_phone', '=', $outcome1_id)->first();
    $outcome1->outcome_inst1 = $request->outcome_inst1;
	$outcome1->outcome_inst1_campus = $request->outcome_inst1_campus;
        $outcome1->outcome_inst1_intake = $request->outcome_inst1_intake;
	$outcome1->outcome_course1 = $request->outcome_course1;
	$outcome1->outcome_course1_startDate = $request->outcome_course1_startDate;
        $outcome1->outcome_course1_link = $request->outcome_course1_link;
    $outcome1->save();

    return response()->json($outcome1);
});


Route::get('/serviceView/edit/outcome/outcome2/{outcome2_id?}',function($outcome2_id){
    $outcome2 = App\outcome::where('gef_phone', '=', $outcome2_id)->first();
    return response()->json($outcome2);
});	

Route::patch('/serviceView/edit/outcome/outcome2/{outcome2_id?}',function(Request $request,$outcome2_id){
	$outcome2 = App\outcome::where('gef_phone', '=', $outcome2_id)->first();
 	$outcome2->outcome_inst2 = $request->outcome_inst2;
        $outcome2->outcome_inst2_intake = $request->outcome_inst2_intake;
	$outcome2->outcome_inst2_campus = $request->outcome_inst2_campus;
	$outcome2->outcome_course2 = $request->outcome_course2;
	$outcome2->outcome_course2_startDate = $request->outcome_course2_startDate;
        $outcome2->outcome_course2_link = $request->outcome_course2_link;
    $outcome2->save();
   
    return response()->json($outcome2);
});

Route::get('/serviceView/edit/outcome/outcome3/{outcome3_id?}',function($outcome3_id){
    $outcome3 = App\outcome::where('gef_phone', '=', $outcome3_id)->first();
    return response()->json($outcome3);
});	

Route::patch('/serviceView/edit/outcome/outcome3/{outcome3_id?}',function(Request $request,$outcome3_id){
	$outcome3 = App\outcome::where('gef_phone', '=', $outcome3_id)->first();
    $outcome3->outcome_inst3 = $request->outcome_inst3;
        $outcome3->outcome_inst3_intake = $request->outcome_inst3_intake;
	$outcome3->outcome_inst3_campus = $request->outcome_inst3_campus;
	$outcome3->outcome_course3 = $request->outcome_course3;
	$outcome3->outcome_course3_startDate = $request->outcome_course3_startDate;
        $outcome3->outcome_course3_link = $request->outcome_course3_link;

    $outcome3->save();

    return response()->json($outcome3);
});

Route::get('/serviceView/edit/outcome/comments/{outcome_comments_id?}',function($outcome_comments_id){
    $outcomecomments = App\outcome::where('gef_phone', '=', $outcome_comments_id)->first();
    return response()->json($outcomecomments);
});	

Route::patch('/serviceView/edit/outcome/comments/{outcome_comments_id?}',function(Request $request,$outcome_comments_id){
	$outcomecomments = App\outcome::where('gef_phone', '=', $outcome_comments_id)->first();
	$outcomecomments->outcome_comments = $request->outcome_comments;

    $outcomecomments->save();
    return response()->json($outcomecomments);
});

Route::get('/selectProcess','App\Http\Controllers\Auth\LoginController@selectProcess')->name('selectProcess');












