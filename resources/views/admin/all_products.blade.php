@extends('admin.layout')
@section('title', 'All Products')
@section('content')

<style>

.toggle {
  position: relative;
}

.toggle input {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

.toggle .onoff {
  color: #000;
  font-size: 15px;
  text-align: center;
  display: block;
  font-family: Arial, Helvetica, sans-serif;
}

.slider {
  position: relative;
  display: block;
  cursor: pointer;
  background-color: #3333331c;
  transition: 0.4s;
  width: 40px;
  height: 20px;
}

.slider:before {
  content: "";
  position: absolute;
  height: 20px;
  width: 20px;
  background-color: red;
  transition: 0.4s;
  border-radius: 10px;
}

input:checked + .slider {
  /* background-color: #38cf38; */
  /* box-shadow: 0 0 12px #fd5d00; */
}

input:checked + .slider:before {
  background-color: #38cf38;
  transform: translateX(20px);
}

.slider.round {
  border-radius: 10px;
}
.slider.round::before {
  border-radius: 10px;
}
    


.filterProduct {
    width: auto;
    display: inline;
    margin-right: 10px;
    margin-bottom: 10px;
}

</style>


<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">All Products</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            
        </nav>
    </div>


    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Products</h5>

                        <a href="{{ route('add_product') }}"><button class="form-control filterProduct bg-primary text-white">Add Product</button></a>

                        <select id="" class="filterProduct form-select">
                            <option>Bulk Action</option>
                            <option value="1">Delete</option>
                        </select>

                        <select id="" class="filterProduct form-select">
                            <option>All Seller</option>
                            <option value="1">One</option>
                            <option value="2">Tow</option>
                        </select>

                        <select id="" class="filterProduct form-select">
                            <option>Sort By</option>
                            <option value="1">One</option>
                            <option value="2">Tow</option>
                        </select>

                        <input type="text" class="form-control filterProduct" placeholder="Type & Enter">

                        <table class="table table-hover" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Added By</th>
                                    <th scope="col">Info</th>
                                    <th scope="col">Total Stock</th>
                                    <th scope="col">Todays Deal</th>
                                    <th scope="col">Published</th>
                                    <th scope="col">Featured</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($products as $product)

                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <img src="{{ asset($product->thumbnail_image) }}" style="max-width: 50px; height: auto;">
                                        {{ $product->name }}
                                    </td>
                                    <td>{{ $product->user->name }}</td>
                                    <td>
                                        <small><b>Num of Sale:</b> 0 times</small>
                                        <br>
                                        <small><b>Base Price:</b> $559.990</small>
                                        <br>
                                        <small><b>Rating:</b> 0</small>
                                    </td>
                                    <td>
                                        @php
                                            $total_stock = 0;
                                        @endphp
                                        @foreach($product->product_variant as $product_variant)
                                            
                                            @php
                                                $total_stock = $total_stock + (int)$product_variant->qty;
                                            @endphp
                                            
                                        @endforeach
                                        @php
                                            echo $total_stock ;
                                        @endphp
                                    </td>
                                    <td>
                                        <label class="toggle">
                                            <input id="{{ $product->id }}" onchange="todays_deal(this, {{ $product->todays_deal }})" type="checkbox"  {{ ($product->todays_deal == 1)? 'checked' : '' }}/>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="toggle">
                                            <input id="{{ $product->id }}" type="checkbox" onchange="productStatus(this, {{ $product->status }})"  value="" {{ ($product->status == 1)? 'checked' : '' }}/>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="toggle">
                                            <input id="{{ $product->id }}" type="checkbox" onchange="productFeaturedStatus(this, {{ $product->featured }})"  value="" {{ ($product->featured == 1)? 'checked' : '' }}/>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="icon">
                                            <a href=""><i class="bi bi-eye text-success"></i></a>
                                            <a href="{{ route('product_edit', $product->id) }}"><i class="ri-edit-box-line text-primary"></i></a>
                                            <a href="" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ri-delete-bin-5-line text-danger"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>

    function productFeaturedStatus(data, current_status){

        $.ajax({
            url : "{{ route('product_featured_status_change_ajax') }}",
            type : 'post',
            data : {
                "_token": "{{ csrf_token() }}",
                'id' : data.id,
                'current_status' : current_status,
            },

            dataType : 'json',

            success : function(res){   
                console.log(res);
                if(res.error == false){
                    toastr.success(res.message);
                }
                
                if(res.error == true){
                    toastr.error(res.message);
                }
                
            }
        });

    }

    function productStatus(data, current_status){
        $.ajax({
            url : "{{ route('product_status_change_ajax') }}",
            type : 'post',
            data : {
                "_token": "{{ csrf_token() }}",
                'id' : data.id,
                'current_status' : current_status,
            },

            dataType : 'json',

            success : function(res){   
                console.log(res);
                if(res.error == false){
                    toastr.success(res.message);
                }
                
                if(res.error == true){
                    toastr.error(res.message);
                }
                
            }
        });
    }

    function todays_deal(data, current_status){
        
        $.ajax({
            url : "{{ route('todays_deal_status_change_ajax') }}",
            type : 'post',
            data : {
                "_token": "{{ csrf_token() }}",
                'id' : data.id,
                'current_status' : current_status,
            },

            dataType : 'json',

            success : function(res){   
                console.log(res);
                if(res.error == false){
                    toastr.success(res.message);
                }
                
                if(res.error == true){
                    toastr.error(res.message);
                }
                
            }
        });

        
    }
    

</script>

@endsection

