@extends('admin.layout')
@section('title', 'Edit Product')
@section('content')


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css" />


<script>

    var color_ids = [];
    var attribute_ids = [];
    var attribute_item_ids = [];

    
    @foreach($product->product_variant as $product_variant)

    if(color_ids.indexOf({{ $product_variant->color_id }}) == -1){  
        color_ids.push({{ $product_variant->color_id }});
    }

    if(attribute_ids.indexOf({{ $product_variant->attribute_id }}) == -1){  
        attribute_ids.push({{ $product_variant->attribute_id }});
    }


    if(attribute_item_ids.indexOf({{ $product_variant->attribute_item_id }}) == -1){  
        attribute_item_ids.push({{ $product_variant->attribute_item_id }});
    }
        
    @endforeach

</script>

<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.0/"
        }
    }
</script>

<style>
    .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred,
    .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-focused {
        min-height: 300px;
    }

    .ck .ck-powered-by {
        display: none;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--multiple,
    .select2-dropdown,
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #dee2e6 !important;
    }

    .upload {
        &__box {
            padding: 40px;
        }

        &__inputfile {
            width: .1px;
            height: .1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        &__btn {
            display: inline-block;
            font-weight: 600;
            color: #fff;
            text-align: center;
            min-width: 116px;
            padding: 5px;
            transition: all .3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #4045ba;
            border-color: #4045ba;
            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;

            &:hover {
                background-color: unset;
                color: #4045ba;
                transition: all .3s ease;
            }

            &-box {
                margin-bottom: 10px;
            }
        }

        &__img {
            &-wrap {
                display: flex;
                flex-wrap: wrap;
                margin: 0 -10px;
            }

            &-box {
                width: 200px;
                padding: 0 10px;
                margin-bottom: 12px;
            }

            &-close {
                width: 24px;
                height: 24px;
                border-radius: 50%;
                background-color: rgba(0, 0, 0, 0.5);
                position: absolute;
                top: 10px;
                right: 10px;
                text-align: center;
                line-height: 24px;
                z-index: 1;
                cursor: pointer;

                &:after {
                    content: '\2716';
                    font-size: 14px;
                    color: white;
                }
            }
        }
    }

    .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        padding-bottom: 100%;
    }

    .upload__img-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
    }

    .upload__img-close:after {
        content: "✖";
        font-size: 14px;
        color: white;
    }

    .upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        margin: 20px -10px;
    }

    .upload__img-box {
        width: 200px;
        padding: 0 10px;
        margin-bottom: 12px;
    }




    #img-preview {
        display: none;
        width: 155px;
        /* border: 2px dashed #333;   */
        margin-bottom: 20px;
    }

    #img-preview img {
        width: 100%;
        height: auto;
        display: block;
    }
</style>

<style>
    ._box {
        position: relative;
        width: 30rem;
        margin: 1rem auto;
        border-radius: 0.5rem;
        box-shadow: 0 0.25rem 2rem rgba(67, 160, 71, 0.1);
        padding: 2rem;
        background-color: white;
        border-top: 0.125rem solid #A5D6A7;
    }

    #newTag {
        font-size: 1rem;
        color: #455A64;
        display: block;
        width: 100%;
        height: 38px;
        padding: 0 1rem;
        border: 0.125rem solid #CFD8DC;
        border-radius: 0.25rem;
        margin-bottom: 1rem;
        transition: 0.5s all;
    }

    #newTag:focus,
    #newTag:active {
        outline: none;
        /* border: 0.125rem solid #81C784; */
        /* box-shadow: 0 0 0.5rem rgba(67,160,71,0.15); */
    }

    ul#tagList {
        display: block;
        padding: 0;
        margin: 0;
    }

    ul#tagList::after {
        content: "";
        clear: both;
        display: table;
    }

    ul#tagList li {
        position: relative;
        list-style: none;
        float: left;
        font-size: 0.835rem;
        text-transform: capitalize;
        background-color: #E8F5E9;
        line-height: 1rem;
        padding: 0.5rem 2rem 0.5rem 1rem;
        border-radius: 1rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
        word-break: break-all;
    }

    ul#tagList li>span.rmTag {
        position: absolute;
        margin: 0.25rem;
        top: 0;
        right: 0;
        height: 1.5rem;
        width: 1.5rem;
        border-radius: 1rem;
        color: #fff;
        font-size: 1.25rem;
        line-height: 1.5rem;
        text-align: center;
        background-color: #C8E6C9;
        cursor: pointer;
        -webkit-transition: 0.3s all;
        transition: 0.3s all;
    }

    ul#tagList li>span.rmTag:hover {
        background-color: #ef9a9a;
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Add New Product</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>


    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Product</h5>

                        <!-- Vertical Pills Tabs -->
                        <div class="d-flex align-items-start">
                            <div class="nav flex-column nav-pills me-3 col-lg-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link active text-start" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">General</button>
                                <button class="nav-link text-start" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-fileNmedia" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Files & Media</button>
                                <button class="nav-link text-start" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-priceNstock" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Price & Stock</button>
                                <button class="nav-link text-start" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-seo" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">SEO</button>
                                <button class="nav-link text-start" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-shipping" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Shipping</button>
                                <button class="nav-link text-start" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-frequentlyBought" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Frequently Bought</button>
                            </div>

                            <form action="{{ route('product.add.post') }}" method="post" class="w-100 p-3" enctype="multipart/form-data">

                                @csrf

                                <div class="tab-content col-lg-9" id="v-pills-tabContent">

                                    <div class="tab-pane fade show active col-lg-12" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                        <h5 class="card-title">Product Information</h5>
                                        <hr>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Product Name <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" onkeyup="createSlug(this)" name="name" value="{{ $product->name }}" placeholder="Product Name" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Slug <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" id="slug" name="slug" value="{{ $product->slug }}" placeholder="Slug" class="form-control">
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Category <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-select {{ old('category') }}" name="category" aria-label="category">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                    <option <?= ($product->category_id == $category->id) ? 'selected' : '' ?> value="{{ $category->id }}">{{ $category->name }}</option>

                                                    @if(count($category->childrenRecursive) > 0)
                                                    @include('admin.subCategories', ['subcategories' => $category->childrenRecursive, 'parent' => $category->name])
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Brand <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="brand" aria-label="">
                                                    <option value="">Select</option>
                                                    @foreach($brands as $brand)
                                                    <option <?= ($product->brand_id == $brand->id) ? 'selected' : '' ?> value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Unit <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" value="{{ $product->unit }}" name="unit" placeholder="Unit (e.g. KG, Pc etc)" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Weight (In Kg)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="unit_amount" value="{{ $product->unit_amount }}" name="weight" placeholder="0" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Minimum Purchase Qty <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" value="{{ $product->minimum_purchase_qty }}" name="minimum_purchase_qty" placeholder="1" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Tags</label>
                                            <div class="col-sm-9">

                                                <input type="text" id="newTag" value="" />

                                                <ul id="tagList">
                                                    <?php

                                                    $product_tags = json_decode($product->tags);

                                                    if (!empty($product_tags[0])) {
                                                        foreach ($product_tags as $product_tag) {
                                                    ?>

                                                            <li>{{ $product_tag }}<input type="hidden" name="tags[]" value="dasd"><span class="rmTag">×</span></li>

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Barcode</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="{{ $product->bar_code  }}" name="barcode" placeholder="Barcode" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Product Type</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="product_type" aria-label="">
                                                    <option {{ ($product->product_type == 'single_product')? "selected" : ''  }} value="single_product">Single Product</option>
                                                    <option {{ ($product->product_type == 'variation_product')? "selected" : ''  }} value="variation_product">Product Variation</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Refundable</label>
                                            <div class="col-sm-9">
                                                <input name="refundable" class="form-check-input" type="checkbox" id="gridCheck" {{ ($product->refundable == '1')? "checked" : ''  }}>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea id="editor" cols="30" rows="10" name="description" class="form-control" style="height: 100px">{{ $product->description }}</textarea>
                                            </div>
                                        </div>

                                        <h5>Status</h5>
                                        <hr>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Featured</label>
                                            <div class="col-sm-9">
                                                <input name="featured" class="form-check-input" type="checkbox" id="gridCheck" {{ ($product->featured == '1')? "checked" : ''  }}>
                                                <small>If you enable this, this product will be granted as a featured product.</small>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Today's Deal</label>
                                            <div class="col-sm-9">
                                                <input name="todays_deal" class="form-check-input" type="checkbox" id="gridCheck" {{ ($product->todays_deal == '1')? "checked" : ''  }}>
                                                <small>If you enable this, this product will be granted as a todays deal product.</small>
                                            </div>
                                        </div>

                                        <br>
                                        <h5>Flash Deal<span style="font-size: 13px;">(If you want to select this product as a flash deal, you can use it)</span></h5>
                                        <hr>


                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Add To Flash</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="flash_deal" aria-label="Default select example">
                                                    <option value="">Choose Flash Title</option>
                                                    <option {{ ($product->flash_deal == '1')? "selected" : ''  }} value="1">End of Season</option>
                                                    <option {{ ($product->flash_deal == '2')? "selected" : ''  }} value="2">Winter Sale</option>
                                                    <option {{ ($product->flash_deal == '3')? "selected" : ''  }} value="3">Electronic</option>
                                                    <option {{ ($product->flash_deal == '4')? "selected" : ''  }} value="4">Flash Deal</option>
                                                    <option {{ ($product->flash_deal == '5')? "selected" : ''  }} value="5">Flash Sale</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Discount</label>
                                            <div class="col-sm-9">
                                                <input type="number" value="{{ $product->flash_discount }}" name="flash_discount" placeholder="Discount" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Discount Type</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="flash_discount_type" aria-label="Default select example">
                                                    <option value="" selected>Choose Discount Type</option>
                                                    <option {{ ($product->flash_discount_type == '1')? "selected" : ''  }} value="1">Flat</option>
                                                    <option {{ ($product->flash_discount_type == '2')? "selected" : ''  }} value="2">Percent</option>
                                                </select>
                                            </div>
                                        </div>

                                        <br>
                                        <h5>Vat & TAX</h5>
                                        <hr>

                                        <div class="row mb-3">

                                            <div class="col-md-6">
                                                <label for="inputEmail5" class="form-label">Tax</label>
                                                <input name="tax" value="{{ $product->tax }}" type="text" class="form-control" id="inputEmail5">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputPassword5" class="form-label">Tax type</label>
                                                <select class="form-select" name="tax_type" aria-label="Default select example">
                                                    <option value="" selected>Tax Type</option>
                                                    <option {{ ($product->tax_type == '1')? "selected" : ''  }} value="1">Flat</option>
                                                    <option {{ ($product->tax_type == '2')? "selected" : ''  }} value="2">Percent</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="row mb-3">

                                            <div class="col-md-6">
                                                <label for="inputEmail5" class="form-label">Vat</label>
                                                <input name="vat" value="{{ $product->vat }}" type="text" class="form-control" id="inputEmail5">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputPassword5" class="form-label">Vat type</label>
                                                <select class="form-select" name="vat_type" aria-label="Default select example">
                                                    <option value="" selected>Vat Type</option>
                                                    <option {{ ($product->vat_type == '1')? "selected" : ''  }} value="1">Flat</option>
                                                    <option {{ ($product->vat_type == '2')? "selected" : ''  }} value="2">Percent</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="v-pills-fileNmedia" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                        <h5 class="card-title">Product Information</h5>
                                        <hr>


                                        <div class="upload__box row mb-3">
                                            <label class="upload__btn col-sm-3 col-form-label">Gallery Images <small>(600x600)</small></label>
                                            <div class="col-sm-9">
                                                <input type="file" name="gallery_image[]" multiple data-max_length="30" class="form-control upload__inputfile">
                                            </div>



                                            <div class="upload__img-wrap">
                                                @foreach($product->image_gallery as $g_image)
                                                <div class="upload__img-box">
                                                    <div style="background: url({{ asset($g_image->image) }}); background-repeat: no-repeat; background-position: center; background-size: cover; position: relative; padding-bottom: 100%;" data-number="0" data-file="IMG_8548-copy.jpg" class="img-bg">
                                                        <div class="upload__img-close"></div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>


                                        </div>


                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label" for="choose-file">Thumbnail Image <small>(300x300)</small></label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" id="choose-file" name="thumbnail_image" accept="image/*" />
                                            </div>
                                            <div id="img-preview" style="display: block;">
                                                <img src="{{ asset($product->thumbnail_image) }}">
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Video Provider</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="{{ $product->video_provider }}" name="video_provider_youtube" placeholder="Youtube" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="v-pills-priceNstock" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <h5 class="card-title">Product price + stock</h5>
                                        <hr>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Colors</label>
                                            <div class="col-sm-9">
                                                <select id="colors_attr" class="form-select multiples_items" name="colors[]" aria-label="Default select example" multiple="multiple">
                                                    @foreach($colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Attributes</label>
                                            <div class="col-sm-9">
                                                <select id="attributes_attr" class="form-select multiples_items" name="attributes[]" aria-label="Default select example" multiple="multiple">
                                                    @foreach($attributes as $attribute)
                                                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div id="attributes"></div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Unit price <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" value="{{ old('unit_price') }}" name="unit_price" placeholder="Unit price" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Discount <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" value="" name="discount" placeholder="Discount" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <select class="form-select" name="discount_type" aria-label="Default select example">
                                                    <option value="" selected>Flat</option>
                                                    <option value="" selected>Percent</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Discount Date Start</label>
                                            <div class="col-sm-9">
                                                <input type="date" value="0" name="discount_date_range" placeholder="Discount Date Range" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Discount Date End</label>
                                            <div class="col-sm-9">
                                                <input type="date" value="0" name="discount_date_range" placeholder="Discount Date Range" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Set Point</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="0" name="set_point" placeholder="Set Point" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3 single_product">
                                            <label for="inputText" class="col-sm-3 col-form-label">Quantity <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" value="" name="quantity" placeholder="Quantity" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3 single_product">
                                            <label for="inputText" class="col-sm-3 col-form-label">SKU</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sku" placeholder="SKU" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">External link</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="external_link" placeholder="External link" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">External link Button Text</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="external_link_button_text" placeholder="External link Button Text" class="form-control">
                                            </div>
                                        </div>

                                        <div id="variant_details"></div>

                                        <br>
                                        <h5>Low Stock Quantity Warning</h5>
                                        <hr>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="low_quantity" value="1" class="form-control">
                                            </div>
                                        </div>

                                        <br>
                                        <h5>Stock Visibility State</h5>
                                        <hr>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Show Stock Quantity</label>
                                            <div class="col-sm-9">
                                                <input checked name="show_stock_quantity" class="form-check-input" type="checkbox" id="gridCheck">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Show Stock With Text Only</label>
                                            <div class="col-sm-9">
                                                <input name="show_stock_with_text_only" class="form-check-input" type="checkbox" id="gridCheck">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Hide Stock</label>
                                            <div class="col-sm-9">
                                                <input name="hide_stock" class="form-check-input" type="checkbox" id="gridCheck">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="tab-pane fade" id="v-pills-seo" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <h5 class="card-title">SEO Meta Tags</h5>
                                        <hr>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Meta Title</label>
                                            <div class="col-sm-9">
                                                <input name="seo_meta_title" placeholder="Meta Title" class="form-control" type="text" id="gridCheck">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Meta Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="seo_meta_description" class="form-control" style="height: 100px"></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Meta Image</label>
                                            <div class="col-sm-9">
                                                <input name="meta_image" placeholder="Meta Title" class="form-control" type="file" id="gridCheck">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                                        <h5 class="card-title">Shipping Configuration</h5>
                                        <hr>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Cash On Delivery</label>
                                            <div class="col-sm-9">
                                                <input checked name="cod" class="form-check-input" type="checkbox" id="gridCheck">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Free Shipping</label>
                                            <div class="col-sm-9">
                                                <input checked name="free_shipping" class="form-check-input" type="checkbox" id="gridCheck">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Flat Rate</label>
                                            <div class="col-sm-9">
                                                <input checked name="flat_rate" class="form-check-input" type="checkbox" id="gridCheck">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Is Product Quantity Mulitiply</label>
                                            <div class="col-sm-9">
                                                <input checked name="is_product_quantity_mulitiply" class="form-check-input" type="checkbox" id="gridCheck">
                                            </div>
                                        </div>

                                        <br>
                                        <h5 class="card-title">Estimate Shipping Time</h5>
                                        <hr>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Shipping Days</label>
                                            <div class="col-sm-9">
                                                <input checked name="shpping_days" placeholder="Shipping Days" class="form-control" type="text" id="gridCheck">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="v-pills-frequentlyBought" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                                    </div>
                                    <!-- End Vertical Pills Tabs -->

                                </div>
                                <div class="col-sm-10">
                                    <button type="submit" name="submit" value="0" class="btn btn-secondary">Save & Unpublished</button>
                                    <button type="submit" name="submit" value="1" class="btn btn-success">Save & Published</button>
                                </div>
                            </form>
                        </div>


                    </div>

                </div>
    </section>
</main>

<script>
    $(window).keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });


    // ADD JQUERY
    (function() {
        var tagList = [];


        var $tagList = $("#tagList");
        var $newTag = $("#newTag");


        //tagList_render();


        function tagList_render() {

            $tagList.empty();
            tagList.map(function(_tag) {

                var temp = "<li>" + _tag + "<input type='hidden' name='tags[]' value=" + _tag + " /><span class='rmTag'>&times;</span></li>";

                $tagList.append(temp);
            });
        };


        $newTag.on('keyup', function(e) {

            if (e.keyCode == 13) {

                var newTag = $("#newTag").val();

                newTag = newTag.replace(/\s/g, '_');

                if (newTag.replace(/\s/g, '') !== '') {
                    tagList.push(newTag);
                    $newTag.val('');
                    tagList_render();
                }
            }
        });


        $tagList.on("click", "li>span.rmTag", function() {
            var index = $(this).parent().index();
            tagList.splice(index, 1);
            tagList_render();
        });
    })();
</script>

<script>
    $(document).ready(function(){
        
        $.ajax({
            url : "{{ route('product.edit.get.details') }}",
            type : 'get',
            data : {
                "_token": "{{ csrf_token() }}",
                "produc_id" : "{{ $product_id }}"
            },
            dataType : 'html',
            success : function(res){            
                if(res){
                    $("#attributes").html(res);
                    $('.multiples_items_new').select2();
                    colorChange();
                }   
            }
        });

    });

    $('.multiples_items').select2();
    $('#colors_attr').val(color_ids);
    $('#colors_attr').select2();
    $('#attributes_attr').val(attribute_ids);
    $('#attributes_attr').select2();



    $('#colors_attr').on('change.select2', function(e) {
        $('#loader').css({
            'display': 'flex'
        })
        colorChange();
    });

    $('#attributes_attr').on('change.select2', function(e) {

        $('#loader').css({
            'display': 'flex'
        });
        createAttributes();
    });


    function getAttributes(sel) {
        $('#loader').css({
            'display': 'flex'
        });
        var opts = [],
            opt;
        var len = sel.options.length;
        for (var i = 0; i < len; i++) {
            opt = sel.options[i];

            if (opt.selected) {
                opts.push(opt);


            }
        }

        var getAttributes = {
            'attributes_items': opts
        };

        colorChange();
    }


    function createAttributes() {
        var attributes_attr = $('#attributes_attr').val();


        if (attributes_attr.length > 0) {

            $.ajax({
                url: "{{ route('get_attributes_details_edit') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'data': JSON.stringify(attributes_attr),
                    'product_id' : "{{ $product_id }}",
                },
                dataType: 'html',
                success: function(res) {
                    if (res) {
                        $('#attributes').html(res);
                        $(".attr_create").each(function() {
                            $('.attr_create .multiples_items').select2();
                        });
                        
                        colorChange();
                    }
                }
            });

        } else {
            $('#attributes').empty();
            colorChange();
        }


    }


    function colorChange(id){
        

        var color_id = {
            'color_id': $('#colors_attr').val(),
        };


        if (color_id.color_id.length == 0) {
            color_id = [];
        }

        var attributes_attr = {
            'attributes_attr': $('#attributes_attr').val(),
        };

        var attributes_array = [];

        if ($(".attr_create .multiples_items_new").length !== 0) {
            $(".attr_create .multiples_items_new").each(function(e) {
                if ($(this).find('option:selected').val() != null) {
                    attributes_array.push($(this).val());
                }
            });
        }



        var attributes_item = {
            'attributes_items': attributes_array,
        };

        var product_id = {
            'product_id': "{{ $product_id }}",
        };


        const obj = {
            'product_id' : product_id,
            'color_id': color_id,
            'attributes_attr': attributes_attr,
            'attributes_item': attributes_item
        };
        
        const data = JSON.stringify(obj);
        ajaxGetData(data);
    }


    function createSlug(txt) {
        var sku = txt.value.replace(/ /g, "-");
        sku = sku.toLowerCase();
        $("#slug").val(sku);
    }

    function ajaxGetData(data) {
        $.ajax({
            url: "{{ route('get_variant_details_edit') }}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                'data': data,
                'product_id': "{{ $product_id }}",
            },
            dataType: 'html',
            success: function(res) {
                $('#loader').css({
                    'display': 'none'
                });

                if (res) {
                    $('#variant_details').html(res);
                    $(".single_product").hide();
                }

                if (res == 'error') {
                    $(".single_product").show();
                }
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        ImgUpload();
    });

    function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload__inputfile').each(function() {
            $(this).on('change', function(e) {
                imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');

                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                var iterator = 0;
                filesArr.forEach(function(f, index) {

                    if (!f.type.match('image.*')) {
                        return;
                    }

                    if (imgArray.length > maxLength) {
                        return false
                    } else {
                        var len = 0;
                        for (var i = 0; i < imgArray.length; i++) {
                            if (imgArray[i] !== undefined) {
                                len++;
                            }
                        }
                        if (len > maxLength) {
                            return false;
                        } else {
                            imgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                imgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });
        });

        $('body').on('click', ".upload__img-close", function(e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
                if (imgArray[i].name === file) {
                    imgArray.splice(i, 1);
                    break;
                }
            }
            $(this).parent().parent().remove();
        });
    }





    const chooseFile = document.getElementById("choose-file");
    const imgPreview = document.getElementById("img-preview");

    chooseFile.addEventListener("change", function() {
        getImgData();
    });

    function getImgData() {
        const files = chooseFile.files[0];
        if (files) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function() {
                imgPreview.style.display = "block";
                imgPreview.innerHTML = '<img src="' + this.result + '" />';
            });
        }
    }
</script>
<!-- CK editor -->
<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph
    } from 'ckeditor5';

    ClassicEditor
        .create(document.querySelector('#editor'), {
            plugins: [Essentials, Bold, Italic, Font, Paragraph],
            toolbar: {
                items: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            }
        })
        .then( /* ... */ )
        .catch( /* ... */ );
</script>


@endsection