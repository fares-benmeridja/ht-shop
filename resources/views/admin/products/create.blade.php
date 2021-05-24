@extends('layouts.admin')

@section('title', !isset($product) ? 'Add article' : 'Edit article')

@section('content')
    <div class="add-article">
        <h3 class="title-5 m-b-35"><i class="fas fa-plus"></i>{{ !isset($product) ? 'Add article' : 'Edit article' }}</h3>
        <div class="card">
            <form id="form-create" action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="card-header">
                    <strong>Enter the information below</strong>
                </div>
                <div class="card-body card-block">
                        @csrf
                        @isset($product)
                        @method('PUT')
                        @endisset
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="title" class="form-control-label">Title</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="title" name="title" value="{{ old('title', $product->title ?? null ) }}" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="description" class="form-control-label">Description</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea name="description" id="description" rows="9" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? null ) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="category" class=" form-control-label">Category</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="0">Please select</option>
                                    @foreach($categories as $key => $category)
                                        <option value="{{ $key }}" {{ old('category_id', $product->category_id ?? null) === $key ? "selected" : null }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="quantity" class="form-control-label">Quantity</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input name="qty_available" id="qty_available" class="form-control @error('qty_available') is-invalid @enderror" type="number" min="1" value="{{ old('qty_available', $product->qty_available ?? 1) }}">
                                @error('qty_available')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="price" class=" form-control-label">Price</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="price" name="price" value="{{ old('price', $product->price ?? null ) }}" class="form-control @error('price') is-invalid @enderror">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="images" class=" form-control-label">Select an image</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="images" name="images[]" multiple class="form-control-file @error('images') is-invalid @enderror">

                                @error('images')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" style="padding: 10px 20px" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>{{ ! isset($product) ? 'Add': 'Modify' }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @include('admin.includes.footer')
    </div>
@endsection