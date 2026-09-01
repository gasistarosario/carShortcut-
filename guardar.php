<?php
// 1. Validar que la foto realmente llegó
if (isset($_POST['foto_base64'])) {
    
    // 2. Definir el nombre exacto de la carpeta
    $carpeta = 'foto/';
    
    // Si la carpeta 'foto' no existe en tu servidor, el código la crea sola
    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
    }
    
    // 3. Procesar la imagen que viene codificada desde el celular
    $foto_cruda = $_POST['foto_base64'];
    
    // Quitar el encabezado del formato base64 para dejar solo los datos de la imagen
    $foto_limpia = str_replace('data:image/png;base64,', '', $foto_cruda);
    $foto_limpia = str_replace(' ', '+', $foto_limpia);
    
    // Transformar el texto largo de nuevo a un archivo de imagen real (.png)
    $datos_binarios = base64_decode($foto_limpia);
    
    // 4. Crear un nombre único para que ninguna foto se borre ni se duplique (Ej: foto_20260901_173000.png)
    $nombre_archivo = $carpeta . 'foto_' . date('Ymd_His') . '.png';
    
    // 5. Meter el archivo final dentro de la carpeta 'foto'
    if (file_put_contents($nombre_archivo, $datos_binarios)) {
        echo "¡Excelente! Tu foto se guardó con éxito en la carpeta /foto";
    } else {
        echo "Error: El servidor no tiene permisos para escribir en la carpeta 'foto'.";
    }
    
} else {
    echo "Error: No se recibió ninguna imagen.";
}
?>
