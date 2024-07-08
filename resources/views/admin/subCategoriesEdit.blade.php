@foreach($subcategories as $sub)
    <option {{ ($parent_id == $sub->id )? "selected" : "" }} value="{{ $sub->id }}">{{ $parent}} / {{ $sub->name }}</option>

    @if(count($sub->childrenRecursive) > 0)
        @php
            $parents = $parent." / ".$sub->name
        @endphp
        @include('admin.subCategoriesEdit', ['subcategories' => $sub->childrenRecursive, 'parent' => $parents])
    @endif
    
@endforeach