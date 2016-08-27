(function() {
  var districtButtons, table, incr, index, trashedUsersButtons, trashedUsersTable;

  $('#district-create-form, #district-update-form').modal({
    show: false
  });

  $('form.ajax', '#district-create-form, #district-update-form').on('ajax.form.success', function(evt, data, textStatus, jqXHR) {
    $(this).trigger("reset");
    $(this).parents('.modal').modal('hide');
    $('select', this).trigger('change');
    return table.draw();
  });

  $('#district-table').on('click', '.district-update', function() {
    var $overlay, selectedRoles, that, url;
    that = this;
    selectedRoles = [];
    url = $(this).prop('href');
    $('form', '#district-update-form')[0].reset();
    $('select', '#district-update-form').trigger('change');
    $overlay = $('.overlay', '#district-update-form');
    $('#district-update-form').modal('show');
    $overlay.removeClass('hide');
    $.get(url, function(result) {
      $overlay.addClass('hide');
      $('form', '#district-update-form').prop('action', "/admin/master/district/" + result.district.id);
      $('input[name="name"]', '#district-update-form').val(result.district.name);
      $('select[name="province_id"]', '#district-update-form').empty().append('<option value="'+ result.province.id +'">' + result.province.name + '</option>').val(result.province.id).trigger('change');
      return $('select', '#district-update-form').trigger('change');
    });
    return false;
  });

  table = $('#district-table').DataTable({
    order: [[1, "asc"]],
    columns: [
      {
        "name": "id"
      }, {
        "name": "name"
      }, {
        "name": "province"
      }, {
        "name": "country"
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
            rendered += "<a href=\"/admin/master/district/" + row[0] + "/edit\" class=\"btn btn-default btn-sm district-update\"><i class=\"fa fa-pencil\"></i></a>";
          }
          rendered += '</div>';
          return rendered;
        }
      }
    ],
    ajax: {
      url: 'admin/master/district/datatables',
    },
    buttons: true
  });

  districtButtons = $('#district-table').data('actions');

  incr = 2;

  index = $.inArray('delete', districtButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      extend: 'bulk',
      method: 'delete',
      url: 'admin/master/district',
      text: '<i class="fa fa-trash"></i> Hapus',
      className: 'btn btn-sm btn-danger pull-right',
      formClass: 'undoable',
      formId: 'active-delete'
    });
  }

  incr = index;

  index = $.inArray('create', districtButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      text: '<i class="fa fa-plus"></i> Tambah',
      url: 'admin/master/district/create',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.table().container();
        $('#district-create-form').modal('show');
      }
    });
  }

}).call(this);

//# sourceMappingURL=index.js.map
