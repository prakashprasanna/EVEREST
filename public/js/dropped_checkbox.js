$(document).ready(function () {
 

       $('#master2').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk2").prop('checked', true);  
         } else {  
            $(".sub_chk2").prop('checked',false);  
         }  
        });


        $('.assign2_all').on('click', function(e) {


            var allVals = [];  
            $(".sub_chk2:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  


                var check = confirm("Are you sure you want to Assign?");  
                if(check == true){  


                    var ids = allVals.join(","); 
                    var assign2 = "edit/assign2/assign2";
                //display modal form for product editing
                    var assign2_id = $(this).val();
                    $('#btn-save-assign2').val("update");
                    $('#myassign2').modal('show');

    //create new product / update existing product
    $("#btn-save-assign2").click(function (e) {
        $.ajaxSetup({
           headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        })
        e.preventDefault(); 
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-assign2').val();
        var type = "POST"; //for creating new resource
        var assign2_to = $('#adviser2').val();
        var assign5_to = $('#adviser5').val();

        var my_assign2 = assign2;;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
        }
        console.log(ids);
        $.ajax({
            type: 'PATCH',
            url: my_assign2,
            data:{ids:ids,assign2_to:assign2_to,assign5_to:assign5_to},
            dataType: 'json',
            success: function (data) {
                console.log(data);

                $('#frmProducts2').trigger("reset");
                $('#myassign2').modal('hide')
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