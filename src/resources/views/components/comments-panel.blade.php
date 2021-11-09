@props(['add' => true, 'comments' => [], 'route' => ''])

<x-panel>
    <h3 class="text-lg font-medium leading-6 text-gray-900">Comments</h3>
    <hr class="my-4">
    <div class="mb-8 space-y-6">
        @foreach ($comments as $comment)
            <x-comment :comment="$comment"/>
        @endforeach
    </div>

    @if ($add)        
        <div class="-mb-6 -mx-6 bg-gray-50 text-right">
            <div class="px-6 py-6">
                    @error('body')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                    <textarea id="comment" name="body" rows="5" class="inline-flex  shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2 w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Add your comment here" required></textarea>
                    <x-button class="mt-2">Comment</x-button>
            </div>
        </div>
    @endif

</x-panel>