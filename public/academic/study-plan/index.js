(function() {
  var assignedStudentButtons, assTable, unAssTable, incr, index, trashedUsersButtons, trashedUsersTable;

  assTable = $('#assigned-student-table').DataTable({
    order: [[2, "asc"]],
    columns: [
      {
        "name": "id"
      },{
        "name": "student_reg_no"
      }, {
        "name": "student_name"
      }
    ],
    columnDefs: [
      {
        targets: 0,
        sortable: false,
        searchable: false
      }
    ],
    ajax: {
      url: 'admin/academic/study-plan/assigned-student',
      data: function(d) {
        d.class_id = $('select[name="class_id"]').val();
      }
    },
    buttons: true
  });

  assignedStudentButtons = $('#assigned-student-table').data('actions');

  incr = 2;

  index = $.inArray('map', assignedStudentButtons);

  if (index !== -1) {
    index += incr;
    assTable.button().add(index, {
      text: '<i class="fa fa-reply"></i> Detach',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.assTable().container();
        $('#assigned-student-create-form').modal('show');
      }
    });
  }

  unAssTable = $('#unassigned-student-table').DataTable({
    order: [[2, "asc"]],
    columns: [
      {
        "name": "id"
      },{
        "name": "student_reg_no"
      }, {
        "name": "student_name"
      }
    ],
    columnDefs: [
      {
        targets: 0,
        sortable: false,
        searchable: false
      }
    ],
    ajax: {
      url: 'admin/academic/study-plan/unassigned-student',
      data: function(d) {
        d.academic_year_id = $('select[name="academic_year_id"]').val();
      }
    },
    buttons: true
  });

  unAssignedStudentButtons = $('#unassigned-student-table').data('actions');

  incr = 2;

  index = $.inArray('map', unAssignedStudentButtons);

  if (index !== -1) {
    index += incr;
    unAssTable.button().add(index, {
      text: '<i class="fa fa-share"></i> Attach',
      className: 'btn btn-sm btn-primary pull-right',
      init: function(dt, button, config) {
        return $(button.prop("href", config.url));
      },
      action: function(e, dt, node, config) {
        var container;
        container = dt.unAssTable().container();
        $('#assigned-student-create-form').modal('show');
      }
    });
  }

}).call(this);

//# sourceMappingURL=index.js.map
