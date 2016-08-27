(function() {
  var facultyButtons, table, incr, index, trashedUsersButtons, trashedUsersTable;

  $('#faculty-create-form, #faculty-update-form').modal({
    show: false
  });

  $('form.ajax', '#faculty-create-form, #faculty-update-form').on('ajax.form.success', function(evt, data, textStatus, jqXHR) {
    $(this).trigger("reset");
    $(this).parents('.modal').modal('hide');
    $('select', this).trigger('change');
    return table.draw();
  });

  $('#faculty-table').on('click', '.faculty-update', function() {
    var $overlay, selectedRoles, that, url;
    that = this;
    selectedRoles = [];
    url = $(this).prop('href');
    $('form', '#faculty-update-form')[0].reset();
    $('select', '#faculty-update-form').trigger('change');
    $overlay = $('.overlay', '#faculty-update-form');
    $('#faculty-update-form').modal('show');
    $overlay.removeClass('hide');
    $.get(url, function(result) {
      $overlay.addClass('hide');
      $('form', '#faculty-update-form').prop('action', "/admin/institute/faculty/" + result.faculty.id);
      $('input[name="name"]', '#faculty-update-form').val(result.faculty.name);
      $('input[name="code"]', '#faculty-update-form').val(result.faculty.code);
      return $('select', '#faculty-update-form').trigger('change');
    });
    return false;
  });

  table = $('#faculty-table').DataTable({
    order: [[2, "asc"]],
    columns: [
      {
        "name": "id"
      }, {
        "name": "code"
      }, {
        "name": "name"
      }, {
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
        targets: 3,
        render: function(data, type, row, meta) {
          return moment(data).format('LL');
        }
      }, {
        targets: 4,
        searchable: false,
        sortable: false,
        render: function(data, type, row, meta) {
          var rendered, token;
          rendered = '<div class="text-right">';
          token = $('meta[name="csrf-token"]').attr('content');
          if ($.inArray('update', data) !== -1) {
            rendered += "<a href=\"/admin/institute/faculty/" + row[0] + "/edit\" class=\"btn btn-default btn-sm faculty-update\"><i class=\"fa fa-pencil\"></i></a>";
          }
          rendered += '</div>';
          return rendered;
        }
      }
    ],
    ajax: {
      url: 'admin/institute/faculty/datatables',
    },
    buttons: true
  });

  facultyButtons = $('#faculty-table').data('actions');

  incr = 2;

  index = $.inArray('delete', facultyButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      extend: 'bulk',
      method: 'delete',
      url: 'admin/institute/faculty',
      text: '<i class="fa fa-trash"></i> Hapus',
      className: 'btn btn-sm btn-danger pull-right',
      formClass: 'undoable',
      formId: 'active-delete'
    });
  }

  incr = index;

  index = $.inArray('create', facultyButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      text: '<i class="fa fa-plus"></i> Tambah',
      url: 'admin/institute/faculty/create',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.table().container();
        $('#faculty-create-form').modal('show');
      }
    });
  }

}).call(this);

//# sourceMappingURL=index.js.map
