var fundscomments = "edit/funds/comments";
    //display modal form for product editing
    $(document).on('click','.open_modal_funds_comments',function(){
        var funds_comments_id = $(this).val();
       
        $.get(fundscomments + '/' + funds_comments_id, function (data) {
            //success data
            console.log(data);
            $('#funds_comments_id').val(data.gef_phone);
            $('#funds_comments').val(data.funds_comments);
            $('#btn-save-funds-comments').val("update");
            $('#myfundscomments').modal('show');
        }) 
    });
    //display modal form for creating new product
    $('#btn_add').click(function(){
        $('#btn-save-funds-comments').val("add");
        $('#frmProducts').trigger("reset");
        $('#myfundscomments').modal('show');
    });
    //create new product / update existing product
    $("#btn-save-funds-comments").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            funds_comments: $('#funds_comments').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-funds-comments').val();
        var type = "POST"; //for creating new resource
        var funds_comments_id = $('#funds_comments_id').val();;
        var my_fundscomments = fundscomments;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_fundscomments += '/' + funds_comments_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_fundscomments,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var fundscomments = '<tr id="fundscomments' + data.gef_phone + '"><td><textarea class="form-control" rows="4" cols="500" readonly>' + data.funds_comments + '</textarea></td>';
                fundscomments += '<td>&nbsp;&nbsp;</td>';
                fundscomments += '<td><br><button class="btn btn-warning btn-detail open_modal_funds_comments" value="' + data.gef_phone + '">Edit Comments</button>';
               
                if (state == "add"){ //if user added a new record
                    $('#fundscomments-list').append(fundscomments);
                }else{ //if user updated an existing record
                    $("#fundscomments" + funds_comments_id).replaceWith( fundscomments );
                }
                $('#frmProducts').trigger("reset");
                $('#myfundscomments').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });