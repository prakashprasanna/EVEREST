var admissioncomments = "edit/admission/comments";
    //display modal form for product editing
    $(document).on('click','.open_modal_admission_comments',function(){
        var admission_comments_id = $(this).val();
       
        $.get(admissioncomments + '/' + admission_comments_id, function (data) {
            //success data
            console.log(data);
            $('#admission_comments_id').val(data.gef_phone);
            $('#admission_comments').val(data.admission_comments);
            $('#btn-save-admission-comments').val("update");
            $('#myadmissioncomments').modal('show');
        }) 
    });
    //display modal form for creating new product
    $('#btn_add').click(function(){
        $('#btn-save-admission-comments').val("add");
        $('#frmProducts').trigger("reset");
        $('#myadmissioncomments').modal('show');
    });
    //create new product / update existing product
    $("#btn-save-admission-comments").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            admission_comments: $('#admission_comments').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-admission-comments').val();
        var type = "POST"; //for creating new resource
        var admission_comments_id = $('#admission_comments_id').val();;
        var my_admissioncomments = admissioncomments;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_admissioncomments += '/' + admission_comments_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_admissioncomments,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var admissioncomments = '<tr id="admissioncomments' + data.gef_phone + '"><td><textarea class="form-control" rows="4" cols="500" readonly>' + data.admission_comments + '</textarea></td>';
                admissioncomments += '<td>&nbsp;&nbsp;</td>';
                admissioncomments += '<td><br><button class="btn btn-warning btn-detail open_modal_admission_comments" value="' + data.gef_phone + '">Edit Comments</button>';
               
                if (state == "add"){ //if user added a new record
                    $('#admissioncomments-list').append(admissioncomments);
                }else{ //if user updated an existing record
                    $("#admissioncomments" + admission_comments_id).replaceWith( admissioncomments );
                }
                $('#frmProducts').trigger("reset");
                $('#myadmissioncomments').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });