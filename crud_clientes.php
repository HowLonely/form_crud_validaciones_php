<?php
include "connection.php"; // Incluye el archivo de conexión

// Función para crear un nuevo cliente
function createCliente($rut, $nombres, $apellidos, $direccion, $correo, $telefono) {
    global $conn;
    
    $sql = "INSERT INTO clientes (rut_cliente, nombres, apellidos, direccion, correo, telefono)
            VALUES ('$rut', '$nombres', '$apellidos', '$direccion', '$correo', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Función para obtener todos los clientes
function getClientes() {
    global $conn;
    
    $sql = "SELECT * FROM clientes";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $clientes = array();
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }
        return $clientes;
    } else {
        return array();
    }
}

// Función para actualizar la información de un cliente
function updateCliente($rut, $nuevosDatos) {
    global $conn;
    
    $sql = "UPDATE clientes
            SET nombres = '{$nuevosDatos['nombres']}',
                apellidos = '{$nuevosDatos['apellidos']}',
                direccion = '{$nuevosDatos['direccion']}',
                correo = '{$nuevosDatos['correo']}',
                telefono = '{$nuevosDatos['telefono']}'
            WHERE rut_cliente = '$rut'";
    
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
// La función SOLO verifica si existe algún registro
function verifyClienteByRut($rut_cliente) {
    global $conn; 

    $sql = "SELECT * FROM clientes WHERE rut_cliente = '$rut_cliente'";

    $result = $conn->query($sql);
    
    return $result->num_rows > 0;
}

// Obtener un cliente por número
function getClientePorRut($rut_cliente) {
    global $conn;
    
    $sql = "SELECT * FROM clientes WHERE rut_cliente = '$rut_cliente'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Encontramos el caso
        return mysqli_fetch_assoc($result);
    } else {
        // No se encontró el caso
        return false;
    }
}




// Función para eliminar un cliente
function deleteCliente($rut) {
    global $conn;
    
    $sql = "DELETE FROM clientes WHERE rut_cliente = '$rut'";
    
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
?>
