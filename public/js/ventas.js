$(function () {
  $(".btn-add").click(function () {
    $("#modalAdd").modal("show");
  });

  $(".btn-guardar").click(function () {
    var producto = $("#productoAdd").val();
    var cantidad = $("#cantidadAdd").val();

    var data = {
      producto: producto,
      cantidad: cantidad,
      funcion: "agregarVenta",
    };

    if (!cantidad.match(/^[0-9]+$/) || cantidad <= 0) {
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
              text: "Se ha agregado la venta correctamente",
              icon: "success",
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#3085d6",
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            });
          } else if (data == "no_disponible") {
            Swal.fire({
              title: "Alerta",
              text: "No hay suficientes productos disponibles",
              icon: "warning",
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#3085d6",
            });
          } else {
            Swal.fire({
              title: "Error",
              text: "No se pudo agregar la venta",
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
