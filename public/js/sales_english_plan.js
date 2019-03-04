var url2 = "edit/english/plan";
    //display modal form for product editing
    $(document).on('click','.open_modal_plan',function(){
        var plan_id = $(this).val();
       
        $.get(url2 + '/' + plan_id, function (data) {
            //success data
            console.log(data);
            $('#plan_id').val(data.gef_phone);
            $('#english_test_plan_dte').val(data.english_test_plan_dte);

            $('#btn-save-plan').val("update");
            $('#myplan').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-plan").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            english_test_plan_dte: $('#english_test_plan_dte').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-plan').val();
        var type = "POST"; //for creating new resource
        var plan_id = $('#plan_id').val();;
        var my_url2 = url2;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_url2 += '/' + plan_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url2,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var plan = '<tr id="plan' + data.gef_phone + '"><td>' + data.english_test_plan_dte + '</td>';
                plan += '<td><button class="btn btn-warning btn-detail open_modal_plan" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#plan-list').append(plan);
                }else{ //if user updated an existing record
                    $("#plan" + plan_id).replaceWith( plan );
                }
                $('#frmProducts').trigger("reset");
                $('#myplan').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });