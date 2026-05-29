<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once "../configuracion/database.php";
require_once "../clases/Productos.php";

$database = new Database();
$db = $database->getConnection();
$producto = new Productos($db);

$method = $_SERVER['REQUEST_METHOD'];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$pos = strpos($uri, 'api/');
if ($pos !== false) {
    $endpoint = substr($uri, $pos + 4);
} else {
    $endpoint = '';
}

$endpoint = trim($endpoint, '/');
$segments = explode('/', $endpoint);

if (empty($segments[0]) || $segments[0] !== 'productos') {
    http_response_code(404);
    echo json_encode(["message" => "Recurso no encontrado"]);
    exit;
}

if ($method === 'GET' && count($segments) === 1) {
    $stmt = $producto->getProductos();
    $total = $stmt->rowCount();

    if ($total > 0) {
        $productos = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $row;
        }

        http_response_code(200);
        echo json_encode($productos);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "No se encontraron productos"]);
    }
    exit;
}

if ($method === 'GET' && count($segments) === 2 && is_numeric($segments[1])) {
    $producto->idProducto = (int)$segments[1];

    if ($producto->getProducto()) {
        http_response_code(200);
        echo json_encode([
            "idProducto"      => $producto->idProducto,
            "nombreproducto"  => $producto->nombreproducto,
            "descripcion"     => $producto->descripcion,
            "precioCompra"    => $producto->precioCompra,
            "precioVenta"     => $producto->precioVenta,
            "existencia"      => $producto->existencia
        ]);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "Producto no encontrado"]);
    }
    exit;
}

if ($method === 'POST' && count($segments) === 1) {

    $data = json_decode(file_get_contents("php://input"));

    $errores = [];

    if (empty($data->nombreproducto)) {
        $errores[] = "El nombre del producto es obligatorio";
    }

    if (!isset($data->precioCompra) || $data->precioCompra < 0) {
        $errores[] = "El precio de compra no puede ser negativo";
    }

    if (!isset($data->precioVenta) || $data->precioVenta < 0) {
        $errores[] = "El precio de venta no puede ser negativo";
    }

    if (!isset($data->existencia) || $data->existencia < 0) {
        $errores[] = "La existencia no puede ser negativa";
    }

    if (isset($data->precioVenta, $data->precioCompra) &&
        $data->precioVenta < $data->precioCompra) {
        $errores[] = "El precio de venta no puede ser menor al de compra";
    }

    if (!empty($errores)) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "errores" => $errores
        ]);
        exit;
    }

    $producto->nombreproducto = $data->nombreproducto;
    $producto->descripcion    = $data->descripcion ?? '';
    $producto->precioCompra   = $data->precioCompra;
    $producto->precioVenta    = $data->precioVenta;
    $producto->existencia     = $data->existencia;

    if ($producto->setProductos()) {
        http_response_code(201);
        echo json_encode([
            "status"  => "success",
            "message" => "Producto creado correctamente"
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "status"  => "error",
            "message" => "Error al guardar"
        ]);
    }

    exit;
}

if ($method === 'PUT' && count($segments) === 2) {

    $data = json_decode(file_get_contents("php://input"));
    $producto->idProducto = (int)$segments[1];

    $errores = [];

    if (empty($data->nombreproducto)) {
        $errores[] = "El nombre es obligatorio";
    }

    if ($data->precioCompra < 0) {
        $errores[] = "Precio de compra inválido";
    }

    if ($data->precioVenta < 0) {
        $errores[] = "Precio de venta inválido";
    }

    if ($data->existencia < 0) {
        $errores[] = "Existencia inválida";
    }

    if ($data->precioVenta < $data->precioCompra) {
        $errores[] = "El precio de venta no puede ser menor al de compra";
    }

    if (!empty($errores)) {
        http_response_code(400);
        echo json_encode([
            "status"  => "error",
            "errores" => $errores
        ]);
        exit;
    }

    $producto->nombreproducto = $data->nombreproducto;
    $producto->descripcion    = $data->descripcion;
    $producto->precioCompra   = $data->precioCompra;
    $producto->precioVenta    = $data->precioVenta;
    $producto->existencia     = $data->existencia;

    if ($producto->updateProducto()) {
        echo json_encode(["status" => "success", "message" => "Actualizado"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al actualizar"]);
    }

    exit;
}

if ($method === 'DELETE' && count($segments) === 2 && is_numeric($segments[1])) {
    $producto->idProducto = (int)$segments[1];

    if ($producto->borrarProducto()) {
        http_response_code(200);
        echo json_encode(["message" => "Producto eliminado"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "No se pudo eliminar"]);
    }
    exit;
}

http_response_code(405);
echo json_encode(["message" => "Método no permitido o ruta inválida"]);

if ($method === 'POST' && count($segments) === 1) {

    $data = json_decode(file_get_contents("php://input"));

    $errores = [];

    if (empty($data->nombreproducto)) {
        $errores[] = "El nombre del producto es obligatorio";
    }

    if (!isset($data->precioCompra) || $data->precioCompra < 0) {
        $errores[] = "El precio de compra no puede ser negativo";
    }

    if (!isset($data->precioVenta) || $data->precioVenta < 0) {
        $errores[] = "El precio de venta no puede ser negativo";
    }

    if (!isset($data->existencia) || $data->existencia < 0) {
        $errores[] = "La existencia no puede ser negativa";
    }

    if (isset($data->precioVenta, $data->precioCompra) &&
        $data->precioVenta < $data->precioCompra) {
        $errores[] = "El precio de venta no puede ser menor al de compra";
    }

    if (!empty($errores)) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "errores" => $errores
        ]);
        exit;
    }

    $producto->nombreproducto = $data->nombreproducto;
    $producto->descripcion    = $data->descripcion ?? '';
    $producto->precioCompra   = $data->precioCompra;
    $producto->precioVenta    = $data->precioVenta;
    $producto->existencia     = $data->existencia;

    if ($producto->setProductos()) {
        http_response_code(201);
        echo json_encode([
            "status"  => "success",
            "message" => "Producto creado correctamente"
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "status"  => "error",
            "message" => "Error al guardar"
        ]);
    }

    exit;
}

if ($method === 'PUT' && count($segments) === 2) {

    $data = json_decode(file_get_contents("php://input"));
    $producto->idProducto = (int)$segments[1];

    $errores = [];

    if (empty($data->nombreproducto)) {
        $errores[] = "El nombre es obligatorio";
    }

    if ($data->precioCompra < 0) {
        $errores[] = "Precio de compra inválido";
    }

    if ($data->precioVenta < 0) {
        $errores[] = "Precio de venta inválido";
    }

    if ($data->existencia < 0) {
        $errores[] = "Existencia inválida";
    }

    if ($data->precioVenta < $data->precioCompra) {
        $errores[] = "El precio de venta no puede ser menor al de compra";
    }

    if (!empty($errores)) {
        http_response_code(400);
        echo json_encode([
            "status"  => "error",
            "errores" => $errores
        ]);
        exit;
    }

    $producto->nombreproducto = $data->nombreproducto;
    $producto->descripcion    = $data->descripcion;
    $producto->precioCompra   = $data->precioCompra;
    $producto->precioVenta    = $data->precioVenta;
    $producto->existencia     = $data->existencia;

    if ($producto->updateProducto()) {
        echo json_encode(["status" => "success", "message" => "Actualizado"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al actualizar"]);
    }

    exit;
}

if ($method === 'DELETE' && count($segments) === 2 && is_numeric($segments[1])) {
    $producto->idProducto = (int)$segments[1];

    if ($producto->borrarProducto()) {
        http_response_code(200);
        echo json_encode(["message" => "Producto eliminado"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "No se pudo eliminar"]);
    }
    exit;
}

http_response_code(405);
echo json_encode(["message" => "Método no permitido o ruta inválida"]);