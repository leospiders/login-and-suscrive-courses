// js/scripts.js
function validarFormulario() {
    var contraseña = document.getElementById('contraseña').value;
    if (contraseña.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres');
        return false;
    }
    var telefono = document.getElementById('telefono').value;
    if (isNaN(telefono)) {
        alert('El teléfono debe contener solo números');
        return false;
    }
    return true;
}
