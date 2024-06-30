@extends('admin.layout')
@section('title', 'Attribute Item Edit')
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
                        <h5 class="card-title">{{ $attribute_items->attribute->name }}</h5>
                        <div class="row">
                            <form action="{{ route('attribute_item_edit') }}" method="post">
                                @csrf
                                <input type="hidden" name="attribute_item_id" value="{{ $attribute_items->id }}">
                                <div class="col-lg-12">
                                    <label class="form-label">Attribute Item Name</label>
                                    <input type="text" value="{{ $attribute_items->name }}" placeholder="" class="form-control" name="attribue_item_name">
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