<?php 
require_once('view/header.php');

// Elimino la info de sessión
unset($_SESSION['usuario']);
unset($_SESSION['dni']);
// Y vuelvo al inicio
insertarMensaje(['tipo'=>'success', 'texto'=>'Desconexión completada. Gracias por su visita!']);
volverInicio();

require_once('view/footer.php');
?>