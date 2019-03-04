var outcome2 = "edit/outcome/outcome2";
    //display modal form for product editing
    $(document).on('click','.open_modal_outcome2',function(){
        var outcome2_id = $(this).val();
       
        $.get(outcome2 + '/' + outcome2_id, function (data) {
            //success data
            console.log(data);
            $('#outcome2_id').val(data.gef_phone);
            $('#outcome_inst2').val(data.outcome_inst2);
            $('#outcome_inst2_intake').val(data.outcome_inst2_intake);
            $('#outcome_inst2_campus').val(data.outcome_inst2_campus);
            $('#outcome_course2').val(data.outcome_course2);
            $('#outcome_course2_startDate').val(data.outcome_course2_startDate);
            $('#outcome_course2_link').val(data.outcome_course2_link);


            $('#btn-save-outcome2').val("update");
            $('#myoutcome2').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-outcome2").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            outcome_inst2: $('#outcome_inst2').val(),
            outcome_inst2_intake: $('#outcome_inst2_intake').val(),
            outcome_inst2_campus: $('#outcome_inst2_campus').val(),
            outcome_course2: $('#outcome_course2').val(),
            outcome_course2_startDate: $('#outcome_course2_startDate').val(),
            outcome_course2_link: $('#outcome_course2_link').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-outcome2').val();
        var type = "POST"; //for creating new resource
        var outcome2_id = $('#outcome2_id').val();;
        var my_outcome2 = outcome2;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_outcome2 += '/' + outcome2_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_outcome2,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var outcome2 = '<tr id="outcome2' + data.gef_phone + '"><td>' + data.outcome_inst2 + '</td><td>' + data.outcome_inst2_intake + '</td><td>' + data.outcome_inst2_campus + '</td><td>' + data.outcome_course2 + '</td><td>' + data.outcome_course2_startDate  + '</td><td>' + data.outcome_course2_link  + '</td>';
                outcome2 += '<td><button class="btn btn-warning btn-detail open_modal_outcome2" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#outcome2-list').append(outcome2);
                }else{ //if user updated an existing record
                    $("#outcome2" + outcome2_id).replaceWith( outcome2 );
                }
                $('#frmProducts').trigger("reset");
                $('#myoutcome2').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });