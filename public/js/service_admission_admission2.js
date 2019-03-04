var admission2 = "edit/admission/admission2";
    //display modal form for product editing
    $(document).on('click','.open_modal_admission2',function(){
        var admission2_id = $(this).val();
       
        $.get(admission2 + '/' + admission2_id, function (data) {
            //success data
            console.log(data);
            $('#admission2_id').val(data.gef_phone);
            $('#admission_outcome_inst2').val(data.admission_outcome_inst2);            
            $('#admission_outcome_course2').val(data.admission_outcome_course2);
            $('#admission_appliedDate2').val(data.admission_appliedDate2);            
            $('#admission_appliedStatus2').val(data.admission_appliedStatus2);
            
            $('#btn-save-admission2').val("update");
            $('#myadmission2').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-admission2").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            
            admission_outcome_inst2: $('#admission_outcome_inst2').val(),
            admission_outcome_course2: $('#admission_outcome_course2').val(),
            admission_appliedDate2: $('#admission_appliedDate2').val(),
            admission_appliedStatus2: $('#admission_appliedStatus2').val(),
            
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-admission2').val();
        var type = "POST"; //for creating new resource
        var admission2_id = $('#admission2_id').val();;
        var my_admission2 = admission2;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_admission2 += '/' + admission2_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_admission2,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var admission2 = '<tr id="admission2' + data.gef_phone + '"><td>' + data.admission_outcome_inst2 + '</td><td>' + data.admission_outcome_course2 + '</td><td>' + data.admission_appliedDate2 + '</td><td>' + data.admission_appliedStatus2  + '</td>';
                admission2 += '<td><button class="btn btn-warning btn-detail open_modal_admission2" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#admission2-list').append(admission2);
                }else{ //if user updated an existing record
                    $("#admission2" + admission2_id).replaceWith( admission2 );
                }
                $('#frmProducts').trigger("reset");
                $('#myadmission2').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });