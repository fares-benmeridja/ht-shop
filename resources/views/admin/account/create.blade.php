@extends('layouts.admin')

@section('title', 'Add admin')

@section('content')
    <div class="add-admin">
        <h3 class="title-3 m-b-30">
            <i class="fas fa-users"></i>Admin information</h3>
        <form class="form-sign-up" id="form-create" method="POST" action="{{ route('admins.store') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="first_name" class="form-control" placeholder="First name">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="last_name" class="form-control" placeholder="Last name">
                </div>
                <div class="form-group col-md-6">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="margin-bottom: 16px">+213</div>
                        </div>
                        <input type="text" name="phone" class="form-control" placeholder="Phone number">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group col-md-6">
                    <input name="password_confirmation" type="password" class="form-control" placeholder="Password confirmation">
                </div>
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" name="facebook" placeholder=" Facebook account">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Cité 124 logements">
                </div>
                <br>
                <div class="form-group col-md">
                    <label for="wilaya_id">Wilaya</label>
                    <select class="form-control linked-select" name="wilaya_id" id="wilaya_id" data-target="#daira_id" data-source="/dairas/id">
                        <option value="0" selected>Choose...</option>
                        @foreach($wilayas as $key => $wilaya)
                            <option value="{{ $key }}" {{ old('wilaya_id') == $key ? "selected" : '' }}>{{ "($key) $wilaya" }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md" style="{{ old('daira_id') ?? "display: none" }}">
                    <label for="daira_id">Daira</label>
                    <select class="form-control linked-select" name="daira_id" id="daira_id" data-target="#commune_id" data-source="/communes/id">
                        <option value="0" selected>Choose...</option>

                    </select>
                </div>
                <div class="form-group col-md" style="{{ old('commune_id') ?? "display: none" }}">
                    <label for="commune_id">Commune</label>
                    <select class="form-control" name="commune_id" id="commune_id">
                        <option value="0" selected>Choose...</option>

                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="role_id">Role</label>
                    <select class="form-control" name="role_id">
                        <option value="0" selected>Choose...</option>
                        @foreach($roles as $key => $role)
                            <option value="{{ $key }}" {{ old('wilaya_id') == $key ? "selected" : '' }}>{{ "$role" }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Add admin</button>
        </form>
    </div>
    <div class="row">
        @include('admin.includes.footer')
    </div>
@endsection