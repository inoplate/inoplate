(function() {
  var provinceButtons, table, incr, index, trashedUsersButtons, trashedUsersTable;

  $('#province-create-form, #province-update-form').modal({
    show: false
  });

  $('form.ajax', '#province-create-form, #province-update-form').on('ajax.form.success', function(evt, data, textStatus, jqXHR) {
    $(this).trigger("reset");
    $(this).parents('.modal').modal('hide');
    $('select', this).trigger('change');
    return table.draw();
  });

  $('#province-table').on('click', '.province-update', function() {
    var $overlay, selectedRoles, that, url;
    that = this;
    selectedRoles = [];
    url = $(this).prop('href');
    $('form', '#province-update-form')[0].reset();
    $('select', '#province-update-form').trigger('change');
    $overlay = $('.overlay', '#province-update-form');
    $('#province-update-form').modal('show');
    $overlay.removeClass('hide');
    $.get(url, function(result) {
      $overlay.addClass('hide');
      $('form', '#province-update-form').prop('action', "/admin/master/province/" + result.province.id);
      $('input[name="name"]', '#province-update-form').val(result.province.name);
      $('select[name="country_id"]', '#province-update-form').empty().append('<option value="'+ result.country.id +'">' + result.country.name + '</option>').val(result.country.id).trigger('change');
      return $('select', '#province-update-form').trigger('change');
    });
    return false;
  });

  table = $('#province-table').DataTable({
    order: [[1, "asc"]],
    columns: [
      {
        "name": "id"
      }, {
        "name": "name"
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
            rendered += "<a href=\"/admin/master/province/" + row[0] + "/edit\" class=\"btn btn-default btn-sm province-update\"><i class=\"fa fa-pencil\"></i></a>";
          }
          rendered += '</div>';
          return rendered;
        }
      }
    ],
    ajax: {
      url: 'admin/master/province/datatables',
    },
    buttons: true
  });

  provinceButtons = $('#province-table').data('actions');

  incr = 2;

  index = $.inArray('delete', provinceButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      extend: 'bulk',
      method: 'delete',
      url: 'admin/master/province',
      text: '<i class="fa fa-trash"></i> Hapus',
      className: 'btn btn-sm btn-danger pull-right',
      formClass: 'undoable',
      formId: 'active-delete'
    });
  }

  incr = index;

  index = $.inArray('create', provinceButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      text: '<i class="fa fa-plus"></i> Tambah',
      url: 'admin/master/province/create',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.table().container();
        $('#province-create-form').modal('show');
      }
    });
  }

}).call(this);

//# sourceMappingURL=index.js.map
