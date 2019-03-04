var work1 = "edit/work/work1";
    //display modal form for product editing
    $(document).on('click','.open_modal_work1',function(){
        var work1_id = $(this).val();
       
        $.get(work1 + '/' + work1_id, function (data) {
            //success data
            console.log(data);
            $('#work1_id').val(data.gef_phone);
            $('#work_exp_company1').val(data.work_exp_company1);
            $('#work_exp_designation1').val(data.work_exp_designation1);
            $('#work_exp_employmentPeriod1').val(data.work_exp_employmentPeriod1);
            $('#work_exp_employmentTo1').val(data.work_exp_employmentTo1);
            $('#work_exp_location1').val(data.work_exp_location1);

            $('#btn-save-work1').val("update");
            $('#mywork1').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-work1").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            work_exp_company1: $('#work_exp_company1').val(),
            work_exp_designation1: $('#work_exp_designation1').val(),
            work_exp_employmentPeriod1: $('#work_exp_employmentPeriod1').val(),
            work_exp_employmentTo1: $('#work_exp_employmentTo1').val(),
            work_exp_location1: $('#work_exp_location1').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-work1').val();
        var type = "POST"; //for creating new resource
        var work1_id = $('#work1_id').val();;
        var my_work1 = work1;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_work1 += '/' + work1_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_work1,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var work1 = '<tr id="work1' + data.gef_phone + '"><td>' + data.work_exp_company1 + '</td><td>' + data.work_exp_designation1 + '</td><td>' + data.work_exp_employmentPeriod1 + '</td><td>' + data.work_exp_employmentTo1 + '</td><td>' + data.work_exp_location1  + '</td>';
                work1 += '<td><button class="btn btn-warning btn-detail open_modal_work1" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#work1-list').append(work1);
                }else{ //if user updated an existing record
                    $("#work1" + work1_id).replaceWith( work1 );
                }
                $('#frmProducts').trigger("reset");
                $('#mywork1').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });