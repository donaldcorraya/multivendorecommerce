<?php

use App\Models\Attribute_items;

$attribute_ids = array();
$attribute_item_ids = array();
?>

@foreach($product->product_variant as $product_variant)

<?php if (!in_array($product_variant->attribute_id, $attribute_ids)) {
    array_push($attribute_ids, $product_variant->attribute_id);
    if($product_variant->attribute_id == null and $product_variant->attribute_item_id == null){
        exit();
    }
?>
    <div class="row mb-3 attr_create">
        <label for="inputText" class="col-sm-3 col-form-label">{{ $product_variant->attribute->name }}</label>
        <div class="col-sm-9">
            <select onchange="getAttributes(this)" class="form-select multiples_items multiples_items_new" name="" aria-label="Default select example" multiple="multiple">



                @foreach($product->product_variant as $product_variants)
                <?php

                if ($product_variant->attribute_id == $product_variants->attribute_id){
                    if (!in_array($product_variants->attribute_item_id, $attribute_item_ids)){
                        array_push($attribute_item_ids, $product_variants->attribute_item_id);

                ?>



                        <option selected value="{{ $product_variants->attribute_item->id }}">{{ $product_variants->attribute_item->name }}</option>
                <?php
                    } else {

                        $attr_opts = Attribute_items::where('attribute_id', $product_variant->attribute_id)->get();

                        foreach ($attr_opts as $attr_opt) {
                            
                            if (!in_array($attr_opt->id, $attribute_item_ids)){
                                array_push($attribute_item_ids, $attr_opt->id);
                ?>
                                <option value="{{ $attr_opt->id }}-{{ $product_variants->attribute_item->id }}">{{ $attr_opt->name }}</option>
                <?php 
                            }
                        }
                    }
                }
                ?>

                @endforeach





            </select>
        </div>
    </div>

<?php } ?>

@endforeach