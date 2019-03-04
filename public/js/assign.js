var assign = "edit/assign/assign";
    //display modal form for product editing
    $(document).on('click','.open_modal_assign',function(){
        var assign_id = $(this).val();
            $('#myassign').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-assign").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            assign_to: $('#assign_to').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-assign').val();
        var type = "POST"; //for creating new resource
        var assign_id = $('#assign_id').val();;
        var my_assign = assign;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_assign += '/assign';
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_assign,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                $('#frmProducts').trigger("reset");
                $('#myassign').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });