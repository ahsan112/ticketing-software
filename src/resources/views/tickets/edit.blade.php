<x-app-layout> 
    <x-container>
        @if ($ticket->rejected())
            <div class="mb-8">
                <x-alert-danger>
                    <x-slot name="title">Rejected!</x-slot>
                    this ticket has been rejected.
                </x-alert-danger>
            </div>
            
        @endif
        @if (is_null($ticket->accepted))
            <div class="grid grid-cols-3 gap-6 mb-16">
                <div class="col-span-2">
                    <x-alert-warning>
                        <x-slot name="title">Pending</x-slot>
                        this ticket is waiting to be accepted.
                    </x-alert-warning>
                </div>
                <div class="col-span-1">
                    <div class="flex flex-col space-y-2">
                        <form method="POST" action="{{ route('ticket.reject', $ticket) }}">
                            @csrf
                            <x-button class=" w-full bg-red-900 justify-center">reject</x-button>
                        </form>
                        <form method="POST" action="{{ route('ticket.accept', $ticket) }}">
                            @csrf
                            <x-button class="w-full justify-center">accept</x-button>
                        </form>
                    </div>
                </div>
            </div>
        @endif 

        <form method="POST" action="{{ route('tickets.update', $ticket) }}">
            @csrf
            @method('PUT')
            <x-header-section>
                <x-slot name="heading">
                    {{ $ticket->title }}
                </x-slot>
                <x-slot name="subHeading">
                    {{ 'Created on ' . $ticket->created_at->toFormattedDateString() }}
                </x-slot>
            </x-header-section>

            <div class="grid sm:grid-cols-3 sm:gap-6 sm:mt-6 mt-12">
                <div class="col-span-1 sm:col-span-2">
                    <x-panel class="h-full">
                        <x-form-group>
                            <x-slot name="heading">Title</x-slot>
                            <x-slot name="description">
                                This information will be displayed publicly so be careful what you share.
                            </x-slot>
                            <x-input id="title" class="block mt-2 w-full"
                                    type="text"
                                    name="title"
                                    value="{{ old('title', $ticket->title) }}"
                                    required 
                            />
                        </x-form-group>
                        <x-form-group class="mt-12">
                            <x-slot name="heading">Description</x-slot>
                            <x-slot name="description">
                                This information will be displayed publicly so be careful what you share.
                            </x-slot>
                            <textarea 
                                id="description" 
                                name="description" rows="7" 
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2 block w-full sm:text-sm border border-gray-300 rounded-md" 
                            >{{ old('description', $ticket->description) }}</textarea>
                        </x-form-group>
                    </x-panel>
                </div>
                <div class="mt-4 sm:mt-0 col-span-1">
                    <x-ticket-info :ticket="$ticket"/>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-6 sm:mt-6 mt-12">
            <div class="col-span-1 sm:col-span-2">
                <x-panel>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Comments</h3>
                    <hr class="my-4">
                    <div class="mb-8 space-y-6">
                        @foreach ($ticket->comments as $comment)
                            <x-comment :comment="$comment"/>
                        @endforeach
                    </div>

                    <div class="-mb-6 -mx-6 bg-gray-50 text-right">
                        <div class="px-6 py-6">
                            <form method="POST" action="{{ route('ticket.comments', $ticket) }}">
                                @csrf
                                @error('body')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                                <textarea id="comment" name="body" rows="5" class="inline-flex  shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2 w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Add your comment here" required></textarea>
                                <x-button class="mt-2">Comment</x-button>
                            </form>
                        </div>
                    </div>
                </x-panel>
            </div>
            <div class="mt-4 sm:mt-0 col-span-1">
            </div>
        </div>
    </x-container>
</x-app-layout>