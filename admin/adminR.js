var update_btn_wrapper = document.getElementsByClassName('update_btn_wrapper');
for(var i=0;i<update_btn_wrapper; i++) {
    update_btn_wrapper[i].addEventListener('onclick', checkOrderRowUpdated);
}

var update_status_form = document.getElementById('update_status_form');
update_status_form.onsubmit = checkOrderRowUpdated;
for(var i=0; i< update_btn.length;i++) {
    update_btn[i].onsubmit = checkOrderRowUpdated;
}
// select (dropdown list)
// updatebtn
// remark
