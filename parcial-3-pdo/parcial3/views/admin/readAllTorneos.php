<?php
require_once("../admin/template/header.php");
require_once("../../controllers/torneosController.php");

$objTorneosController = new torneosController();

$rows = $objTorneosController->readTorneos();
?>

<div class="card text-center">
    <div class="card-header">LISTADO DE TORNEOS</div>
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">TORNEO</th>
                    <th scope="col">ORGANIZADOR</th>
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rows): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <th><?= $row['id'] ?></th>
                            <th><?= $row['nombreTorneo'] ?></th>
                            <th><?= $row['organizador'] ?></th>
                            <th>
                                ACCIONES: EDITAR, ELIMINAR.
                                <a href="readOneTorneos.php?id=<?= $row['id'] ?>" class="btn btn-primary">Consultar</a>
                                <a href="updateTorneo.php?id=<?= $row['id'] ?>" class="btn btn-success">Editar</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#idModal<?= $row['id'] ?>">
                                    Eliminar
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="idModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="modal<?= $row['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="Modal<?= $row['id'] ?>">¿Desea Eliminar el torneo?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Esta accion no se puede deshacer
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <a href="deleteTorneo.php?id=<?= $row['id'] ?>" class="btn btn-danger">Eliminar</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center"> No hay torneos aun.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>



<?php
require_once("../admin/template/footer.php");
?>