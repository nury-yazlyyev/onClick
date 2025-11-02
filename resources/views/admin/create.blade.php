@extends('client.layout.app')

@section('content')
<div class="container-xxl">
    <div class="">
        <div class="">
            <div>
                @if (session('success'))
                <div class="alert alert-success mt-2">
                    {{ session('success') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="">
                <form action="{{ route('store.product') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    Ady: <input type="text" name="name" placeholder="Haryt Ady...">
                    Bahasy: <input type="number" name="price" placeholder="Haryt Bahasy...">
                    <select name="category_id" class="form-select">
                        <option value="">Kategori saylan</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    Dusunduris: <input type="text" name="description" placeholder="Dusunduris yazyn...">
                    <input name="image" type="file">
                    <button type="submit" class="btn btn-success">Haryt Gos</button>
                </form>
            </div>
            <div>

            </div>
        </div>
    </div>
@endsection