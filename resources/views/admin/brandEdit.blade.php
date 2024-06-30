@extends('admin.layout')
@section('title', 'Brands Edit')
@section('content')

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
                        <h5 class="card-title">Edit Brand</h5>
                        <div class="row">
                            <form action="{{ route('brand_edit_submit', $brand->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="brand_id" value="{{ $brand->id }}">
                                <div class="col-lg-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" value="{{ $brand->name }}" placeholder="" class="form-control" name="name">
                                </div>
                                <br>

                                <div class="col-lg-12">
                                    <label class="form-label">Logo (120x80)</label>
                                    <img src="{{ asset($brand->logo) }}">
                                    <input type="file" value="" placeholder="" class="form-control" name="logo">
                                </div>
                                <br>

                                <div class="col-lg-12">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" value="{{ $brand->meta_title }}" placeholder="" class="form-control" name="meta_title">
                                </div>
                                <br>

                                <div class="col-lg-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea rows="5" placeholder="" class="form-control" name="meta_description">{{ $brand->meta_description }}</textarea>
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