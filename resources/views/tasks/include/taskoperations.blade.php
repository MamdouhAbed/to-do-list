<script>
    var SITEURL = '{{URL::to('')}}';
    /*  When click add task */
    $('#create-new-task').click(function () {
        $('#btn-save').val("create-task");
        $('#task_id').val('');
        $('#taskForm').trigger("reset");
        $('#ajax-task-modal').iziModal('open');
        $('#ajax-task-modal').iziModal('setTitle', 'إضافة مهمة');
        $('#ajax-task-modal').iziModal('setIcon', 'la la-plus');

    });
    /* When click edit task */
    $('#ajax-task-modal').iziModal();
    function update_task(task_id) {
        $.get('tasks/' + task_id +'/edit', function (data) {
            $('#name-error').hide();
            $('#btn-save').val("update_task");
            $('#ajax-task-modal').iziModal('open');
            $('#ajax-task-modal').iziModal('setTitle', 'تعديل بيانات المهمة');
            $('#ajax-task-modal').iziModal('setIcon', 'la la-edit');
            $('#task_id').val(data.id);
            $('#name').val(data.name);
            $('#description').val(data.description);
            $('#start_date').val(data.start_date);
            $('#end_date').val(data.end_date);
        })
    }


    if ($("#taskForm").length > 0) {
        $("#taskForm").validate({
            submitHandler: function(form) {
                var actionType = $('#btn-save').val();
                $('#btn-save').html('جاري الحفظ..');

                $.ajax({
                    data: $('#taskForm').serialize(),
                    url: SITEURL + "/tasks/store",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#taskForm').trigger("reset");
                        $('#ajax-task-modal').iziModal('close');
                        $('#btn-save').html('حفظ');
                        swal({
                            title: "تمت العملية بنجاح!",
                            type: "success",
                            confirmButtonClass: 'btn-success',
                            confirmButtonText: "تم "
                        });

                        var oTable = $('#datatable').dataTable();
                        oTable.fnDraw(false);

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#btn-save').html('حفظ');
                        swal({
                            title: "خطأ!",
                            text: "لم تتم العملية!",
                            type: "error",
                            confirmButtonClass: 'btn-danger',
                            confirmButtonText: "موافق "
                        });
                    }
                });
            }
        })
    }
    /* When click complete task */
    function complete_task(task_id) {

        swal({
                    title: "هل أنت متأكد من اكتمال المهمة؟",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: 'btn-warning',
                    confirmButtonText: '!نعم، المهمة اكتملت',
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    cancelButtonText: "ليس الآن"
                },
                function() {
                    $.ajax({
                        type: "get",
                        url: SITEURL + "/tasks/complete/" + task_id,
                        success: function (data) {
                            swal({
                                title: "تم انجاز المهمة بنجاح!",
                                text: "",
                                type: "success",
                                confirmButtonClass: 'btn-success',
                                confirmButtonText: "تم "
                            });
                            var oTable = $('#datatable').dataTable();
                            oTable.fnDraw(false);
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            swal({
                                title: "خطأ!",
                                text: "لم يتم انجاز المهمة!",
                                type: "error",
                                confirmButtonClass: 'btn-danger',
                                confirmButtonText: "موافق "
                            });
                        }
                    });
                });
    }
    /* When click delete task */
    function delete_task(task_id) {

        swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف المهمة!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-warning',
                confirmButtonText: '!نعم، احذف',
                closeOnConfirm: false,
                closeOnCancel: true,
                cancelButtonText: "ليس الآن"
            },
            function() {
                $.ajax({
                    type: "DELETE",
                    url: SITEURL + "/tasks/" + task_id ,
                    success: function (data) {
                        swal({
                            title: "تم حذف المهمة بنجاح!",
                            text: "",
                            type: "success",
                            confirmButtonClass: 'btn-success',
                            confirmButtonText: "تم "
                        });
                        var oTable = $('#datatable').dataTable();
                        oTable.fnDraw(false);

                    },

                    error: function (data) {
                        console.log('Error:', data);
                        swal({
                            title: "خطأ!",
                            text: "لم يتم حذف المهمة!",
                            type: "error",
                            confirmButtonClass: 'btn-danger',
                            confirmButtonText: "موافق "
                        });
                    }
                });
            });
    }



</script>
