@extends('admin.layout')
@section('title', 'Brands')
@section('content')

<style>

    #pagination svg{
        width: 20px;
    }

</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item active">Brands</li>
            </ol>
        </nav>
    </div>


    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Brands</h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Values</th>
                                            <th scope="col">Logo</th>
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
                                        @foreach($brands as $brand)
                                        
                                        <tr>
                                            <th scope="row">{{ $offset }}</th>
                                            <td>{{ $brand->name }}</td>
                                            <td><img src="{{ asset($brand->logo) }}"></td>
                                            <td>
                                                <div class="icon">
                                                    <a href="{{ route('brand_edit', $brand->id) }}"><i class="ri-edit-box-line text-primary"></i></a>
                                                    <a href="{{ route('brand_delete', $brand->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ri-delete-bin-5-line text-danger"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $offset++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <nav id="pagination">
                                    {{ $brands->links() }}
                                </nav>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Brand</h5>
                        <div class="row">
                            <form action="{{ route('add_new_brand') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" value="" placeholder="" class="form-control" name="name">
                                </div>
                                <br>

                                <div class="col-lg-12">
                                    <label class="form-label">Logo (120x80)</label>
                                    <input type="file" value="" placeholder="" class="form-control" name="logo">
                                </div>
                                <br>

                                <div class="col-lg-12">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" value="" placeholder="" class="form-control" name="meta_title">
                                </div>
                                <br>

                                <div class="col-lg-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea rows="5" placeholder="" class="form-control" name="meta_description"></textarea>
                                </div>

                                <br>
                                <br>
                                <div class="col-lg-12">
                                    <button class="btn btn-success" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


@endsection