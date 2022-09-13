//table setup
var table = $('#table').DataTable({
    scrollX: true,
    lengthChange: false,
    searching: true,
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'print',
            text: 'พิมพ์'
        }
    ]
});
$(document).ready(function() {
    $(".buttons-print").hide();
});

//search data
$('#searchWord').on('keyup', function () {
    table.search(this.value).draw();
});

//print data
$('#print').click(function() {
    $(".buttons-print").click();
});