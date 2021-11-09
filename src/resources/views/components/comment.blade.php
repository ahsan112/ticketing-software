@props(['comment'])

<div class="text-sm">              
    <header class="mb-1">
        <p class=" font-semibold text-gray-900">{{ $comment->createdBy->name }} - <span class="text-sm font-normal text-gray-600">{{ $comment->created_at->diffForHumans() }}</span></p>
    </header>
    <p class=" text-gray-700 leading-snug">{{ $comment->body }}</p>
</div>