(function() {
  var classButtons, table, incr, index, trashedUsersButtons, trashedUsersTable;

  $('#class-create-form, #class-update-form').modal({
    show: false
  });

  $('form.ajax', '#class-create-form, #class-update-form').on('ajax.form.success', function(evt, data, textStatus, jqXHR) {
    $(this).trigger("reset");
    $(this).parents('.modal').modal('hide');
    $('select', this).trigger('change');
    return table.draw();
  });

  $('#class-table').on('click', '.class-update', function() {
    var $overlay, selectedRoles, that, url;
    that = this;
    selectedRoles = [];
    url = $(this).prop('href');
    $('form', '#class-update-form')[0].reset();
    $('select', '#class-update-form').trigger('change');
    $overlay = $('.overlay', '#class-update-form');
    $('#class-update-form').modal('show');
    $overlay.removeClass('hide');
    $.get(url, function(result) {
      $overlay.addClass('hide');
      $('form', '#class-update-form').prop('action', "/admin/academic/class/" + result.class.id);
      $('input[name="code"]', '#class-update-form').val(result.class.code);
      $('input[name="name"]', '#class-update-form').val(result.class.name);
      $('select[name="subject_id"]', '#class-update-form').empty().append('<option value="'+ result.subject.id +'">' + result.subject.name + '</option>').val(result.subject.id).trigger('change');
      $('select[name="lecturer_id"]', '#class-update-form').empty().append('<option value="'+ result.lecturer.id +'">' + result.lecturer.name + '</option>').val(result.lecturer.id).trigger('change');
      $('select[name="academic_year_id"]', '#class-update-form').empty().append('<option value="'+ result.academicYear.id +'">' + result.academicYear.name + '</option>').val(result.academicYear.id).trigger('change');
      return $('select', '#class-update-form').trigger('change');
    });
    return false;
  });

  table = $('#class-table').DataTable({
    order: [[1, "asc"]],
    columns: [
      {
        "name": "id"
      },{
        "name": "code"
      }, {
        "name": "name"
      }, {
        "name": "subject"
      }, {
        "name": "lecturer"
      }, {
        "name": "academic_year"
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
        targets: 6,
        searchable: false,
        sortable: false,
        render: function(data, type, row, meta) {
          var rendered, token;
          rendered = '<div class="text-right">';
          token = $('meta[name="csrf-token"]').attr('content');
          if ($.inArray('update', data) !== -1) {
            rendered += "<a href=\"/admin/academic/class/" + row[0] + "/edit\" class=\"btn btn-default btn-sm class-update\"><i class=\"fa fa-pencil\"></i></a>";
          }
          rendered += '</div>';
          return rendered;
        }
      }
    ],
    ajax: {
      url: 'admin/academic/class/datatables',
    },
    buttons: true
  });

  classButtons = $('#class-table').data('actions');

  incr = 2;

  index = $.inArray('delete', classButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      extend: 'bulk',
      method: 'delete',
      url: 'admin/academic/class',
      text: '<i class="fa fa-trash"></i> Hapus',
      className: 'btn btn-sm btn-danger pull-right',
      formClass: 'undoable',
      formId: 'active-delete'
    });
  }

  incr = index;

  index = $.inArray('create', classButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      text: '<i class="fa fa-plus"></i> Tambah',
      url: 'admin/academic/class/create',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.table().container();
        $('#class-create-form').modal('show');
      }
    });
  }

}).call(this);

//# sourceMappingURL=index.js.map
