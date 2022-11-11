<?php
include 'class/assets/header.php';
require_once("class/class.php");

$instancia = new Trabajo();
$categorias = $instancia->consultaCategorias();
?>

<body class="mt-6">
    <?php include 'class/assets/navbar.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="titulo-tabla">Categorías</h3>
                <table id="table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($categorias as $result) {
                            echo "<tr>
                                    <td>" . $result->NOMBRE . "</td>
                                    <td>" . $result->DATE . "</td>
                                    <td>
                                    <a href='#' data-id='" . $result->ID . "' data-nombre='" . $result->NOMBRE . "' class='btn-edit'><i class='fa fa-pencil'></i></a>
                                    &nbsp&nbsp
                                    <a data-id='" . $result->ID . "' href='#' class='btn-delete'><i class='fa fa-trash'></i></a></td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Agregar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input type="text" class="form-control" id="nombre" aria-describedby="nombreHelp">
                            <small id="nombreHelp" class="form-text text-muted">Recuerda no incluir carácteres especiales.</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Editar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="hidden" disabled id="id">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input type="text" class="form-control" id="nombreEdit" aria-describedby="nombreHelp">
                            <small id="nombreHelp" class="form-text text-muted">Recuerda no incluir carácteres especiales.</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-save-edit">Modificar</button>
                </div>
            </div>
        </div>
    </div>
    <?php include 'class/assets/scripts.php'; ?>
    <script src="public/js/categorias.js"></script>
</body>

</html>