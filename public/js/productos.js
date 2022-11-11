$(function () {
  $(".btn-add").click(function () {
    $("#modalAdd").modal("show");
  });

  $(".btn-guardar").click(function () {
    var nombre = $("#nombreAdd").val();
    var referencia = $("#referenciaAdd").val();
    var precio = $("#precioAdd").val();
    var peso = $("#pesoAdd").val();
    var categoria = $("#categoriaAdd").val();
    var cantidad = $("#cantidadAdd").val();

    var data = {
      nombre: nombre,
      referencia: referencia,
      precio: precio,
      peso: peso,
      categoria: categoria,
      cantidad: cantidad,
      funcion: "agregarProducto",
    };

    if (!nombre.match(/^[a-zA-Z0-9\s]+$/) || nombre.trim().length == 0) {
      Swal.fire({
        title: "Alerta",
        text: "El nombre no puede estar vacío y solo puede contener letras y números",
        icon: "warning",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6",
      });
    } else if (!referencia.match(/^[0-9]+$/) || referencia <= 0) {
      Swal.fire({
        title: "Alerta",
        text: "La referencia tiene que ser mayor a 0 y solo puede contener números",
        icon: "warning",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6",
      });
    } else if (!precio.match(/^[0-9]+$/) || precio <= 0) {
      Swal.fire({
        title: "Alerta",
        text: "El precio tiene que ser mayor a 0 y solo puede contener números",
        icon: "warning",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6",
      });
    } else if (!peso.match(/^[0-9]+$/) || peso <= 0) {
      Swal.fire({
        title: "Alerta",
        text: "El peso tiene que ser mayor a 0 y solo puede contener números",
        icon: "warning",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6",
      });
    } else if (!cantidad.match(/^[0-9]+$/) || cantidad <= 0) {
      Swal.fire({
        title: "Alerta",
        text: "La cantidad tiene que ser mayor a 0 y solo puede contener números",
        icon: "warning",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6",
      });
    } else {
      $.ajax({
        type: "POST",
        url: "class/ajax.php",
        data: {
          data: data,
        },
        success: function (data) {
          if (data == "ok") {
            Swal.fire({
              title: "Éxito",
              text: "El producto se ha agregado correctamente",
              icon: "success",
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#3085d6",
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            });
          } else {
            Swal.fire({
              title: "Error",
              text: "No se pudo agregar el producto",
              icon: "error",
              confirmButtonText: "Aceptar",
            });
          }
        },
        error: function (data) {
          console.log(data);
        },
      });
    }
  });

  $(".btn-delete").click(function () {
    Swal.fire({
      title: "¿Estás seguro?",
      text: "No podrás revertir esto",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        var id = $(this).data("id");
        var data = { id: id, funcion: "eliminarProducto" };
        $.ajax({
          type: "POST",
          url: "class/ajax.php",
          data: {
            data: data,
          },
          success: function (data) {
            if (data == "ok") {
              Swal.fire({
                title: "Éxito",
                text: "El producto se ha eliminado correctamente",
                icon: "success",
                confirmButtonText: "Aceptar",
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              });
            } else if (data == "con_ventas") {
              Swal.fire({
                title: "Error",
                text: "No se puede eliminar el producto porque tiene ventas asociadas",
                icon: "error",
                confirmButtonText: "Aceptar",
              });
            } else {
              Swal.fire({
                title: "Error",
                text: "No se pudo eliminar el producto",
                icon: "error",
                confirmButtonText: "Aceptar",
              });
            }
          },
          error: function (data) {
            console.log(data);
          },
        });
      }
    });
  });

  $(".btn-edit").click(function () {
    var id = $(this).data("id");
    var nombre = $(this).data("nombre");
    var referencia = $(this).data("ref");
    var precio = $(this).data("precio");
    var peso = $(this).data("peso");
    var categoria = $(this).data("cate");
    var cantidad = $(this).data("stock");
    $("#id").val(id);
    $("#nombreEdit").val(nombre);
    $("#referenciaEdit").val(referencia);
    $("#precioEdit").val(precio);
    $("#pesoEdit").val(peso);
    $("#categoriaEdit").val(categoria);
    $("#cantidadEdit").val(cantidad);
    $("#modalEdit").modal("show");
  });

  $(".btn-save-edit").click(function () {
    var id = $("#id").val();
    var nombre = $("#nombreEdit").val();
    var referencia = $("#referenciaEdit").val();
    var precio = $("#precioEdit").val();
    var peso = $("#pesoEdit").val();
    var categoria = $("#categoriaEdit").val();
    var cantidad = $("#cantidadEdit").val();

    var data = {
      id: id,
      nombre: nombre,
      referencia: referencia,
      precio: precio,
      peso: peso,
      categoria: categoria,
      cantidad: cantidad,
      funcion: "editarProducto",
    };

    if (!nombre.match(/^[a-zA-Z0-9\s]+$/) || nombre.trim().length == 0) {
      Swal.fire({
        title: "Alerta",
        text: "El nombre no puede estar vacío y solo puede contener letras y números",
        icon: "warning",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6",
      });
    } else if (!referencia.match(/^[0-9]+$/) || referencia <= 0) {
      Swal.fire({
        title: "Alerta",
        text: "La referencia tiene que ser mayor a 0 y solo puede contener números",
        icon: "warning",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6",
      });
    } else if (!precio.match(/^[0-9]+$/) || precio <= 0) {
      Swal.fire({
        title: "Alerta",
        text: "El precio tiene que ser mayor a 0 y solo puede contener números",
        icon: "warning",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6",
      });
    } else if (!peso.match(/^[0-9]+$/) || peso <= 0) {
      Swal.fire({
        title: "Alerta",
        text: "El peso tiene que ser mayor a 0 y solo puede contener números",
        icon: "warning",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6",
      });
    } else if (!cantidad.match(/^[0-9]+$/) || cantidad <= 0) {
      Swal.fire({
        title: "Alerta",
        text: "La cantidad tiene que ser mayor a 0 y solo puede contener números",
        icon: "warning",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6",
      });
    } else {
      $.ajax({
        type: "POST",
        url: "class/ajax.php",
        data: {
          data: data,
        },
        success: function (data) {
          if (data == "ok") {
            Swal.fire({
              title: "Éxito",
              text: "El producto se ha editado correctamente",
              icon: "success",
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#3085d6",
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            });
          } else {
            Swal.fire({
              title: "Error",
              text: "No se pudo editar el producto",
              icon: "error",
              confirmButtonText: "Aceptar",
            });
          }
        },
        error: function (data) {
          console.log(data);
        },
      });
    }
  });
});
