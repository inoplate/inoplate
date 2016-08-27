(function() {
  var districtButtons, table, incr, index, trashedUsersButtons, trashedUsersTable;

  $('#sub-district-create-form, #sub-district-update-form').modal({
    show: false
  });

  $('form.ajax', '#sub-district-create-form, #sub-district-update-form').on('ajax.form.success', function(evt, data, textStatus, jqXHR) {
    $(this).trigger("reset");
    $(this).parents('.modal').modal('hide');
    $('select', this).trigger('change');
    return table.draw();
  });

  $('#sub-district-table').on('click', '.district-update', function() {
    var $overlay, selectedRoles, that, url;
    that = this;
    selectedRoles = [];
    url = $(this).prop('href');
    $('form', '#sub-district-update-form')[0].reset();
    $('select', '#sub-district-update-form').trigger('change');
    $overlay = $('.overlay', '#sub-district-update-form');
    $('#sub-district-update-form').modal('show');
    $overlay.removeClass('hide');
    $.get(url, function(result) {
      $overlay.addClass('hide');
      $('form', '#sub-district-update-form').prop('action', "/admin/master/sub-district/" + result.subDistrict.id);
      $('input[name="name"]', '#sub-district-update-form').val(result.subDistrict.name);
      $('select[name="district_id"]', '#sub-district-update-form').empty().append('<option value="'+ result.district.id +'">' + result.district.name + '</option>').val(result.district.id).trigger('change');
      return $('select', '#sub-district-update-form').trigger('change');
    });
    return false;
  });

  table = $('#sub-district-table').DataTable({
    order: [[1, "asc"]],
    columns: [
      {
        "name": "id"
      }, {
        "name": "name"
      }, {
        "name": "district"
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
            rendered += "<a href=\"/admin/master/sub-district/" + row[0] + "/edit\" class=\"btn btn-default btn-sm district-update\"><i class=\"fa fa-pencil\"></i></a>";
          }
          rendered += '</div>';
          return rendered;
        }
      }
    ],
    ajax: {
      url: 'admin/master/sub-district/datatables',
    },
    buttons: true
  });

  districtButtons = $('#sub-district-table').data('actions');

  incr = 2;

  index = $.inArray('delete', districtButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      extend: 'bulk',
      method: 'delete',
      url: 'admin/master/sub-district',
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
      url: 'admin/master/sub-district/create',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.table().container();
        $('#sub-district-create-form').modal('show');
      }
    });
  }

}).call(this);

//# sourceMappingURL=index.js.map
