<!--Start Modal-->
@guest
<div class="window">

    <!-- Start Modal Login -->
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enter your e-mail and password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="sign-in" class="form-sign-up" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-label-group">
                            <input name="email" type="email" id="email" class="form-control" placeholder="E-mail" required autofocus autocomplete="email">
                        </div>
                        <div class="form-label-group">
                            <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Login -->

    <!--Start Modal Sign up-->
    <div class="modal fade" id="signup" tabindex="-1" aria-labelledby="signup-modal" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signup-modal">Please fill in the fields below</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-create" class="form-sign-up" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="margin-bottom: 16px">+213</div>
                                    </div>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="address">Mailing address</label>
                                <input type="text" name="address" class="form-control" id="address" placeholder="Cité 124 logements">
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
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal Sign uo -->
</div>
<!--End Modal-->
@endguest