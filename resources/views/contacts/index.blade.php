@extends("layouts.app")

@section("content")
    <button style="margin:15px" data-option="create" class="show_modal btn btn-primary" data-toggle="modal" data-target="#contact-modal">
        <i class="fa fa-plus"></i> Argegar 
    </button>
    <table class="table table-hover table-striped" id="table_contacts">
        <thead>
            <tr>
                <th><i class="fa fa-user"></i> Nombre</th>
                <th><i class="fa fa-user"></i> Apellidos</th>
                <th><i class="fa fa-envelope"></i> Email</th>
                <th><i class="fa fa-telephone"></i> Telefono</th>
                <th><i class="fa fa-info"></i> Estado</th>
                <th><i class="fa fa-info"></i> Municipio</th>
                <th><i class="fa fa-gear"></i> Opciones</th>
            </tr>
        </thead>

</table>
@include('contacts.modal')
@endsection

@section('extra-js')
    <script src="/js/contacts/contacts.js"></script>
@endsection
