<div>
    {{-- Be like water. --}}

    <ul wire:sortable="updateTaskOrder">
        @foreach ($tasks as $task)
            <li wire:sortable.item="{{ $task['id'] }}" wire:key="task-{{ $task['id'] }}">
                <h4 wire:sortable.handle>{{ $task['title'] }}</h4>
{{--                <button wire:click="removeTask({{$task['id'] }})">Remove</button>--}}
            </li>
        @endforeach
    </ul>
</div>
