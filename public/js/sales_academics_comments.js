var academicscomments = "edit/academics/comments";
    //display modal form for product editing
    $(document).on('click','.open_modal_academics_comments',function(){
        var academics_comments_id = $(this).val();
       
        $.get(academicscomments + '/' + academics_comments_id, function (data) {
            //success data
            console.log(data);
            $('#academics_comments_id').val(data.gef_phone);
            $('#academics_gap_reason').val(data.academics_gap_reason);
            $('#btn-save-academics-comments').val("update");
            $('#myacademicscomments').modal('show');
        }) 
    });
    //display modal form for creating new product
    $('#btn_add').click(function(){
        $('#btn-save-academics-comments').val("add");
        $('#frmProducts').trigger("reset");
        $('#myacademicscomments').modal('show');
    });
    //create new product / update existing product
    $("#btn-save-academics-comments").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            academics_gap_reason: $('#academics_gap_reason').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-academics-comments').val();
        var type = "POST"; //for creating new resource
        var academics_comments_id = $('#academics_comments_id').val();;
        var my_academicscomments = academicscomments;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_academicscomments += '/' + academics_comments_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_academicscomments,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var academicscomments = '<tr id="academicscomments' + data.gef_phone + '"><td><textarea class="form-control" rows="4" cols="500" readonly>' + data.academics_gap_reason + '</textarea></td>';
                academicscomments += '<td>&nbsp;&nbsp;</td>';
                academicscomments += '<td><br><button class="btn btn-warning btn-detail open_modal_academics_comments" value="' + data.gef_phone + '">Edit Comments</button>';
               
                if (state == "add"){ //if user added a new record
                    $('#academicscomments-list').append(academicscomments);
                }else{ //if user updated an existing record
                    $("#academicscomments" + academics_comments_id).replaceWith( academicscomments );
                }
                $('#frmProducts').trigger("reset");
                $('#myacademicscomments').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });