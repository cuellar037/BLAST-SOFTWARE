function alertProfile(id, rol, name){

    switch(rol){
        case 'proveedor':
            console.log(id, rol, name);
            var respuesta = confirm("¿Esta seguro(a) de eliminar al proveedor "+name+"?");
            if(respuesta === true){
                window.location.href = "?b=profile&s=deleteProveedor&id="+id+"&name="+name; 
            } 
            break;
        case 'usuario':
            console.log(id); 
            var respuesta = confirm("¿Esta seguro(a) de eliminar el usuario "+name+"?");
            if(respuesta === true){
                window.location.href = "?b=profile&s=deleteUser&id="+id+"name="+name; 
            } 
            break;
        case 'mascota':
            var respuesta = confirm("¿Esta seguro(a) de eliminar esta mascota?");
            if(respuesta === true){
                window.location.href = "?b=profile&s=deleteProfile&p=mascota&id="+id; 
            } 
            break;
        default:
            break;
    }
}

function destroySession(){
    var respuesta = confirm("¿Esta seguro(a) de finalizar la sesión?");
    if(respuesta === true){
        window.location.href = "?b=profile&s=cerrarSesion"; 
    } 
}