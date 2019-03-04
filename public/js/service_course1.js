var course1 = "edit/admissions/course1";
    //display modal form for product editing
    $(document).on('click','.open_modal_course1',function(){
        var course1_id = $(this).val();
       
        $.get(course1 + '/' + course1_id, function (data) {
            //success data
            console.log(data);
            $('#course1_id').val(data.gef_phone);
            $('#outcome_course1_startDate1').val(data.outcome_course1_startDate);
            $('#outcome_course1_offRecDate').val(data.outcome_course1_offRecDate);
            $('#outcome_course1_studentID').val(data.outcome_course1_studentID);
            $('#outcome_course1_fees').val(data.outcome_course1_fees);
            $('#outcome_course1_link').val(data.outcome_course1_link);

            $('#btn-save-course1').val("update");
            $('#mycourse1').modal('show');
        }) 
    });

var ins1;
$('#outcome_course1_offRecDate').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins1);
    ins1 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins();
    }, 1000);
});
$('#outcome_course1_startDate1').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins1);
    ins1 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins();
    }, 1000);
});
$('#outcome_course1_studentID').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins1);
    ins1 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins();
    }, 1000);
});
$('#outcome_course1_fees').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins1);
    ins1 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins();
    }, 1000);
});

                          function saveToDB_ins()
                          {
                            console.log('Saving to the db');
                            form = $('.ins-form');
                        	$.ajax({
                 		url: "update/ins_details",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-ins').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var ins = new Date();
                           $('.form-status-ins').html('Saved! Last: ' + ins.toLocaleTimeString());
         		    },
                           });
                        }


                         $('.ins-form').submit(function(e) {
                        	saveToDB_ins();
                        	e.preventDefault();
                         });
    
