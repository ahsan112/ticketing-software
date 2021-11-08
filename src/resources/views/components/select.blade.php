@props(['items', 'selected' => ''])

<select {{ $attributes->merge(['class'=> "mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"]) }}>
    <option value="">Please Select</option>
    @foreach ($items as $item)
        <option value="{{ $item->id }}" @if($selected == $item->id) selected @endif>{{ $item->name }}</option>
    @endforeach
</select>