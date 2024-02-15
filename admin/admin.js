function checkOrderRowUpdated(event) {
    // event.preventDefaut();

    btnClicked = event.currentTarget;

    console.log(btnClicked.id);

    if (btnClicked.id== 'update_btn_wrapper') {
        console.log(row_being_updated);
        // bubble up to to <tr> element to find its id
        // var row_being_updated = btnClicked.parentElement.parentElement;
        // var order_id = row_being_updated.id;

        // console.log(row_being_updated);

    }

    return true;
}