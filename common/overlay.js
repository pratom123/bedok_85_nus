// function nodeClicked(event) {

//     var _nodeClicked = event.currentTarget;

//     document.getElementsByClassName('overlay')[0].style.width = "400px";

//     console.log(_nodeClicked.id + ' is selected');

//         document.getElementById('nav_option_wrapper').style.display = "block";
// }


function openOverlay(event) {
    console.log(event.currentTarget);
    document.getElementById("overlay").style.width = "400px";
    // document.getElementById('nav_option_wrapper').style.display = "block";
}

function closeOverlay() {
    document.getElementById("overlay").style.width = "0px";
    // document.getElementById('nav_option_wrapper').style.display = "none";
}

// Under food dish

// function changeQty(event) {
//     var changeQtyBtn = event.currentTarget;

//     console.log(changeQtyBtn);

//     var qty_display_node = document.getElementById("qty_display");

//     var qty = parseInt(qty_display_node.value);

//     if (changeQtyBtn.innerHTML == "-") {
//         console.log("'-' button detected");
//         // '-' button detected
//         if (qty > 1)  //Minimum number must be 1
//             qty_display_node.value = qty - 1;
//     } else {
//         // '+' button detected
//         console.log("'+' button detected");
//         qty_display_node.value = qty + 1;
//     }
// }

// function updatePrice(event) {
//         // console.log("dasdjnsjd");
//         console.log(event.currentTarget);
//  }
// function checkDishPreference(event) {
//     event.preventDefault();
//     console.log("checkDishPreference()");

//     if (!checkNoodleType())
//         return false
//     if (!checkDrySoup())
//         return false
//     // if (!checkSpecialInstruction())
//     //     return false

//     form = event.currentTarget;
//     form.submit();
// }

// function checkNoodleType() {
//     var noodle_type_radio = document.getElementsByName("bcm_small[noodle_type]");
//     var errorMsg_node = document.getElementById("bcm_small")
//     .querySelectorAll(".dish_pref")[0]  //select noodle type preference
//         .querySelector(".invalid_input_msg");

//     //  Hide or show error message
//     for(var i=0; i<noodle_type_radio.length; i++) {
//         if (noodle_type_radio[i].checked) {
//             if (errorMsg_node.style.display == "block")
//                 errorMsg_node.style.display = "none"
//             return true;
//         }
//     }
//     //radio buttons not checked

//     errorMsg_node.style.display = "block"

//     return false;
// }

// function checkDrySoup() {
//     var dry_soup_radio = document.getElementsByName("bcm_small[dry_soup]");
//     var errorMsg_node = document.getElementById("bcm_small")
//     .querySelectorAll(".dish_pref")[1]  //select dry_soup preference
//         .querySelector(".invalid_input_msg");

//         //  Hide or show error message
//         for(var i=0; i<dry_soup_radio.length; i++) {
//             if (dry_soup_radio[i].checked) {
//                 if (errorMsg_node.style.display == "block")
//                     errorMsg_node.style.display = "none"
//                 return true;
//             }
//         }
//         //radio buttons not checked
    
//         errorMsg_node.style.display = "block"
    
//         return false;
// }

// function checkSpecialInstruction() {
//     var si_text_area_node = 
//     document.getElementById("bcm_small")
//         .querySelectorAll(".dish_pref")[3] //select special instructions
//             .getElementsByTagName('textarea')[0];


//     var errorMsg_node = 
//     document.getElementById("bcm_small")
//         .querySelectorAll(".dish_pref")[3]
//             .querySelector(".invalid_input_msg");

//     var reg = /^[a-zA-Z0-9]*$/;
//     var result = reg.test(si_text_area_node.value);
//     console.log(si_text_area_node.value);

//     if (result) {
//         //valid input
//         if (errorMsg_node.style.display == "block")
//             errorMsg_node.style.display = "none"
//         return true;
//     } else {
//         errorMsg_node.style.display = "block"
//         return false;
//     }
// }