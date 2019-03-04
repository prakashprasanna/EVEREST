var outcomecomments = "edit/outcome/comments";
    //display modal form for product editing
    $(document).on('click','.open_modal_outcome_comments',function(){
        var outcome_comments_id = $(this).val();
       
        $.get(outcomecomments + '/' + outcome_comments_id, function (data) {
            //success data
            console.log(data);
            $('#outcome_comments_id').val(data.gef_phone);
            $('#outcome_comments').val(data.outcome_comments);
            $('#btn-save-outcome-comments').val("update");
            $('#myoutcomecomments').modal('show');
        }) 
    });
    //display modal form for creating new product
    $('#btn_add').click(function(){
        $('#btn-save-outcome-comments').val("add");
        $('#frmProducts').trigger("reset");
        $('#myoutcomecomments').modal('show');
    });
    //create new product / update existing product
    $("#btn-save-outcome-comments").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            outcome_comments: $('#outcome_comments').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-outcome-comments').val();
        var type = "POST"; //for creating new resource
        var outcome_comments_id = $('#outcome_comments_id').val();;
        var my_outcomecomments = outcomecomments;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_outcomecomments += '/' + outcome_comments_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_outcomecomments,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var outcomecomments = '<tr id="outcomecomments' + data.gef_phone + '"><td><textarea class="form-control" rows="4" cols="500" readonly>' + data.outcome_comments + '</textarea></td>';
                outcomecomments += '<td>&nbsp;&nbsp;</td>';
                outcomecomments += '<td><br><button class="btn btn-warning btn-detail open_modal_outcome_comments" value="' + data.gef_phone + '">Edit Comments</button>';
               
                if (state == "add"){ //if user added a new record
                    $('#outcomecomments-list').append(outcomecomments);
                }else{ //if user updated an existing record
                    $("#outcomecomments" + outcome_comments_id).replaceWith( outcomecomments );
                }
                $('#frmProducts').trigger("reset");
                $('#myoutcomecomments').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });