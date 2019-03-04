var course2 = "edit/admissions/course2";
    //display modal form for product editing
    $(document).on('click','.open_modal_course2',function(){
        var course2_id = $(this).val();
       
        $.get(course2 + '/' + course2_id, function (data) {
            //success data
            console.log(data);
            $('#course2_id').val(data.gef_phone);
            $('#outcome_course2_startDate2').val(data.outcome_course2_startDate);
            $('#outcome_course2_offRecDate').val(data.outcome_course2_offRecDate);
            $('#outcome_course2_studentID').val(data.outcome_course2_studentID);
            $('#outcome_course2_fees').val(data.outcome_course2_fees);
            $('#outcome_course2_link').val(data.outcome_course2_link);
                        

            $('#btn-save-course2').val("update");
            $('#mycourse2').modal('show');
        }) 
    });
var ins2;
$('#outcome_course2_offRecDate').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins2);
    ins2 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins2();
    }, 1000);
});
$('#outcome_course2_startDate2').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins2);
    ins2 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins2();
    }, 1000);
});
$('#outcome_course2_studentID').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins2);
    ins2 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins2();
    }, 1000);
});
$('#outcome_course2_fees').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins2);
    ins2 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins2();
    }, 1000);
});
$('#outcome_course2_link').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins2);
    ins2 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins2();
    }, 1000);
});

                          function saveToDB_ins2()
                          {
                            console.log('Saving to the db');
                            form = $('.ins2-form');
                        	$.ajax({
                 		url: "update/ins2_details",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-ins2').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var ins2 = new Date();
                           $('.form-status-ins2').html('Saved! Last: ' + ins2.toLocaleTimeString());
         		    },
                           });
                        }


                         $('.ins2-form').submit(function(e) {
                        	saveToDB_ins2();
                        	e.preventDefault();
                         });
    
