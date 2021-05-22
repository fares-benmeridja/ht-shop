<form class="form-sign-up" id="form-update" method="POST" action="{{ route('admins.update', $admin) }}">
    @csrf
    @method('PUT')
    <div class="form-row">
        <div class="form-group col-md-6">
            <input type="text" value="{{ $admin->first_name }}" name="first_name" class="form-control" placeholder="First name">
        </div>
        <div class="form-group col-md-6">
            <input type="text" value="{{ $admin->last_name }}" name="last_name" class="form-control" placeholder="Last name">
        </div>
        <div class="form-group col-md-6">
            <input type="email" value="{{ $admin->email }}" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group col-md-6">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="margin-bottom: 16px">+213</div>
                </div>
                <input type="text" value="{{ $admin->phone_native }}" name="phone" class="form-control" placeholder="Phone number">
            </div>
        </div>
            <div class="form-group col-md-12">
                <label for="wilaya_id">Rôle</label>
                <select class="form-control" name="role_id" id="role_id">
                    <option value="0" selected>Choose...</option>
                    @foreach($roles as $key => $role)
                        <option value="{{ $key }}" {{ old('wilaya_id', $admin->role_id ) == $key ? "selected" : '' }}>{{ "$role" }}</option>
                    @endforeach
                </select>
            </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="address">Mailing address</label>
            <input type="text" value="{{ $admin->address }}" name="address" class="form-control" id="address" placeholder="Cité 124 logements">
        </div>
        <br>
        <div class="form-group col-md">
            <label for="wilaya_id">Wilaya</label>
            <select class="form-control linked-select" name="wilaya_id" id="wilaya_id" data-target="#daira_id" data-source="/dairas/id">
                <option value="0" selected>Choose...</option>
                @foreach($wilayas as $key => $wilaya)
                    <option value="{{ $key }}" {{ old('wilaya_id', $admin->wilaya_id ) == $key ? "selected" : '' }}>{{ "($key) $wilaya" }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md" style="{{ old('daira_id', $admin->daira_id ?? null) ?? "display: none" }}">
            <label for="daira_id">Daira</label>
            <select class="form-control linked-select" name="daira_id" id="daira_id" data-target="#commune_id" data-source="/communes/id">
                <option value="0" selected>Choose...</option>
                @foreach(\App\Models\Daira::where('wilaya_id', $admin->wilaya_id)->pluck('name', 'id') as $key => $daira)
                    <option value="{{ $key }}" {{ old('daira_id', $admin->daira_id ?? null) == $key ? "selected" : '' }}>{{ "($key) $daira" }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md" style="{{ old('commune_id', $admin->commune->id ?? null) ?? "display: none" }}">
            <label for="commune_id">Commune</label>
            <select class="form-control" name="commune_id" id="commune_id">
                <option value="0" selected>Choose...</option>
                @foreach(\App\Models\Commune::where('daira_id', $admin->daira_id)->pluck('name', 'id') as $key => $commune)
                    <option value="{{ $key }}" {{ old('commune_id', $admin->commune->id ?? null ) == $key ? "selected" : '' }}>{{ "($key) $commune" }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Save changes</button>
</form>