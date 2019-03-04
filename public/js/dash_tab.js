$('.ajaxLink').click(function (e) {
  location.hash = this.id; // get the clicked link id
  var x = location.hash;
  e.preventDefault(); // cancel navigation
$.get('dashTab',{ value : x }, function(response) {
    // handle your response here
    console.log(response);
})
})
