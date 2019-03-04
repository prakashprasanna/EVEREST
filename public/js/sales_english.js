var url = "edit/english/ielts";
    //display modal form for product editing
    $(document).on('click','.open_modal_ielts',function(){
        var ielts_id = $(this).val();
       
        $.get(url + '/' + ielts_id, function (data) {
            //success data
            console.log(data);
            $('#ielts_id').val(data.gef_phone);
            $('#english_IELTS_listening').val(data.english_IELTS_listening);
            $('#english_IELTS_read').val(data.english_IELTS_read);
            $('#english_IELTS_write').val(data.english_IELTS_write);
            $('#english_IELTS_speaking').val(data.english_IELTS_speaking);
            $('#english_IELTS_overall').val(data.english_IELTS_overall);


            $('#btn-save-ielts').val("update");
            $('#myielts').modal('show');
        }) 
    });
    
    //create new ielts / update existing ielts
    $("#btn-save-ielts").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            english_IELTS_listening: $('#english_IELTS_listening').val(),
            english_IELTS_read: $('#english_IELTS_read').val(),
            english_IELTS_write: $('#english_IELTS_write').val(),
            english_IELTS_speaking: $('#english_IELTS_speaking').val(),
            english_IELTS_overall: $('#english_IELTS_overall').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-ielts').val();
        var type = "POST"; //for creating new resource
        var ielts_id = $('#ielts_id').val();;
        var my_url = url;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_url += '/' + ielts_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var ielts = '<tr id="ielts' + data.gef_phone + '"><td>' + data.english_IELTS_listening + '</td><td>' + data.english_IELTS_read + '</td><td>' + data.english_IELTS_write + '</td><td>' + data.english_IELTS_speaking + '</td><td>' + data.english_IELTS_overall + '</td>';
                ielts += '<td><button class="btn btn-warning btn-detail open_modal_ielts" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#ielts-list').append(ielts);
                }else{ //if user updated an existing record
                    $("#ielts" + ielts_id).replaceWith( ielts );
                }
                $('#frmProducts').trigger("reset");
                $('#myielts').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

