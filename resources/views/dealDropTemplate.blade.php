<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
</head>
<body>
<h2>Deal rejected by {{$caseOfficer}}, Client - {{$firstname}}</h2>
<br>
Hello {{ $advisor }}, Please find the rejected deal details below:
<br>
First Name  : {{$firstname}} 
<br>
Last  Name  : {{$lastname}} 
<br>
Mobile No   : {{$deal_phone}} 
<br>
Email       : {{$email}} 
<br>
City        : {{$city}} 
<br>
Nationality  : {{$nationality}} 
<br>
CO Notes : {{$reason}} 

<br>
Thanks,
<br>
{{$caseOfficer}}   

 
</body>
</html>