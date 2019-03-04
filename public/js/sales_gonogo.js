var gonogo = "edit";
    //display modal form for product editing
    $(document).on('click','.open_modal',function(){
        var product_id = $(this).val();
       
        $.get(gonogo + '/' + product_id, function (data) {
            //success data
            console.log(data);
            $('#product_id').val(data.gef_phone);
            $('#gonogo_comments').val(data.gonogo_comments);
            $('#btn-save').val("update");
            $('#myModal').modal('show');
        }) 
    });
    //display modal form for creating new product
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmProducts').trigger("reset");
        $('#myModal').modal('show');
    });
    //create new product / update existing product
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            gonogo_comments: $('#gonogo_comments').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var product_id = $('#product_id').val();;
        var my_gonogo = gonogo;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_gonogo += '/' + product_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_gonogo,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var product = '<tr id="product' + data.gef_phone + '"><td><textarea class="form-control" rows="4" cols="500" readonly>' + data.gonogo_comments + '</textarea></td>';
                product += '<td>&nbsp;&nbsp;</td>';
                product += '<td><br><button class="btn btn-warning btn-detail open_modal" value="' + data.gef_phone + '">Edit Comments</button>';


                if (state == "add"){ //if user added a new record
                    $('#products-list').append(product);
                }else{ //if user updated an existing record
                    $("#product" + product_id).replaceWith( product );
                }
                $('#frmProducts').trigger("reset");
                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });