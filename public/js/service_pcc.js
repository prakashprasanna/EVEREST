var pcc = "edit/pcc/pcc";
    //display modal form for product editing
    $(document).on('click','.open_modal_pcc',function(){
        var pcc_id = $(this).val();
       
        $.get(pcc + '/' + pcc_id, function (data) {
            //success data
            console.log(data);
            $('#pcc_id').val(data.gef_phone);
            $('#pcc_appliedDte').val(data.pcc_appliedDte);
            $('#pcc_appliedPlace').val(data.pcc_appliedPlace);
            $('#pcc_appliedStatus').val(data.pcc_appliedStatus);

            $('#btn-save-pcc').val("update");
            $('#mypcc').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-pcc").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            pcc_appliedDte: $('#pcc_appliedDte').val(),
            pcc_appliedPlace: $('#pcc_appliedPlace').val(),
            pcc_appliedStatus: $('#pcc_appliedStatus').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-pcc').val();
        var type = "POST"; //for creating new resource
        var pcc_id = $('#pcc_id').val();;
        var my_pcc = pcc;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_pcc += '/' + pcc_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_pcc,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var pcc = '<tr id="pcc' + data.gef_phone + '"><td>' + data.pcc_appliedDte + '</td><td>' + data.pcc_appliedPlace + '</td><td>' + data.pcc_appliedStatus + '</td>';
                pcc += '<td><button class="btn btn-warning btn-detail open_modal_pcc" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#pcc-list').append(pcc);
                }else{ //if user updated an existing record
                    $("#pcc" + pcc_id).replaceWith( pcc );
                }
                $('#frmProducts').trigger("reset");
                $('#mypcc').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });