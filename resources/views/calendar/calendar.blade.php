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
                        alert("Error en la obtención de los eventos!");
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
                eventOverlap: false,
                height: 800,
                editable: true,
                dayClick: function(date, jsEvent, view) {
                    if (view.name === 'month') { 
                        let form = $("#calendar-form")[0];   
                        form.action = 'calendar/events';
                        
                        const input = document.querySelector('#calendar-form > input[name=_method]');
                        if (input) {
                            input.parentNode.removeChild(input);
                        }

                        $('#date').val(date.format('YYYY-MM-DD'));

                        $('.modal-title').text('Crear Evento');
                        $('#guardar').text('Crear');
                        $('#calendar-modal').modal();
                    }
                },
                eventClick: function(calEvent) {
                    let form = $("#calendar-form")[0];
                    form.action = 'calendar/events/' + calEvent.id;

                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "_method";
                    input.value = "PUT";

                    form.appendChild(input);

                    $('#title').val(calEvent.title);
                    $('#description').val(calEvent.description);
                    $('#date').val(calEvent.start.format('YYYY-MM-DD'));
                    $('#start').val(calEvent.start.format('HH:mm'));
                    $('#end').val(calEvent.end.format('HH:mm'));
                    
                    $('.modal-title').text('Actualizar Evento');
                    $('#guardar').text('Actualizar');
                    $('#calendar-modal').modal();
                }
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
                            swal("¡Error en los datos!", `<small class=text-danger>${respuesta}</small>`, "error");
                        } else {
                            swal("¡Realizado!", respuesta, "success");
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            $('#calendar').fullCalendar('renderEvent', event, true);
                            $('#calendar-modal').modal('hide');
                        }
                    }
                })
                .catch(error => {
                    swal("Hubo un problema!", error.message, "error");
                });
            });
    
            $('#calendar-modal').on('hidden.bs.modal', function (e) {
                $('form')[0].reset();
            });
        });
        
    </script>
@endsection