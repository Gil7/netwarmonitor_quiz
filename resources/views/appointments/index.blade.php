@extends("layouts.app")

@section("content")
<form class="text-center form-inline" style="margin:15px">
    <div class="form-group">
        <label>Fecha de inicio</label>
        <input class="form-control" type="date" id="from">
    </div>
    <div class="form-group">
        <label>Fecha final</label>
        <input class="form-control" type="date" id="to">
    </div>
    <button id="filter" class="btn btn-sm btn-info"><i class="fa fa-filter"></i> Filtrar</button>
</form>
<div class="row">
    <button style="margin:15px;" data-option="create" class="show_modal btn btn-primary" data-toggle="modal" data-target="#appointment-modal"><i class="fa fa-plus"></i> Agregar</button>
    <div class="col-md-12">
        <table style="margin-top:15px" class="table table-hover table-striped" id="table_appointments">
            <thead>
                <tr>
                    <th><i class="fa fa-info"></i> Asunto</th>
                    <th><i class="fa fa-info"></i> Estatus</th>
                    <th><i class="fa fa-calendar"></i> Fecha</th>
                    <th><i class="fa fa-clock-o"></i> Hora</th>
                    <th><i class="fa fa-user"></i> Contacto</th>
                    <th><i class="fa fa-info"></i> Fecha de creación</th>
                    <th><i class="fa fa-gear"></i> Opciones</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="col-md-12">
        @include('appointments.modal')
    </div>

</div>
<button title="Ver graficas" class="btn-primary graphics" data-toggle="modal" data-target="#appointment-graphic" class="btn-circle"><i class="fa fa-line-chart fa-2x"></i></button>
@include('appointments.graphic')

@endsection

@section('extra-js')
    <script src="/js/appointments/appointments.js"></script>
    <!--script src="/js/graphics.js"></script-->
@endsection
