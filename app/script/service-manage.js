var id;
var name;
var action;
var url = "be-service-manage.php";

//add new service
function add(){
	Swal.fire({
        title: 'เพิ่มรายการใหม่',
		input: 'text',
		html:'<div class="mt-0"></div>',
		inputValue: '',
		inputPlaceholder: 'ชื่อบริการ',
		reverseButtons: true,
        showCancelButton: true,
        cancelButtonColor: 'white',
        cancelButtonText: '<span class="text-dark">ยกเลิกรายการ</span>',
        confirmButtonColor: window.theme.primary,
        confirmButtonText: '<span class="text-light">เพิ่มรายการ</span>',
  		inputValidator: (value) => {
			if (!value) {
				return 'กรุณาระบุชื่อบริการ'
			}else{
				id = "-";
				name = value;
				action = "add";
			}
  		}
    }).then((result) => {
		if (result.isConfirmed) {
			lunchAjax(id, name, action, url);
		}
	})
}

//edit service
function edit(paramID, paramName){
	Swal.fire({
        title: 'แก้ไขรายการ',
		input: 'text',
		html:'<div class="mt-0"></div>',
		inputValue: paramName,
		inputPlaceholder: 'ชื่อบริการ',
		reverseButtons: true,
        showCancelButton: true,
        cancelButtonColor: 'white',
        cancelButtonText: '<span class="text-dark">ยกเลิกรายการ</span>',
        confirmButtonColor: window.theme.primary,
        confirmButtonText: '<span class="text-light">แก้ไขรายการ</span>',
  		inputValidator: (value) => {
			if (!value) {
				return 'กรุณาระบุชื่อบริการ'
			}else{
				id = paramID;
				name = value;
				action = "edit";
			}
  		}
    }).then((result) => {
		if (result.isConfirmed) {
			lunchAjax(id, name, action, url);
		}
	})
}

//delete service
function del(paramID){
	Swal.fire({
		icon: 'warning',
		title: 'ลบรายการ',
		text: "รายการแจ้งซ่อมที่เกี่ยวข้องจะถูกตั้งค่านี้เป็นค่าว่าง",
		reverseButtons: true,
		showCancelButton: true,
		cancelButtonColor: 'white',
		cancelButtonText: '<span class="text-dark">ยกเลิก</span>',
		confirmButtonColor: window.theme.primary,
		confirmButtonText: '<span class="text-light">ลบรายการ</span>'
	}).then((result) => {
		if (result.isConfirmed) {
			id = paramID;
			action = "delete";
			lunchAjax(id, name, action, url);
		}
	})
}

//lunch Ajax
function lunchAjax(id, name, action, url){
	$.ajax({
		type:'post',
		url: url,
		data: {dataID: id, dataName: name, dataAction: action},
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