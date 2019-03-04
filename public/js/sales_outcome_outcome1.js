var outcome1 = "edit/outcome/outcome1";
    //display modal form for product editing
    $(document).on('click','.open_modal_outcome1',function(){
        var outcome1_id = $(this).val();
       
        $.get(outcome1 + '/' + outcome1_id, function (data) {
            //success data
            console.log(data);
            $('#outcome1_id').val(data.gef_phone);
            $('#outcome_inst1').val(data.outcome_inst1);
            $('#outcome_inst1_intake').val(data.outcome_inst1_intake);
            $('#outcome_inst1_campus').val(data.outcome_inst1_campus);
            $('#outcome_course1').val(data.outcome_course1);
            $('#outcome_course1_startDate').val(data.outcome_course1_startDate);
            $('#outcome_course1_link').val(data.outcome_course1_link);

            $('#btn-save-outcome1').val("update");
            $('#myoutcome1').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-outcome1").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            outcome_inst1: $('#outcome_inst1').val(),
            outcome_inst1_intake: $('#outcome_inst1_intake').val(),
            outcome_inst1_campus: $('#outcome_inst1_campus').val(),
            outcome_course1: $('#outcome_course1').val(),
            outcome_course1_startDate: $('#outcome_course1_startDate').val(),
            outcome_course1_link: $('#outcome_course1_link').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-outcome1').val();
        var type = "POST"; //for creating new resource
        var outcome1_id = $('#outcome1_id').val();;
        var my_outcome1 = outcome1;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_outcome1 += '/' + outcome1_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_outcome1,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var outcome1 = '<tr id="outcome1' + data.gef_phone + '"><td>' + data.outcome_inst1 + '</td><td>' + data.outcome_inst1_intake + '</td><td>' + data.outcome_inst1_campus + '</td><td>' + data.outcome_course1 + '</td><td>' + data.outcome_course1_startDate  + '</td><td>' + data.outcome_course1_link  + '</td>';
                outcome1 += '<td><button class="btn btn-warning btn-detail open_modal_outcome1" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#outcome1-list').append(outcome1);
                }else{ //if user updated an existing record
                    $("#outcome1" + outcome1_id).replaceWith( outcome1 );
                }
                $('#frmProducts').trigger("reset");
                $('#myoutcome1').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });