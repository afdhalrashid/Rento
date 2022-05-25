@method('PUT')
{{-- <input type="hidden" name="user_id" value="{{$todos->id}}"> --}}

@if (isset($todos))
    <input type="hidden" name="todoTitle_id" value="{{ $todos->id }}">

    @foreach ($todos->tasks as $todo)
        <input type="hidden" name="task[{{ $loop->index }}][todo_id]" value="{{ $todo->id }}">

        <div class="row">
            <div class="col-1 my-auto mx-0">
                <input type="checkbox" name="task[{{ $loop->index }}][completed]" id="completed" class="completed"
                    value="1" title="Complete Task" @if ($todo->completed) checked @endif>
            </div>
            <div class="col-8">
                <input type="text" class="form-control tasks" id="tasks" name="task[{{ $loop->index }}][tasks]" @if ($todo->tasks !== null) disabled @endif
                    value="{!! $todo->tasks ?? '' !!}" placeholder="Tambah sub-tugasan">
            </div>
            <div class="col-1 my-auto mx-0">
                <a href="#" class="fas fa-edit" title="Edit"></a>
            </div>

            <div class="col-1 my-auto mx-0">
                @if (!$loop->first)
                    <a href="#" class="far fa-trash-alt" title="Delete" data-taskId="{{ $todo->id }}"></a>
                @endif
            </div>

            @if ($loop->first)
                <div class="col-1 my-auto mx-0">
                    <a href="#" class="fas fa-plus-circle" title="Add"></a>
                </div>
            @endif
        </div>
    @endforeach
@else
    <div class="row">
        <input type="hidden" name="todo_id" class="todo_id" value="T0001">
        <div class="col-1 my-auto mx-0">
            <input type="checkbox" name="task[][completed]" id="completed" class="completed" value="1"
                title="Complete Task">
        </div>
        <div class="col-8">
            <input type="text" class="form-control tasks" id="tasks" name="task[][tasks]"
                placeholder="Tambah sub-tugasan">
        </div>
        <div class="col-1 my-auto mx-0">
            <a href="#" class="fas fa-edit" title="Edit"></a>
        </div>
        <div class="col-1 my-auto mx-0">
            {{-- <a href="#" class="far fa-trash-alt" title="Delete" data-taskId=""></a> --}}
        </div>

        @if ($add)
            <div class="col-1 my-auto mx-0">
                <a href="#" class="fas fa-plus-circle"></a>
            </div>
        @endif
    </div>
@endif
