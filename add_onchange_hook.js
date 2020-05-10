function add_onchange_hook() {
    document.getElementById("birthdate").setAttribute('onchange', "calculate_sign(event)");
}

add_onchange_hook();