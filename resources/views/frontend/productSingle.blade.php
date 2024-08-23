@extends('frontend.layout')
@section('title', 'Details')
@section('content')
<?php

use App\Models\Colors;

?>
<style>

.product-variants{
    display: flex;
    margin-bottom: 20px;
}

</style>

<div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="active">{{ $products->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!-- content-wraper start -->
            <div class="content-wraper">
                <div class="container">
                    <div class="row single-product-area">
                        <div class="col-lg-5 col-md-6">
                           <!-- Product Details Left -->
                            <div class="product-details-left">
                                
                                <div class="product-details-images slider-navigation-1">

                                    @foreach($products->image_gallery as $product)

                                    <div class="lg-image">
                                        <a class="popup-img venobox vbox-item" href="{{ asset($product->image) }}" data-gall="myGallery">
                                            <img src="{{ asset($product->image) }}" alt="product image">
                                        </a>
                                    </div>

                                    @endforeach
                                    
                                </div>

                                <div class="product-details-thumbs slider-thumbs-1">   
                                    @foreach($products->image_gallery as $product)                                     
                                    <div class="sm-image"><img src="{{ asset($product->image) }}" alt="product image thumb"></div>
                                    @endforeach
                                </div>
                            </div>
                            <!--// Product Details Left -->
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="product-details-view-content pt-60">
                                <div class="product-info">
                                    <h2>{{ $products->name }}</h2>
                                    <span class="product-details-ref">Reference: demo_15</span>
                                    <div class="rating-box pt-20">
                                        <ul class="rating rating-with-review-item">
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="review-item"><a href="#">Read Review</a></li>
                                            <li class="review-item"><a href="#">Write Review</a></li>
                                        </ul>
                                    </div>
                                    <div class="price-box pt-20">
                                        <span class="new-price new-price-2">${{ $products->unit_price }}</span>
                                    </div>
                                    <div class="product-desc">
                                        <p>
                                            <span>{{ $products->description }}</span>
                                        </p>
                                    </div>

                                    @php
                                        $attribute_ids = array(); 
                                        $attribute_item_ids = array(); 
                                        $color_ids = array(); 
                                    @endphp
                                    @foreach($products->product_variant as $product_dimension)

                                    @php
                                        if(!in_array($product_dimension->attribute_id, $attribute_ids)){
                                            array_push($attribute_ids, $product_dimension->attribute_id);
                                        
                                    @endphp

                                    <div class="product-variants">
                                        <div class="produt-variants-size">
                                            <label>{{ $product_dimension->attribute->name }}</label>

                                            <select class="nice-select">
                                                @foreach($products->product_variant as $product_attribute_item)
                                                @php
                                                    if(!in_array($product_attribute_item->attribute_item_id, $attribute_item_ids)){
                                                        array_push($attribute_item_ids, $product_attribute_item->attribute_item_id);
                                                    
                                                @endphp
                                                <option value="1" title="S">{{ $product_attribute_item->attribute_item->name }}</option>

                                                @php } @endphp
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>

                                    @php
                                        }

                                        if(!in_array($product_dimension->color_id, $color_ids)){
                                            array_push($color_ids, $product_dimension->color_id);
                                        }
                                    @endphp

                                    @endforeach


                                    <?php if($color_ids[0] != null){ ?>
                                        <div class="product-variants">
                                            <div class="produt-variants-size">
                                                <label>Colors</label>

                                                <select class="nice-select">
                                                    
                                                   <?php
                                                    foreach($color_ids as $color_id){
                                                    $color = Colors::find($color_id);

                                                   ?>
                                                    <option value="1" title="">{{ $color->name }}</option>
                                                    <?php } ?>
                                                </select>
                                                    
                                            </div>
                                        </div>
                                    <?php } ?>
                                    
                                    
                                    <div class="single-add-to-cart">
                                        <form action="#" class="cart-quantity">
                                            <div class="quantity">
                                                <label>Quantity</label>
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" value="1" type="text">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </div>
                                            <button class="add-to-cart" type="submit">Add to cart</button>
                                        </form>
                                    </div>
                                    <div class="product-additional-info pt-25">
                                        <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                                        <div class="product-social-sharing pt-25">
                                            <ul>
                                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                                <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                                <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                                <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="block-reassurance">
                                        <ul>
                                            <li>
                                                <div class="reassurance-item">
                                                    <div class="reassurance-icon">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </div>
                                                    <p>Security policy (edit with Customer reassurance module)</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="reassurance-item">
                                                    <div class="reassurance-icon">
                                                        <i class="fa fa-truck"></i>
                                                    </div>
                                                    <p>Delivery policy (edit with Customer reassurance module)</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="reassurance-item">
                                                    <div class="reassurance-icon">
                                                        <i class="fa fa-exchange"></i>
                                                    </div>
                                                    <p> Return policy (edit with Customer reassurance module)</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

@endsection