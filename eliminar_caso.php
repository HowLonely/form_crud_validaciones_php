<?php
include "crud_casos.php"; // Incluye el archivo que contiene las funciones CRUD para casos

if (isset($_GET['num_caso'])) {
    $num_caso = $_GET['num_caso'];
    if (deleteCaso($num_caso)) {
        // Redirige a la página inicial después de la eliminación exitosa
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar el caso.";
    }
}
?>
