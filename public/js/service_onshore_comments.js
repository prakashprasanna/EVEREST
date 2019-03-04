var onshorecomments = "edit/onshore/comments";
    //display modal form for product editing
    $(document).on('click','.open_modal_onshore_comments',function(){
        var onshore_comments_id = $(this).val();
       
        $.get(onshorecomments + '/' + onshore_comments_id, function (data) {
            //success data
            console.log(data);
            $('#onshore_comments_id').val(data.gef_phone);
            $('#onshore_comments').val(data.onshore_comments);
            $('#btn-save-onshore-comments').val("update");
            $('#myonshorecomments').modal('show');
        }) 
    });
    //display modal form for creating new product
    $('#btn_add').click(function(){
        $('#btn-save-onshore-comments').val("add");
        $('#frmProducts').trigger("reset");
        $('#myonshorecomments').modal('show');
    });
    //create new product / update existing product
    $("#btn-save-onshore-comments").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            onshore_comments: $('#onshore_comments').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-onshore-comments').val();
        var type = "POST"; //for creating new resource
        var onshore_comments_id = $('#onshore_comments_id').val();;
        var my_onshorecomments = onshorecomments;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_onshorecomments += '/' + onshore_comments_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_onshorecomments,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var onshorecomments = '<tr id="onshorecomments' + data.gef_phone + '"><td><textarea class="form-control" rows="4" cols="500" readonly>' + data.onshore_comments + '</textarea></td>';
                onshorecomments += '<td>&nbsp;&nbsp;</td>';
                onshorecomments += '<td><br><button class="btn btn-warning btn-detail open_modal_onshore_comments" value="' + data.gef_phone + '">Edit Comments</button>';
               
                if (state == "add"){ //if user added a new record
                    $('#onshorecomments-list').append(onshorecomments);
                }else{ //if user updated an existing record
                    $("#onshorecomments" + onshore_comments_id).replaceWith( onshorecomments );
                }
                $('#frmProducts').trigger("reset");
                $('#myonshorecomments').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });