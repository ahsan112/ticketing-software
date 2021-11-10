
<select class="mt-1 block w-full border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="role" id="">
    @foreach ($roles as $role)
        <option {{ $selected == $role ? 'selected' : '' }} value="{{ $role }}">{{ $role }}</option>
    @endforeach
</select>