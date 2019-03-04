var outcome3 = "edit/outcome/outcome3";
    //display modal form for product editing
    $(document).on('click','.open_modal_outcome3',function(){
        var outcome3_id = $(this).val();
       
        $.get(outcome3 + '/' + outcome3_id, function (data) {
            //success data
            console.log(data);
            $('#outcome3_id').val(data.gef_phone);
            $('#outcome_inst3').val(data.outcome_inst3);
            $('#outcome_inst3_intake').val(data.outcome_inst3_intake);
            $('#outcome_inst3_campus').val(data.outcome_inst3_campus);
            $('#outcome_course3').val(data.outcome_course3);
            $('#outcome_course3_startDate').val(data.outcome_course3_startDate);
            $('#outcome_course3_link').val(data.outcome_course3_link);

            $('#btn-save-outcome3').val("update");
            $('#myoutcome3').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-outcome3").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            outcome_inst3: $('#outcome_inst3').val(),
            outcome_inst3_intake: $('#outcome_inst3_intake').val(),
            outcome_inst3_campus: $('#outcome_inst3_campus').val(),
            outcome_course3: $('#outcome_course3').val(),
            outcome_course3_startDate: $('#outcome_course3_startDate').val(),
            outcome_course3_link: $('#outcome_course3_link').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-outcome3').val();
        var type = "POST"; //for creating new resource
        var outcome3_id = $('#outcome3_id').val();;
        var my_outcome3 = outcome3;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_outcome3 += '/' + outcome3_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_outcome3,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var outcome3 = '<tr id="outcome3' + data.gef_phone + '"><td>' + data.outcome_inst3 + '</td><td>' + data.outcome_inst3_intake + '</td><td>' + data.outcome_inst3_campus + '</td><td>' + data.outcome_course3 + '</td><td>' + data.outcome_course3_startDate  + '</td><td>' + data.outcome_course3_link  + '</td>';
                outcome3 += '<td><button class="btn btn-warning btn-detail open_modal_outcome3" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#outcome3-list').append(outcome3);
                }else{ //if user updated an existing record
                    $("#outcome3" + outcome3_id).replaceWith( outcome3 );
                }
                $('#frmProducts').trigger("reset");
                $('#myoutcome3').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });