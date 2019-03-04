var qualification1 = "edit/academics/qualification1";
    //display modal form for product editing
    $(document).on('click','.open_modal_qualification1',function(){
        var qualification1_id = $(this).val();
       
        $.get(qualification1 + '/' + qualification1_id, function (data) {
            //success data
            console.log(data);
            $('#qualification1_id').val(data.gef_phone);
            $('#academics_yearOfPassing1').val(data.academics_yearOfPassing1);
            $('#academics_university1').val(data.academics_university1);
            $('#academics_uni_city1').val(data.academics_uni_city1);
            $('#academics_final_result1').val(data.academics_final_result1);
            $('#academics_higestDegree1').val(data.academics_higestDegree1);


            $('#btn-save-qualification1').val("update");
            $('#myqualification1').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-qualification1").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            academics_yearOfPassing1: $('#academics_yearOfPassing1').val(),
            academics_university1: $('#academics_university1').val(),
            academics_uni_city1: $('#academics_uni_city1').val(),
            academics_final_result1: $('#academics_final_result1').val(),
            academics_higestDegree1: $('#academics_higestDegree1').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-qualification1').val();
        var type = "POST"; //for creating new resource
        var qualification1_id = $('#qualification1_id').val();;
        var my_qualification1 = qualification1;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_qualification1 += '/' + qualification1_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_qualification1,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var qualification1 = '<tr id="qualification1' + data.gef_phone + '"><td>' + "PHD" +  '</td><td>' + data.academics_yearOfPassing1 + '</td><td>' + data.academics_university1 + '</td><td>' + data.academics_uni_city1 + '</td><td>' + data.academics_final_result1 + '</td><td>' + data.academics_higestDegree1 + '</td>';
                qualification1 += '<td><button class="btn btn-warning btn-detail open_modal_qualification1" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#qualification1-list').append(qualification1);
                }else{ //if user updated an existing record
                    $("#qualification1" + qualification1_id).replaceWith( qualification1 );
                }
                $('#frmProducts').trigger("reset");
                $('#myqualification1').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });