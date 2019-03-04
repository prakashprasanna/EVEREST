var gonogo1 = "edit/gonogo/gonogo";
    //display modal form for product editing
    $(document).on('click','.open_modal_gonogo1',function(){
        var gonogo1_id = $(this).val();
       
        $.get(gonogo1 + '/' + gonogo1_id, function (data) {
            //success data
            console.log(data);
            $('#gonogo1_id').val(data.gef_phone);
            $('#gonogo_dob').val(data.gonogo_dob);
            $('#gonogo_spokenEnglish').val(data.gonogo_spokenEnglish);
            $('#gonogo_prevNzVisa').val(data.gonogo_prevNzVisa);
            $('#gonogo_prevInsAgentOrSelf').val(data.gonogo_prevInsAgentOrSelf);
            $('#gonogo_intakePlan ').val(data.gonogo_intakePlan);
            $('#gonogo_priorVisaRejection').val(data.gonogo_priorVisaRejection);
            $('#gonogo_friend').val(data.gonogo_friend);
            $('#gonogo_group').val(data.gonogo_group);
            $('#gonogo_skilled').val(data.gonogo_skilled);
            $('#gonogo_characterIssue').val(data.gonogo_characterIssue);
            $('#gonogo_healthIssue').val(data.gonogo_healthIssue);              

            $('#btn-save-gonogo1').val("update");
            $('#mygonogo').modal('show');
        }) 
    });
    
    //create new product / update existing product
    $("#btn-save-gonogo1").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_tokenenglish"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            gonogo_dob: $('#gonogo_dob').val(),
            gonogo_spokenEnglish: $('#gonogo_spokenEnglish').val(),
            gonogo_prevNzVisa: $('#gonogo_prevNzVisa').val(),
            gonogo_prevInsAgentOrSelf: $('#gonogo_prevInsAgentOrSelf').val(),
            gonogo_intakePlan: $('#gonogo_intakePlan').val(),
            gonogo_priorVisaRejection: $('#gonogo_priorVisaRejection').val(),
            gonogo_friend: $('#gonogo_friend').val(),
            gonogo_group: $('#gonogo_group').val(),
            gonogo_skilled: $('#gonogo_skilled').val(),
            gonogo_characterIssue: $('#gonogo_characterIssue').val(),
            gonogo_healthIssue: $('#gonogo_healthIssue').val(),                        

        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-gonogo1').val();
        var type = "POST"; //for creating new resource
        var gonogo1_id = $('#gonogo1_id').val();;
        var my_gonogo = gonogo1;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_gonogo += '/' + gonogo1_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_gonogo,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#frmProducts').trigger("reset");
                $('#mygonogo').modal('hide')
             window.location.reload();                

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });