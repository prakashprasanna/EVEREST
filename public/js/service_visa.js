var visa = "edit/visa/visa";
    //display modal form for product editing
    $(document).on('click','.open_modal_visa',function(){
        var visa_id = $(this).val();
       
        $.get(visa + '/' + visa_id, function (data) {
            //success data
            console.log(data);
            $('#visa_id').val(data.gef_phone);
            $('#visa_ajvProcessDte').val(data.visa_ajvProcessDte);
            $('#visa_ajvPaidAmt').val(data.visa_ajvPaidAmt);
            $('#visa_docsCol').val(data.visa_docsCol);
            $('#visa_appExpectDte').val(data.visa_appExpectDte);
            $('#visa_aipDeadlineDte').val(data.visa_aipDeadlineDte);
            $('#visa_aipUploadDte').val(data.visa_aipUploadDte);
            $('#visa_mockAdvisor').val(data.visa_mockAdvisor);
            $('#visa_qcTL').val(data.visa_qcTL);
            $('#visa_mockTL').val(data.visa_mockTL);
            $('#visa_visaAppliedDte').val(data.visa_visaAppliedDte);
            $('#visa_evisaDte').val(data.visa_evisaDte);                        

            $('#btn-save-visa').val("update");
            $('#myvisa').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-visa").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            visa_ajvProcessDte: $('#visa_ajvProcessDte').val(),
            visa_ajvPaidAmt: $('#visa_ajvPaidAmt').val(),
            visa_docsCol: $('#visa_docsCol').val(),
            visa_appExpectDte: $('#visa_appExpectDte').val(),
            visa_aipDeadlineDte: $('#visa_aipDeadlineDte').val(),
            visa_aipUploadDte: $('#visa_aipUploadDte').val(),
            visa_mockAdvisor: $('#visa_mockAdvisor').val(),
            visa_qcTL: $('#visa_qcTL').val(),
            visa_mockTL: $('#visa_mockTL').val(),
            visa_visaAppliedDte: $('#visa_visaAppliedDte').val(),
            visa_evisaDte: $('#visa_evisaDte').val(),                        

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-visa').val();
        var type = "POST"; //for creating new resource
        var visa_id = $('#visa_id').val();;
        var my_visa = visa;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_visa += '/' + visa_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_visa,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#frmProducts').trigger("reset");
                $('#myvisa').modal('hide')
             window.location.reload();                

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });