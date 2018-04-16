$(document).ready(function () {
    loadMyContacts()
    loadAppointments()
    $("#btn_add_appointment").click(function (e) {
        e.preventDefault()
        var appointment = {
            subject: $("#subject").val().trim(),
            status: 1,//default option  = pending
            date_to_attend: $("#date_to_attend").val(),
            time_to_attend: $("#time_to_attend").val(),
            contact_id: $("#contacts :selected").val()
        }
        createAppointment(appointment)
    })
    $("#btn_update_appointment").on('click', function (e) {
        e.preventDefault()
        var appointment = {
            subject: $("#subject").val().trim(),
            status: $("#status :selected").val(),
            date_to_attend: $("#date_to_attend").val(),
            time_to_attend: $("#time_to_attend").val(),
            contact_id: $("#contacts :selected").val()
        }
        var id = $("#appointment_id").val();
        updateAppointment(appointment, id)
    })
    $("#filter").click(function (e) {
        e.preventDefault();
        var from = $("#from").val()
        var to = $("#to").val()
        console.log(from, to)
        if (from == "") {
            $("#from").parent().addClass('has-warning')
        }
        else if (to == "") {
            $("#to").parent().addClass('has-warning')
        }
        else {
            loadFromTo(from, to)
        }

    })
    function createAppointment(appointment) {
        $.ajax({
            url: '/appointments',
            method: 'post',
            data: appointment,
            success: function (data) {
                if (data.success) {
                    $('#table_appointments').DataTable().ajax.url("/allappointments").load();
                    swal(data.message, {
                        icon: "success",
                    });
                    $("#appointment-modal").modal('hide')
                }
                else {
                    //display some error message
                    swal(data.message, {
                        icon: "warning",
                    });
                }
            },
            error: function (err) {
                swal("Ha surgido un error, vuelve a intentarlo", {
                    icon: "warning",
                });
            }

        })
    }
    function updateAppointment(appointment, id) {
        $.ajax({
            url: '/appointments/' + id,
            method: 'put',
            data: appointment,
            success: function (data) {
                console.log(data)
                if (data.success) {
                    swal(data.message, {
                        icon: "warning",
                    });
                    $('#table_appointments').DataTable().ajax.url("/allappointments").load();
                    $("#appointment-modal").modal('hide')
                }
                else {
                    //display some message error
                    swal(data.message, {
                        icon: "warning",
                    });
                }

            },
            error: function (err) {
                swal("Ha surgido un error, vuelve a intentarlo", {
                    icon: "warning",
                });
            }
        })
    }
    $("#table_appointments tbody").on('click', 'tr .show_modal', function (e) {
        $("#status_div").show();
        var data = $('#table_appointments').DataTable().row($(this).parent().parent()).data();
        $("#appointment_id").val(data.id)
        $("#subject").val(data.subject)
        $("#date_to_attend").val(data.date_to_attend)
        $("#time_to_attend").val(data.time_to_attend)
        $("#contacts").val(data.contact_id)
        $("#status").val(data.status);
        $("#btn_update_appointment").show();
        $("#btn_add_appointment").hide();
    })
    $(".show_modal").on('click', function (e) {
        var modal_to_display = $(this).attr("data-option");
        if (modal_to_display == "create") {
            $("#form_add")[0].reset()
            $("#status_div").hide();
            $("#btn_update_appointment").hide();
            $("#btn_add_appointment").show();
        }
    })
    $("#table_appointments tbody").on('click', 'tr button.btn-delete', function (e) {
        var data = $('#table_appointments').DataTable().row($(this).parent().parent()).data()
        swal({
            title: "Acción",
            text: "¿Deseas eliminar esta cita?",
            icon: "warning",
            buttons: ["Cancelar", "Eliminar"],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    deleteAppointment(data.id)
                } else {
                    swal("Cita no eliminada", { icon: 'danger' });
                }
            });
    })
    function deleteAppointment(id) {
        $.ajax({
            url: '/appointments/' + id,
            method: 'DELETE',
            success: function (data) {
                if (data != false) {
                    $('#table_appointments').DataTable().ajax.url("/allappointments").load();
                    swal("Cita eliminada de manera correcta", { icon: 'success' });
                }
                else {
                    swal("Ha surgido un error, vuelve a intentarlo", {
                        icon: "warning",
                    });
                }
            },
            error: function (err) {
                swal("Ha surgido un error, vuelve a intentarlo", {
                    icon: "warning",
                });
            }
        })
    }
    function loadMyContacts() {
        $.ajax({
            url: '/allcontacts',
            method: 'get',
            success: function (contacts) {
                var select_contacts = $("#contacts")
                select_contacts.empty();
                var options = "";
                contacts.data.map((contact) => {
                    options += "<option value='" + contact.id + "'>" + contact.name + "</option>"
                })
                select_contacts.append(options)
            },
            error: function (err) {
                swal("Ha surgido un error al cargar tus contactos :(", { icon: 'danger' });
            }
        })
    }
    function loadFromTo(from, to) {
        var url = "/appointments_range/" + from + "/" + to
        $('#table_appointments').DataTable().ajax.url(url).load();
    }
    function loadAppointments() {
        $('#table_appointments').DataTable({
            "ajax": "/allappointments",
            "columns": [
                { "data": "subject" },
                { "data": "status" },
                { "data": "date_to_attend" },
                { "data": "time_to_attend" },
                { "data": "contact_name" },
                { "data": "created_at" },
                {
                    "data": null,
                    "defaultContent": '<button type="button" class= "btn btn-danger btn-xs btn-delete" > <i class="fa fa-archive"></i> Eliminar</button> <button type="button" class="show_modal btn btn-info btn-xs btn-update" data-toggle="modal" data-target="#appointment-modal" data-option="update"><i class="fa fa-eye"></i> Ver detalles</button>'
                }
            ],
            "dom": 'Bfrtip',
            "buttons": [
                //'copy', 'csv', 'excel', 'pdf', 'print'
                {
                    extend: 'excelHtml5',
                    title: "Lista de citas",
                    text: 'Excel <i class="fa fa-file-excel-o"></i> ',
                    titleAttr: 'Excel',
                    className: 'btn btn-success btn-xs pull-left',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: "Lista de citas",
                    text: 'CSV <i class="fa fa-file-text-o"></i> ',
                    titleAttr: 'CSV',
                    className: 'btn btn-success btn-xs pull-left',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: "Lista de citas",
                    text: 'PDF <i class="fa fa-file-pdf-o"></i> ',
                    titleAttr: 'pdf',
                    className: 'btn btn-danger btn-xs pull-left',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    orientation: 'landscape'
                }

            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ resultados por pagina",
                "zeroRecords": "No se ha encontado citas registradas",
                "info": "",
                "infoEmpty": "No hay resultados disponibles",
                "infoFiltered": "(filtrado de _MAX_ resultados)",
                "search": "Buscar cita: ",
                "paginate": {
                    "previous": " <i class='fa fa-arrow-circle-left'></i> ",
                    "next": " <i class='fa fa-arrow-circle-right'></i> "
                }

            },
            "responsive" : true
        });
    }

})