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

Route::get('/', function () {
    return view('home');
});

use Illuminate\Http\Request;

Route::get('dashboard', function () {
    $gefData3 = App\employee::all();
	$gefData = App\enquiry::getGefData();
    $gefData2 = App\enquiry::getGefData2();
      //  $gefData3 = employee::getEmpSummary();

    return view('dashboard', compact('gefData','gefData2','gefData3'));
})->name('dashboard');
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

use Illuminate\Http\Request1;

Route::get('/leadView/{gef_phone}', 'App\Http\Controllers\EnquiryController@leadView')->name('leadView');

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

Route::get('/leadView/edit/outcome/outcome1/{outcome1_id?}',function($outcome1_id){
    $outcome1 = App\outcome::where('gef_phone', '=', $outcome1_id)->first();
    return response()->json($outcome1);
});	

Route::patch('/leadView/edit/outcome/outcome1/{outcome1_id?}',function(Request $request,$outcome1_id){
	$outcome1 = App\outcome::where('gef_phone', '=', $outcome1_id)->first();
    $outcome1->outcome_inst1 = $request->outcome_inst1;
	$outcome1->outcome_inst1_campus = $request->outcome_inst1_campus;
	$outcome1->outcome_course1 = $request->outcome_course1;
	$outcome1->outcome_course1_startDate = $request->outcome_course1_startDate;
    $outcome1->save();

    $admission1 = App\admission::where('gef_phone', '=', $outcome1_id)->first();
    $admission1->admission_outcome_inst1 = $request->outcome_inst1;
    $admission1->admission_outcome_course1 = $request->outcome_course1;
    $admission1->save();


    return response()->json($outcome1);
});


Route::get('/leadView/edit/outcome/outcome2/{outcome2_id?}',function($outcome2_id){
    $outcome2 = App\outcome::where('gef_phone', '=', $outcome2_id)->first();
    return response()->json($outcome2);
});	

Route::patch('/leadView/edit/outcome/outcome2/{outcome2_id?}',function(Request $request,$outcome2_id){
	$outcome2 = App\outcome::where('gef_phone', '=', $outcome2_id)->first();
 	$outcome2->outcome_inst2 = $request->outcome_inst2;
	$outcome2->outcome_inst2_campus = $request->outcome_inst2_campus;
	$outcome2->outcome_course2 = $request->outcome_course2;
	$outcome2->outcome_course2_startDate = $request->outcome_course2_startDate;
    $outcome2->save();

    $admission2 = App\admission::where('gef_phone', '=', $outcome2_id)->first();
    $admission2->admission_outcome_inst2 = $request->outcome_inst2;
    $admission2->admission_outcome_course2 = $request->outcome_course2;
    $admission2->save();
   
    return response()->json($outcome2);
});

Route::get('/leadView/edit/outcome/outcome3/{outcome3_id?}',function($outcome3_id){
    $outcome3 = App\outcome::where('gef_phone', '=', $outcome3_id)->first();
    return response()->json($outcome3);
});	

Route::patch('/leadView/edit/outcome/outcome3/{outcome3_id?}',function(Request $request,$outcome3_id){
	$outcome3 = App\outcome::where('gef_phone', '=', $outcome3_id)->first();
    $outcome3->outcome_inst3 = $request->outcome_inst3;
	$outcome3->outcome_inst3_campus = $request->outcome_inst3_campus;
	$outcome3->outcome_course3 = $request->outcome_course3;
	$outcome3->outcome_course3_startDate = $request->outcome_course3_startDate;

    $outcome3->save();

    $admission3 = App\admission::where('gef_phone', '=', $outcome3_id)->first();
    $admission3->admission_outcome_inst3 = $request->outcome_inst3;
    $admission3->admission_outcome_course3 = $request->outcome_course3;
    $admission3->save();

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

Route::patch('forApproval/{gef_phone}', 'App\Http\Controllers\EnquiryController@forApproval')->name('forApproval');

Route::get('enquiry','App\Http\Controllers\EnquiryController@create')->name('enquiry');

Route::post('enquiry_store','App\Http\Controllers\EnquiryController@store')->name('enquiry_store');

Route::patch('updateAssignTo/{gef_id}', 'App\Http\Controllers\EnquiryController@updateAssignTo')->name('updateAssignTo');


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

Route::patch('admission_store/{gef_phone}','App\Http\Controllers\ServiceController@storeAdmission')->name('admission_store');

Route::patch('funds_store/{gef_phone}','App\Http\Controllers\ServiceController@storeFunds')->name('funds_store');

Route::patch('pcc_store/{gef_phone}','App\Http\Controllers\ServiceController@storePcc')->name('pcc_store');

Route::patch('med_store/{gef_phone}','App\Http\Controllers\ServiceController@storeMed')->name('med_store');

Route::patch('visa_store/{gef_phone}','App\Http\Controllers\ServiceController@storeVisa')->name('visa_store');

Route::patch('onshore_store/{gef_phone}','App\Http\Controllers\ServiceController@storeOnshore')->name('onshore_store');

Route::get('/leadView/edit/admission/admission1/{admission1_id?}',function($admission1_id){
    $admission1 = App\admission::where('gef_phone', '=', $admission1_id)->first();
    return response()->json($admission1);
});	

Route::patch('/leadView/edit/admission/admission1/{admission1_id?}',function(Request $request,$admission1_id){
	$admission1 = App\admission::where('gef_phone', '=', $admission1_id)->first();
    $admission1->admission_appliedDate1 = $request->admission_appliedDate1;
	$admission1->admission_appliedStatus1 = $request->admission_appliedStatus1;
	
    $admission1->save();
    return response()->json($admission1);
});

Route::get('/leadView/edit/admission/admission2/{admission2_id?}',function($admission2_id){
    $admission2 = App\admission::where('gef_phone', '=', $admission2_id)->first();
    return response()->json($admission2);
});	

Route::patch('/leadView/edit/admission/admission2/{admission2_id?}',function(Request $request,$admission2_id){
	$admission2 = App\admission::where('gef_phone', '=', $admission2_id)->first();
    $admission2->admission_appliedDate2 = $request->admission_appliedDate2;
	$admission2->admission_appliedStatus2 = $request->admission_appliedStatus2;
	
    $admission2->save();
    return response()->json($admission2);
});

Route::get('/leadView/edit/admission/admission3/{admission3_id?}',function($admission3_id){
    $admission3 = App\admission::where('gef_phone', '=', $admission3_id)->first();
    return response()->json($admission3);
});	

Route::patch('/leadView/edit/admission/admission3/{admission3_id?}',function(Request $request,$admission3_id){
	$admission3 = App\admission::where('gef_phone', '=', $admission3_id)->first();
    $admission3->admission_appliedDate3 = $request->admission_appliedDate3;
	$admission3->admission_appliedStatus3 = $request->admission_appliedStatus3;
	
    $admission3->save();
    return response()->json($admission3);
});

Route::get('/leadView/edit/admission/finalIns/{finalIns_id?}',function($finalIns_id){
    $finalIns = App\admission::where('gef_phone', '=', $finalIns_id)->first();
    return response()->json($finalIns);
});	

Route::patch('/leadView/edit/admission/finalIns/{finalIns_id?}',function(Request $request,$finalIns_id){
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

Route::get('/leadView/edit/admission/insDates/{insDates_id?}',function($insDates_id){
    $insDates = App\admission::where('gef_phone', '=', $insDates_id)->first();
    return response()->json($insDates);
});	

Route::patch('/leadView/edit/admission/insDates/{insDates_id?}',function(Request $request,$insDates_id){
	$insDates = App\admission::where('gef_phone', '=', $insDates_id)->first();
    $insDates->admission_insStartDte = $request->admission_insStartDte;
	$insDates->admission_insExtDte = $request->admission_insExtDte;
	$insDates->admission_insBkpDte = $request->admission_insBkpDte;
	
    $insDates->save();
    return response()->json($insDates);
});

Route::get('/leadView/edit/admission/comments/{admission_comments_id?}',function($admission_comments_id){
    $admissioncomments = App\admission::where('gef_phone', '=', $admission_comments_id)->first();
    return response()->json($admissioncomments);
});	

Route::patch('/leadView/edit/admission/comments/{admission_comments_id?}',function(Request $request,$admission_comments_id){
	$admissioncomments = App\admission::where('gef_phone', '=', $admission_comments_id)->first();
	$admissioncomments->admission_comments = $request->admission_comments;

    $admissioncomments->save();
    return response()->json($admissioncomments);
});

Route::get('/leadView/edit/funds/courseFee/{courseFee_id?}',function($courseFee_id){
    $courseFee = App\funds::where('gef_phone', '=', $courseFee_id)->first();
    return response()->json($courseFee);
});	

Route::patch('/leadView/edit/funds/courseFee/{courseFee_id?}',function(Request $request,$courseFee_id){
	$courseFee = App\funds::where('gef_phone', '=', $courseFee_id)->first();
    $courseFee->funds_courseFee = $request->funds_courseFee;
	$courseFee->funds_paymentStatus = $request->funds_paymentStatus;
	
    $courseFee->save();
    return response()->json($courseFee);
});

Route::get('/leadView/edit/funds/comments/{funds_comments_id?}',function($funds_comments_id){
    $fundscomments = App\funds::where('gef_phone', '=', $funds_comments_id)->first();
    return response()->json($fundscomments);
});	

Route::patch('/leadView/edit/funds/comments/{funds_comments_id?}',function(Request $request,$funds_comments_id){
	$fundscomments = App\funds::where('gef_phone', '=', $funds_comments_id)->first();
	$fundscomments->funds_comments = $request->funds_comments;

    $fundscomments->save();
    return response()->json($fundscomments);
});

