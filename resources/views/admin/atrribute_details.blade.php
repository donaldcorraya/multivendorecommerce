@extends('admin.layout')
@section('title', 'Attribute Details')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Attributes</li>
            </ol>
        </nav>
    </div>


    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $attribute->name }}</h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Values</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attribute->attribute_items as $attribute_items)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <span class="badge bg-secondary">{{ $attribute_items->name }}</span>
                                            </td>
                                            <td>
                                                <div class="icon">
                                                    <a href="{{ route('attributesDetailsEdit', $attribute_items->id) }}"><i class="ri-edit-box-line text-primary"></i></a>
                                                    <a href="{{ route('attributesDetailsDelete', $attribute_items->id) }}"><i class="ri-delete-bin-5-line text-danger"></i></a>
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
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Attribute</h5>
                        <div class="row">
                            <form action="{{ route('add_attribute_item') }}" method="post">
                                @csrf
                                <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
                                <div class="col-lg-12">
                                    <label class="form-label">Attribute Name</label>
                                    <input type="text" value="{{ $attribute->name }}" disabled placeholder="{{ $attribute->name }}" class="form-control" name="attribue_name">
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <label class="form-label">Attribute Value</label>
                                    <input type="text" placeholder="Value" class="form-control" name="attribue_value">
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