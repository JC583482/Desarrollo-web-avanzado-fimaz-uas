<?php

//Coronel Lopez Jesus Yibran

require_once 'autoload.php';
use controllers\ProductoController;
use models\Producto;

$controller = new ProductoController();
$mensaje = "";
$productoEditar = null;

$terminoBusqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

if (isset($_GET['eliminar'])) {
    $idEliminar = $_GET['eliminar'];
    if ($controller->eliminar($idEliminar)) {
        $mensaje = "Producto eliminado correctamente.";
    } else {
        $mensaje = "Error al eliminar el producto.";
    }
}

if (isset($_GET['editar'])) {
    $idEditar = $_GET['editar'];
    $productoEditar = $controller->obtenerPorId($idEditar);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = !empty($_POST['id']) ? $_POST['id'] : null;
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $existencia = (int) $_POST['existencia'];
    $precio = (float) $_POST['precio'];

    $producto = new Producto();
    if ($id) $producto->setId($id);
    $producto->setNombre($nombre);
    $producto->setDescripcion($descripcion);
    $producto->setExistencia($existencia);
    $producto->setPrecio($precio);

    if ($id) {
        if ($controller->actualizar($producto)) {
            $mensaje = "Producto actualizado correctamente.";
            $productoEditar = null;
        } else {
            $mensaje = "Error al actualizar el producto.";
        }
    } else {
        if ($controller->crear($producto)) {
            $mensaje = "Producto agregado correctamente.";
        } else {
            $mensaje = "Error al agregar el producto.";
        }
    }
}

if ($terminoBusqueda !== '') {
    $productos = $controller->buscar($terminoBusqueda);
} else {
    $productos = $controller->listar();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Productos - PHP PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">

    <h1 class="text-center mb-4">CRUD de Productos con PHP, PDO y POO</h1>

    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-info alert-dismissible fade show">
            <?php echo htmlspecialchars($mensaje); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <?php echo $productoEditar ? "Editar producto" : "Agregar producto"; ?>
        </div>
        <div class="card-body">
            <form method="POST" action="index.php">
                <input type="hidden" name="id" value="<?php echo $productoEditar['id'] ?? ''; ?>">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $productoEditar['nombre'] ?? ''; ?>" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="<?php echo $productoEditar['descripcion'] ?? ''; ?>" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Existencia</label>
                        <input type="number" name="existencia" class="form-control" value="<?php echo $productoEditar['existencia'] ?? ''; ?>" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" value="<?php echo $productoEditar['precio'] ?? ''; ?>" required>
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-success w-100">
                            <?php echo $productoEditar ? "Actualizar" : "Guardar"; ?>
                        </button>
                    </div>
                </div>
                <?php if ($productoEditar): ?>
                    <a href="index.php" class="btn btn-secondary btn-sm">Cancelar edición</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span>Lista de productos</span>
            <form method="GET" action="index.php" class="d-flex gap-2">
                <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar..." value="<?php echo htmlspecialchars($terminoBusqueda); ?>">
                <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                <?php if ($terminoBusqueda !== ''): ?>
                    <a href="index.php" class="btn btn-light btn-sm">Limpiar</a>
                <?php endif; ?>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Existencia</th>
                        <th>Precio</th>
                        <th width="150">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($productos) > 0): ?>
                        <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?php echo $p['id']; ?></td>
                            <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($p['descripcion']); ?></td>
                            <td><?php echo $p['existencia']; ?></td>
                            <td>$<?php echo number_format($p['precio'], 2); ?></td>
                            <td>
                                <a href="index.php?editar=<?php echo $p['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="index.php?eliminar=<?php echo $p['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Borrar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center">No hay productos.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>