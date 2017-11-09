@extends('app')

@section('htmlheader_title')
    Calendario
@endsection


@section('contentheader_title')
    Calendario
@endsection

@section('contentheader_description')
    Reservas 
@endsection

@section('main-content')

<link href='fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />

<link href='fullcalendar/bootstrap/css/bootstrap.min.css' rel='stylesheet' />
<link href='fullcalendar/bootstrap-datetimepicker/css/bootstrap-material-datetimepicker.css' rel='stylesheet' />
<link href='fullcalendar/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css' rel='stylesheet' />



<script src='fullcalendar/bootstrap/js/bootstrap.min.js'></script>

<script src='fullcalendar/lib/moment.min.js'></script>
<script src='fullcalendar/fullcalendar.min.js'></script>
<script src='fullcalendar/jquery-1.9.1.js'></script>

<script src='fullcalendar/bootstrap-datetimepicker/js/bootstrap-material-datetimepicker.js'></script>
<script src='fullcalendar/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'></script>


<body>


  <!-- /.col -->
        <div class="col" style="padding: 25px;">
          <div class="box box-primary">
            <div class="box-body no-padding">

              <div class="container">
                {!! Form::open(['route' => 'calendario.store', 'method' => 'post', 'role' => 'form']) !!}

            <div id="responsive-modal" class="modal fade" tabindex="-1" data-backdrop="static" >

                <div class="modal-dialog" style="background: #ffffff;">
                    
                    <div class="modal-body">

                      <h4>Registro De Nuevo Evento</h4>                        
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            {!! Form::label('actividad', 'Actividad') !!}
                            {!! Form::text('actividad', old('actividad'), ['class' => 'form-control']) !!}
                        </div>
    
                        <div class="form-group">
                            {!! Form::label('descripcion', 'Descripcion') !!}
                            {!! Form::text('descripcion', old('descripcion'), ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('date_start', 'Fecha Inicio') !!}
                            {!! Form::text('date_start', old('date_start'), ['class' => 'form-control', 'readonly' => 'true']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('date_end', 'Fecha Fin') !!}
                            {!! Form::text('date_end', old('date_end'), ['class' => 'form-control']) !!}
                        </div>

                         <div class="form-group">
                            {!! Form::label('color', 'Color de Reserva') !!}
                            <div class="input-group colorpicker">
                              {!! Form::text('color', old('color'), ['class' => 'form-control']) !!}
                              <span class="input-group-addon">
                                <i></i>
                              </span>
                            </div>
                        </div>

                        <div class="box-group">

                                  {!!Form::label('Hora inicio y final:')!!}
                              
                              <div class="box-group"> 
                                 
                                 {!! Form::select('periodos[]',$hora,null,['class'=>'tamano form-control input-sm select-tag','multiple','required']) !!}

                              </div>

                        </div>

                        <div class="form-group">
                             
                             <div class="col">

                                  {!!Form::label('Tipo de ambiente')!!}
                                
                                  {!! Form::select('state',$states,null,['id'=>'state','class'=>'form-control input-sm'
                                      ,'placeholder'=>'Seleccione','required'=>'required']) !!}
                                
                                  {!!Form::label('Ambiente')!!}
                                
                                  {!! Form::select('town',['placeholder'=>'Selecciona'],null,['id'=>'town','class'=>'form-control select-category input-sm'
                                      ,'required'=>'required']) !!}

                             </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
  
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                        
                    </div>

               </div>

           </div>

            {!! Form::close() !!}


              </div>
              <!-- THE CALENDAR -->

            <div id="calendar"></div>

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->

</body>

<script>

  var BASEURL_DOS = "{{ url('/get_reservas') }}";

  var BASEURL = "{{ url('/') }}";
  $(document).ready(function() {
    
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      eventLimit: true,
      selectable:true,
      selectHelper:true,

      select: function(start){
        start=moment(start.format());
        $('#date_start').val(start.format('YYYY-MM-DD'));
        $('#responsive-modal').modal('show');
      },

      events: BASEURL_DOS

    });
    
  });

  $('.colorpicker').colorpicker();


  $('#date_end').bootstrapMaterialDatePicker({ 
    date: true,
    shortTime: false,
    time: false,
    format: 'YYYY-MM-DD'
  });
</script>

@section('js')
  <script>

      $('.select-tag').chosen({
        placeholder_text_multiple:'Seleccione los periodos de reserva',
        width: '100%'

      });

  </script>
@endsection

@endsection





