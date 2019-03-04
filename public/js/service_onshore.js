var onshore = "edit/onshore/onshore";
    //display modal form for product editing
    $(document).on('click','.open_modal_onshore',function(){
        var onshore_id = $(this).val();
       
        $.get(onshore + '/' + onshore_id, function (data) {
            //success data
            console.log(data);
            $('#onshore_id').val(data.gef_phone);
            $('#onshore_kitContents').val(data.onshore_kitContents);
            $('#onshore_courier').val(data.onshore_courier);
            $('#onshore_bookedOn').val(data.onshore_bookedOn);
            $('#onshore_clientAddress').val(data.onshore_clientAddress);

            $('#btn-save-onshore').val("update");
            $('#myonshore').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-onshore").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            onshore_kitContents: $('#onshore_kitContents').val(),
            onshore_courier: $('#onshore_courier').val(),
            onshore_bookedOn: $('#onshore_bookedOn').val(),
            onshore_clientAddress: $('#onshore_clientAddress').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-onshore').val();
        var type = "POST"; //for creating new resource
        var onshore_id = $('#onshore_id').val();;
        var my_onshore = onshore;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_onshore += '/' + onshore_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_onshore,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var onshore = '<tr id="onshore' + data.gef_phone + '"><td>' + data.onshore_kitContents + '</td><td>' + data.onshore_courier + '</td><td>' + data.onshore_bookedOn + '</td><td>' + data.onshore_clientAddress + '</td>';
                onshore += '<td><button class="btn btn-warning btn-detail open_modal_onshore" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#onshore-list').append(onshore);
                }else{ //if user updated an existing record
                    $("#onshore" + onshore_id).replaceWith( onshore );
                }
                $('#frmProducts').trigger("reset");
                $('#myonshore').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });