(function() {
  var academicYearButtons, table, incr, index, trashedUsersButtons, trashedUsersTable;

  $('#academic-year-create-form, #academic-year-update-form').modal({
    show: false
  });

  $('form.ajax', '#academic-year-create-form, #academic-year-update-form').on('ajax.form.success', function(evt, data, textStatus, jqXHR) {
    $(this).trigger("reset");
    $(this).parents('.modal').modal('hide');
    $('select', this).trigger('change');
    return table.draw();
  });

  $('#academic-year-table').on('click', '.academic-year-update', function() {
    var $overlay, selectedRoles, that, url;
    that = this;
    selectedRoles = [];
    url = $(this).prop('href');
    $('form', '#academic-year-update-form')[0].reset();
    $('select', '#academic-year-update-form').trigger('change');
    $overlay = $('.overlay', '#academic-year-update-form');
    $('#academic-year-update-form').modal('show');
    $overlay.removeClass('hide');
    $.get(url, function(result) {
      $overlay.addClass('hide');
      $('form', '#academic-year-update-form').prop('action', "/admin/institute/academic-year/" + result.academicYear.id);
      $('input[name="name"]', '#academic-year-update-form').val(result.academicYear.name);
      $('input[name="code"]', '#academic-year-update-form').val(result.academicYear.code);
      return $('select', '#academic-year-update-form').trigger('change');
    });
    return false;
  });

  table = $('#academic-year-table').DataTable({
    order: [[3, "desc"]],
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
            rendered += "<a href=\"/admin/institute/academic-year/" + row[0] + "/edit\" class=\"btn btn-default btn-sm academic-year-update\"><i class=\"fa fa-pencil\"></i></a>";
          }
          rendered += '</div>';
          return rendered;
        }
      }
    ],
    ajax: {
      url: 'admin/institute/academic-year/datatables',
    },
    buttons: true
  });

  academicYearButtons = $('#academic-year-table').data('actions');

  incr = 2;

  index = $.inArray('delete', academicYearButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      extend: 'bulk',
      method: 'delete',
      url: 'admin/institute/academic-year',
      text: '<i class="fa fa-trash"></i> Hapus',
      className: 'btn btn-sm btn-danger pull-right',
      formClass: 'undoable',
      formId: 'active-delete'
    });
  }

  incr = index;

  index = $.inArray('create', academicYearButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      text: '<i class="fa fa-plus"></i> Tambah',
      url: 'admin/institute/academic-year/create',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.table().container();
        $('#academic-year-create-form').modal('show');
      }
    });
  }

}).call(this);

//# sourceMappingURL=index.js.map
