@extends('admin.layout')
@section('title', 'Add New Category')
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

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Add new category</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>


    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Category Information</h5>

                        <form method="post" action="{{ route('add_new_category') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <select name="type_id" required="" class="form-control">
                                        <option value="1">Physical</option>
                                        <option value="2">Digital</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Parent Category</label>
                                <div class="col-sm-10">
                                    <select name="parent_category_id" class="form-select" aria-label="Default select example">
                                        <option value="">No Parent</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>

                                            @if(count($category->childrenRecursive) > 0)
                                                @include('admin.subCategories', ['subcategories' => $category->childrenRecursive, 'parent' => $category->name])
                                            @endif
                                            
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Ordering number</label>
                                <div class="col-sm-10">
                                    <input type="number" name="orderNumber" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Banner(200x200)</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="banner" type="file" id="formFile">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Icon(32x32)</label>
                                <div class="col-sm-10">
                                    <input type="file" name="icon" class="form-control">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="inputTime" class="col-sm-2 col-form-label">Cover Image(360x360)</label>
                                <div class="col-sm-10">
                                    <input type="file" name="cover" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputColor" class="col-sm-2 col-form-label">Meta title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="meta" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Meta description</label>
                                <div class="col-sm-10">
                                    <textarea name="metaDescription" class="form-control" style="height: 100px"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Filtering Attributes</label>
                                <div class="col-sm-10">
                                    <select class="js-example-basic-multiple" name="attributes[]" multiple="multiple">
                                        @foreach($attributes as $attribute)
                                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section>
</main>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>

@endsection