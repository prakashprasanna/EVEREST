var qualification2 = "edit/academics/qualification2";
    //display modal form for product editing
    $(document).on('click','.open_modal_qualification2',function(){
        var qualification2_id = $(this).val();
       
        $.get(qualification2 + '/' + qualification2_id, function (data) {
            //success data
            console.log(data);
            $('#qualification2_id').val(data.gef_phone);
            $('#academics_yearOfPassing2').val(data.academics_yearOfPassing2);
            $('#academics_university2').val(data.academics_university2);
            $('#academics_uni_city2').val(data.academics_uni_city2);
            $('#academics_final_result2').val(data.academics_final_result2);
            $('#academics_higestDegree2').val(data.academics_higestDegree2);

            $('#btn-save-qualification2').val("update");
            $('#myqualification2').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-qualification2").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            academics_yearOfPassing2: $('#academics_yearOfPassing2').val(),
            academics_university2: $('#academics_university2').val(),
            academics_uni_city2: $('#academics_uni_city2').val(),
            academics_final_result2: $('#academics_final_result2').val(),
            academics_higestDegree2: $('#academics_higestDegree2').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-qualification2').val();
        var type = "POST"; //for creating new resource
        var qualification2_id = $('#qualification2_id').val();;
        var my_qualification2 = qualification2;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_qualification2 += '/' + qualification2_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_qualification2,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var qualification2 = '<tr id="qualification2' + data.gef_phone + '"><td>' + "Masters Degree" +  '</td><td>' + data.academics_yearOfPassing2 + '</td><td>' + data.academics_university2 + '</td><td>' + data.academics_uni_city2 + '</td><td>' + data.academics_final_result2 + '</td><td>' + data.academics_higestDegree2 + '</td>';
                qualification2 += '<td><button class="btn btn-warning btn-detail open_modal_qualification2" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#qualification2-list').append(qualification2);
                }else{ //if user updated an existing record
                    $("#qualification2" + qualification2_id).replaceWith( qualification2 );
                }
                $('#frmProducts').trigger("reset");
                $('#myqualification2').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });