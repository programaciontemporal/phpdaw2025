<?php
require 'conexion.php';

$id = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
$titulo = filter_input( INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS );
$autor = filter_input( INPUT_POST, 'autor', FILTER_SANITIZE_SPECIAL_CHARS );
$anio = filter_input( INPUT_POST, 'anio', FILTER_VALIDATE_INT );

$stmt = $pdo->prepare( 'UPDATE libros SET titulo = ?, autor = ?, anio = ? WHERE id_libro = ?' );
if ( $stmt->execute( [ $titulo, $autor, $anio, $id ] ) ) {
    header( 'Location: listado.php?success=edit' );
} else {
    header( 'Location: listado.php?error=edit' );
}