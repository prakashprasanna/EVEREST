var admission3 = "edit/admission/admission3";
    //display modal form for product editing
    $(document).on('click','.open_modal_admission3',function(){
        var admission3_id = $(this).val();
       
        $.get(admission3 + '/' + admission3_id, function (data) {
            //success data
            console.log(data);
            $('#admission3_id').val(data.gef_phone);
            $('#admission_outcome_inst3').val(data.admission_outcome_inst3);            
            $('#admission_outcome_course3').val(data.admission_outcome_course3);
            $('#admission_appliedDate3').val(data.admission_appliedDate3);            
            $('#admission_appliedStatus3').val(data.admission_appliedStatus3);
            
            $('#btn-save-admission3').val("update");
            $('#myadmission3').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-admission3").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            
            admission_outcome_inst3: $('#admission_outcome_inst3').val(),
            admission_outcome_course3: $('#admission_outcome_course3').val(),
            admission_appliedDate3: $('#admission_appliedDate3').val(),
            admission_appliedStatus3: $('#admission_appliedStatus3').val(),
            
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-admission3').val();
        var type = "POST"; //for creating new resource
        var admission3_id = $('#admission3_id').val();;
        var my_admission3 = admission3;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_admission3 += '/' + admission3_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_admission3,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var admission3 = '<tr id="admission3' + data.gef_phone + '"><td>' + data.admission_outcome_inst3 + '</td><td>' + data.admission_outcome_course3 + '</td><td>' + data.admission_appliedDate3 + '</td><td>' + data.admission_appliedStatus3  + '</td>';
                admission3 += '<td><button class="btn btn-warning btn-detail open_modal_admission3" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#admission3-list').append(admission3);
                }else{ //if user updated an existing record
                    $("#admission3" + admission3_id).replaceWith( admission3 );
                }
                $('#frmProducts').trigger("reset");
                $('#myadmission3').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });