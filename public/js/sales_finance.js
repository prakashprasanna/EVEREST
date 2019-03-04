var finance = "edit/finance/finance";
    //display modal form for product editing
    $(document).on('click','.open_modal_finance',function(){
        var finance_id = $(this).val();
       
        $.get(finance + '/' + finance_id, function (data) {
            //success data
            console.log(data);
            $('#finance_id').val(data.gef_phone);
            $('#sales_fin_maritalStatus').val(data.sales_fin_maritalStatus);
            $('#sales_fin_35To45k').val(data.sales_fin_35To45k);
            $('#sales_fin_fundSource').val(data.sales_fin_fundSource);                     

            $('#btn-save-finance').val("update");
            $('#myfinance').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-finance").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            sales_fin_maritalStatus: $('#sales_fin_maritalStatus').val(),
            sales_fin_35To45k: $('#sales_fin_35To45k').val(),
            sales_fin_fundSource: $('#sales_fin_fundSource').val(),
                  

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-finance').val();
        var type = "POST"; //for creating new resource
        var finance_id = $('#finance_id').val();;
        var my_finance = finance;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_finance += '/' + finance_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_finance,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#frmProducts').trigger("reset");
                $('#myfinance').modal('hide')
             window.location.reload();                

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });