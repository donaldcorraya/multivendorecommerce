@extends('admin.layout')
@section('title', 'Colors')
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
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Colors</li>
            </ol>
        </nav>
    </div>


    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Colors</h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($colors as $color)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $color->name }}</td>
                                            <td>{{ $color->code }}</td>
                                            <td>
                                                <div class="icon">
                                                    <a href="{{ route('colors_edit', $color->id) }}"><i class="ri-edit-box-line text-primary"></i></a>
                                                    <a href="{{ route('colors_delete', $color->id) }}"><i class="ri-delete-bin-5-line text-danger"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <nav id="pagination">
                                    {{ $colors->links() }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Color</h5>
                        <div class="row">
                            <form action="{{ route('add_color') }}" method="post">
                                @csrf
                                <div class="col-lg-12">
                                    <input type="text" placeholder="Name" class="form-control" name="name">
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <input type="text" placeholder="Code" class="form-control" name="code">
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