@extends('admin.layout')
@section('title', 'Categories')
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

</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>All Categories</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item">Categories</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title d-inline-block">Categories</h5>
                        <div class="float-end mt-3">
                            <a href="{{ route('add_new_category') }}"><button class="btn btn-success">Add new categories</button></a>
                            <form class="d-inline-block" id="sort_categories" action="" method="GET">
                                <div class="box-inline pad-rgt pull-left">
                                    <div class="" style="min-width: 200px;">
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Type name &amp; Enter">
                                    </div>
                                </div>
                            </form>
                        </div>
                        

                        <!-- Default Table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Parent Category</th>
                                    <th scope="col">Order Level</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Banner</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Cover Image</th>
                                    <th scope="col">Featured</th>
                                    <th scope="col">Commission</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                    $offset = 1;

                                    if(isset($_GET['page'])){
                                        $offset = ($_GET['page'] - 1) * $limit + 1;
                                    }
                                
                                ?>
                                @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $offset }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ ($category->parent_category)? $category->parent_category->name : "—" }}</td>
                                    <td>0</td>
                                    <td>{{ $category->orderNumber-1}}</td>
                                    <td><img width="50" src="{{ asset($category->banner) }}"></td>
                                    <td><img width="50" src="{{ asset($category->icon) }}"></td>
                                    <td><img width="50" src="{{ asset($category->cover) }}"></td>
                                    <td>
                                        <label class="toggle">
                                            <input onclick="featured_status(this, {{ $category->featured }})" id="{{ $category->id }}" type="checkbox" {{ ($category->featured == 1)? 'checked' : '' }} value="{{ $category->featured }}"/>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>0%</td>
                                    <td>
                                        <div class="icon">
                                            <a href="{{ route('category_edit', $category->id)}}"><i class="ri-edit-box-line text-primary"></i></a>
                                            <a href="{{ route('category_delete', $category->id)}}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ri-delete-bin-5-line text-danger"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $offset++; ?>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
                        <nav id="pagination">
                            {{ $categories->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>

        function featured_status(data, current_status){
            

            if($("#checkSurfaceEnvironment-1").prop('checked') == true){
                //do something
            }

            $.ajax({
                url : "{{ route('featured_status_change_ajax') }}",
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