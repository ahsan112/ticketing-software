{{-- @dd($developers) --}}
<x-select 
    id="owner_id" 
    name="owner_id" 
    :items="$developers" 
    :selected="$selected" 
/>
