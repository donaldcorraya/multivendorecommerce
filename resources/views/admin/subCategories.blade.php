@foreach($subcategories as $sub)
    <option value="{{ $sub->id }}">{{ $parent}} - {{ $sub->name }}</option>

    @if(count($sub->childrenRecursive) > 0)
        @php
            $parents = $parent." - ".$sub->name
        @endphp
        @include('admin.subCategories', ['subcategories' => $sub->childrenRecursive, 'parent' => $parents])
    @endif
    
@endforeach