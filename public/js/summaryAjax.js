var url = "dashboard";
    //display modal form for product editing
    $(document).on('click','.open_modal',function(){
        var product_id = $(this).val();
       
        $.get(url + '/' + product_id, function (data) {
            //success data
            console.log(data);
            $('#product_id').val(data.AJV_EMP_ID);
            $('#AJV_EMP_MonthlyTarget').val(data.AJV_EMP_MonthlyTarget);
            $('#AJV_EMP_workAssigned').val(data.AJV_EMP_workAssigned);
            $('#AJV_EMP_workCompleted').val(data.AJV_EMP_workCompleted);
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
    //delete product and remove it from list
    $(document).on('click','.delete-product',function(){
        var product_id = $(this).val();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + product_id,
            success: function (data) {
                console.log(data);
                $("#product" + product_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
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
            AJV_EMP_MonthlyTarget: $('#AJV_EMP_MonthlyTarget').val(),
            AJV_EMP_workAssigned: $('#AJV_EMP_workAssigned').val(),
            AJV_EMP_workCompleted: $('#AJV_EMP_workCompleted').val(),
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var product_id = $('#product_id').val();;
        var my_url = url;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_url += '/' + product_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var product = '<tr id="product' + data.AJV_EMP_ID + '"><td>' + data.AJV_EMP_Fname + data.AJV_EMP_Lname + '</td><td>' + data.AJV_EMP_MonthlyTarget + '</td><td>' + data.AJV_EMP_workAssigned + '</td><td>' + data.AJV_EMP_workCompleted + '</td>';
                product += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.AJV_EMP_ID + '">Edit</button>';
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