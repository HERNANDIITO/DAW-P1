// Archivo: register.js
// En este archivo se define la logica del registro
// Creado por: David González Moreno el 23/10/2024
// Historial de cambios:
// 23/10/2024 - Creado 

function checkEnglish(word, slash) {
    value = true;
    for (const letter in word) {
        if (!Object.prototype.hasOwnProperty.call(word, letter)) { return; }

        const element = `${(word[letter])}`;
        if (
            ( element.charCodeAt(0) < 48 ) ||                                       // Comprobamos que no sea un numero
            (!( element.charCodeAt(0) >= 48 || element.charCodeAt(0) <= 57 )) ||    // Comprobamos que no sea un numero
            (!( element.charCodeAt(0) >= 65 || element.charCodeAt(0) <= 90 )) ||    // Comprobamos que no sea una letra
            (!( element.charCodeAt(0) >= 97 || element.charCodeAt(0) <= 122 ))      // Comprobamos que no sea un letra minuscula
        )   {
            if ( slash == true ) { // En caso de esta permitidos los guiones
                if (
                    (element.charCodeAt(0) != 95) && // Comprobamos que no es un guion bajo
                    (element.charCodeAt(0) != 45)    // Comprobamos que no es un guion
                )   { value = false; }
            } else { value = false; }
            break;
        }
    }

    return value;
}

function checkMayusNum(word) {
    mayus = 0;
    minus = 0;
    nums  = 0;

    for (const letter in word) {
        if (!Object.prototype.hasOwnProperty.call(word, letter)) { return; }

        const element = `${(word[letter])}`;
        
        if ( element.charCodeAt(0) >= 65 && element.charCodeAt(0) <= 90 ) { mayus++; }
        if ( element.charCodeAt(0) >= 97 && element.charCodeAt(0) <= 122) { minus++; }
        if ( element.charCodeAt(0) >= 48 && element.charCodeAt(0) <= 57 ) { nums++;  }

    }

    return mayus >= 1 && minus >= 1 && nums >= 1 ? true : false

}

function checkEmail(value) {

    if ( value.length > 254 ) {
        console.log("Demasiado largo");
        return;
    }
    
    splittedEmail = value.split('@')

    if ( splittedEmail.length < 2 ) {
        console.log("Falta un @");
        return;
    }

    local = splittedEmail[0]
    domain = splittedEmail[1]
    
    if ( !checkLocal(local) ) {
        console.log("Parte local equivocada");
        return;
    }

    if ( !checkDomain(domain) ) {
        console.log("Dominio equivocado");
        return;
    }

    console.log("Correo apropiado!");
    

}

function checkLocal(local) {
    value = true;
    for (const letter in local) {
        if (!Object.prototype.hasOwnProperty.call(local, letter)) { return; }
        const element = `${(local[letter])}`;
        if (
            !(( element.charCodeAt(0) >= 65 && element.charCodeAt(0) <= 90 ) || // Comprobamos mayuculas
            ( element.charCodeAt(0) >= 97 && element.charCodeAt(0) <= 122) ||   // Comprobamos minusculas
            ( element.charCodeAt(0) >= 48 && element.charCodeAt(0) <= 57 ) ||   // Comprobamos digitos
            ( element.charCodeAt(0) == 239 ) ||
            ( element === '!' ) ||
            ( element === '#' ) ||
            ( element === '$' ) ||
            ( element === '%' ) ||
            ( element === '&' ) ||
            ( element === '*' ) ||
            ( element === '+' ) ||
            ( element === '-' ) ||
            ( element === '/' ) ||
            ( element === '=' ) ||
            ( element === '?' ) ||
            ( element === '^' ) ||
            ( element === '_' ) ||
            ( element === '{' ) ||
            ( element === '|' ) ||
            ( element === '}' ) ||
            ( element === '~' ) ||
            ( element === '.' ))
        )   {
            value = false;
        }
    }

    if ( !value ) { return value } // Interrumpimos para ahorrar antes de seguir comprobando

    if ( local[0] == '.' || local[ local.length - 1 ] == '.' ) { value = false; return value; } // Comprobamos que el punto no este ni al principio ni al final


    cont = 0;
    for (const letter in local) {
        if (!Object.prototype.hasOwnProperty.call(local, letter)) { return; }
        const element = `${(local[letter])}`;

        if ( element == '.' ) { cont++; }   // Si hay un punto en la letra, incrementamos el contador
        else { cont == 0 }                  // Si no, lo reiniciamos

        if ( cont >= 2 ) { value = false; break; } // En caso de que el contador haya llegado hasta 2, salimos del bucle y terminamos comprobaciones
    }

    return value;
}

function checkDomain(domain) {
    console.log(domain);
    
    if ( domain.length > 255 ) { console.log("Muy largo"); return false; } // Demasiado largo

    domains = domain.split('.')

    if ( domains.length < 2 ) { console.log("No hay subdominios"); return false; } // No hay subdominios

    for ( subdomain_pos in domains ) {
        
        subdomain = domains[subdomain_pos]
        
        if ( subdomain.length > 63 || subdomain.length < 1 ) { console.log("Longitud inapropiada"); return false; } // Subdominio demasiado largo

        if ( subdomain[0] == "-" || subdomain[ subdomain.length - 1 ] == "-" ) { console.log("El guion no puede ser primero ni ultimo"); return false; } // El guion no puede ser primero ni ultimo

        for (const letter in subdomain) {
            const element = `${(subdomain[letter])}`;

            if (   !(   ( element.charCodeAt(0) >= 65 && element.charCodeAt(0) <= 90 ) ||       // Comprobamos mayuculas
                        ( element.charCodeAt(0) >= 97 && element.charCodeAt(0) <= 122) ||       // Comprobamos minusculas
                        ( element.charCodeAt(0) >= 48 && element.charCodeAt(0) <= 57 ) ||       // Comprobamos digitos
                        ( element == '-' )  )   )
            {
                console.log("Caracter inapropiado"); return false; // Caracter inapropiado
            }
        }
    }

    return true;
}


function checkUser(value) {
    if ( value.length < 3 ) {
        console.log("Demasiado corto");
        return;
    }
    
    if ( value.length > 15 ) {
        console.log("Demasiado largo");
        return;
    }

    if ( !checkEnglish(value, false) ) {
        console.log("Caracteres inapropiados");
        return;
    }

    console.log("Buen usuario!");

}

function checkPass(value) {
    if ( value.length < 6 ) {
        console.log("Demasiado corto");
        return;
    }
    
    if ( value.length > 15 ) {
        console.log("Demasiado largo");
        return;
    }
    
    if ( !checkEnglish(value, true) ) {
        console.log("Caracteres inapropiados");
        return;
    }

    if ( !checkMayusNum(value) ) {
        console.log("Minimo una mayuscula, una minuscula y un número");
        return;
    }

    console.log("Buen password!");

}

function checkPass2(value) {
    pass1 = document.getElementById("passInput").value

    if (!(pass1 === value)) {
        console.log("Contraseñas no coinciden");
        return;
    }

    console.log("Contraseñas coinciden!");
}

function checkBirthDate(value) {
    const now = new Date()
    const birth = new Date(value)

    if ( now.getFullYear() - birth.getFullYear() < 18 ) {
        console.log("Tienes que ser mayor de edad");
        
    }
    
    
}
