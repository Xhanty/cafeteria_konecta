$(function () {
  $(".btn-add").click(function () {
    $("#modalAdd").modal("show");
  });

  $(".btn-guardar").click(function () {
    var nombre = $("#nombre").val();
    var data = { nombre: nombre, funcion: "agregarCategoria" };

    if (!nombre.match(/^[a-zA-Z0-9\s]+$/) || nombre.trim().length == 0) {
      Swal.fire({
        title: "Alerta",
        text: "El nombre no puede estar vacío y solo puede contener letras y números",
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
              text: "La categoría se agregó correctamente",
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
              text: "No se pudo agregar la categoría",
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
        var data = { id: id, funcion: "eliminarCategoria" };
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
                text: "La categoría se eliminó correctamente",
                icon: "success",
                confirmButtonText: "Aceptar",
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              });
            } else if (data == "con_productos") {
              Swal.fire({
                title: "Alerta",
                text: "No se puede eliminar la categoría porque tiene productos asociados",
                icon: "warning",
                confirmButtonText: "Aceptar",
              });
            } else {
              Swal.fire({
                title: "Error",
                text: "No se pudo eliminar la categoría",
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
    $("#modalEdit").modal("show");
    $("#id").val(id);
    $("#nombreEdit").val(nombre);
  });

  $(".btn-save-edit").click(function () {
    var id = $("#id").val();
    var nombre = $("#nombreEdit").val();
    var data = { id: id, nombre: nombre, funcion: "editarCategoria" };

    if (!nombre.match(/^[a-zA-Z0-9\s]+$/) || nombre.trim().length == 0) {
      Swal.fire({
        title: "Alerta",
        text: "El nombre no puede estar vacío y solo puede contener letras y números",
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
              text: "La categoría se editó correctamente",
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
              text: "No se pudo editar la categoría",
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
