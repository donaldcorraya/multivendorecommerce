@extends('admin.layout')
@section('title', 'Add New Product')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--multiple,
    .select2-dropdown,
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #dee2e6 !important;
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

                            <form action="{{ route('product.add.post') }}" method="post" class="w-100 p-3">

                                @csrf
                            
                                <div class="tab-content col-lg-9" id="v-pills-tabContent">

                                    <div class="tab-pane fade show active col-lg-12" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                        <h5 class="card-title">Product Information</h5>
                                        <hr>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Product Name <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" placeholder="Product Name" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Brand <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="brand" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Unit <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="number" name="unit" placeholder="Unit (e.g. KG, Pc etc)" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Weight (In Kg)</label>
                                            <div class="col-sm-9">
                                                <input type="number" value="0" name="weight" placeholder="0" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Minimum Purchase Qty <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" value="1" name="minimum_qty" placeholder="1" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Tags</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="newTag" />
                                                <ul id="tagList"></ul>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Barcode</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="" name="barcode" placeholder="Barcode" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Refundable</label>
                                            <div class="col-sm-9">
                                                <input name="refundable" class="form-check-input" type="checkbox" id="gridCheck">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <div class="quill-editor-default">
                                                    <p>Hello World!</p>
                                                    <p>This is Quill <strong>default</strong> editor</p>
                                                </div>
                                            </div>
                                        </div>

                                        <h5>Status</h5>
                                        <hr>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Featured</label>
                                            <div class="col-sm-9">
                                                <input name="featured" class="form-check-input" type="checkbox" id="gridCheck">
                                                <small>If you enable this, this product will be granted as a featured product.</small>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Today's Deal</label>
                                            <div class="col-sm-9">
                                                <input name="todays_deal" class="form-check-input" type="checkbox" id="gridCheck">
                                                <small>If you enable this, this product will be granted as a todays deal product.</small>
                                            </div>
                                        </div>

                                        <br>
                                        <h5>Flash Deal<span style="font-size: 13px;">(If you want to select this product as a flash deal, you can use it)</span></h5>
                                        <hr>


                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Add To Flash</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="flash_deal_id" aria-label="Default select example">
                                                    <option value="" selected>Choose Flash Title</option>
                                                    <option value="1">End of Season</option>
                                                    <option value="2">Winter Sale</option>
                                                    <option value="3">Electronic</option>
                                                    <option value="4">Flash Deal</option>
                                                    <option value="5">Flash Sale</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Discount</label>
                                            <div class="col-sm-9">
                                                <input type="number" value="0" name="flash_discount" placeholder="Discount" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Discount Type</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="flash_discount_type" aria-label="Default select example">
                                                    <option value="" selected>Choose Discount Type</option>
                                                    <option value="1">Flat</option>
                                                    <option value="2">Percent</option>
                                                </select>
                                            </div>
                                        </div>

                                        <br>
                                        <h5>Vat & TAX</h5>
                                        <hr>

                                        <div class="row mb-3">

                                            <div class="col-md-6">
                                                <label for="inputEmail5" class="form-label">Tax</label>
                                                <input type="text" class="form-control" id="inputEmail5">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputPassword5" class="form-label">Tax type</label>
                                                <select class="form-select" name="tax_type" aria-label="Default select example">
                                                    <option value="" selected>Tax Type</option>
                                                    <option value="1">Flat</option>
                                                    <option value="2">Percent</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="row mb-3">

                                            <div class="col-md-6">
                                                <label for="inputEmail5" class="form-label">Vat</label>
                                                <input type="text" class="form-control" id="inputEmail5">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputPassword5" class="form-label">Vat type</label>
                                                <select class="form-select" name="vat_type" aria-label="Default select example">
                                                    <option value="" selected>Vat Type</option>
                                                    <option value="1">Flat</option>
                                                    <option value="2">Percent</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="v-pills-fileNmedia" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                        <h5 class="card-title">Product Information</h5>
                                        <hr>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Gallery Images <small>(600x600)</small></label>
                                            <div class="col-sm-9">
                                                <input type="file" name="gallery_image" placeholder="Gallery Images" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Thumbnail Image <small>(300x300)</small></label>
                                            <div class="col-sm-9">
                                                <input type="file" name="thumbnail_image" placeholder="Thumbnail Image" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Video Provider</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="video_provider_youtube" placeholder="Youtube" class="form-control">
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

                                        <div id="attributes"> </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Unit price <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" value="0" name="unit_price" placeholder="Unit price" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Discount Date Range</label>
                                            <div class="col-sm-9">
                                                <input type="date" value="0" name="discount_date_range" placeholder="Discount Date Range" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Discount <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" value="0" name="discount" placeholder="Discount" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <select class="form-select" name="discount_type" aria-label="Default select example">
                                                    <option value="" selected>Flat</option>
                                                    <option value="" selected>Percent</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Set Point</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="0" name="set_point" placeholder="Set Point" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Quantity <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" value="0" name="quantity" placeholder="Quantity" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
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
                                                <input name="" class="form-check-input" type="checkbox" id="gridCheck">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Hide Stock</label>
                                            <div class="col-sm-9">
                                                <input name="" class="form-check-input" type="checkbox" id="gridCheck">
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
                                                <input name="seo_meta_img" placeholder="Meta Title" class="form-control" type="file" id="gridCheck">
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
                                                <input checked name="" class="form-check-input" type="checkbox" id="gridCheck">
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
                                    <button type="submit" class="btn btn-secondary">Save & Unpublished</button>
                                    <button type="submit" class="btn btn-success">Save & Published</button>
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

        // cacheing the DOM elements
        var $tagList = $("#tagList");
        var $newTag = $("#newTag");

        // initial render
        tagList_render();

        // always put logic sections and render sections in seperate functions/class
        // trust me it will help a lot on big projects!
        function tagList_render() {

            $tagList.empty();
            tagList.map(function(_tag) {
                // var temp = '<li>' + _tag + '<span class="rmTag">&times;</span></li>';
                var temp = "<li>" + _tag + "<input type='hidden' name='tags[]' value=" + _tag + " /><span class='rmTag'>&times;</span></li>";
                $tagList.append(temp);
            });
        };

        // key events
        // Add new tag on "ENTER" press
        $newTag.on('keyup', function(e) {
            // enter keycode 13

            if (e.keyCode == 13) {

                var newTag = $("#newTag").val();
                if (newTag.replace(/\s/g, '') !== '') {
                    tagList.push(newTag);
                    $newTag.val('');
                    tagList_render();
                }
            }
        });

        // button events
        // Remove Tag
        $tagList.on("click", "li>span.rmTag", function() {
            var index = $(this).parent().index();
            tagList.splice(index, 1);
            tagList_render();
        });
    })();
</script>

<script>
    $(document).ready(function() {
        $('.multiples_items').select2();
    });

    

    $('#colors_attr').on('change.select2', function (e) {
        $('#loader').css({ 'display' : 'flex'})
        colorChange();
    });

    $('#attributes_attr').on('change.select2', function (e){
        $('#loader').css({ 'display' : 'flex'});
        createAttributes();
    });
   

    function getAttributes(sel) {
        $('#loader').css({ 'display' : 'flex'});
         var opts = [],
            opt;
        var len = sel.options.length;
        for (var i = 0; i < len; i++) {
            opt = sel.options[i];

            if (opt.selected) {
            opts.push(opt);
            
            
            }
        }
        
        var getAttributes = {'attributes_items' : opts };
        colorChange();
    }
    

    function createAttributes(){
        var attributes_attr = $('#attributes_attr').val();
        
        

        

        if(attributes_attr.length > 0){

            $.ajax({
                url : "{{ route('get_attributes_details') }}",
                type : 'post',
                data : {
                    "_token": "{{ csrf_token() }}",
                    'data' : JSON.stringify(attributes_attr)
                },
                dataType : 'html',
                success : function(res){ 
                    if(res){
                        $('#attributes').html(res);
                        $(".attr_create").each(function(){
                            $('.attr_create .multiples_items').select2();
                        });
                        colorChange();
                    }
                }
            });
            
        }else{ 
            
            $('#attributes').empty();
            colorChange();
            
        }


        
        
        
    }


    function colorChange(){

        var color_id = {
            'color_id' : $('#colors_attr').val(),
        };
        

        var attributes_attr = {
            'attributes_attr' : $('#attributes_attr').val(),
        };

        var attributes_array = [];

        if($(".attr_create .multiples_items_new").length !== 0){
            $(".attr_create .multiples_items_new").each(function(e){
                if($(this).find('option:selected').val() != null){
                    attributes_array.push($(this).val());
                    //attributes_array = $(this).val();
                }
            });
        }

        

        var attributes_item = {
            'attributes_items' : attributes_array,
            
        };
        

        const obj = {'color_id' : color_id, 'attributes_attr' : attributes_attr, 'attributes_item' : attributes_item };
        const data = JSON.stringify(obj);
        ajaxGetData(data);
    }
    

    function ajaxGetData(data){
        $.ajax({
            url : "{{ route('get_variant_details') }}",
            type : 'post',
            data : {
                "_token": "{{ csrf_token() }}",
                'data' : data
            },
            dataType : 'html',
            success : function(res){  
                $('#loader').css({ 'display' : 'none'});
                $('#variant_details').html(res);
            }
        });
    }
</script>

@endsection