//table setup
var table = $('#table').DataTable({
    scrollX: true,
    lengthChange: false,
    order: [[1, 'asc']],
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

function searchCol(col, word){
    var col = col;
    var word = word;
    table.columns( col ).search( word ).draw();

    $('.my-badge').removeClass("active-badge");

    $('.my-badge').filter(function(){
        return $(this).data("group") == word;
    }).addClass("active-badge");
}