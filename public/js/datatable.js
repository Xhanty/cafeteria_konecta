var idioma = {
  sProcessing: "Procesando...",
  sLengthMenu: "Mostrar _MENU_ registros",
  sZeroRecords: "No se encontraron resultados",
  sEmptyTable: "Ningún dato disponible en esta tabla",
  sInfo:
    "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
  sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
  sInfoPostFix: "",
  sSearch: "Buscar:",
  sUrl: "",
  sInfoThousands: ",",
  sLoadingRecords: "Cargando...",
  oPaginate: {
    sFirst: "Primero",
    sLast: "Último",
    sNext: "Siguiente",
    sPrevious: "Anterior",
  },
  oAria: {
    sSortAscending: ": Activar para ordenar la columna de manera ascendente",
    sSortDescending: ": Activar para ordenar la columna de manera descendente",
  },
  buttons: {
    pageLength: {
      _: "Mostrar %d filas",
      "-1": "Mostrar Todo",
    },
  },
};

$(document).ready(function () {
  var table = $("#table").DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    language: idioma,
    lengthMenu: [
      [5, 10, 20, -1],
      [5, 10, 50, "Mostrar Todo"],
    ],
    dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',

    buttons: {
      dom: {
        container: {
          tag: "div",
          className: "flexcontent",
        },
        buttonLiner: {
          tag: null,
        },
      },

      buttons: [
        {
          text: '<i class="fa fa-plus"></i>Agregar',
          titleAttr: "Agregar",
          className: "btn btn-app add btn-add",
        },
        {
          extend: "excelHtml5",
          text: '<i class="fa fa-file-excel-o"></i>Excel',
          titleAttr: "Excel",
          className: "btn btn-app export excel",
        },
        {
          extend: "print",
          text: '<i class="fa fa-print"></i>Imprimir',
          titleAttr: "Imprimir",
          className: "btn btn-app export imprimir",
        },
        {
          extend: "pageLength",
          titleAttr: "Registros a mostrar",
          className: "selectTable",
        },
      ],
    },
  });
});
