$("#settoken").click(function(){
    var token = $('#line_token').val();
    Swal.fire({
        title: 'ตั้งค่า Access Token',
        input: 'text',
        html:'<div class="mt-0"></div>',
        inputValue: token,
        inputPlaceholder: 'Access Token',
        reverseButtons: true,
        showCancelButton: true,
        cancelButtonColor: 'white',
        cancelButtonText: '<span class="text-dark">ยกเลิก</span>',
        confirmButtonColor: window.theme.primary,
        confirmButtonText: '<span class="text-light">บันทึก</span>',
        inputValidator: (value) => {
            if (!value) {
                token = "";
            }else{
                token = value;
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $('#line_token').val(token);
        }
    })
});

$("#on").click(function(){
    $('#noti_active').val("on");
});
$("#off").click(function(){
    $('#noti_active').val("off");
});

$('#mainForm').submit(function(e){
    e.preventDefault();
    var form = $(this);
    var actionUrl = form.attr('action');
    $.ajax({
        type:'post',
        url:actionUrl,
        data:form.serialize(),
        success:function(data) {
            if(data == "success"){
                Swal.fire({
                    icon: 'success',
                    showConfirmButton: false,
                    title: 'บันทึกการตั้งค่าสำเร็จ',
                    timer: 2000,
                    timerProgressBar: true
                }).then((result) => {
                    if (result.dismiss) {
                        window.location.reload();
                    }
                })  
            }
            else{
                var msg = data.split("|");
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: msg[1],
                    showConfirmButton: false
                })
            }
        }
    })
});