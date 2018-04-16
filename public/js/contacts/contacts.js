$(document).ready(function () {
    var all_municipalities = []
    loadContactsAndStates();
    $("#state").on('change', (e) => 
    {
        e.preventDefault();
        var id = $("#state :selected").val();
        filyerByState(id)
    })
    $("#btn_add_contact").on('click', function (e) 
    {
        e.preventDefault();
        console.log("add a new contact")
        var contact = {
            name: $("#name").val().trim(),
            lastname: $("#lastname").val().trim(),
            email: $("#email").val().trim(),
            phone: $("#phone").val().trim(),
            state: $("#state :selected").val(),
            municipality: $("#municipality :selected").val()
        }
        createContact(contact);
    })
    $("#btn_update_contact").on('click', function (e) {
        e.preventDefault();
        var contact = {
            name: $("#name").val().trim(),
            lastname: $("#lastname").val().trim(),
            email: $("#email").val().trim(),
            phone: $("#phone").val().trim(),
            state: $("#state :selected").val(),
            municipality: $("#municipality :selected").val()
        }
        var id = $("#contact_id").val();;
        updateContact(contact, id)

    })
    $(".show_modal").on('click', function (e) {
        var modal_to_display = $(this).attr("data-option");
        filyerByState(1)
        if (modal_to_display == "create") {
            $("#form_add")[0].reset()
            $("#btn_update_contact").hide();
            $("#btn_add_contact").show();
        }
    })
    $("#table_contacts tbody").on('click', 'tr button.show_modal', function (e) {
        var data = $('#table_contacts').DataTable().row($(this).parent().parent()).data();
        $("#contact_id").val(data.id);
        $("#name").val(data.name)
        $("#lastname").val(data.lastname)
        $("#phone").val(data.phone)
        $("#email").val(data.email)
        $("#state").val(data.state_id)
        filyerByState(data.state_id)
        $("#municipality").val(data.municipality_id)
        $("#btn_update_contact").show();
        $("#btn_add_contact").hide();

    })
    $("#table_contacts tbody").on('click', 'tr button.btn-delete', function (e) {
        var data = $('#table_contacts').DataTable().row($(this).parent().parent()).data()
        swal({
            title: "¿Confirmar acción?",
            text: "Borrar a tu contacto: " + data.name + " " + data.lastname,
            icon: "warning",
            buttons: ["Cancelar", "Eliminar"],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    deleteContact(data.id)
                } else {
                    swal("Contacto no eliminado");
                }
            });
    })
    function filyerByState(id) {
        var state_selected = all_municipalities.filter((state) => {
            return state.id == id
        })
        var filtered = state_selected[0].municipalities.filter((municipality) => {
            return municipality.state_id = id
        })
        console.log("filtered: ", filtered)
        var select_municipalities = $("#municipality")
        select_municipalities.empty()
        var options = "";
        filtered.map((municipality) => {
            options += "<option value='" + municipality.id + "'>" + municipality.name + "</option>"
        })
        select_municipalities.append(options)
    }
    function createContact(contact) {
        $.ajax({
            url: '/contacts',
            method: 'POST',
            data: contact,
            beforeSend: function () {
                
            },
            success: function (data) {
                
                if (data.success) {
                    $("#contact-modal").modal('hide');
                    $("#table_contacts").DataTable().ajax.url('/allcontacts').load();
                    swal(data.message, {
                        icon: "success",
                    });

                }
                else {
                    swal(data.message, {
                        icon: "warning",
                    });
                }

            },
            error: function (err) {
                console.log(err)
                swal("Ha surgido un error, vuelve a intentarlo", {
                    icon: "warning",
                });
            },
            complete: function () {

            }
        })
        return false;
    }
    function updateContact(contact, id) {
        $.ajax({
            url: '/contacts/' + id,
            method: 'PUT',
            data: contact,
            beforeSend: function () {

            },
            success: function (data) {
                
                if (data.success) {
                    $("#contact-modal").modal('hide');
                    $("#table_contacts").DataTable().ajax.url('/allcontacts').load();

                    swal(data.message, {
                        icon: "success",
                    });
                }
                else {
                    swal(data.message, {
                        icon: "warning",
                    });
                }
            },
            error: function (err) {
                swal("Ha surgido un error, vuelve a intentarlo", {
                    icon: "warning",
                });
            },
            complete: function () {

            }
        })
    }

    function deleteContact(contact_id) {
        $.ajax({
            url: '/contacts/' + contact_id,
            method: 'delete',
            beforeSend: function () {

            },
            success: function (data) {
                if (data) {
                    $("#table_contacts").DataTable().ajax.url('/allcontacts').load();
                    swal("Contacto eliminado de manera correcta", {
                        icon: "success",
                    });

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
            },
            complete: function () {

            }
        })
    }
    function loadContactsAndStates() {
        $('#table_contacts').DataTable({
            "ajax": "/allcontacts",
            "columns": [
                { "data": "name" },
                { "data": "lastname" },
                { "data": "phone" },
                { "data": "email" },
                { "data": "state_name" },
                { "data": "municipality_name" },
                {
                    "data": null,
                    "defaultContent": '<button title="eliminar" type="button" class= "btn btn-danger btn-xs btn-delete" > <i class="fa fa-archive"></i> Eliminar</button> <button title="detalles" type="button" class="show_modal btn btn-info btn-xs btn-update" data-toggle="modal" data-target="#contact-modal" data-option="update"><i class="fa fa-eye"></i> Ver detalles</button>'
                }
            ],
            "order": false,
            "filter": true,
            "dom": 'Bfrtip',
            "buttons": [
                //'copy', 'csv', 'excel', 'pdf', 'print'
                {
                    extend: 'excelHtml5',
                    title: "Lista de contactos",
                    text: ' Excel <i class="fa fa-file-excel-o"></i> ',
                    titleAttr: 'Excel',
                    className: 'btn btn-success btn-xs pull-left',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: "Lista de contactos",
                    text: ' CSV <i class="fa fa-file-text-o"></i> ',
                    titleAttr: 'CSV',
                    className: 'btn btn-success btn-xs pull-left',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: "Lista de contactos",
                    text: ' PDF <i class="fa fa-file-pdf-o"></i> ',
                    titleAttr: 'pdf',
                    orientation: 'landscape',
                    className: 'btn btn-danger btn-xs pull-left',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }

            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ resultados por pagina",
                "zeroRecords": "No se han encontrado contactos registrados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay resultados disponibles",
                "infoFiltered": "(filtrado de _MAX_ resultados)",
                "search": "Buscar contacto: ",
                "paginate": {
                    "previous": " <i class='fa fa-arrow-circle-left'></i> ",
                    "next": " <i class='fa fa-arrow-circle-right'></i> "
                }

            }

        });
        //load states
        $.ajax({
            url: '/states',
            beforeSend: function () {

            },
            success: function (data) {
                all_municipalities = data
                var select = $("#state");
                select.empty();
                var options = "";
                data.map((state) => {
                    options += "<option value='" + state.id + "'>" + state.name + "</option>"
                })
                select.append(options);
            },
            error: function (err) {
                console.log(err)
            },
            complete: function () {
                filyerByState(1)
            }
        })
    }
});