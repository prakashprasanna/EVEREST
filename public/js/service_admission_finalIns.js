var finalIns = "edit/admission/finalIns";
    //display modal form for product editing
    $(document).on('click','.open_modal_finalIns',function(){
        var finalIns_id = $(this).val();
       
        $.get(finalIns + '/' + finalIns_id, function (data) {
            //success data
            console.log(data);
            $('#finalIns_id').val(data.gef_phone);
            $('#admission_finalIns').val(data.admission_finalIns);
            $('#admission_finalCampus').val(data.admission_finalCampus);
            $('#admission_finalCourse').val(data.admission_finalCourse);

            $('#btn-save-finalIns').val("update");
            $('#myfinalIns').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-finalIns").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            admission_finalIns: $('#admission_finalIns').val(),
            admission_finalCampus: $('#admission_finalCampus').val(),
            admission_finalCourse: $('#admission_finalCourse').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-finalIns').val();
        var type = "POST"; //for creating new resource
        var finalIns_id = $('#finalIns_id').val();;
        var my_finalIns = finalIns;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_finalIns += '/' + finalIns_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_finalIns,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var finalIns = '<tr id="finalIns' + data.gef_phone + '"><td>' + data.admission_finalIns + '</td><td>' + data.admission_finalCampus + '</td><td>' + data.admission_finalCourse + '</td>';
                finalIns += '<td><button class="btn btn-warning btn-detail open_modal_finalIns" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#finalIns-list').append(finalIns);
                }else{ //if user updated an existing record
                    $("#finalIns" + finalIns_id).replaceWith( finalIns );
                }
                $('#frmProducts').trigger("reset");
                $('#myfinalIns').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });