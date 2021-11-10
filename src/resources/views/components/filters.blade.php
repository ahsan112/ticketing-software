@props(['view', 'user'])
<form method="POST" action="{{ route('tickets.filter') }}">
    @csrf

    <div class="flex items-end space-x-4">
        <div>
            <select class="mt-1 block w-full border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="view" id="">
                <option {{ $view == 'open' ? 'selected' : '' }} value="open">Open</option>
                <option {{ $view == 'completed' ? 'selected' : '' }} value="completed">Completed</option>
                <option {{ $view == 'rejected' ? 'selected' : '' }} value="rejected">Rejected</option>
            </select>
        </div>
        <div>
            <x-user-select :selected="$user"></x-user-select>
        </div>
        <div>
            <x-button>filter</x-button>
        </div>
    </div>
    
</form>