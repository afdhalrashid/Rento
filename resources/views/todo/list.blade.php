@foreach($todoLists as $key => $todo)
<div class="task high">
    <div class="desc">
        <div class="title"><a href="" class="editTask" id="{{$todo->id}}">{{$todo->title}}</a></div>
        <div>
            {!!Str::words($todo->tasks ?? "No task added", 5, ' ...')!!}
            {{-- {!! nl2br($todo->tasks ?? "No task added") !!} --}}
        </div>
    </div>
    <div class="time">
        <div class="date">Date created: {{\Carbon\carbon::parse($todo->created_at)->format('d M Y')}}</div>
        <div class="date">
            Dateline: {{ ($todo->dateline !== '0000-00-00 00:00:00' && $todo->dateline !== NULL) ? \Carbon\carbon::parse($todo->dateline)->format('d M Y') : "-"}}</div>
        {{-- <?php
        $date_created = \Carbon\carbon::parse($todo->created_at);  
        $today = \Carbon\carbon::now('ASIA/KUALA_LUMPUR');
        $date_difference = $today->diffInDays($date_created);    
        ?> --}}
        {{-- <div>Status: {{($todo->completed) ? 'Completed' : 'Pending'}}</div> --}}
        {{-- <div>{{$date_difference}} day(s)</div> --}}
        <div style="margin: 0 auto;">
            @if(array_key_exists($todo->id, $status))
                {{-- <span class="badge badge-pill {{(array_key_exists('pending', $status[$todo->id])) ? "badge-warning" :  "badge-success"}}">
                    {{$status[$todo->id]['pending'] ?? 0}} Not Complete
                </span> --}}
                <span class="badge badge-pill badge-warning">
                    {{$status[$todo->id]['pending'] ?? 0}} Not Complete
                </span>

                <span class="badge badge-pill badge-success">
                    {{$status[$todo->id]['completed'] ?? 0}} Complete
                </span>
            @endif
        </div>
        {{-- <div>{{$status[$todo->id]['completed'] ?? 0}} Completed</div> --}}
        <div style="font-size: 14px"><a href="/todos/{{$todo->id}}?delete='title'" class="far fa-trash-alt" data-taskId="{{$todo->id}}"></a></div>
    </div>
</div>
@endforeach

<div class="task high">
    {{$todoLists->links()}}
</div>
