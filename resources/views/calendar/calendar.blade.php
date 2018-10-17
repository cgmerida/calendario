@extends('admin.master')

<div class="modal" tabindex="-1" role="dialog" id="crear-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('app.add_new_item') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @include('calendar.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="crear-evento">Crear</button>
            </div>
        </div>
    </div>
</div>

@section('content')
    <div id="calendar"></div>
@endsection
 
@section('js')
    <script>
        $(function(){
            $("#calendar").fullCalendar({
                events: {
                    url: "/calendar",
                    type: "GET",
                    cache: true,
                    error: function() {
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
                height: 800,
                dayClick: function(date, jsEvent, view) {
                    if (view.name === 'month') {
                        $('#date').val(date.format('YYYY-MM-DD'));
                        $('#crear-modal').modal();
                    }
                }
            });
            
            $("#crear-evento").click(function(e) {
                e.preventDefault();
                var form = $("#crearForm");
                var myHeaders = new Headers();
                myHeaders.append('Content-Type', 'application/json');
                myHeaders.append('X-CSRF-Token', $('input[name="_token"]').val());

                swal({
                    title: "¿Estás seguro de crear el evento?",
                    showLoaderOnConfirm: true,
                    type: 'warning',
                    preConfirm: () => {
                        return fetch(form.attr("action"), {
                            method: form.attr("method"),
                            headers: myHeaders,
                            body: form.serialize()
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
                            swal("¡Error en los datos!", respuesta, "error");
                        } else {
                            swal("¡Realizado!", respuesta, "success");
                        }
                    }
                })
                .catch(error => {
                    swal("Hubo un problema!", error.message, "error");
                });
            });
    
            $('#crear-modal').on('hidden.bs.modal', function (e) {
                $('form')[0].reset();
            });
        });
        
    </script>
@endsection