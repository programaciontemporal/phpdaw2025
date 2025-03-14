<?php
session_start();

if ( isset( $_SESSION[ 'usuario' ] ) ) {
    $usuario = $_SESSION[ 'usuario' ];
    $tipo_usuario = $_SESSION[ 'tipo_usuario' ];

    if ( $tipo_usuario === 'admin' ) {
        // Página de administrador
        echo '¡Bienvenido, Administrador!';
        echo '<br><p>Tienes acceso a todas las funciones del sistema.</p>';
    } else {
        // Página de usuario común
        echo "¡Bienvenido, $usuario!";
        echo '<br><p>Eres un usuario común. Tu acceso es limitado.</p>';
    }

    echo "<br><a href='02cerrar_sesion.php'>Cerrar sesión</a>";
} else {
    echo "No has iniciado sesión. <a href='02login.php'>Volver al inicio</a>";
}
?>