//Show record detail
function showDetail(id) {
	$.ajax({
		type:'post',
		url: "be-resolv-manage.php",
		data: {action: "viewRequest", req_id: id},
		success:function() {
			window.location.href="o-resolv-manage.php";
		}
	});
}

//Update request solv
$('#updateResolvForm').submit(function(e){
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
					title: 'อัพเดทรายการสำเร็จ',
					timer: 2000,
					timerProgressBar: true
				}).then((result) => {
					if (result.dismiss) {
						window.location.href="o-resolv-manage.php";
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
});

//Cancle request resolv
function cancelReq(paramID, solvID){
	Swal.fire({
		icon: 'warning',
		title: 'ยกเลิกรายการแจ้งซ่อม',
		text: "ทำเครื่องหมายว่ารายการแจ้งซ่อมนี้ถูกยกเลิก",
		reverseButtons: true,
		showCancelButton: true,
		cancelButtonColor: 'white',
		cancelButtonText: '<span class="text-dark">ยกเลิก</span>',
		confirmButtonColor: window.theme.primary,
		confirmButtonText: '<span class="text-light">ลบรายการ</span>'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type:'post',
				url: "be-resolv-manage.php",
				data: {action: "cancleRequest", req_id: paramID, resolv_id: solvID},
				success:function(data) {
					if(data == "success"){
						Swal.fire({
							icon: 'success',
							showConfirmButton: false,
							title: 'ดำเนินการสำเร็จ',
							timer: 2000,
							timerProgressBar: true
						}).then((result) => {
							if (result.dismiss) {
								window.location.href = "o-resolv.php";
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

function approveReq(paramID, officerID){
	Swal.fire({
		icon: 'question',
		title: 'รับคำร้องรายการแจ้งซ่อม',
		text: 'รายการแจ้งซ่อมจะถูกเพิ่มไปยัง "บันทึกการปฏิบัติงาน"',
		reverseButtons: true,
		showCancelButton: true,
		cancelButtonColor: 'white',
		cancelButtonText: '<span class="text-dark">ยกเลิก</span>',
		confirmButtonColor: window.theme.primary,
		confirmButtonText: '<span class="text-light">รับคำร้อง</span>'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type:'post',
				url: "be-request-manage.php",
				data: {action: "approveRequest", req_id: paramID, officer_id: officerID},
				success:function(data) {
					if(data == "success"){
						Swal.fire({
							icon: 'success',
							showConfirmButton: false,
							title: 'ดำเนินการสำเร็จ',
							timer: 2000,
							timerProgressBar: true
						}).then((result) => {
							if (result.dismiss) {
								window.location.href = "o-request.php";
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