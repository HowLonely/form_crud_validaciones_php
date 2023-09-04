<?php
// Inicializa clases para todos los campos (Para validación con bootstrap)
$rutClass = "is-invalid";
$nombresClass = "is-invalid";
$apellidosClass = "is-invalid";
$correoClass = "is-invalid";
$paisClass = "is-invalid";
$numeroCasaClass = "is-invalid";
$nombreCalleClass = "is-invalid";
$codigoPostalClass = "is-invalid";
$celularClass = "is-invalid";
$numCasoClass = "is-invalid";
$fechaInicioCasoClass = "is-invalid";
$fechaCierreCasoClass = "is-invalid";
$descSentenciaClass = "is-invalid";

// Variables para validación en index.php
$rutValid = false;
$nombresValid = false;
$apellidosValid = false;
$correoValid = false;
$paisValid = false;
$numeroCasaValid = false;
$nombreCalleValid = false;
$codigoPostalValid = false;
$celularValid = false;
$numCasoValid = false;
$fechaInicioCasoValid = false;
$fechaCierreCasoValid = false;
$descSentenciaValid = false;

// Validar el Rut
$rut = $_POST["rut"];
$digito_verificador = $_POST["digito_verificador"];
$rutCompleto = $rut . "-" . $digito_verificador; // Se crea el rut completo con el digito verificador
if (empty($rut)) {
    $rutClass = 'is-invalid';
} else if (!preg_match("/^[0-9]{7,8}$/", $rut) || !preg_match("/^[0-9kK]{1}$/", $digito_verificador)) {
    $rutClass = 'is-invalid';
} else {
    $rutValid = true; // Cambia a true si la validación es exitosa
    $rutClass = "is-valid";
}

// Validar los Nombres
$nombres = $_POST["nombres"];
if (empty($nombres)) {
    $nombresValid = false;
} else {
    $nombresValid = true; // Cambia a true si la validación es exitosa
    $nombresClass = 'is-valid';
}

// Validar los Apellidos
$apellidos = $_POST["apellidos"];
if (empty($apellidos)) {
    $apellidosClass = "is-invalid";
} else {
    $apellidosValid = true; // Cambia a true si la validación es exitosa
    $apellidosClass = "is-valid";
}


// Validar el Correo
$correo = $_POST["correo"];
if (empty($correo)) {
} else if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
} else {
    $correoValid = true; // Cambia a true si la validación es exitosa
    $correoClass = "is-valid";
}

// Validar el campo "País"
$pais = $_POST["pais"];
if (empty($pais) || preg_match("/[0-9]/", $pais)) {
} else {
    $paisValid = true; // Cambia a true si la validación es exitosa
    $paisClass = "is-valid";
}

// Validar el campo "Nombre de la Calle"
$nombre_calle = $_POST["nombre_calle"];
if (empty($nombre_calle) || preg_match("/[0-9]/", $nombre_calle)) {
} else {
    $nombreCalleValid = true; // Cambia a true si la validación es exitosa
    $nombreCalleClass = "is-valid";
}

// Validar el campo "Número de Casa"
$numero_casa = $_POST["numero_casa"];
if (empty($numero_casa)) {
} else {
    $numeroCasaValid = true; // Cambia a true si la validación es exitosa
    $numeroCasaClass = "is-valid";
}

// Validar el campo "Código Postal"
$codigo_postal = $_POST["codigo_postal"];
if (empty($codigo_postal)) {
} else {
    $codigoPostalValid = true; // Cambia a true si la validación es exitosa
    $codigoPostalClass = "is-valid";
}

// Se crea la dirección completa
$direccion = $pais . ',' . $nombre_calle . ',' . $numero_casa . ',' . $codigo_postal;

// Validar el Número de celular
$celular = $_POST["celular"];
if (preg_match("/^\+\d{2,3}\s?\d{2,6}\s?\d{1,11}$/", $celular) && is_numeric(ltrim($celular, '+'))) {
    $celularValid = true;
    $celularClass = "is-valid";
}
// Validar estado caso
$estado_caso = $_POST["estado_caso"];

// Validar el Número de caso
$numero_caso = $_POST["numero_caso"];
if (!empty($numero_caso) && preg_match("/^[0-9]+$/", $numero_caso)) {
    $numCasoClass = "is-valid";
    $numCasoValid = true;
}

// Validar Fecha de inicio del caso
$fecha_inicio_caso = $_POST["fecha_inicio_caso"];
if (!empty($fecha_inicio_caso)) {
    $fechaInicioCasoValid = true;
    $fechaInicioCasoClass = "is-valid";
}

$fecha_cierre_caso = $_POST["fecha_cierre_caso"];
// Validar que si el estado no está en "cerrado "y se proporciona una fecha de cierre, mostrar un mensaje de error
if ($estado_caso !== "cerrado" && !empty($fecha_cierre_caso)) {
    $fecha_cierre_caso = ""; // Borra el valor en la variable
    $mensajeError = "No se puede proporcionar una fecha de cierre si el caso no está cerrado."; // Mensaje de error personalizado
} else if ($estado_caso === 'cerrado' && empty($fecha_cierre_caso)){
    $mensajeError = "Se debe proporcionar una fecha de cierre si el caso está cerrado.";
} else {
    $fechaCierreCasoClass = 'is-valid';
    $fechaCierreCasoValid = true;
}

//Validar descripción de sentencia
$descripcion_sentencia = $_POST["descripcion_sentencia"];
if ($estado_caso != "cerrado" && $descripcion_sentencia != "") { // Solo en el estado de caso cerrado se puede proporcionar una descripcion de sentencia
    $descripcion_sentencia = ""; // Borra el valor de la variable
    $mensajeError = "No se puede proporcionar una descripción de sentencia cuando el caso no está cerrado.";
} else if ($estado_caso === 'cerrado' && empty($descripcion_sentencia)) {
    $mensajeError = "Se debe proporcionar una descripción de la sentencia si el caso está cerrado";
} else {
    $descSentenciaValid = true;
    $descSentenciaClass = "is-valid";
}

if (
    $rutValid &&
    $nombresValid &&
    $apellidosValid &&
    $correoValid &&
    $paisValid &&
    $numeroCasaValid &&
    $nombreCalleValid &&
    $codigoPostalValid &&
    $celularValid &&
    $numCasoValid &&
    $fechaInicioCasoValid &&
    $fechaCierreCasoValid &&
    $descSentenciaValid
    && $_POST["form_source"] === 'register' //INCLUIR ADEMÁS QUE EL FORMULARIO SEA DEL SOURCE DEL INDEX.PHP (REGISTRO)
) {
    // Todas las variables son true, lo que significa que todas las validaciones fueron exitosas.

    include 'crud_clientes.php';
    include 'crud_casos.php';

    // Verificar si el cliente ya existe por su RUT.
    $cliente_existente = verifyClienteByRut($rutCompleto);

    if (!$cliente_existente) {
        $creacion = createCliente($rutCompleto, $nombres, $apellidos, $direccion, $correo, $celular);
    }

    // Crear un nuevo caso
    createCaso(intval($numero_caso), $descripcion_sentencia, $fecha_inicio_caso, $fecha_cierre_caso, $estado_caso, $rutCompleto);

    header('Location: index.php');
    exit();
} else if (
    $rutValid &&
    $nombresValid &&
    $apellidosValid &&
    $correoValid &&
    $paisValid &&
    $numeroCasaValid &&
    $nombreCalleValid &&
    $codigoPostalValid &&
    $celularValid &&
    $numCasoValid &&
    $fechaInicioCasoValid &&
    $fechaCierreCasoValid &&
    $descSentenciaValid
    && $_POST["form_source"] === 'edit'
) {
    // El formulario de validación es para editar un caso

    // SeCreaa un arreglo asociativo con los nuevos datos
    $nuevosDatos = array(
        'desc_caso' => $descripcion_sentencia,
        'fecha_inicio' => $fecha_inicio_caso, // Nueva fecha de inicio
        'fecha_termino' => $fecha_cierre_caso, // Nueva fecha de término
        'estado_caso' => $estado_caso, // Nuevo estado del caso
        'rut_cliente' => $rut . '-' . $digito_verificador, // Nuevo rut del cliente
    );

    include 'crud_casos.php';
    if (updateCaso($numero_caso, $nuevosDatos)) {
        header('Location: index.php');
        exit();
    }
}

// Incluir nuevamente el formulario para mostrar errores y mensajes de éxito (Temporal)
if ($_POST["form_source"] === 'register') {
    include 'index.php';
} else if ($_POST["form_source"] === 'edit') {
    include 'editar_caso.php';
}
