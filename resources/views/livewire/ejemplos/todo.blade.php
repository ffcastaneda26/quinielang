<div>
    <td>{{ $task->id }}</td>
    <td>{{ $task->task }}</td>
    <td>{{ $task->finished ? 'Si' : 'No' }}</td>
    <td class="text-cener">
        <input type="checkbox"
                wire:model="status"
                wire:click="update_status({{ $task->id }})">
    </td>

</div>
