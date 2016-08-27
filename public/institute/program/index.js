(function() {
  var programButtons, table, incr, index, trashedUsersButtons, trashedUsersTable;

  $('#program-create-form, #program-update-form').modal({
    show: false
  });

  $('form.ajax', '#program-create-form, #program-update-form').on('ajax.form.success', function(evt, data, textStatus, jqXHR) {
    $(this).trigger("reset");
    $(this).parents('.modal').modal('hide');
    $('select', this).trigger('change');
    return table.draw();
  });

  $('#program-table').on('click', '.program-update', function() {
    var $overlay, selectedRoles, that, url;
    that = this;
    selectedRoles = [];
    url = $(this).prop('href');
    $('form', '#program-update-form')[0].reset();
    $('select', '#program-update-form').trigger('change');
    $overlay = $('.overlay', '#program-update-form');
    $('#program-update-form').modal('show');
    $overlay.removeClass('hide');
    $.get(url, function(result) {
      $overlay.addClass('hide');
      $('form', '#program-update-form').prop('action', "/admin/institute/program/" + result.program.id);
      $('input[name="name"]', '#program-update-form').val(result.program.name);
      $('input[name="code"]', '#program-update-form').val(result.program.code);
      $('select[name="department_id"]', '#program-update-form').empty().append('<option value="'+ result.department.id +'">' + result.department.name + '</option>').val(result.department.id).trigger('change');
      return $('select', '#program-update-form').trigger('change');
    });
    return false;
  });

  table = $('#program-table').DataTable({
    order: [[2, "asc"]],
    columns: [
      {
        "name": "id"
      }, {
        "name": "code"
      }, {
        "name": "name"
      }, {
        "name": "department"
      }, {
        "name": "faculty"
      },{
        "name": "created_at"
      }, {
        "name": "actions"
      }
    ],
    columnDefs: [
      {
        targets: 0,
        sortable: false,
        searchable: false
      }, {
        targets: 5,
        render: function(data, type, row, meta) {
          return moment(data).format('LL');
        }
      }, {
        targets: 6,
        searchable: false,
        sortable: false,
        render: function(data, type, row, meta) {
          var rendered, token;
          rendered = '<div class="text-right">';
          token = $('meta[name="csrf-token"]').attr('content');
          if ($.inArray('update', data) !== -1) {
            rendered += "<a href=\"/admin/institute/program/" + row[0] + "/edit\" class=\"btn btn-default btn-sm program-update\"><i class=\"fa fa-pencil\"></i></a>";
          }
          rendered += '</div>';
          return rendered;
        }
      }
    ],
    ajax: {
      url: 'admin/institute/program/datatables',
    },
    buttons: true
  });

  programButtons = $('#program-table').data('actions');

  incr = 2;

  index = $.inArray('delete', programButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      extend: 'bulk',
      method: 'delete',
      url: 'admin/institute/program',
      text: '<i class="fa fa-trash"></i> Hapus',
      className: 'btn btn-sm btn-danger pull-right',
      formClass: 'undoable',
      formId: 'active-delete'
    });
  }

  incr = index;

  index = $.inArray('create', programButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      text: '<i class="fa fa-plus"></i> Tambah',
      url: 'admin/institute/program/create',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.table().container();
        $('#program-create-form').modal('show');
      }
    });
  }

}).call(this);

//# sourceMappingURL=index.js.map
