var qualification4 = "edit/academics/qualification4";
    //display modal form for product editing
    $(document).on('click','.open_modal_qualification4',function(){
        var qualification4_id = $(this).val();
       
        $.get(qualification4 + '/' + qualification4_id, function (data) {
            //success data
            console.log(data);
            $('#qualification4_id').val(data.gef_phone);
            $('#academics_yearOfPassing4').val(data.academics_yearOfPassing4);
            $('#academics_university4').val(data.academics_university4);
            $('#academics_uni_city4').val(data.academics_uni_city4);
            $('#academics_final_result4').val(data.academics_final_result4);
            $('#academics_higestDegree4').val(data.academics_higestDegree4);

            $('#btn-save-qualification4').val("update");
            $('#myqualification4').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-qualification4").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            academics_yearOfPassing4: $('#academics_yearOfPassing4').val(),
            academics_university4: $('#academics_university4').val(),
            academics_uni_city4: $('#academics_uni_city4').val(),
            academics_final_result4: $('#academics_final_result4').val(),
            academics_higestDegree4: $('#academics_higestDegree4').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-qualification4').val();
        var type = "POST"; //for creating new resource
        var qualification4_id = $('#qualification4_id').val();;
        var my_qualification4 = qualification4;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_qualification4 += '/' + qualification4_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_qualification4,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var qualification4 = '<tr id="qualification4' + data.gef_phone + '"><td>' + "Diploma" +  '</td><td>' + data.academics_yearOfPassing4 + '</td><td>' + data.academics_university4 + '</td><td>' + data.academics_uni_city4 + '</td><td>' + data.academics_final_result4 + '</td><td>' + data.academics_higestDegree4 + '</td>';
                qualification4 += '<td><button class="btn btn-warning btn-detail open_modal_qualification4" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#qualification4-list').append(qualification4);
                }else{ //if user updated an existing record
                    $("#qualification4" + qualification4_id).replaceWith( qualification4 );
                }
                $('#frmProducts').trigger("reset");
                $('#myqualification4').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });