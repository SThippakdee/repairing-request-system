//Update data
$('#mainForm').submit(function(e){
	e.preventDefault();
	var form = $(this);
	var actionUrl = form.attr('action');
	var form_data = new FormData($('#mainForm')[0]);
	
	$.ajax({
		type:'post',
		url:actionUrl,
		data:form_data,
		processData: false,
    	contentType: false,
		success:function(data) {
			if(data == "success"){
				Swal.fire({
					icon: 'success',
					showConfirmButton: false,
					title: 'อัพเดทข้อมูลสำเร็จ',
					timer: 2000,
					timerProgressBar: true
				}).then((result) => {
					if (result.dismiss) {
						window.location.href="profile.php";
					}
				})  
			}
			else{
				var msg = data.split("|");
				Swal.fire({
					icon: 'error',
					title: 'เกิดข้อผิดพลาดในการอัพเดทข้อมูล',
					text: msg[1],
					showConfirmButton: false
				})
			}
		}
	});
});

//Reset password
function resetPass(id){
	var id = id;
	var pass = "";
	action = "resetPassword"
	Swal.fire({
        title: 'รีเซ็ตรหัสผ่าน',
		input: 'password',
		html:'<div class="mt-0"></div>',
		inputPlaceholder: 'รหัสผ่านใหม่',
		reverseButtons: true,
        showCancelButton: true,
        cancelButtonColor: 'white',
        cancelButtonText: '<span class="text-dark">ยกเลิก</span>',
        confirmButtonColor: window.theme.primary,
        confirmButtonText: '<span class="text-light">รีเซ็ตรหัสผ่าน</span>',
  		inputValidator: (value) => {
			if (!value) {
				return 'กรุณาระบุรหัสผ่านใหม่'
			}else{
				pass = value;
			}
  		}
    }).then((result) => {
		if (result.isConfirmed) {
			Swal.fire({
				title: 'ยืนยันรหัสผ่าน',
				input: 'password',
				html:'<div class="mt-0"></div>',
				inputPlaceholder: 'ระบุรหัสผ่านใหม่อีกครั้ง',
				reverseButtons: true,
				showCancelButton: true,
				cancelButtonColor: 'white',
				cancelButtonText: '<span class="text-dark">ยกเลิก</span>',
				confirmButtonColor: window.theme.primary,
				confirmButtonText: '<span class="text-light">ยืนยันรหัสผ่าน</span>',
				  inputValidator: (value) => {
					if (!value) {
						return 'กรุณาระบุรหัสผ่านใหม่'
					}else if(value != pass){
						return 'รหัสผ่านที่ระบุไม่ตรงกัน'
					}else{
						pass = value;
				  	}
				}
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type:'post',
						url: "be-profile-manage.php",
						data: {user_id: id, user_password: pass, action: action},
						success:function(data) {
							if(data == "success"){
								Swal.fire({
									icon: 'success',
									showConfirmButton: false,
									title: 'รีเซ็ตรหัสผ่านสำเร็จ',
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
					});
				}
			})
		}
	})
}

//Preview Profie
$('#profilePic').click( function() {
	$('#avatarUpload').click();
});

function previewFile(input){
	var file = $("input[type=file]").get(0).files[0];
	if(file){
		var reader = new FileReader();
		reader.onload = function(){
			$("#profilePic").attr("src", reader.result);
		}
		reader.readAsDataURL(file);
	}
}
