var work2 = "edit/work/work2";
    //display modal form for product editing
    $(document).on('click','.open_modal_work2',function(){
        var work2_id = $(this).val();
       
        $.get(work2 + '/' + work2_id, function (data) {
            //success data
            console.log(data);
            $('#work2_id').val(data.gef_phone);
            $('#work_exp_company2').val(data.work_exp_company2);
            $('#work_exp_designation2').val(data.work_exp_designation2);
            $('#work_exp_employmentPeriod2').val(data.work_exp_employmentPeriod2);
            $('#work_exp_employmentTo2').val(data.work_exp_employmentTo2);
            $('#work_exp_location2').val(data.work_exp_location2);

            $('#btn-save-work2').val("update");
            $('#mywork2').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-work2").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            work_exp_company2: $('#work_exp_company2').val(),
            work_exp_designation2: $('#work_exp_designation2').val(),
            work_exp_employmentPeriod2: $('#work_exp_employmentPeriod2').val(),
            work_exp_employmentTo2: $('#work_exp_employmentTo2').val(),
            work_exp_location2: $('#work_exp_location2').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-work2').val();
        var type = "POST"; //for creating new resource
        var work2_id = $('#work2_id').val();;
        var my_work2 = work2;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_work2 += '/' + work2_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_work2,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var work2 = '<tr id="work2' + data.gef_phone + '"><td>' + data.work_exp_company2 + '</td><td>' + data.work_exp_designation2 + '</td><td>' + data.work_exp_employmentPeriod2 + '</td><td>' + data.work_exp_employmentTo2 + '</td><td>' + data.work_exp_location2  + '</td>';
                work2 += '<td><button class="btn btn-warning btn-detail open_modal_work2" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#work2-list').append(work2);
                }else{ //if user updated an existing record
                    $("#work2" + work2_id).replaceWith( work2 );
                }
                $('#frmProducts').trigger("reset");
                $('#mywork2').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });