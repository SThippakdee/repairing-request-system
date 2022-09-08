//add active class to sidebar item.
$(document).ready(function () {
    var title = $('title').text();
    $('.sidebar-item[data-title="'+ title +'"]').addClass('active');
    
    var page = $('#pageName').text();
    ($('.sidebar-link[data-page="'+ page +'"]').parent()).parent().addClass('show');
    $('.sidebar-link[data-page="'+ page +'"]').addClass('text-light');
});

//confirm logout dialog
function logout(){
    Swal.fire({
        title: 'ออกจากระบบ',
        text: "ต้องการออกจากระบบบัญชีผู้ใช้ปัจจุบันหรือไม่ ?",
        reverseButtons: true,
        showCancelButton: true,
        cancelButtonColor: 'white',
        cancelButtonText: '<span class="text-dark">ยกเลิก</span>',
        confirmButtonColor: window.theme.primary,
        confirmButtonText: '<span class="text-light">ออกจากระบบ</span>'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="be-logout.php";
        }
    })
}