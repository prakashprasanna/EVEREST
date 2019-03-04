var med = "edit/med/med";
    //display modal form for product editing
    $(document).on('click','.open_modal_med',function(){
        var med_id = $(this).val();
       
        $.get(med + '/' + med_id, function (data) {
            //success data
            console.log(data);
            $('#med_id').val(data.gef_phone);
            $('#med_appliedDte').val(data.med_appliedDte);
            $('#med_appliedPlace').val(data.med_appliedPlace);
            $('#med_appliedStatus').val(data.med_appliedStatus);

            $('#btn-save-med').val("update");
            $('#mymed').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-med").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            med_appliedDte: $('#med_appliedDte').val(),
            med_appliedPlace: $('#med_appliedPlace').val(),
            med_appliedStatus: $('#med_appliedStatus').val(),

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-med').val();
        var type = "POST"; //for creating new resource
        var med_id = $('#med_id').val();;
        var my_med = med;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_med += '/' + med_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_med,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var med = '<tr id="med' + data.gef_phone + '"><td>' + data.med_appliedDte + '</td><td>' + data.med_appliedPlace + '</td><td>' + data.med_appliedStatus + '</td>';
                med += '<td><button class="btn btn-warning btn-detail open_modal_med" value="' + data.gef_phone + '">Edit</button>';

                if (state == "add"){ //if user added a new record
                    $('#med-list').append(med);
                }else{ //if user updated an existing record
                    $("#med" + med_id).replaceWith( med );
                }
                $('#frmProducts').trigger("reset");
                $('#mymed').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });