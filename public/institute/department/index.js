(function() {
  var departmentButtons, table, incr, index, trashedUsersButtons, trashedUsersTable;

  $('#department-create-form, #department-update-form').modal({
    show: false
  });

  $('form.ajax', '#department-create-form, #department-update-form').on('ajax.form.success', function(evt, data, textStatus, jqXHR) {
    $(this).trigger("reset");
    $(this).parents('.modal').modal('hide');
    $('select', this).trigger('change');
    return table.draw();
  });

  $('#department-table').on('click', '.department-update', function() {
    var $overlay, selectedRoles, that, url;
    that = this;
    selectedRoles = [];
    url = $(this).prop('href');
    $('form', '#department-update-form')[0].reset();
    $('select', '#department-update-form').trigger('change');
    $overlay = $('.overlay', '#department-update-form');
    $('#department-update-form').modal('show');
    $overlay.removeClass('hide');
    $.get(url, function(result) {
      $overlay.addClass('hide');
      $('form', '#department-update-form').prop('action', "/admin/institute/department/" + result.department.id);
      $('input[name="name"]', '#department-update-form').val(result.department.name);
      $('input[name="code"]', '#department-update-form').val(result.department.code);
      $('select[name="faculty_id"]', '#department-update-form').empty().append('<option value="'+ result.faculty.id +'">' + result.faculty.name + '</option>').val(result.faculty.id).trigger('change');
      return $('select', '#department-update-form').trigger('change');
    });
    return false;
  });

  table = $('#department-table').DataTable({
    order: [[2, "asc"]],
    columns: [
      {
        "name": "id"
      }, {
        "name": "code"
      }, {
        "name": "name"
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
        targets: 4,
        render: function(data, type, row, meta) {
          return moment(data).format('LL');
        }
      }, {
        targets: 5,
        searchable: false,
        sortable: false,
        render: function(data, type, row, meta) {
          var rendered, token;
          rendered = '<div class="text-right">';
          token = $('meta[name="csrf-token"]').attr('content');
          if ($.inArray('update', data) !== -1) {
            rendered += "<a href=\"/admin/institute/department/" + row[0] + "/edit\" class=\"btn btn-default btn-sm department-update\"><i class=\"fa fa-pencil\"></i></a>";
          }
          rendered += '</div>';
          return rendered;
        }
      }
    ],
    ajax: {
      url: 'admin/institute/department/datatables',
    },
    buttons: true
  });

  departmentButtons = $('#department-table').data('actions');

  incr = 2;

  index = $.inArray('delete', departmentButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      extend: 'bulk',
      method: 'delete',
      url: 'admin/institute/department',
      text: '<i class="fa fa-trash"></i> Hapus',
      className: 'btn btn-sm btn-danger pull-right',
      formClass: 'undoable',
      formId: 'active-delete'
    });
  }

  incr = index;

  index = $.inArray('create', departmentButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      text: '<i class="fa fa-plus"></i> Tambah',
      url: 'admin/institute/department/create',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.table().container();
        $('#department-create-form').modal('show');
      }
    });
  }

}).call(this);

//# sourceMappingURL=index.js.map
