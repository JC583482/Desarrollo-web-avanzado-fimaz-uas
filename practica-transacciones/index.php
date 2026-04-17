<?php
$host = "localhost";
$db = "escuela";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$mensaje = "";
$detalle = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $apellido = trim($_POST["apellido"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $simularError = isset($_POST["simular_error"]);

    if ($nombre === "" || $apellido === "" || $correo === "") {
        $mensaje = "Todos los campos son obligatorios.";
    } else {
        try {
            $pdo->beginTransaction();

            $sqlAlumno = "INSERT INTO alumnos (nombre, apellido, correo) VALUES (:nombre, :apellido, :correo)";
            $stmtAlumno = $pdo->prepare($sqlAlumno);
            $stmtAlumno->execute([
                "nombre" => $nombre,
                "apellido" => $apellido,
                "correo" => $correo
            ]);

            $idAlumno = (int)$pdo->lastInsertId();

            if ($simularError) {
                throw new Exception("Error forzado: se ejecuta rollback.");
            } else {
                $sqlLog = "INSERT INTO logs_alumnos (idAlumno, accion) VALUES (:idAlumno, :accion)";
                $stmtLog = $pdo->prepare($sqlLog);
                $stmtLog->execute([
                    "idAlumno" => $idAlumno,
                    "accion" => "ALTA_ALUMNO"
                ]);
            }

            $pdo->commit();
            $mensaje = "Registro completado con éxito. ID: $idAlumno";

        } catch (Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $mensaje = "Error en el proceso. Los cambios han sido revertidos.";
            $detalle = $e->getMessage();
        }
    }
}

$alumnos = $pdo->query("SELECT * FROM alumnos ORDER BY idAlumno DESC")->fetchAll();
$logs = $pdo->query("SELECT * FROM logs_alumnos ORDER BY idLog DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transacciones PDO</title>
    <style>
        body{font-family: sans-serif; margin:20px; color: #333}
        .card{border:1px solid #ddd; padding:15px; margin-bottom:15px; border-radius:5px}
        .row{display:flex; gap:10px; margin-bottom:10px}
        label{display:block; font-weight:bold}
        input[type="text"], input[type="email"]{padding:5px; border:1px solid #ccc}
        button{background:#0056b7; color:white; border:0; padding:8px 15px; cursor:pointer}
        table{border-collapse:collapse; width:100%; margin-top:10px}
        th,td{border:1px solid #ddd; padding:8px; text-align:left}
        th{background:#eee}
        .error{color:red; font-size:0.9em}
    </style>
</head>
<body>
    <h2>Registro de Alumnos (Transacciones)</h2>

    <div class="card">
        <form method="POST">
            <div class="row">
                <div>
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
                </div>
                <div>
                    <label>Apellido</label>
                    <input type="text" name="apellido" value="<?= htmlspecialchars($_POST['apellido'] ?? '') ?>">
                </div>
                <div>
                    <label>Correo</label>
                    <input type="email" name="correo" value="<?= htmlspecialchars($_POST['correo'] ?? '') ?>">
                </div>
            </div>

            <p>
                <input type="checkbox" name="simular_error" id="sim" <?= isset($_POST['simular_error']) ? 'checked' : '' ?>>
                <label style="display:inline" for="sim">Simular error de sistema</label>
            </p>

            <button type="submit">Registrar</button>
        </form>
    </div>

    <?php if ($mensaje): ?>
        <div class="card">
            <p><strong><?= htmlspecialchars($mensaje) ?></strong></p>
            <?php if ($detalle): ?>
                <p class="error"><?= htmlspecialchars($detalle) ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <h3>Alumnos</h3>
        <table>
            <thead>
                <tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th></tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $a): ?>
                    <tr>
                        <td><?= $a['idAlumno'] ?></td>
                        <td><?= htmlspecialchars($a['nombre']) ?></td>
                        <td><?= htmlspecialchars($a['apellido']) ?></td>
                        <td><?= htmlspecialchars($a['correo']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3>Logs de Actividad</h3>
        <table>
            <thead>
                <tr><th>ID Log</th><th>ID Alumno</th><th>Acción</th><th>Fecha</th></tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $l): ?>
                    <tr>
                        <td><?= $l['idLog'] ?></td>
                        <td><?= $l['idAlumno'] ?></td>
                        <td><?= htmlspecialchars($l['accion']) ?></td>
                        <td><?= $l['fecha'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>