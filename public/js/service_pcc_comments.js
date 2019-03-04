var pcccomments = "edit/pcc/comments";
    //display modal form for product editing
    $(document).on('click','.open_modal_pcc_comments',function(){
        var pcc_comments_id = $(this).val();
       
        $.get(pcccomments + '/' + pcc_comments_id, function (data) {
            //success data
            console.log(data);
            $('#pcc_comments_id').val(data.gef_phone);
            $('#pcc_comments').val(data.pcc_comments);
            $('#btn-save-pcc-comments').val("update");
            $('#mypcccomments').modal('show');
        }) 
    });
    //display modal form for creating new product
    $('#btn_add').click(function(){
        $('#btn-save-pcc-comments').val("add");
        $('#frmProducts').trigger("reset");
        $('#mypcccomments').modal('show');
    });
    //create new product / update existing product
    $("#btn-save-pcc-comments").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            pcc_comments: $('#pcc_comments').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-pcc-comments').val();
        var type = "POST"; //for creating new resource
        var pcc_comments_id = $('#pcc_comments_id').val();;
        var my_pcccomments = pcccomments;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_pcccomments += '/' + pcc_comments_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_pcccomments,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var pcccomments = '<tr id="pcccomments' + data.gef_phone + '"><td><textarea class="form-control" rows="4" cols="500" readonly>' + data.pcc_comments + '</textarea></td>';
                pcccomments += '<td>&nbsp;&nbsp;</td>';
                pcccomments += '<td><br><button class="btn btn-warning btn-detail open_modal_pcc_comments" value="' + data.gef_phone + '">Edit Comments</button>';
               
                if (state == "add"){ //if user added a new record
                    $('#pcccomments-list').append(pcccomments);
                }else{ //if user updated an existing record
                    $("#pcccomments" + pcc_comments_id).replaceWith( pcccomments );
                }
                $('#frmProducts').trigger("reset");
                $('#mypcccomments').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });