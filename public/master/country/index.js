(function() {
  var countryButtons, table, incr, index, trashedUsersButtons, trashedUsersTable;

  $('#country-create-form, #country-update-form').modal({
    show: false
  });

  $('form.ajax', '#country-create-form, #country-update-form').on('ajax.form.success', function(evt, data, textStatus, jqXHR) {
    $(this).trigger("reset");
    $(this).parents('.modal').modal('hide');
    $('select', this).trigger('change');
    return table.draw();
  });

  $('#country-table').on('click', '.country-update', function() {
    var $overlay, selectedRoles, that, url;
    that = this;
    selectedRoles = [];
    url = $(this).prop('href');
    $('form', '#country-update-form')[0].reset();
    $('select', '#country-update-form').trigger('change');
    $overlay = $('.overlay', '#country-update-form');
    $('#country-update-form').modal('show');
    $overlay.removeClass('hide');
    $.get(url, function(result) {
      $overlay.addClass('hide');
      $('form', '#country-update-form').prop('action', "/admin/master/country/" + result.country.id);
      $('input[name="name"]', '#country-update-form').val(result.country.name);
      return $('select', '#country-update-form').trigger('change');
    });
    return false;
  });

  table = $('#country-table').DataTable({
    order: [[1, "asc"]],
    columns: [
      {
        "name": "id"
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
        targets: 2,
        render: function(data, type, row, meta) {
          return moment(data).format('LL');
        }
      }, {
        targets: 3,
        searchable: false,
        sortable: false,
        render: function(data, type, row, meta) {
          var rendered, token;
          rendered = '<div class="text-right">';
          token = $('meta[name="csrf-token"]').attr('content');
          if ($.inArray('update', data) !== -1) {
            rendered += "<a href=\"/admin/master/country/" + row[0] + "/edit\" class=\"btn btn-default btn-sm country-update\"><i class=\"fa fa-pencil\"></i></a>";
          }
          rendered += '</div>';
          return rendered;
        }
      }
    ],
    ajax: {
      url: 'admin/master/country/datatables',
    },
    buttons: true
  });

  countryButtons = $('#country-table').data('actions');

  incr = 2;

  index = $.inArray('delete', countryButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      extend: 'bulk',
      method: 'delete',
      url: 'admin/master/country',
      text: '<i class="fa fa-trash"></i> Hapus',
      className: 'btn btn-sm btn-danger pull-right',
      formClass: 'undoable',
      formId: 'active-delete'
    });
  }

  incr = index;

  index = $.inArray('create', countryButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      text: '<i class="fa fa-plus"></i> Tambah',
      url: 'admin/master/country/create',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.table().container();
        $('#country-create-form').modal('show');
      }
    });
  }

}).call(this);

//# sourceMappingURL=index.js.map
