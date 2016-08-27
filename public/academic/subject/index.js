(function() {
  var subjectButtons, table, incr, index, trashedUsersButtons, trashedUsersTable;

  $('#subject-create-form, #subject-update-form').modal({
    show: false
  });

  $('form.ajax', '#subject-create-form, #subject-update-form').on('ajax.form.success', function(evt, data, textStatus, jqXHR) {
    $(this).trigger("reset");
    $(this).parents('.modal').modal('hide');
    $('select', this).trigger('change');
    return table.draw();
  });

  $('#subject-table').on('click', '.subject-update', function() {
    var $overlay, selectedRoles, that, url;
    that = this;
    selectedRoles = [];
    url = $(this).prop('href');
    $('form', '#subject-update-form')[0].reset();
    $('select', '#subject-update-form').trigger('change');
    $overlay = $('.overlay', '#subject-update-form');
    $('#subject-update-form').modal('show');
    $overlay.removeClass('hide');
    $.get(url, function(result) {
      $overlay.addClass('hide');
      $('form', '#subject-update-form').prop('action', "/admin/academic/subject/" + result.subject.id);
      $('input[name="code"]', '#subject-update-form').val(result.subject.code);
      $('input[name="name"]', '#subject-update-form').val(result.subject.name);
      $('select[name="type"]', '#subject-update-form').val(result.subject.type);
      $('select[name="group"]', '#subject-update-form').val(result.subject.group);
      $('input[name="sks_tm"]', '#subject-update-form').val(result.subject.sks_tm);
      $('input[name="sks_p"]', '#subject-update-form').val(result.subject.sks_p);
      $('input[name="sks_pl"]', '#subject-update-form').val(result.subject.sks_pl);
      $('input[name="sks_s"]', '#subject-update-form').val(result.subject.sks_s);
      $('select[name="program_id"]', '#subject-update-form').empty().append('<option value="'+ result.program.id +'">' + result.program.name + '</option>').val(result.program.id).trigger('change');
      return $('select', '#subject-update-form').trigger('change');
    });
    return false;
  });

  table = $('#subject-table').DataTable({
    order: [[1, "asc"]],
    columns: [
      {
        "name": "id"
      },{
        "name": "code"
      }, {
        "name": "name"
      }, {
        "name": "type"
      },{
        "name": "`group`"
      },{
        "name": "program"
      },{
        "name": "sks"
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
        targets: 7,
        searchable: false,
        sortable: false,
        render: function(data, type, row, meta) {
          var rendered, token;
          rendered = '<div class="text-right">';
          token = $('meta[name="csrf-token"]').attr('content');
          if ($.inArray('update', data) !== -1) {
            rendered += "<a href=\"/admin/academic/subject/" + row[0] + "/edit\" class=\"btn btn-default btn-sm subject-update\"><i class=\"fa fa-pencil\"></i></a>";
          }
          rendered += '</div>';
          return rendered;
        }
      }
    ],
    ajax: {
      url: 'admin/academic/subject/datatables',
    },
    buttons: true
  });

  subjectButtons = $('#subject-table').data('actions');

  incr = 2;

  index = $.inArray('delete', subjectButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      extend: 'bulk',
      method: 'delete',
      url: 'admin/academic/subject',
      text: '<i class="fa fa-trash"></i> Hapus',
      className: 'btn btn-sm btn-danger pull-right',
      formClass: 'undoable',
      formId: 'active-delete'
    });
  }

  incr = index;

  index = $.inArray('create', subjectButtons);

  if (index !== -1) {
    index += incr;
    table.button().add(index, {
      text: '<i class="fa fa-plus"></i> Tambah',
      url: 'admin/academic/subject/create',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.table().container();
        $('#subject-create-form').modal('show');
      }
    });
  }

}).call(this);

//# sourceMappingURL=index.js.map
