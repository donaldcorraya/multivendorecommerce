
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Variant</th>
            <th scope="col">Variant Price</th>
            <th scope="col">SKU</th>
            <th scope="col">Quantity</th>
            <th scope="col">Photo</th>
        </tr>
    </thead>
    <tbody>
        
        @php

            if(count($colors) != 0){
                foreach($colors as $color){
                    if (empty(array_filter($attributes_item_arr))){
                        @endphp
                        <tr>
                            <th scope="row">{{ (isset($color->name)? $color->name : '') }}</th>
                            <td><input type="text" name="variant_price[]" value="0" multiple class="form-control"></td>
                            <input type="hidden" name="sku[]" value="{{ strtolower((isset($color->name)? $color->name : '')) }}" multiple class="form-control">
                            <td>{{ strtolower((isset($color->name)? $color->name : '')) }}</td>
                            <td><input type="text" name="variant_qty[]" value="0" class="form-control" multiple></td>
                            <td><input type="file" name="variant_img[]" class="form-control" multiple></td>
                        </tr>
                        @php
                    }
                    foreach($attributes_item_arr as $attributes_item){
                        foreach(json_decode($attributes_item) as $attr_item){
        @endphp
        
        <tr>
            <th scope="row">{{ (isset($color->name)? $color->name : '') }} {{ $attr_item->name }}</th>
            <td><input type="text" name="variant_price[]" value="0" multiple class="form-control"></td>
            <input type="hidden" name="sku[]" value="{{ strtolower((isset($color->name)? $color->name.'-' : '')) }}{{ strtolower($attr_item->name) }}" multiple class="form-control">
            <td>{{ strtolower((isset($color->name)? $color->name."-" : '')) }}{{ strtolower($attr_item->name) }}</td>
            <td><input type="text" name="variant_qty[]" value="0" class="form-control" multiple></td>
            <td><input type="file" name="variant_img[]" class="form-control" multiple></td>
        </tr>


        @php             
                       
                        }
                    }
                }
            }else{
                foreach($attributes_item_arr as $attributes_item){
                    foreach(json_decode($attributes_item) as $attr_item){
        @endphp
            <tr>
                <th scope="row">{{ $attr_item->name }}</th>
                <td><input type="text" name="variant_price[]" value="0" multiple class="form-control"></td>
                <input type="hidden" name="sku[]" value="{{ strtolower($attr_item->name) }}" class="form-control">
                <td>{{ strtolower($attr_item->name) }}</td>
                <td><input type="text" name="variant_qty[]" value="0" class="form-control" multiple></td>
                <td><input type="file" name="variant_img[]" class="form-control" multiple></td>
            </tr>
        @php
                    }
                }
            }
        @endphp
        
    </tbody>
</table>