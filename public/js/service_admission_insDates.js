var insDates = "edit/admission/insDates";
    //display modal form for product editing
    $(document).on('click','.open_modal_insDates',function(){
        var insDates_id = $(this).val();
       
        $.get(insDates + '/' + insDates_id, function (data) {
            //success data
            console.log(data);
            $('#insDates_id').val(data.gef_phone);
            $('#admission_insStartDte').val(data.admission_insStartDte);
            $('#admission_insExtDte').val(data.admission_insExtDte);
            $('#admission_insBkpDte').val(data.admission_insBkpDte);

            $('#btn-save-insDates').val("update");
            $('#myinsDates').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-insDates").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            admission_insStartDte: $('#admission_insStartDte').val(),
            admission_insExtDte: $('#admission_insExtDte').val(),
            admission_insBkpDte: $('#admission_insBkpDte').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-insDates').val();
        var type = "POST"; //for creating new resource
        var insDates_id = $('#insDates_id').val();;
        var my_insDates = insDates;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_insDates += '/' + insDates_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_insDates,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var insDates = '<tr id="insDates' + data.gef_phone + '"><td>' + data.admission_insStartDte + '</td><td>' + data.admission_insExtDte + '</td><td>' + data.admission_insBkpDte + '</td>';
                insDates += '<td><button class="btn btn-warning btn-detail open_modal_insDates" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#insDates-list').append(insDates);
                }else{ //if user updated an existing record
                    $("#insDates" + insDates_id).replaceWith( insDates );
                }
                $('#frmProducts').trigger("reset");
                $('#myinsDates').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });