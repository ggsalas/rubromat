/**
 * Validaciones para los formularios de RubroMAT
 *
 * Crear validaciones para:
 *  + Campos vacíos
 *
 *    OBRA
 *    Nombre - Texto
 *    Descripción - Texto
 *    Cantidad - Número decimal positivo
 *
 *    RUBRO
 *    Nombre - Palabras
 *    Unidad - X
 *    Rendimiento - Número decimal positivo
 *
 *    INSUMO
 *    Nombre - PalaBras
 *    Unidad métrica - X
 *    Unidad Comercial - X
 *    Cantidad Comercial - Número decimal positivo
 */

/* FUNCIONES PARA LAS VALIDACIONES
*******************************************************************************/

// si la validación da error se da formato y agrega un mensaje
function error(elemento, errorTxt){
    // Asignar clase de error (css)
    var elemento = elemento; // para que no de error: [object HTMLDivElement]
    document.getElementById(elemento).style.background = "rgba(255, 255, 0, .1)";
    document.getElementById(elemento).style.borderColor = "#FFFF00";

    /**
     * Mensaje de error
     */
    var errorDiv = errorTxt; // para que no de error: [object HTMLDivElement]

    // selecciono el elemento con nombre igual al elemento más "Error"
    var errorTxt = document.getElementById(elemento + "Error");

    // escribo el mensaje de error
    var errorMensaje = errorTxt.innerHTML = errorDiv;

    // Evitar que se envíe el formulario mientras hay error
    var detener = event.preventDefault();

    return false;
}

// si valida bien se quita el mensaje y formato de error
function ok(elemento){
    // Quitar clase de error (css)
    var elemento = elemento; // para que no de error: [object HTMLDivElement]
    document.getElementById(elemento).style.background = "rgba(255, 255, 0, 0)";
    document.getElementById(elemento).style.borderColor = "#ddd";

    // Mensaje de error
    var errorTxt = document.getElementById(elemento + "Error");
    var errorMensaje = errorTxt.innerHTML = "";

    return;
}

/**
 * Chequear los valores
 */
// detectar si el campo está vacío
function esVacio(valor){
    return valor.value == null || valor.value == "";
}

// detectar si el campo es un texto con números
function noEsTexto(valor){
    var letrasNumeros = /[^\w\s.,-=áéíóú°"()]/; //https://developer.mozilla.org/es/docs/Web/JavaScript/Guide/Regular_Expressions
    return valor.value.match(letrasNumeros); // || valor.value == null || valor.value == "";
}

// detectar si el campo es un número positivo (entero o decimales con punto)
function esNumero(valor){
    var numeros = /^\d*\.?\d*$/; // http://stackoverflow.com/a/12117062
    return valor.value.match(numeros);
}

/* VALIDAR CADA FORMULARIO
*******************************************************************************/
function validarInsumo(){
    var nombre = document.getElementById("nombre");
    var cantComercial = document.getElementById("cantComercial");

    // nombre
    if (esVacio(nombre))
        error("nombre", "Ingresar un nombre");
    else if (noEsTexto(nombre))
        error("nombre", "El nombre debe contener únicamente letras, números y guión medio");
    else
        ok("nombre");

    // cantComercial
    if (esVacio(cantComercial))
        error("cantComercial", "Ingresar la cantidad de unidades métricas que posee una unidad comercial");
    else if (!esNumero(cantComercial))
        error("cantComercial", "Se debe ingresar un número positivo Ej: 2.50");
    else
        ok("cantComercial");
}

function validarRubro(){
    var nombre = document.getElementById("nombre");

    // nombre
    if (esVacio(nombre))
        error("nombre", "Ingresar un nombre");
    else if (noEsTexto(nombre))
        error("nombre", "El nombre debe contener únicamente letras, números y guión medio");
    else
        ok("nombre");
}

function validarObra(){
    var nombre = document.getElementById("nombre");
    var descripcion = document.getElementById("descripcion");

    // nombre
    if (esVacio(nombre))
        error("nombre", "Ingresar un nombre");
    else if (noEsTexto(nombre))
        error("nombre", "El nombre debe contener únicamente letras, números y guión medio");
    else
        ok("nombre");

    // descripcion
    if (noEsTexto(descripcion))
        error("descripcion", "La descripción debe contener únicamente letras, números y guión medio");
    else
        ok("descripcion");
}

function validarInsumoXrubro(){
    var rendimiento = document.getElementById("rendimiento");

    // rendimiento
    if (esVacio(rendimiento))
        error("rendimiento", "Ingresar la cantidad de unidades del material por cada unidad del rubro");
    else if (!esNumero(rendimiento))
        error("rendimiento", "Se debe ingresar un número positivo Ej: 2.50");
    else
        ok("rendimiento");
}

function validarRubroXobra(){
    var cantidad = document.getElementById("cantidad");

    // rendimiento
    if (esVacio(cantidad))
        error("cantidad", "Ingresar la cantidad de unidades del rubro");
    else if (!esNumero(cantidad))
        error("cantidad", "Se debe ingresar un número positivo Ej: 2.50");
    else
        ok("cantidad");
}
