function scrollToStall(event) {
    nav_link = event.currentTarget;
    console.log(nav_link);
    
    if (nav_link.id == "stall_link_xjrcm") {
        scroll(0, 690);
    } else {
        scroll(0, 1340);
    }
}