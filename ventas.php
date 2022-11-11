<?php
include 'class/assets/header.php';
require_once("class/class.php");

$instancia = new Trabajo();
$ventas = $instancia->consultaVentas();
$productos = $instancia->consultaProductos();
?>

<body class="mt-6">
    <?php include 'class/assets/navbar.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="titulo-tabla">Ventas</h3>
                <table id="table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($ventas as $result) {
                            echo "<tr>
                                    <td>" . $result->PRODUCTO . "</td>
                                    <td>" . $result->CANTIDAD . "</td>
                                    <td>" . $result->DATE . "</td>
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
                    <h5 class="modal-title" id="modalAddLabel">Agregar Venta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Producto</label>
                            <select class="form-control" id="productoAdd">
                                <?php
                                foreach ($productos as $result) {
                                    echo "<option value='" . $result->ID . "'>" . $result->NOMBRE . ' - (' . $result->STOCK  . ")</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cantidad</label>
                            <input type="text" class="form-control" id="cantidadAdd" aria-describedby="nombreHelp">
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

    <?php include 'class/assets/scripts.php'; ?>
    <script src="public/js/ventas.js"></script>
</body>

</html>