<?php

// Recuperar los parámetros de la URL si es que existen
if (isset($_GET["num_caso"])) {

    //Obtener el caso
    include 'crud_casos.php';
    $caso = getCasoPorNumero($_GET["num_caso"]);

    $numero_caso_url = $_GET['num_caso'];
    $fecha_inicio_caso_url = $caso["fecha_inicio"];
    $fecha_cierre_caso_url = $caso["fecha_termino"];
    $estado_caso = $caso["estado_caso"];
    $descripcion_sentencia_url = $caso["desc_caso"];

    //Obtener el cliente asociado al caso
    include 'crud_clientes.php';
    $cliente = getClientePorRut($caso["rut_cliente"]);

    // Separar el rut de tipo xxxxxxx-x en rut y digito
    list($rut_url, $digito_verificador_url) = explode('-', $caso["rut_cliente"]);

    // Separar la cadena en partes
    $direccion = explode(",", $cliente["direccion"]);

    // Asignar las partes a las variables correspondientes
    $_pais = $direccion[0];            // País
    $_nombre_calle = $direccion[1];    // Nombre de la calle
    $_numero_casa = $direccion[2];     // Número de casa
    $_codigo_postal = $direccion[3];   // Código postal

} else {
    $numero_caso_url = "";
    $fecha_inicio_caso_url = "";
    $fecha_cierre_caso_url = "";
    $estado_caso_url = "";
    $descripcion_sentencia_url = "";
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>Edición del caso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
</head>

<body data-bs-theme="dark">
    <div class="container text-center">

        <h3 class="m-4">Editar caso</h3>

        <form method="post" action="validation.php" class="container text-center">
            <div class="row">

                <!-- Se utilizan inputs disabled para mostrar los datos y no editarlos, el hidden es para mandar el valor real del input -->
                <!-- Con disabled no se envia el valor del input -->

                <div class="input-group mb-3 col align-items-center">
                    <span class="input-group-text">Rut</span>
                    <input type="text" name="rut_disabled" placeholder="12345678" class="form-control <?php echo $rutClass; ?>" value="<?php echo isset($rutValid) ? $rut : $rut_url; ?>" disabled />
                    <input type="text" name="rut" placeholder="12345678" class="form-control <?php echo $rutClass; ?>" value="<?php echo isset($rutValid) ? $rut : $rut_url; ?>" hidden>

                    <span class="input-group-text">-</span>
                    <input type="text" name="digito_verificador_disabled" placeholder="9" class="form-control <?php echo $rutClass; ?>" maxlength="1" value="<?php echo isset($rutValid) ? $digito_verificador : $digito_verificador_url; ?>" disabled />
                    <input type="text" name="digito_verificador" placeholder="9" class="form-control <?php echo $rutClass; ?>" maxlength="1" value="<?php echo isset($rutValid) ? $digito_verificador : $digito_verificador_url; ?>" hidden>

                </div>

                <div class="input-group col mb-3">
                    <span class="input-group-text">Nombres</span>
                    <input type="text" name="nombres_disabled" placeholder="Juan Pedro" class="form-control <?php echo $nombresClass; ?>" value="<?php echo isset($nombresValid) ? $nombres : $cliente["nombres"]; ?>" disabled />
                    <input type="text" name="nombres" placeholder="Juan Pedro" class="form-control <?php echo $nombresClass; ?>" value="<?php echo isset($nombresValid) ? $nombres : $cliente["nombres"]; ?>" hidden>

                </div>

            </div>

            <div class="row">

                <div class="col input-group mb-3">
                    <span class="input-group-text">Apellidos</span>
                    <input type="text" name="apellidos_disabled" class="form-control <?php echo $apellidosClass; ?>" placeholder="Perez Rojas" value="<?php echo isset($apellidosValid) ? $apellidos : $cliente["apellidos"]; ?>" disabled />
                    <input type="text" name="apellidos" class="form-control <?php echo $apellidosClass; ?>" placeholder="Perez Rojas" value="<?php echo isset($apellidosValid) ? $apellidos : $cliente["apellidos"]; ?>" hidden />

                </div>

                <div class="col input-group mb-3">
                    <span class="input-group-text">Correo</span>
                    <input type="email" name="correo_disabled" placeholder="correo@ejemplo.cl" class="form-control <?php echo $correoClass; ?>" value="<?php echo isset($correoValid) ? $correo : $cliente["correo"]; ?>" disabled />
                    <input type="email" name="correo" placeholder="correo@ejemplo.cl" class="form-control <?php echo $correoClass; ?>" value="<?php echo isset($correoValid) ? $correo : $cliente["correo"]; ?>" hidden />

                </div>

            </div>

            <div class="row">
                <div class="col input-group mb-3">
                    <span class="input-group-text">Dirección</span>
                    <input type="text" name="pais_disabled" placeholder="País" class="form-control <?php echo $paisClass; ?>" value="<?php echo isset($paisValid) ? $pais : $_pais; ?>" disabled />
                    <input type="text" name="pais" placeholder="País" class="form-control <?php echo $paisClass; ?>" value="<?php echo isset($paisValid) ? $pais : $_pais; ?>" hidden />

                    <input type="text" name="nombre_calle_disabled" placeholder="Calle" class="form-control <?php echo $nombreCalleClass; ?>" value="<?php echo isset($nombreCalleValid) ? $nombre_calle : $_nombre_calle; ?>" disabled />
                    <input type="text" name="nombre_calle" placeholder="Calle" class="form-control <?php echo $nombreCalleClass; ?>" value="<?php echo isset($nombreCalleValid) ? $nombre_calle : $_nombre_calle; ?>" hidden />

                    <input type="tel" name="numero_casa_disabled" placeholder="N° Casa" class="form-control <?php echo $numeroCasaClass; ?>" pattern="[0-9]*" value="<?php echo isset($numeroCasaValid) ? $numero_casa : $_numero_casa; ?>" disabled />
                    <input type="tel" name="numero_casa" placeholder="N° Casa" class="form-control <?php echo $numeroCasaClass; ?>" pattern="[0-9]*" value="<?php echo isset($numeroCasaValid) ? $numero_casa : $_numero_casa; ?>" hidden />

                    <input type="tel" name="codigo_postal_disabled" placeholder="Código postal" class="form-control <?php echo $codigoPostalClass; ?>" pattern="[0-9]*" value="<?php echo isset($codigoPostalValid) ? $codigo_postal : $_codigo_postal; ?>" disabled />
                    <input type="tel" name="codigo_postal" placeholder="Código postal" class="form-control <?php echo $codigoPostalClass; ?>" pattern="[0-9]*" value="<?php echo isset($codigoPostalValid) ? $codigo_postal : $_codigo_postal; ?>" hidden />
                </div>
            </div>

            <div class="row">
                <div class="col input-group mb-3">
                    <span class="input-group-text">Número de celular</span>
                    <input type="tel" name="celular_disabled" placeholder="+56 9 12345678" class="form-control <?php echo $celularClass; ?>" pattern="^\+\d{2,3}\s?\d{2,6}\s?\d{1,11}$" value="<?php echo isset($celularValid) ? $celular : $cliente["telefono"]; ?>" disabled />
                    <input type="tel" name="celular" placeholder="+56 9 12345678" class="form-control <?php echo $celularClass; ?>" pattern="^\+\d{2,3}\s?\d{2,6}\s?\d{1,11}$" value="<?php echo isset($celularValid) ? $celular : $cliente["telefono"]; ?>" hidden />

                </div>
            </div>

            <div class="row">
                <div class="col input-group mb-3">
                    <span class="input-group-text">Número de caso</span>
                    <input type="text" name="numero_caso_disabled" placeholder="Número de caso" class="form-control <?php echo $numCasoClass; ?>" value="<?php echo isset($numCasoValid) ? $numero_caso : $numero_caso_url; ?>" disabled />
                    <input type="text" name="numero_caso" placeholder="Número de caso" class="form-control <?php echo $numCasoClass; ?>" value="<?php echo isset($numCasoValid) ? $numero_caso : $numero_caso_url; ?>" hidden />

                </div>

                <div class="col input-group mb-3">
                    <span class="input-group-text">Fecha de inicio del caso</span>
                    <input type="date" name="fecha_inicio_caso" class="form-control <?php echo $fechaInicioCasoClass; ?>" value="<?php echo isset($fechaInicioCasoValid) ? $fecha_inicio_caso : $fecha_inicio_caso_url; ?>">
                </div>
            </div>

            <div class="row">

                <div class="col input-group mb-3">
                    <span class="input-group-text">Estado del caso</span>
                    <select name="estado_caso" class="form-select">
                        <option value="activo" <?php echo ($estado_caso === "activo") ? "selected" : ""; ?>>Activo</option>
                        <option value="en_proceso" <?php echo ($estado_caso === "en_proceso") ? "selected" : ""; ?>>En Proceso</option>
                        <option value="cerrado" <?php echo ($estado_caso === "cerrado") ? "selected" : ""; ?>>Cerrado</option>
                    </select>

                </div>

                <div class="col input-group mb-3">
                    <span class="input-group-text">Fecha de cierre del caso</span>
                    <input type="date" name="fecha_cierre_caso" class="form-control <?php echo $fechaCierreCasoClass; ?>" value="<?php echo isset($fechaCierreCasoValid) ? $fecha_cierre_caso : $fecha_cierre_caso_url; ?>">
                </div>
            </div>

            <div class="row">
                <div class="col input-group">
                    <span class="input-group-text">Descripción de sentencia</span>
                    <textarea name="descripcion_sentencia" placeholder="Descripción de sentencia" class="form-control <?php echo $descSentenciaClass; ?>"><?php echo isset($descSentenciaValid) ? $descripcion_sentencia : $descripcion_sentencia_url; ?></textarea>
                </div>
            </div>

            <!-- Campo para mostrar el mensaje de error -->
            <div class="form-group justify-content-center">
                <div class="invalid-feedback">
                    <?php if (!empty($mensajeError)) : ?>
                        <?php echo $mensajeError; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col m-3 d-grid">
                    <input class="btn btn-success m-3" type="submit" name="registrar" />
                </div>
            </div>

            <!-- Campo oculto para indicar la fuente del formulario -->
            <input type="hidden" name="form_source" value="edit">
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        // script para mostrar el mensaje de error si $mensajeError no esta vacio
        <?php if (!empty($mensajeError)) : ?>
            $(document).ready(function() {
                $('.invalid-feedback').show();
            });
        <?php endif; ?>
    </script>
</body>

</html>