var url = document.location.toString();
if (url.match('#')) {

   $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
}

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
});