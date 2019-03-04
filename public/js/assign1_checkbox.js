       
    $(document).ready(function () {
 

       $('#master1').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk1").prop('checked', true);  
         } else {  
            $(".sub_chk1").prop('checked',false);  
         }  
        });


        $('.assign1_all').on('click', function(e) {


            var allVals = [];  
            $(".sub_chk1:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  


                var check = confirm("Are you sure you want to Assign?");  
                if(check == true){  


                    var ids = allVals.join(","); 
                    var assign1 = "edit/assign1/assign1";
                //display modal form for product editing
                    var assign1_id = $(this).val();
                    $('#btn-save-assign1').val("update");
                    $('#myassign1').modal('show');

    //create new product / update existing product
    $("#btn-save-assign1").click(function (e) {
        $.ajaxSetup({
           headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        })
        e.preventDefault(); 
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-assign1').val();
        var type = "POST"; //for creating new resource
        var assign1_to = $('#adviser1').val();
        var assign4_to = $('#adviser4').val();

        var my_assign1 = assign1;;
        if (state == "update"){
            type = "PATCH"; //for updating existing resource
        }
        console.log(ids);
        $.ajax({
            type: 'PATCH',
            url: my_assign1,
            data:{ids:ids,assign1_to:assign1_to,assign4_to:assign4_to},
            dataType: 'json',
            success: function (data) {
                console.log(data);

                $('#frmProducts1').trigger("reset");
                $('#myassign1').modal('hide')
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