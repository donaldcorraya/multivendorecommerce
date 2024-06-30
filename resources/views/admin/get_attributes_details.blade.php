

@foreach($data_items as $data_item)
    @foreach($data_item as $item)

    <div class="row mb-3 attr_create">
        <label for="inputText" class="col-sm-3 col-form-label">{{ $item->name }}</label>
        <div class="col-sm-9">
            <select onchange="getAttributes(this)" class="form-select multiples_items multiples_items_new" name="{{ strtolower($item->name) }}[]" aria-label="Default select example" multiple="multiple">
                @foreach($item->attribute_items as $item->attribute_item)
                <option value="{{ $item->attribute_item->id }}">{{ $item->attribute_item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @endforeach
@endforeach



