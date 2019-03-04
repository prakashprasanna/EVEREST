var url3 = "edit/english/comments";
    //display modal form for product editing
    $(document).on('click','.open_modal_english_comments',function(){
        var english_comments_id = $(this).val();
       
        $.get(url3 + '/' + english_comments_id, function (data) {
            //success data
            console.log(data);
            $('#english_comments_id').val(data.gef_phone);
            $('#english_comments').val(data.english_comments);
            $('#btn-save-english-comments').val("update");
            $('#myenglishcomments').modal('show');
        }) 
    });
    //display modal form for creating new product
    $('#btn_add').click(function(){
        $('#btn-save-english-comments').val("add");
        $('#frmProducts').trigger("reset");
        $('#myenglishcomments').modal('show');
    });
    //create new product / update existing product
    $("#btn-save-english-comments").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            english_comments: $('#english_comments').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-english-comments').val();
        var type = "POST"; //for creating new resource
        var english_comments_id = $('#english_comments_id').val();;
        var my_url3 = url3;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_url3 += '/' + english_comments_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url3,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var englishcomments = '<tr id="englishcomments' + data.gef_phone + '"><td><textarea class="form-control" rows="4" cols="500" readonly>' + data.english_comments + '</textarea></td>';
                englishcomments += '<td>&nbsp;&nbsp;</td>';
                englishcomments += '<td><br><button class="btn btn-warning btn-detail open_modal_english_comments" value="' + data.gef_phone + '">Edit Comments</button>';
               
                if (state == "add"){ //if user added a new record
                    $('#englishcomments-list').append(englishcomments);
                }else{ //if user updated an existing record
                    $("#englishcomments" + english_comments_id).replaceWith( englishcomments );
                }
                $('#frmProducts').trigger("reset");
                $('#myenglishcomments').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });