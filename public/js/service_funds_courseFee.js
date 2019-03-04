var courseFee = "edit/funds/courseFee";
    //display modal form for product editing
    $(document).on('click','.open_modal_courseFee',function(){
        var courseFee_id = $(this).val();
       
        $.get(courseFee + '/' + courseFee_id, function (data) {
            //success data
            console.log(data);
            $('#courseFee_id').val(data.gef_phone);
            $('#funds_admission_finalIns').val(data.funds_admission_finalIns);            
            $('#funds_admission_finalCourse').val(data.funds_admission_finalCourse);
            $('#funds_courseFee').val(data.funds_courseFee);
            $('#funds_paymentStatus').val(data.funds_paymentStatus);            

            
            $('#btn-save-courseFee').val("update");
            $('#mycourseFee').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-courseFee").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            
            funds_admission_finalIns: $('#funds_admission_finalIns').val(),
            funds_admission_finalCourse: $('#funds_admission_finalCourse').val(),
            funds_courseFee: $('#funds_courseFee').val(),
            funds_paymentStatus: $('#funds_paymentStatus').val(),
            
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-courseFee').val();
        var type = "POST"; //for creating new resource
        var courseFee_id = $('#courseFee_id').val();;
        var my_courseFee = courseFee;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_courseFee += '/' + courseFee_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_courseFee,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var courseFee = '<tr id="courseFee' + data.gef_phone + '"><td>' + data.funds_admission_finalIns + '</td><td>' + data.funds_admission_finalCourse + '</td><td>' + data.funds_courseFee + '</td><td>' + data.funds_paymentStatus  + '</td>';
                courseFee += '<td><button class="btn btn-warning btn-detail open_modal_courseFee" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#courseFee-list').append(courseFee);
                }else{ //if user updated an existing record
                    $("#courseFee" + courseFee_id).replaceWith( courseFee );
                }
                $('#frmProducts').trigger("reset");
                $('#mycourseFee').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });