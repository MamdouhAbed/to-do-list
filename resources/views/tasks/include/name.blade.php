<span @if($tasks->end_date <= \Carbon\Carbon::today()->format("Y-m-d") && $tasks->status != 'completed') style="text-decoration: line-through;" @endif>{{$tasks->name }}</span>
