<?php
include "connection.php";
// Función para crear un nuevo caso
function createCaso($num_caso, $desc_caso, $fecha_inicio, $fecha_termino, $estado_caso, $rut_cliente) {
    global $conn;

    $sql = "INSERT INTO casos (num_caso, desc_caso, fecha_inicio, fecha_termino, estado_caso, rut_cliente)
            VALUES ('$num_caso', '$desc_caso', '$fecha_inicio', '$fecha_termino', '$estado_caso', '$rut_cliente')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Función para obtener todos los casos
function getCasos() {
    global $conn;

    $sql = "SELECT * FROM casos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $casos = array();
        while ($row = $result->fetch_assoc()) { //los resultados se van a un array asociativo con fetch_assoc()
            $casos[] = $row;
        }
        return $casos;
    } else {
        return array();
    }
}

// Obtener un caso por su número
function getCasoPorNumero($num_caso) {
    global $conn;
    
    $sql = "SELECT * FROM casos WHERE num_caso = '$num_caso'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Encontramos el caso
        return mysqli_fetch_assoc($result);
    } else {
        // No se encontró el caso
        return false;
    }
}

// Función para actualizar la información de un caso
function updateCaso($num_caso, $nuevosDatos) {
    global $conn;

    $sql = "UPDATE casos
            SET desc_caso = '{$nuevosDatos['desc_caso']}',
                fecha_inicio = '{$nuevosDatos['fecha_inicio']}',
                fecha_termino = '{$nuevosDatos['fecha_termino']}',
                estado_caso = '{$nuevosDatos['estado_caso']}',
                rut_cliente = '{$nuevosDatos['rut_cliente']}'
            WHERE num_caso = $num_caso";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Función para eliminar un caso
function deleteCaso($num_caso) {
    global $conn;

    $sql = "DELETE FROM casos WHERE num_caso = $num_caso";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
?>
