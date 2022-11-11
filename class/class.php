<?php
include "config/conexion.php";
// ERRORES NO VISIBLES AL USUARIO, SINO AL DESARROLLADOR
error_reporting(1);
// IGNORA EL LIMITE DE TIEMPO DE CARGA DEL SERVIDOR Y PERMITE TENER CONTINUIDAD EN LA CARGA DEL SERVIDOR
set_time_limit(0);

// CLASE "TRABAJO"
class Trabajo
{
    private $db;
    private $dbname;

    public function __construct()
    {
        $conn = new Conexion();
        $this->dbname = $this->conn->dbname;
        $this->db = $conn->getConexion();
    }

    public function consultaProductos() // Metodo para Consultar en la Tabla PRODUCTOS
    {
        $sql = "SELECT productos.*, categorias.NOMBRE AS CATEGORIA FROM productos JOIN categorias ON productos.ID_CATEGORIA = categorias.ID";
        $result = $this->db->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function consultaCategorias() // Metodo para Consultar en la Tabla CATEGORIAS
    {
        $sql = "SELECT * FROM categorias";
        $result = $this->db->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function agregarCategoria($data) // Metodo para Agregar en la Tabla CATEGORIAS
    {
        $sql = "INSERT INTO categorias (NOMBRE) VALUES (:nombre)";
        $result = $this->db->prepare($sql);
        $result->bindParam(":nombre", $data['nombre']);
        $result->execute();
        return "ok";
    }

    public function editarCategoria($data) // Metodo para Editar en la Tabla CATEGORIAS
    {
        $sql = "UPDATE categorias SET NOMBRE = :nombre WHERE ID = :id";
        $result = $this->db->prepare($sql);
        $result->bindParam(":nombre", $data['nombre']);
        $result->bindParam(":id", $data['id']);
        $result->execute();
        return "ok";
    }

    public function validarCategoriaEliminar($id) // Metodo para Validar en la Tabla CATEGORIAS
    {
        $sql = "SELECT categorias.ID  FROM categorias JOIN productos ON categorias.ID = productos.ID_CATEGORIA WHERE categorias.ID = :id";
        $result = $this->db->prepare($sql);
        $result->bindParam(":id", $id);
        $result->execute();
        return $result->fetch(PDO::FETCH_OBJ);
    }

    public function eliminarCategoria($data) // Metodo para Eliminar en la Tabla CATEGORIAS
    {
        $validCategoria = $this->validarCategoriaEliminar($data['id']);
        if ($validCategoria->ID > 0) {
            return "con_productos";
        } else {
            $sql = "DELETE FROM categorias WHERE ID = :id";
            $result = $this->db->prepare($sql);
            $result->bindParam(":id", $data['id']);
            $result->execute();
            return "ok";
        }
    }

    public function agregarProducto($data) // Metodo para Agregar en la Tabla PRODUCTOS
    {
        $sql = "INSERT INTO productos (NOMBRE, REFERENCIA, PRECIO, PESO, ID_CATEGORIA, STOCK) VALUES (:nombre, :referencia, :precio, :peso, :id_categoria, :stock)";
        $result = $this->db->prepare($sql);
        $result->bindParam(":nombre", $data['nombre']);
        $result->bindParam(":referencia", $data['referencia']);
        $result->bindParam(":precio", $data['precio']);
        $result->bindParam(":peso", $data['peso']);
        $result->bindParam(":id_categoria", $data['categoria']);
        $result->bindParam(":stock", $data['cantidad']);
        $result->execute();
        return "ok";
    }

    public function editarProducto($data) // Metodo para Editar en la Tabla PRODUCTOS
    {
        $sql = "UPDATE productos SET NOMBRE = :nombre, REFERENCIA = :referencia, PRECIO = :precio, PESO = :peso, ID_CATEGORIA = :id_categoria, STOCK = :stock WHERE ID = :id";
        $result = $this->db->prepare($sql);
        $result->bindParam(":nombre", $data['nombre']);
        $result->bindParam(":referencia", $data['referencia']);
        $result->bindParam(":precio", $data['precio']);
        $result->bindParam(":peso", $data['peso']);
        $result->bindParam(":id_categoria", $data['categoria']);
        $result->bindParam(":stock", $data['cantidad']);
        $result->bindParam(":id", $data['id']);
        $result->execute();
        return "ok";
    }

    public function validarProductoEliminar($id) // Metodo para Validar en la Tabla CATEGORIAS
    {
        $sql = "SELECT productos.ID  FROM productos JOIN ventas ON productos.ID = ventas.ID_PRODUCTO WHERE productos.ID = :id";
        $result = $this->db->prepare($sql);
        $result->bindParam(":id", $id);
        $result->execute();
        return $result->fetch(PDO::FETCH_OBJ);
    }

    public function eliminarProducto($data) // Metodo para Eliminar en la Tabla PRODUCTOS
    {
        $validProducto = $this->validarProductoEliminar($data['id']);
        if ($validProducto->ID > 0) {
            return "con_ventas";
        } else {
            $sql = "DELETE FROM productos WHERE ID = :id";
            $result = $this->db->prepare($sql);
            $result->bindParam(":id", $data['id']);
            $result->execute();
            return "ok";
        }
    }

    public function consultaVentas() // Metodo para Consultar en la Tabla VENTAS
    {
        $sql = "SELECT SUM(ventas.CANTIDAD) AS CANTIDAD, productos.NOMBRE AS PRODUCTO, ventas.DATE FROM ventas JOIN productos ON ventas.ID_PRODUCTO = productos.ID GROUP BY ventas.DATE, ventas.ID_PRODUCTO";
        $result = $this->db->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function validarCantidadProducto($id) // Metodo para Validar la Cantidad de Productos
    {
        $sql = "SELECT stock FROM productos WHERE ID = :id";
        $result = $this->db->prepare($sql);
        $result->bindParam(":id", $id);
        $result->execute();
        return $result->fetch(PDO::FETCH_OBJ);
    }

    public function restarStockProducto($id, $cantidad) // Metodo para Restar el Stock de los Productos
    {
        $sql = "UPDATE productos SET STOCK = STOCK - :cantidad WHERE ID = :id";
        $result = $this->db->prepare($sql);
        $result->bindParam(":cantidad", $cantidad);
        $result->bindParam(":id", $id);
        $result->execute();
        return "ok";
    }

    public function agregarVenta($data) // Metodo para Agregar en la Tabla VENTAS
    {
        $validCantidad = $this->validarCantidadProducto($data['producto']);

        if ($validCantidad->stock >= $data['cantidad']) {
            $sql = "INSERT INTO ventas (ID_PRODUCTO, CANTIDAD) VALUES (:id_producto, :cantidad)";
            $result = $this->db->prepare($sql);
            $result->bindParam(":id_producto", $data['producto']);
            $result->bindParam(":cantidad", $data['cantidad']);
            $result->execute();

            $this->restarStockProducto($data['producto'], $data['cantidad']);

            return "ok";
        } else {
            return "no_disponible";
        }
    }
}
