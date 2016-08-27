(function() {
  var lecturerButtons, table, incr, index;

  $('#lecturer-import-form').modal({
    show: false
  });

  $('form.ajax', '#lecturer-import-form').on('ajax.form.success', function(evt, data, textStatus, jqXHR) {
    $(this).trigger("reset");
    $(this).parents('.modal').modal('hide');
    $('select', this).trigger('change');
    return table.draw();
  });

  table = $('#lecturer-table').DataTable({
    order: [[2, "asc"]],
    columns: [
      {
        "name": "id"
      }, {
        "name": "reg_no"
      },  {
        "name": "local_reg_no"
      }, {
        "name": "name"
      },{
        "name": "actions"
      }
    ],
    columnDefs: [
      {
        targets: 0,
        sortable: false,
        searchable: false
      }, {
        targets: 4,
        searchable: false,
        sortable: false,
        render: function(data, type, row, meta) {
          var rendered, token;
          rendered = '<div class="text-right">';
          token = $('meta[name="csrf-token"]').attr('content');
          if ($.inArray('update', data) !== -1) {
            rendered += "<a href=\"/admin/employee/lecturer/" + row[0] + "/edit\" class=\"btn btn-default btn-sm lecturer-update\"><i class=\"fa fa-pencil\"></i></a>";
          }
          rendered += '</div>';
          return rendered;
        }
      }
    ],
    ajax: {
      url: 'admin/employee/lecturer/datatables',
      data: function(d) {
        d.program_id = $('select[name="program"]').val();
        d.entry_year = $('select[name="entry_year"]').val();
        d.status = $('select[name="status"]').val();
      }
    },
    buttons: true
  });

  lecturerButtons = $('#lecturer-table').data('actions');

  incr = 2;

  index = $.inArray('delete', lecturerButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      extend: 'bulk',
      method: 'delete',
      url: 'admin/employee/lecturer',
      text: '<i class="fa fa-trash"></i> Hapus',
      className: 'btn btn-sm btn-danger pull-right',
      formClass: 'undoable',
      formId: 'active-delete'
    });
  }

  incr = index;

  index = $.inArray('create', lecturerButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      text: '<i class="fa fa-plus"></i> Tambah',
      url: 'admin/employee/lecturer/create',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        window.location = config.url;
      }
    });

    index += incr;
    table.button().add(index, {
      text: '<i class="fa fa-cloud-upload"></i> Import',
      url: '#',
      className: 'btn btn-sm btn-success pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.table().container();
        $('#lecturer-import-form').modal('show');
      }
    });
  }

}).call(this);

//# sourceMappingURL=index.js.map
