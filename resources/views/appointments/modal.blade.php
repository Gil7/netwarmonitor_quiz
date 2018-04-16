<!-- Modal -->
<div class="modal fade" id="appointment-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Datos de la cita</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="form_add">
            <input type="hidden" id="appointment_id">
            <div class="form-group">
                <label for="subject"><i class="fa fa-info"></i> Asunto</label>
                <textarea class="form-control" id="subject"></textarea>
            </div>
            <div class="form-group col-xs-12 col-md-6">
                <label for="date_to_attend"><i class="fa fa-calendar"></i> Fecha</label>
                <input type="date"  class="form-control" id="date_to_attend" />
            </div>
            <div class="form-group col-xs-12 col-md-6">
                <label for=time_to_attend><i class="fa fa-clock-o"></i> Hora</label>
                <input type="time"  class="form-control" id="time_to_attend" />
            </div>
            
            <div class="form-group">
                <label for="contacts"><i class="fa fa-user"></i> Contacto</label>
                <select class="form-control" id="contacts" name="contacts"></select>
            </div>
            <div class="form-group" id="status_div">
                <label>Estatus actual:</label>
                <select class="form-control" id="status">
                    <option value="Pendiente">Por atender</option>
                    <option value="Atendida">Atendida</option>
                    <option value="Cancelada">Cancelada</option>
                    <!--option value="4">Eliminar</option-->
                </select>
            </div>
            <button id="btn_add_appointment" class="btn btn-success"><i class="fa fa-add"></i> Agregar</button>
            <button id="btn_update_appointment" class="btn btn-info"><i class="fa fa-refresh"></i> Actualizar</button>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
        <!--button type="button" class="btn btn-primary"><i class="fa fa-check"></i> Guardar</button-->
      </div>
    </div>
  </div>
</div>