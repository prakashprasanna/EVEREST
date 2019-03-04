
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
</head>
<body>
<h2>Admission process completed by {{$ADCO}}, Client - {{$firstname}}</h2>
<br>
Hello {{ $CO }}, Please find below the course applied:
<br>
Course 1 Details
<br> 
----------------
<br>
Institution : {{$outcome_inst1}} 
<br>
Course   : {{$outcome_course1}}
<br>
Intake : {{$outcome_inst1_intake}}
<br>
Campus : {{$outcome_inst1_campus}}
<br>
Start Date : {{$outcome_course1_startDate}}
<br>
<br>
@if($outcome_inst2 != null)
Course 2 Details
<br>

----------------
<br>

Institution : {{$outcome_inst2}} 
<br>

Course   : {{$outcome_course2}}
<br>

Intake : {{$outcome_inst2_intake}}
<br>

Campus : {{$outcome_inst2_campus}}
<br>

Start Date : {{$outcome_course2_startDate}}
<br>

<br>
@endif
@if($outcome_inst3 != null)
Course 3 Details
<br>

----------------
<br>

Institution : {{$outcome_inst3}} 
<br>

Course   : {{$outcome_course3}}
<br>

Intake : {{$outcome_inst3_intake}}
<br>

Campus : {{$outcome_inst3_campus}}
<br>

Start Date : {{$outcome_course3_startDate}}
<br>

@endif
<br>

Thanks,
<br>
{{$ADCO}}   

 
</body>
</html>