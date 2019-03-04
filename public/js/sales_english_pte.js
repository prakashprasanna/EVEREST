var url1 = "edit/english/pte";
    //display modal form for product editing
    $(document).on('click','.open_modal_pte',function(){
        var pte_id = $(this).val();
       
        $.get(url1 + '/' + pte_id, function (data) {
            //success data
            console.log(data);
            $('#pte_id').val(data.gef_phone);
            $('#english_PTE_listening').val(data.english_PTE_listening);
            $('#english_PTE_read').val(data.english_PTE_read);
            $('#english_PTE_write').val(data.english_PTE_write);
            $('#english_PTE_speaking').val(data.english_PTE_speaking);
            $('#english_PTE_overall').val(data.english_PTE_overall);

            $('#btn-save-pte').val("update");
            $('#mypte').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-pte").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            english_PTE_listening: $('#english_PTE_listening').val(),
            english_PTE_read: $('#english_PTE_read').val(),
            english_PTE_write: $('#english_PTE_write').val(),
            english_PTE_speaking: $('#english_PTE_speaking').val(),
            english_PTE_overall: $('#english_PTE_overall').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-pte').val();
        var type = "POST"; //for creating new resource
        var pte_id = $('#pte_id').val();;
        var my_url1 = url1;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_url1 += '/' + pte_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url1,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var pte = '<tr id="pte' + data.gef_phone + '"><td>' + data.english_PTE_listening + '</td><td>' + data.english_PTE_read + '</td><td>' + data.english_PTE_write + '</td><td>' + data.english_PTE_speaking + '</td><td>' + data.english_PTE_overall + '</td>';
                pte += '<td><button class="btn btn-warning btn-detail open_modal_pte" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#pte-list').append(pte);
                }else{ //if user updated an existing record
                    $("#pte" + pte_id).replaceWith( pte );
                }
                $('#frmProducts').trigger("reset");
                $('#mypte').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });