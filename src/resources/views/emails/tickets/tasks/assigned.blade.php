<div>
    <h3> You have been assigned a new Task on Ticket #{{ $task->ticket_id }} </h3>
    <p>Title: {{ $task->title }}</p>
    <p>Description: {{ $task->description }}</p>
    <p>Target Date: {{ $task->target_date?->diffForHumans() ?? 'Not Set' }}</p>
</div>