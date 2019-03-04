var qualification3 = "edit/academics/qualification3";
    //display modal form for product editing
    $(document).on('click','.open_modal_qualification3',function(){
        var qualification3_id = $(this).val();
       
        $.get(qualification3 + '/' + qualification3_id, function (data) {
            //success data
            console.log(data);
            $('#qualification3_id').val(data.gef_phone);
            $('#academics_yearOfPassing3').val(data.academics_yearOfPassing3);
            $('#academics_university3').val(data.academics_university3);
            $('#academics_uni_city3').val(data.academics_uni_city3);
            $('#academics_final_result3').val(data.academics_final_result3);
            $('#academics_higestDegree3').val(data.academics_higestDegree3);

            $('#btn-save-qualification3').val("update");
            $('#myqualification3').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-qualification3").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            academics_yearOfPassing3: $('#academics_yearOfPassing3').val(),
            academics_university3: $('#academics_university3').val(),
            academics_uni_city3: $('#academics_uni_city3').val(),
            academics_final_result3: $('#academics_final_result3').val(),
            academics_higestDegree3: $('#academics_higestDegree3').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-qualification3').val();
        var type = "POST"; //for creating new resource
        var qualification3_id = $('#qualification3_id').val();;
        var my_qualification3 = qualification3;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_qualification3 += '/' + qualification3_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_qualification3,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var qualification3 = '<tr id="qualification3' + data.gef_phone + '"><td>' + "Bachelors Degree" +  '</td><td>' + data.academics_yearOfPassing3 + '</td><td>' + data.academics_university3 + '</td><td>' + data.academics_uni_city3 + '</td><td>' + data.academics_final_result3 + '</td><td>' + data.academics_higestDegree3 + '</td>';
                qualification3 += '<td><button class="btn btn-warning btn-detail open_modal_qualification3" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#qualification3-list').append(qualification3);
                }else{ //if user updated an existing record
                    $("#qualification3" + qualification3_id).replaceWith( qualification3 );
                }
                $('#frmProducts').trigger("reset");
                $('#myqualification3').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });