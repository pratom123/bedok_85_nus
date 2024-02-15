function checkOpenStatus(event) {
    var stall_div_clicked = event.currentTarget;
    
    var stall_clicked = stall_div_clicked.closest('.stall');    //find its ancestor to identify which stall is clicked

    console.log(stall_clicked.getElementsByTagName('input')[0].value);

    
    var hidden_input_value = stall_clicked.getElementsByTagName('input')[0].value;

    if (hidden_input_value == '0') {
        if (stall_clicked.id == 'stall_section_xjrcm') {   // '0' represents stall is closed
            // Xing Ji Rou Cuo Mian stall is closed
            $msg = 'Xing Ji Rou Cuo Mian is closed for now!';
        } else if (stall_clicked.id == 'stall_section_sbbq') {
            $msg = 'Sin BBQ is closed for now!';
        }
        alert($msg);
    }

}