<?php
include 'conexion.php';

$titulo = 'El extranjero';
$autor = 'Albert Camus';
$anio = 1942;

$stmt = $pdo->prepare( 'INSERT INTO libros (titulo, autor, anio) VALUES (?, ?, ?)' );
$stmt->execute( [ $titulo, $autor, $anio ] );
echo 'Libro insertado correctamente.';
?>
