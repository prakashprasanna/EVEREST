    $(document).ready(function () {


        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });

        $('.assign_all').on('click', function(e) {


            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  


                var check = confirm("Are you sure you want to Assign?");  
                if(check == true){  


                    var ids = allVals.join(","); 
                    var assign = "edit/assign/assign";
                //display modal form for product editing
                    var assign_id = $(this).val();
                    $('#btn-save-assign').val("update");
                    $('#myassign').modal('show');

    //create new product / update existing product
    $("#btn-save-assign").click(function (e) {
        $.ajaxSetup({
           headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        })
        e.preventDefault(); 
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-assign').val();
        var type = "POST"; //for creating new resource
        var assign_to = $('#adviser').val();
        var assign3_to = $('#adviser3').val();

        var my_assign = assign;;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
        }
        console.log(ids);
        $.ajax({
            type: 'PATCH',
            url: my_assign,
            data:{ids:ids,assign_to:assign_to,assign3_to:assign3_to},
            dataType: 'json',
            success: function (data) {
                console.log(data);

                $('#frmProducts').trigger("reset");
                $('#myassign').modal('hide')
             window.location.reload();                

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
                }
            }
         });
    
    });
