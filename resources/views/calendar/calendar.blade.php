@extends('admin.master')

@section('content')

    <div class="modal" tabindex="-1" role="dialog" id="calendar-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    @include('calendar.form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <div id="deletable" class="m-0"></div>
                    <button type="button" class="btn btn-primary" id="guardar"></button>
                </div>
            </div>
        </div>
    </div>


    <div id="calendar"></div>
@endsection
 
@section('js')
    <script>
        $(function(){
            $("#calendar").fullCalendar({
                themeSystem: 'bootstrap4',
                events: {
                    url: "calendar/events",
                    type: "GET",
                    cache: true,
                    error: function(e) {
                        console.log(e);
                        swallError("Error en la obtención de los eventos!");
                    }
                },
                // hiddenDays: [1],
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
                height: 800,
                editable: true,
                dayClick: function(date, jsEvent, view) {
                    if (view.name === 'month') {
                        
                        let d = new Date();
                        if(date > d.getTime()){
                            $('input[name=_method]').val('POST');
    
                            let form = $("#calendar-form")[0];   
                            form.action = 'calendar/events';
    
                            $('#date').val(date.format('YYYY-MM-DD'));
    
                            $('.modal-title').text('Crear Evento');
                            $('#guardar').text('Crear');
                            $('#calendar-modal').modal();
                        } else {
                            swallError('No puedes crear eventos en fechas pasadas.')
                        }
                    }
                },
                eventClick: function(calEvent) {
                    let d = new Date();
                    let titulo = "";
                    if(calEvent.start > d.getTime()){
                        $.ajax({
                            url: 'calendar/events/delete-btn/' + calEvent.id,
                            type: "GET",
                            success: function(data){
                                $('#deletable').html(data);
                            }
                        });

                        titulo = 'Actualizar Evento';
                        $('#guardar').text('Actualizar');
                        
                    } else {
                        titulo = 'Ver Evento';
                        $("#calendar-form :input").prop("disabled", true);
                        $('#guardar').hide();
                    }
                    
                    const action = 'calendar/events/' + calEvent.id;
                    fillEventForm(action, 'PUT', calEvent);
                        
                    $('.modal-title').text(titulo);
                    $('#calendar-modal').modal();
                },
                eventDrop: EventUpdate,
                eventResize: EventUpdate
            });
            
            $("#guardar").click(function(e) {
                e.preventDefault();
                let form = $("#calendar-form")[0];

                swal({
                    title: "¿Estás seguro?",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: 'Si, ¡Estoy seguro!',
                    cancelButtonText: 'No, ¡Regresar!',
                    type: 'warning',
                    preConfirm: () => {
                        return fetch(form.action, {
                            method: 'POST',
                            credentials: "same-origin",
                            body: new FormData(form)
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                    },
                    allowOutsideClick: () => !swal.isLoading()
                }).then(result => {
                    if (result.value) {
                        const respuesta = result.value.message;
                        const status = result.value.status;
                        const event = result.value.event;
                        if(status === 'bad'){
                            swallError(respuesta);
                        } else {
                            swal("¡Realizado!", respuesta, "success");
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            $('#calendar').fullCalendar('renderEvent', event, true);
                            $('#calendar-modal').modal('hide');
                        }
                    }
                })
                .catch(error => {
                    swallError(error.message);
                });
            });
        });
        
        function swallError(mensaje) {
            swal("¡Error!", `<small class=text-danger>${mensaje}</small>`, "error");
        }

        function fillEventForm(action, method, event) {
            $("#calendar-form").attr('action', action);
            $('input[name=_method]').val(method);

            $('#title').val(event.title);
            $('#description').val(event.description);
            $('#date').val(event.start.format('YYYY-MM-DD'));
            $('#start').val(event.start.format('HH:mm'));
            $('#end').val(event.end.format('HH:mm'));
        }

        function EventUpdate(event, delta, revertFunc) {
            let d = new Date();
            if(event.start > d.getTime()){
                const action = 'calendar/events/' + event.id;
                fillEventForm(action, 'PUT', event);
                
                let form = $("#calendar-form")[0];
                
                swal({
                    type: 'question',
                    title: '¿Esta seguro de cambiar el evento?',
                    text: 'Asegurate siempre de tus cambios',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: 'Si, ¡Estoy seguro!',
                    cancelButtonText: 'No, ¡Regresar!',
                    preConfirm: () => {
                        return fetch('calendar/events/' + event.id, {
                            method: 'POST',
                            credentials: "same-origin",
                            body: new FormData(form)
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        });
                    },
                    allowOutsideClick: () => !swal.isLoading()
                }).then((result) => {
                    console.log(result);
                    if (result.value) {
                        const respuesta = result.value.message;
                        const status = result.value.status;
                        const event = result.value.event;
                        if(status === 'bad'){
                            swallError(respuesta);
                            revertFunc();
                        } else {
                            swal("¡Realizado!", respuesta, "success");
                        }
                    } else if (result.dismiss) {
                        revertFunc();
                    }
                })
                .catch(error => {
                    swallError(error.message);
                });
            } else {
                swallError('No puedes actualizar eventos pasados su fecha.');
                revertFunc();
            }
        }

        function deleteEvent(btn, event_id) {
            const form = $(btn).closest("form")[0];
            swal({
                title: "¿Estás seguro?",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Si, ¡Estoy seguro!',
                cancelButtonText: 'No, ¡Regresar!',
                type: 'warning',
                preConfirm: () => {
                    return fetch(form.action, {
                        method: 'POST',
                        credentials: "same-origin",
                        body: new FormData(form)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                },
                allowOutsideClick: () => !swal.isLoading()
            }).then(result => {
                if (result.value) {
                    const respuesta = result.value.message;
                    const status = result.value.status;
                    if(status === 'bad'){
                        swallError(respuesta);
                    } else {
                        swal("¡Realizado!", respuesta, "success");
                        $('#calendar').fullCalendar('removeEvents', event_id);
                    }
                }
            })
            .catch(error => {
                swallError(error.message);
            });
        }

        $(document).ready(function() {
            $('#calendar-modal').on('hidden.bs.modal', function (e) {
                $("#calendar-form")[0].reset();
                $('#guardar').show();
                $("#calendar-form :input").prop("disabled", false);
                $('#deletable').empty();
            });
        });
    </script>
@endsection