<div class="izi-modal"
     data-iziModal-fullscreen="true"
     data-iziModal-title=""
     data-iziModal-icon=""
     data-iziModal-padding="20"
     data-iziModal-autoopen="false"
     data-iziModal-headercolor="#4e7ea3"
     id="ajax-task-modal">

    <form class="" id="taskForm" name="taskForm">
        <input type="hidden" name="task_id" id="task_id">
        <div class="form-group">
            <label>المهمة</label>
            <input type="text"
                   id="name"
                   class="form-control"
                   required=""
                   placeholder="أدخل المهمة"
                   data-validation="required"
                   data-validation-error-msg-required="هذا الحقل مطلوب"
                   name="name">
        </div>
        <div class="form-group">
            <label>الوصف</label>
            <input type="text"
                   id="description"
                   class="form-control"
                   placeholder="أدخل وصف"
                   name="description">
        </div>
        <div class="row" style="margin-bottom: 0">
            <div class="form-group col-lg-6">
                <label>تاريخ بداية المهمة</label>
                <input class="form-control flatpickr"
                       data-validation="required"
                       data-validation-error-msg-required="هذا الحقل مطلوب"
                       id="start_date" name="start_date" value="">
            </div>
            <div class="form-group col-lg-6">
                <label>تاريخ نهاية المهمة</label>
                <input class="form-control flatpickr"
                       data-validation="required"
                       data-validation-error-msg-required="هذا الحقل مطلوب"
                       id="end_date" name="end_date" value="">
            </div>
        </div>
        <style>
            select.form-control:not([size]):not([multiple]){
                padding-top: 5px;
            }
        </style>


        <div class="form-group">
            <button type="submit" class="btn btn-primary" id="btn-save" value="create">حفظ</button>
            <button class="btn btn-primary-outline light" data-izimodal-close >إلغاء الأمر</button>
        </div>
    </form>

</div>

<script type="application/javascript">
    @if (session()->has('success'))
                   setTimeout(function () {
        new Noty({
            text: 'تمت العملية بنجاح',
            type: 'information',
            theme: 'mint',
            layout: 'topLeft',
            timeout: 3000
        }).show();
    }, 1500);
    @endif
</script>