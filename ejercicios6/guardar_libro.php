<?php
require 'conexion.php';
header( 'Content-Type: application/json' );

try {
    // Validar datos
    $titulo = filter_input( INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS );
    $autor = filter_input( INPUT_POST, 'autor', FILTER_SANITIZE_SPECIAL_CHARS );
    $anio = filter_input( INPUT_POST, 'anio', FILTER_VALIDATE_INT, [
        'options' => [ 'min_range' => 1000, 'max_range' => date( 'Y' ) ]
    ] );

    if ( !$titulo || !$autor || !$anio ) {
        throw new Exception( 'Datos inválidos' );
    }

    // Insertar en BD ( ajustado a id_libro )
    $stmt = $pdo->prepare( 'INSERT INTO libros (titulo, autor, anio) VALUES (?, ?, ?)' );
    $stmt->execute( [ $titulo, $autor, $anio ] );

    echo json_encode( [
        'success' => true,
        'id_libro' => $pdo->lastInsertId()
    ] );
} catch ( Exception $e ) {
    echo json_encode( [
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ] );
}