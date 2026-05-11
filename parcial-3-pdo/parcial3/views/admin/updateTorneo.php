<?php
require_once("../admin/template/header.php");
require_once("../../controllers/torneosController.php");

$objTorneosController = new torneosController();

$rows = $objTorneosController->readTorneos();

$lstTorneos = $objTorneosController->readOneTorneos($_GET['id']);
?>

<div class="mx-auto p-5">
    <div class="card">
        <div class="card-header">
            INFORMACION DEL TORNEO.
        </div>
        <div class="card-body">
            <form action="torneoUpdate.php" method="post">

                <div class="mb-3">
                    <label for="id" class="form-label">ID DEL TORNEO</label>
                    <input type="text" class="form-control" name="txtid" id="id" value="<?= $lstTorneos['id'] ?>" >
                </div>
                <div class="mb-3">
                    <label for="nombreTorneo" class="form-label">NOMBRE DEL TORNEO (ID: <?= $lstTorneos['id'] ?>)</label>
                    <input type="text" class="form-control" name="txtNombreTorneo" id="nombreTorneo" value="<?= $lstTorneos['nombreTorneo'] ?>" >
                </div>
                <div class="mb-3">
                    <label for="organizador" class="form-label">ORGANIZADOR (nombre completo)</label>
                    <input type="text" name="txtOrganizador" id="organizador" class="form-control" value="<?= $lstTorneos['organizador'] ?>" >
                </div>
                <div class="mb-3">
                    <label for="patrocinador" class="form-label">PATROCINADOR(ES)</label>
                    <textarea name="txtPatrocinador" id="patrocinador" cols="30" rows="2"
                        class="form-control" > <?= $lstTorneos['patrocinadores'] ?>  </textarea>
                </div>
                <span class="form-text">
                    se puede separar con "," si hay mas de un patrocinador
                </span>
                <div class="row">
                    <div class="mb-3">
                        <label for="sede" class="form-label">SEDE(cancha)</label>
                        <input type="text" name="txtSede" id="sede" class="form-control" value="<?= $lstTorneos['sede'] ?>" >
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">CATEGORIA</label>
                        <input list="lstCategorias" name="txtCategoria" id="categoria" class="form-control" value="<?= $lstTorneos['categoria'] ?>" >

                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="premio1" class="form-label">PREMIO 1ER. LUGAR</label>
                        <input type="text" name="txtPremio1" id="premio1" class="form-control" value="<?= $lstTorneos['premio1'] ?>" >
                    </div>
                    <div class="col mb-3">
                        <label for="premio2" class="form-label">PREMIO 2DO. LUGAR</label>
                        <input type="text" name="txtPremio2" id="premio2" class="form-control" value="<?= $lstTorneos['premio2'] ?>" >
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="premio3" class="form-label">PREMIO 3ER. LUGAR</label>
                        <input type="text" name="txtPremio3" id="premio3" class="form-control" value="<?= $lstTorneos['premio3'] ?>" >
                    </div>
                    <div class="col mb-3">
                        <label for="otroPremio" class="form-label">OTRO PREMIO (CAMPEON CANASTERO)</label>
                        <input type="text" name="txtOtroPremio" id="otroPremio" class="form-control" value="<?= $lstTorneos['otroPremio'] ?>" >
                    </div>
                </div>


                <div class="col mb-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="admin.php" class="btn btn-danger">Cancelar</a>
                </div>

            </form>
        </div>
        <div class="card-footer text-body-secondary">
            DETALLES TORNEO
        </div>
    </div>

</div>

<?php
require_once("../admin/template/footer.php");
?>