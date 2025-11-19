@extends('admin.partials.app')

@section('content')
<div class="container-xxl">
    <div class="d-flex justify-content-between">
        <div class="text-end">
            <a href="{{ route('admin.create.product') }}" class="btn btn-success">Haryt Gos</a>
        </div>
        <div>
            <a href="{{ route('admin.seller') }}" class="btn btn-outline-success w-100 fw-semibold text-start mb-2">
                Create Store
            </a>
        </div>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr class="fw-bold text-center">
                    <th>T/b</th>
                    <th>Satyjy</th>
                    <th>Haryt ady</th>
                    <th>Bahasy</th>
                    <th>Kategoriyasy</th>
                    <th>Dusundirisi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $products as $product )
                <tr>
                    <td class="fw-bold">{{ $i++ }}</td>
                    <td>{{ $product->vendor->name }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td class="d-flex"><a href="#" class="btn btn-warning me-1 text-white">Uytget</a>
                        <a href="" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection