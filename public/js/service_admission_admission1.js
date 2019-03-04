var admission1 = "edit/admission/admission1";
    //display modal form for product editing
    $(document).on('click','.open_modal_admission1',function(){
        var admission1_id = $(this).val();
       
        $.get(admission1 + '/' + admission1_id, function (data) {
            //success data
            console.log(data);
            $('#admission1_id').val(data.gef_phone);
            $('#admission_outcome_inst1').val(data.admission_outcome_inst1);            
            $('#admission_outcome_course1').val(data.admission_outcome_course1);
            $('#admission_appliedDate1').val(data.admission_appliedDate1);            
            $('#admission_appliedStatus1').val(data.admission_appliedStatus1);
            
            $('#btn-save-admission1').val("update");
            $('#myadmission1').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-admission1").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            
            admission_outcome_inst1: $('#admission_outcome_inst1').val(),
            admission_outcome_course1: $('#admission_outcome_course1').val(),
            admission_appliedDate1: $('#admission_appliedDate1').val(),
            admission_appliedStatus1: $('#admission_appliedStatus1').val(),
            
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-admission1').val();
        var type = "POST"; //for creating new resource
        var admission1_id = $('#admission1_id').val();;
        var my_admission1 = admission1;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_admission1 += '/' + admission1_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_admission1,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var admission1 = '<tr id="admission1' + data.gef_phone + '"><td>' + data.admission_outcome_inst1 + '</td><td>' + data.admission_outcome_course1 + '</td><td>' + data.admission_appliedDate1 + '</td><td>' + data.admission_appliedStatus1  + '</td>';
                admission1 += '<td><button class="btn btn-warning btn-detail open_modal_admission1" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#admission1-list').append(admission1);
                }else{ //if user updated an existing record
                    $("#admission1" + admission1_id).replaceWith( admission1 );
                }
                $('#frmProducts').trigger("reset");
                $('#myadmission1').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });