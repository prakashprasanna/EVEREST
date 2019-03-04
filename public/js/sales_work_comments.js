var workcomments = "edit/work/comments";
    //display modal form for product editing
    $(document).on('click','.open_modal_work_comments',function(){
        var work_comments_id = $(this).val();
       
        $.get(workcomments + '/' + work_comments_id, function (data) {
            //success data
            console.log(data);
            $('#work_comments_id').val(data.gef_phone);
            $('#work_gap_reason').val(data.work_gap_reason);
            $('#btn-save-work-comments').val("update");
            $('#myworkcomments').modal('show');
        }) 
    });
    //display modal form for creating new product
    $('#btn_add').click(function(){
        $('#btn-save-work-comments').val("add");
        $('#frmProducts').trigger("reset");
        $('#myworkcomments').modal('show');
    });
    //create new product / update existing product
    $("#btn-save-work-comments").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            work_gap_reason: $('#work_gap_reason').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-work-comments').val();
        var type = "POST"; //for creating new resource
        var work_comments_id = $('#work_comments_id').val();;
        var my_workcomments = workcomments;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_workcomments += '/' + work_comments_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_workcomments,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var workcomments = '<tr id="workcomments' + data.gef_phone + '"><td><textarea class="form-control" rows="4" cols="500" readonly>' + data.work_gap_reason + '</textarea></td>';
                workcomments += '<td>&nbsp;&nbsp;</td>';
                workcomments += '<td><br><button class="btn btn-warning btn-detail open_modal_work_comments" value="' + data.gef_phone + '">Edit Comments</button>';
               
                if (state == "add"){ //if user added a new record
                    $('#workcomments-list').append(workcomments);
                }else{ //if user updated an existing record
                    $("#workcomments" + work_comments_id).replaceWith( workcomments );
                }
                $('#frmProducts').trigger("reset");
                $('#myworkcomments').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });