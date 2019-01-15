@extends('admin.master')

@section('content')

    <div class="modal" tabindex="-1" role="dialog" id="calendar-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title c-grey-900"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="c-grey-800 text-center" id="event-title"></h5>
                    @include('calendar.partials.form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


    <div id="calendar" class="pT-20"></div>
@endsection
 
@section('js')
    <script>
        $(function(){
            $("#calendar-form :input").prop("disabled", true);

            $("#calendar").fullCalendar({
                themeSystem: 'bootstrap4',
                eventRender: function(eventObj, $el) {
                    $el.popover({
                        title: eventObj.title,
                        content: eventObj.description
                    });
                },
                events: {
                    url: "events",
                    type: "GET",
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
    
    </script>
@endsection