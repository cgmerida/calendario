<script>
    $(function(){
        $("#calendar-form :input").prop("disabled", true);

        $("#calendar").fullCalendar({
            themeSystem: 'bootstrap4',
            eventRender: eventPopover,
            events: {
                url: "{{ route('calendar.events.index') }}",
                type: "GET",
                cache: true,
                data: {
                    logistics: true
                },
                cache: true,
                error: function(e) {
                    console.log(e);
                    swallError(`Error en la obtención de los eventos!<br>Error: ${e.responseText}`);
                }
            },
            header: {
                left: "month,agendaWeek,agendaDay",
                center: "title",
                right: "today prev,next"
            },
            locale: "es",
            buttonText: {
                today: "hoy",
                month: "mes",
                week: "semana",
                day: "día"
            },
            height: 'auto',
            eventClick: function(calEvent) {
                titulo = 'Ver Evento';
            
                fillEventForm(calEvent);
                    
                $('.modal-title').text(titulo);
                $('#calendar-modal').modal();
            },
        });
    });

    function fillEventForm(event) {
        $("#calendar-form").attr('action', null);

        $('#event-title').text(event.title);
        $('#unity_id').val(event.activity.unity.id);
        $("#activity_id").append($('<option>', {
            value: event.activity_id,
            text: event.activity.name,
            selected: true
        }));
        $('#zone').val(event.colony.zone);
        $("#colony_id").append($('<option>', {
            value: event.colony_id,
            text: event.colony.name,
            selected: true
        }));
        $('#address').val(event.address);
        $('#description').val(event.description);
        $('#date').val(event.start.format('DD/MM/YYYY'));
        $('#start').val(event.start.format('HH:mm'));
        $('#end').val(event.end.format('HH:mm'));
        $('#logistics').prop('checked', event.logistics);
    }

    $(document).ready(function() {
        $('#calendar-modal').on('hidden.bs.modal', function (e) {
            $('#event-title').empty();
            $("#calendar-form")[0].reset();
            $("#activity_id, #colony_id").html('<option>Seleccione opcion anterior</option>');
        });
    });
    
    function swallError(mensaje) {
        swal("¡Error!", `<small class=text-danger>${mensaje}</small>`, "error");
    }

    function eventPopover(eventObj, $el) {
        let content = `
        ${eventObj.description}
        <hr>
        <div class="popover-footer">
            <h6 class="c-grey-900">Requerimientos:</h6>
            ${eventObj.activity.require}
        </div>`;

        if (eventObj.status == 'Pendiente') {
            content += `
            <hr>
            <div class="popover-footer">
                <button type="button" class="btn btn-success btn-sm"
                onclick="scheludeEvent(${eventObj.id});">
                    <i class="ti-check-box"></i> Agendar
                </button>
                <button type="button" class="btn btn-danger btn-sm"
                onclick="rejectEvent(${eventObj.id});">
                    <i class="ti-close"></i> Rechazar
                </button>
            </div>`;
        }
        $el.popover({
            trigger: "manual",
            title: eventObj.title,
            content: content,
            animation: false
        })
        .on("mouseenter", function () {
            if ($('.popover').length > 0) {
                $('.popover').remove();
            }
            var _this = this;
            $(this).popover("show");
            $(".popover").on("mouseleave", function () {
                $(_this).popover('hide');
            });
        }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide");
                }
            }, 100);
        });
    }

    function scheludeEvent(event_id) {
        swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir el cambio!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, ¡Agendarlo!',
            cancelButtonText: 'No, ¡Cancelar!',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                return axios.post(`${event_id}/schelude`)
                .then(res => res.data)
                .catch(error => {
                    swal.showValidationMessage(
                    `Fallo la petición: ${error.message}`
                    )
                });
            },
            allowOutsideClick: () => !swal.isLoading()
        })
        .then(res => {
            if (res.value) {
                const message = res.value.message,
                event = res.value.event;

                $('#calendar').fullCalendar('removeEvents', event.id);
                $('#calendar').fullCalendar('renderEvent', event, false);
                
                swal.fire(
                    '¡Agendado!',
                    `${res.value.message}`,
                    'success'
                )
            }
        });
    }

    function rejectEvent(event_id) {
        swal.fire({
            title: '¿Estás seguro que deseas Rechazar?',
            text: "¡No podrás revertir el cambio!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, ¡Rechazarlo!',
            cancelButtonText: 'No, ¡Cancelar!',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                return axios.post(`${event_id}/reject`)
                .then(res => res.data)
                .catch(error => {
                    swal.showValidationMessage(
                    `Fallo la petición: ${error.message}`
                    )
                });
            },
            allowOutsideClick: () => !swal.isLoading()
        })
        .then(res => {
            if (res.value) {
                const message = res.value.message,
                event = res.value.event;

                $('#calendar').fullCalendar('removeEvents', event.id);
                $('#calendar').fullCalendar('renderEvent', event, false);
                
                swal.fire(
                    '¡Rechazado!',
                    `${res.value.message}`,
                    'success'
                )
            }
        });
    }
    
</script>