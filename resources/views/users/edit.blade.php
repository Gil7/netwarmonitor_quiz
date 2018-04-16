@extends("layouts.app")

@section("content")
    <div class="col-xs-12 col-md-offset-3 col-md-6" style="margin-top:15px;"> 
        <form class="form" id="form_profile">
            <input type="hidden" class="form-control" id="user_id" >
            <div class="form-group col-xs-12">
                <label><i class="fa fa-user"></i> Nombre: </label>
                <input name="name" type="text" class="form-control" id="name" required>
            </div>
            <div class="form-group col-xs-12">
                <label><i class="fa fa-envelope"></i> Correo: </label>
                <input name="email" class="form-control" id="email" required >
            </div>
            <div class="form-group col-xs-12">
                <label><i class="fa fa-key"></i> Nueva contraseña: </label>
                <input name="password" type="password" class="form-control" id="password" required>
            </div>
            <br>
            <div class="col-xs-12">

                <button id="btn_update_profile" class="btn btn-primary" ><i class="fa fa-refresh"></i> Actualizar</button>
            </div>
        </form>
    </div>
@endsection
@section('extra-js')
    <script src="/js/users/profile.js"></script>
@endsection

