<?php
include 'class/assets/header.php';
require_once("class/class.php");

$instancia = new Trabajo();
$productos = $instancia->consultaProductos();
$categorias = $instancia->consultaCategorias();
?>

<body class="mt-6">
  <?php include 'class/assets/navbar.php'; ?>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="titulo-tabla">Productos</h3>
        <table id="table" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Referencia</th>
              <th>Precio</th>
              <th>Categoria</th>
              <th>Cantidad</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($productos as $result) {
              echo "<tr>
                  <td>" . $result->NOMBRE . "</td>
                  <td>" . $result->REFERENCIA . "</td>
                  <td>" . $result->PRECIO . "</td>
                  <td>" . $result->CATEGORIA . "</td>
                  <td>" . $result->STOCK . "</td>
                  <td><a href='#' 
                  data-id='" . $result->ID . "' data-nombre='" . $result->NOMBRE . "' data-ref='" . $result->REFERENCIA . "' data-precio='" . $result->PRECIO . "'
                  data-peso='" . $result->PESO . "' data-cate='" . $result->ID_CATEGORIA . "' data-stock='" . $result->STOCK . "' class='btn-edit'><i class='fa fa-pencil'></i></a>
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
          <h5 class="modal-title" id="modalAddLabel">Agregar Producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre</label>
              <input type="text" class="form-control" id="nombreAdd" aria-describedby="nombreHelp">
              <small id="nombreHelp" class="form-text text-muted">Recuerda no incluir carácteres especiales.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Referencia</label>
              <input type="number" class="form-control" id="referenciaAdd" aria-describedby="nombreHelp">
              <small id="nombreHelp" class="form-text text-muted">Recuerda no incluir carácteres especiales.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Precio</label>
              <input type="number" class="form-control" id="precioAdd" aria-describedby="nombreHelp">
              <small id="nombreHelp" class="form-text text-muted">Precio COP.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Peso</label>
              <input type="number" class="form-control" id="pesoAdd" aria-describedby="nombreHelp">
              <small id="nombreHelp" class="form-text text-muted">Peso en Kg.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Categoría</label>
              <select class="form-control" id="categoriaAdd">
                <?php
                foreach ($categorias as $result) {
                  echo "<option value='" . $result->ID . "'>" . $result->NOMBRE . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Cantidad</label>
              <input type="number" class="form-control" id="cantidadAdd" aria-describedby="nombreHelp">
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
            <input type="hidden" disabled id="id">
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre</label>
              <input type="text" class="form-control" id="nombreEdit" aria-describedby="nombreHelp">
              <small id="nombreHelp" class="form-text text-muted">Recuerda no incluir carácteres especiales.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Referencia</label>
              <input type="number" class="form-control" id="referenciaEdit" aria-describedby="nombreHelp">
              <small id="nombreHelp" class="form-text text-muted">Recuerda no incluir carácteres especiales.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Precio</label>
              <input type="number" class="form-control" id="precioEdit" aria-describedby="nombreHelp">
              <small id="nombreHelp" class="form-text text-muted">Precio COP.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Peso</label>
              <input type="number" class="form-control" id="pesoEdit" aria-describedby="nombreHelp">
              <small id="nombreHelp" class="form-text text-muted">Peso en Kg.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Categoría</label>
              <select class="form-control" id="categoriaEdit">
                <?php
                foreach ($categorias as $result) {
                  echo "<option value='" . $result->ID . "'>" . $result->NOMBRE . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Cantidad</label>
              <input type="number" class="form-control" id="cantidadEdit" aria-describedby="nombreHelp">
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
  <script src="public/js/productos.js"></script>
</body>

</html>