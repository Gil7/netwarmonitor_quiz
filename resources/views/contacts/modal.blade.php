<!-- Modal for contacts, actions : create or update-->
<div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Datos de contacto</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="form_add">
            <input type="hidden" value="" id="contact_id">
            <div class="form-group col-xs-12 col-sm-6">
                <label for="name"><i class="fa fa-user"></i> Nombre</label>
                <input type="text" class="form-control" id="name" />
            </div>
            <div class="form-group col-xs-12 col-sm-6">
                <label for="lastname"><i class="fa fa-user"></i> Apellidos</label>
                <input type="text" class="form-control" id="lastname" />
            </div>
            <div class="form-group col-xs-12 col-sm-6">
                <label for="email"><i class="fa fa-envelope"></i> Correo electronico</label>
                <input type="email"  class="form-control" id="email" />
            </div>
            <div class="form-group col-xs-12 col-sm-6">
                <label for="phone"><i class="fa fa-phone"></i> Telefono</label>
                <input type="phone"  class="form-control" id="phone" />
            </div>
            <div class="form-group col-xs-12 col-sm-6">
                <label for="state"><i class="fa fa-info"></i> Estado</label>
                <select class="form-control" id="state" name="state"></select>
            </div>
            <div class="form-group col-xs-12 col-sm-6">
                <label for="municipality"><i class="fa fa-info"></i> Municipio</label>
                <select class="form-control" id="municipality" name="municipality"></select>
            </div>
            <button id="btn_add_contact" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button>
            <button id="btn_update_contact" class="btn btn-info"><i class="fa fa-refresh"></i> Actualizar</button>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
        <!--button type="button" class="btn btn-primary"><i class="fa fa-check"></i> Guardar</button-->
      </div>
    </div>
  </div>
</div>