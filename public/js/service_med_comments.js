var medcomments = "edit/med/comments";
    //display modal form for product editing
    $(document).on('click','.open_modal_med_comments',function(){
        var med_comments_id = $(this).val();
       
        $.get(medcomments + '/' + med_comments_id, function (data) {
            //success data
            console.log(data);
            $('#med_comments_id').val(data.gef_phone);
            $('#med_comments').val(data.med_comments);
            $('#btn-save-med-comments').val("update");
            $('#mymedcomments').modal('show');
        }) 
    });
    //display modal form for creating new product
    $('#btn_add').click(function(){
        $('#btn-save-med-comments').val("add");
        $('#frmProducts').trigger("reset");
        $('#mymedcomments').modal('show');
    });
    //create new product / update existing product
    $("#btn-save-med-comments").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            med_comments: $('#med_comments').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-med-comments').val();
        var type = "POST"; //for creating new resource
        var med_comments_id = $('#med_comments_id').val();;
        var my_medcomments = medcomments;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_medcomments += '/' + med_comments_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_medcomments,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var medcomments = '<tr id="medcomments' + data.gef_phone + '"><td><textarea class="form-control" rows="4" cols="500" readonly>' + data.med_comments + '</textarea></td>';
                medcomments += '<td>&nbsp;&nbsp;</td>';
                medcomments += '<td><br><button class="btn btn-warning btn-detail open_modal_med_comments" value="' + data.gef_phone + '">Edit Comments</button>';
               
                if (state == "add"){ //if user added a new record
                    $('#medcomments-list').append(medcomments);
                }else{ //if user updated an existing record
                    $("#medcomments" + med_comments_id).replaceWith( medcomments );
                }
                $('#frmProducts').trigger("reset");
                $('#mymedcomments').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });