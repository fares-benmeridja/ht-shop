<form method="POST" id="form-create" action="{{ route('profil.updatePass', auth()->user()) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <input type="password" name="current_password" class="form-control" placeholder="Current password">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="New password">
    </div>
    <div class="form-group">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Re-type new password">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>