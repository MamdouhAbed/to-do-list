@if($tasks->status!='completed')
<a  href="javascript:void(0);" data-id="{{ $tasks->id }}" onclick="return update_task('{{$tasks->id}}');" class="update_task"><span class="icon la la-edit" title="تحرير" style="font-size: 20px;"></span></a>
@endif
<a href="javascript:void(0);" class="text-danger btndelete" onclick="return delete_task('{{$tasks->id}}');"><span class="icon la la-trash-o" title="حذف" style="font-size: 20px;"></span></a>
@if($tasks->status!='completed' && $tasks->end_date > \Carbon\Carbon::today()->format("Y-m-d"))
<a  href="javascript:void(0);" data-id="{{ $tasks->id }}" onclick="return complete_task('{{$tasks->id}}');" class="complete_task"><span class="icon la la-check" title="اكتمال المهمة" style="font-size: 20px;color: green"></span></a>
@endif