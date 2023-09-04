<!DOCTYPE html>
<html>

<head>
  <title>Formulario Cliente</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
</head>

<body data-bs-theme="dark">
  <div class="container text-center">

    <h3 class="m-4">Registro de casos</h3>

    <form method="post" action="validation.php" class="container text-center">

      <div class="row">

        <div class="input-group mb-3 col align-items-center">
          <span class="input-group-text">Rut</span>
          <input type="text" name="rut" placeholder="12345678" class="form-control <?php echo $rutClass; ?>" value="<?php echo isset($rutValid) ? $rut : ''; ?>">
          <span class="input-group-text">-</span>
          <input type="text" name="digito_verificador" placeholder="9" class="form-control <?php echo $rutClass; ?>" maxlength="1" value="<?php echo isset($rutValid) ? $digito_verificador : ''; ?>">
        </div>

        <div class="input-group col mb-3">
          <span class="input-group-text">Nombres</span>
          <input type="text" name="nombres" placeholder="Juan Pedro" class="form-control <?php echo $nombresClass; ?>" value="<?php echo isset($nombresValid) ? $nombres : ''; ?>">
        </div>

      </div>

      <div class="row">

        <div class="col input-group mb-3">
          <span class="input-group-text">Apellidos</span>
          <input type="text" name="apellidos" class="form-control <?php echo $apellidosClass; ?>" placeholder="Perez Rojas" value="<?php echo isset($apellidosValid) ? $apellidos : ''; ?>">
        </div>

        <div class="col input-group mb-3">
          <span class="input-group-text">Correo</span>
          <input type="email" name="correo" placeholder="correo@ejemplo.cl" class="form-control <?php echo $correoClass; ?>" value="<?php echo isset($correoValid) ? $correo : ''; ?>" />
        </div>

      </div>

      <div class="row">
        <div class="col input-group mb-3">
          <span class="input-group-text">Dirección</span>
          <input type="text" name="pais" placeholder="País" class="form-control <?php echo $paisClass; ?>" value="<?php echo isset($paisValid) ? $pais : ''; ?>">
          <input type="text" name="nombre_calle" placeholder="Calle" class="form-control <?php echo $nombreCalleClass; ?>" value="<?php echo isset($nombreCalleValid) ? $nombre_calle : ''; ?>">
          <input type="tel" name="numero_casa" placeholder="N° Casa" class="form-control <?php echo $numeroCasaClass; ?>" pattern="[0-9]*" value="<?php echo isset($numeroCasaValid) ? $numero_casa : ''; ?>">
          <input type="tel" name="codigo_postal" placeholder="Código postal" class="form-control <?php echo $codigoPostalClass; ?>" pattern="[0-9]*" value="<?php echo isset($codigoPostalValid) ? $codigo_postal : ''; ?>">
        </div>
      </div>

      <div class="row">
        <div class="col input-group mb-3">
          <span class="input-group-text">Número de celular</span>
          <input type="tel" name="celular" placeholder="+56 9 12345678" class="form-control <?php echo $celularClass; ?>" pattern="^\+\d{2,3}\s?\d{2,6}\s?\d{1,11}$" value="<?php echo isset($celularValid) ? $celular : ''; ?>">
        </div>
      </div>

      <div class="row">
        <div class="col input-group mb-3">
          <span class="input-group-text">Número de caso</span>
          <input type="text" name="numero_caso" placeholder="Número de caso" class="form-control <?php echo $numCasoClass; ?>" value="<?php echo isset($numCasoValid) ? $numero_caso : ''; ?>">
        </div>

        <div class="col input-group mb-3">
          <span class="input-group-text">Fecha de inicio del caso</span>
          <input type="date" name="fecha_inicio_caso" class="form-control <?php echo $fechaInicioCasoClass; ?>" value="<?php echo isset($fechaInicioCasoValid) ? $fecha_inicio_caso : ""; ?>">
        </div>
      </div>

      <div class="row">

        <div class="col input-group mb-3">
          <span class="input-group-text">Estado del caso</span>
          <select name="estado_caso" class="form-select">
            <?php if (isset($estado_caso)) : ?>
              <option value="activo" <?php echo ($estado_caso === "activo") ? "selected" : ""; ?>>Activo</option>
              <option value="en_proceso" <?php echo ($estado_caso === "en_proceso") ? "selected" : ""; ?>>En Proceso</option>
              <option value="cerrado" <?php echo ($estado_caso === "cerrado") ? "selected" : ""; ?>>Cerrado</option>
            <?php else : ?>
              <option value="activo">Activo</option>
              <option value="en_proceso">En Proceso</option>
              <option value="cerrado">Cerrado</option>
            <?php endif; ?>
          </select>

        </div>

        <div class="col input-group mb-3">
          <span class="input-group-text">Fecha de cierre del caso</span>
          <input type="date" name="fecha_cierre_caso" class="form-control <?php echo $fechaCierreCasoClass; ?>" value="<?php echo isset($fechaCierreCasoValid) ? $fecha_cierre_caso : ""; ?>">
        </div>
      </div>

      <div class="row">
        <div class="col input-group">
          <span class="input-group-text">Descripción de sentencia</span>
          <textarea name="descripcion_sentencia" placeholder="Descripción de sentencia" class="form-control <?php echo $descSentenciaClass; ?>" value="<?php echo isset($descSentenciaValid) ? $descripcion_sentencia : ''; ?>"></textarea>
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

      <!-- Campo oculto para indicar la fuente del formulario -->
      <input type="hidden" name="form_source" value="register">

      <div class="row">
        <div class="col d-grid">
          <input class="btn btn-success m-3" type="submit" name="registrar" />
        </div>
      </div>

    </form>

  </div>

  <!-- Tabla casos -->
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Número de Caso</th>
        <th scope="col">Rut cliente</th>
        <th scope="col">Estado del caso</th>
        <th scope="col">Descripción</th>
        <th scope="col">Fecha de inicio</th>
        <th scope="col">Fecha de término</th>
        <th scope="col">Acciones</th> <!-- Agregamos una columna para acciones -->
      </tr>
    </thead>
    <tbody>
      <?php
      include "crud_casos.php"; // Incluye el archivo que contiene las funciones CRUD para casos

      // Obtén los datos de los casos
      $casos = getCasos();

      // Itera a través de los casos y muestra cada uno en una fila de la tabla
      foreach ($casos as $caso) {
        echo "<tr>";
        echo "<td>" . $caso['num_caso'] . "</td>";
        echo "<td>" . $caso['rut_cliente'] . "</td>";
        echo "<td>" . $caso['estado_caso'] . "</td>";
        echo "<td>" . $caso['desc_caso'] . "</td>";
        echo "<td>" . $caso['fecha_inicio'] . "</td>";
        echo "<td>" . $caso['fecha_termino'] . "</td>";
        echo "<td>";
        echo '<a href="editar_caso.php?num_caso=' . $caso['num_caso'] . '" class="btn btn-warning btn-sm">Editar</a>';
        echo ' <a href="eliminar_caso.php?num_caso=' . $caso['num_caso'] . '" class="btn btn-danger btn-sm">Eliminar</a>';
        echo "</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>

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