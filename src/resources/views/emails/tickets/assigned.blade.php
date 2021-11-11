<div>
    <h3> You have been assigned a new Ticket #{{ $ticket->id }} </h3>
    <p>Title: {{ $ticket->title }}</p>
    <p>Description: {{ $ticket->description }}</p>
    <p>Priority: {{ $ticket->priority?->name ?? 'Not Set' }}</p>
    <p>Target Date: {{ $ticket->target_date?->diffForHumans() ?? 'Not Set' }}</p>
</div>