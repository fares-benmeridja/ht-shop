@extends('layouts.master')

@section('title', 'ht_shop - Contact us!')

@section('content')
    <div class="form-group col-md">
        <label for="processor">Processor</label>
        <select class="form-control linked-select" name="processor" id="processor" data-target="" data-source="/product/id">
            <option value="0" selected>Choose...</option>
            @foreach($products['CPUs'] as $cpu)
                <option value="{{ $cpu->id }}" {{ old('processor') == $cpu->id ? "selected" : '' }}>{{ "$cpu->title" }}</option>
            @endforeach
        </select>
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