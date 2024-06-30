@extends('admin.layout')
@section('title', 'Attributes')
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
                        <h5 class="card-title">Attributes</h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Values</th>
                                            <th scope="col">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attributes as $attribute)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $attribute->name }}</td>
                                            <td>
                                                @foreach($attribute->attribute_items as $attr_item)
                                                <span class="badge bg-secondary">{{ $attr_item->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="icon">
                                                    <a href="{{ route('attributesDetails', $attribute->id) }}"><i class="bi bi-eye-fill text-success"></i></a>
                                                    <a href="{{ route('attributes_edit', $attribute->id) }}"><i class="ri-edit-box-line text-primary"></i></a>
                                                    <a href="{{ route('attributes_delete', $attribute->id) }}"><i class="ri-delete-bin-5-line text-danger"></i></a>
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
                            <form action="{{ route('add_attribute') }}" method="post">
                                @csrf
                                <div class="col-lg-12">
                                    <input type="text" placeholder="Name" class="form-control" name="name">
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