$('#serveyForm').submit(function(e){
	e.preventDefault();
	var form = $(this);
	var actionUrl = form.attr('action');
    Swal.fire({
		icon: 'warning',
		title: 'ยืนยันการประเมินความพึงพอใจ',
		text: "การประเมินสามารถทำได้ครั้งเดียวในแต่ละรายการ",
		reverseButtons: true,
		showCancelButton: true,
		cancelButtonColor: 'white',
		cancelButtonText: '<span class="text-dark">ยกเลิก</span>',
		confirmButtonColor: window.theme.primary,
		confirmButtonText: '<span class="text-light">ส่งแบบประเมิน</span>'
	}).then((result) => {
		if (result.isConfirmed) {
            $.ajax({
                type:'post',
                url:actionUrl,
                data:form.serialize(),
                success:function(data) {
                    if(data == "success"){
                        Swal.fire({
                            icon: 'success',
                            showConfirmButton: false,
                            title: 'ประเมินความพึงพอใจสำเร็จ',
                            timer: 2000,
                            timerProgressBar: true
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.reload();
                            }
                        })  
                    }
                    else{
                        //var msg = data.split("|");
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: data,
                            showConfirmButton: false
                        })
                    }
                }
            });
        }
    })
});