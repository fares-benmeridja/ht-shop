@extends('layouts.master')

@section('title', 'ht_shop - Contact us!')

@section('content')
    <div class="container">
        <div class="row">

        @foreach($products as $categories)
            <div class="form-group col-md-12 col-xl-6">
                <img src="{{ asset('storage'.DIRECTORY_SEPARATOR.$categories->first()->category->image) }}" style="width: 50px; height: 50px; margin-right: 16px; object-fit: cover" alt="{{ $categories->first()->category->name }}"><label for="{{ $categories->first()->category->name }}" style="font-size: large">{{ $categories->first()->category->name }}s</label>
                <select class="form-control multiple-linked-select" name="{{ $categories->first()->category->name }}" id="{{ $categories->first()->category->name }}" data-target="#" data-source="/product/id">
                    <option value="0" selected>Choose...</option>
                    @foreach($categories as $product)
                        <option value="{{ $product->id }}" {{ old($product->category->name) == $product->id ? "selected" : '' }}>{{ "$product->title $product->formatedPrice" }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach
        </div>
    </div>
{{--    <div class="form-group col-md" style="{{ old('daira_id', auth()->user()->daira_id ?? null) ?? "display: none" }}">--}}
{{--        <label for="daira_id">Daira</label>--}}
{{--        <select class="form-control linked-select" name="daira_id" id="daira_id" data-target="#commune_id" data-source="/communes/id">--}}
{{--            <option value="0" selected>Choose...</option>--}}
{{--            @foreach(\App\Models\Daira::where('wilaya_id', auth()->user()->wilaya_id)->pluck('name', 'id') as $key => $daira)--}}
{{--                <option value="{{ $key }}" {{ old('daira_id', auth()->user()->daira_id ?? null) == $key ? "selected" : '' }}>{{ "($key) $daira" }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </div>--}}
{{--    <div class="form-group col-md">--}}
{{--        <label for="commune_id">Commune</label>--}}
{{--        <select class="form-control" name="commune_id" id="commune_id">--}}
{{--            <option value="0" selected>Choose...</option>--}}
{{--            @foreach(\App\Models\Commune::where('daira_id', auth()->user()->daira_id)->pluck('name', 'id') as $key => $commune)--}}
{{--                <option value="{{ $key }}" {{ old('commune_id', auth()->user()->commune->id ?? null ) == $key ? "selected" : '' }}>{{ "($key) $commune" }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </div>--}}

@endsection