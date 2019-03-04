var course3 = "edit/admissions/course3";
    //display modal form for product editing
    $(document).on('click','.open_modal_course3',function(){
        var course3_id = $(this).val();
       
        $.get(course3 + '/' + course3_id, function (data) {
            //success data
            console.log(data);
            $('#course3_id').val(data.gef_phone);
            $('#outcome_course3_startDate3').val(data.outcome_course3_startDate);
            $('#outcome_course3_offRecDate').val(data.outcome_course3_offRecDate);
            $('#outcome_course3_studentID').val(data.outcome_course3_studentID);
            $('#outcome_course3_fees').val(data.outcome_course3_fees);
            $('#outcome_course3_link').val(data.outcome_course3_link);

            
            $('#btn-save-course3').val("update");
            $('#mycourse3').modal('show');
        }) 
    });
var ins3;
$('#outcome_course3_offRecDate').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins3);
    ins3 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins3();
    }, 1000);
});
$('#outcome_course3_startDate3').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins3);
    ins3 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins3();
    }, 1000);
});
$('#outcome_course3_studentID').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins3);
    ins3 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins3();
    }, 1000);
});
$('#outcome_course3_fees').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins3);
    ins3 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins3();
    }, 1000);
});
$('#outcome_course3_link').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins2);
    ins2 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins2();
    }, 1000);
});

                          function saveToDB_ins3()
                          {
                            console.log('Saving to the db');
                            form = $('.ins3-form');
                        	$.ajax({
                 		url: "update/ins3_details",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-ins3').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var ins3 = new Date();
                           $('.form-status-ins3').html('Saved! Last: ' + ins3.toLocaleTimeString());
         		    },
                           });
                        }


                         $('.ins3-form').submit(function(e) {
                        	saveToDB_ins3();
                        	e.preventDefault();
                         });
    
