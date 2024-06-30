@extends('admin.layout')
@section('title', 'Color Edit')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Color Edit</li>
            </ol>
        </nav>
    </div>


    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $color->name }}</h5>
                        <div class="row">
                            <form action="{{ route('color_edit_submit') }}" method="post">
                                @csrf
                                <input type="hidden" name="color_id" value="{{ $color->id }}">
                                <div class="col-lg-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" value="{{ $color->name }}" placeholder="" class="form-control" name="name">
                                </div>
                                
                                <br>
                                <div class="col-lg-12">
                                    <label class="form-label">Code</label>
                                    <input type="text" value="{{ $color->code }}" placeholder="" class="form-control" name="code">
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