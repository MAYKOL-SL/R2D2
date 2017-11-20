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
                                {!!Form::label('Usuario:')!!}
                                <div class="input-group col-md-12"> 
                                      <!--<div class="input-group-addon">-->
                                          <select name="user_id" class="form-control" required>
                                                  @foreach ($user as $us)
                                                  @if($us->id==Auth::user()->id)
                                                   <option value="{{$us->id}}">
                                                      {{$us->name}}
                                                  </option>
                                                  @else
                                                   @endif
                                              @endforeach
                                          </select>
                                      <!--</div>-->
                                 </div>
                        </div>

                        <div class="form-group">
                              {!!Form::label('Nombre Reserva:')!!}
                              <div class="input-group col-md-12" > 
                                    <div class="form-group">
                                        <input type="text" name="nombre_reserva" class="form-control" placeholder="Nombre reserva..." required>
                                    </div>
                              </div>
                        </div>
    
                        <div class="form-group">
                              {!!Form::label('Descripcion:')!!}
                              <div class="input-group col-md-12"> 
                                    <div class="form-group">
                                        <input type="text" name="description" class="form-control" placeholder="descripcion..." required>
                                    </div>
                              </div>
                        </div>

                        <div class="form-group">
                              {!!Form::label('Ambiente:')!!}
                              <div class="input-group col-md-12" > 
                                    <!--<div class="input-group-addon">-->
                                        <select name="ambiente_id" class="form-control select-category" required>
                                            @foreach ($ambiente as $amb)
                                                <option value="{{$amb->id}}">
                                                    {{$amb->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                    <!--</div>-->
                              </div>
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
                                  {!!Form::label('Dias:')!!}
                                  <div class="input-group col-md-5">
                                          
                                            <input type="checkbox" name="lunes" value="Lunes">Lunes<br>
                                          
                                            <input type="checkbox" name="martes" value="Martes">Martes<br>
                                          
                                            <input type="checkbox" name="miercoles" value="Miercoles">Miercoles<br>
                                          
                                            <input type="checkbox" name="jueves" value="Jueves">Jueves<br>
                                          
                                            <input type="checkbox" name="viernes" value="Viernes">Viernes<br>
                                          
                                            <input type="checkbox" name="sabado" value="Sabado">Sabado<br>

                                            <input type="checkbox" name="domingo" value="Domingo">Domingo<br>

                                  </div>
                        </div>

                        <div class="form-group">
                              {!!Form::label('Hora inicio y final:')!!}
                              <div class="input-group col-md-12"> 
                              {!! Form::select('periodos[]',$hora,null,['class'=>'form-control input-sm select-tag','multiple','required']) !!}
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
                


            <div id="modal-event" class="modal fade" tabindex="-1" data-backdrop="static" >

                <div class="modal-dialog" style="background: #ffffff;">
                    
                    <div class="modal-body">

                      <h4>Evento</h4>                        
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                              {!! Form::label('_title', 'Titulo') !!}
                              {!! Form::text('_title', old('_title'), ['class' => 'form-control', 'readonly' => 'true']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('_start', 'Fecha Inicio') !!}
                            {!! Form::text('_start', old('_start'), ['class' => 'form-control', 'readonly' => 'true']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('_end', 'Fecha Fin') !!}
                            {!! Form::text('_end', old('_end'), ['class' => 'form-control', 'readonly' => 'true']) !!}
                        </div>

                    </div>

                    <div class="modal-footer">
                           <a id="delete" data-href="{{ url('calendario') }}" data-id="" class="btn btn-danger" data-dismiss="modal">Eliminar</a>

                           <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                          
                    </div>

               </div>

           </div>



              
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

      eventMouseover: function (data, event, view) {

            tooltip = '<div class="tooltiptopicevent" style="width:auto;height:auto;background:#feb811;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;">' + data.title + '</div>';


            $("body").append(tooltip);
            $(this).mouseover(function (e) {
                $(this).css('z-index', 10000);
                $('.tooltiptopicevent').fadeIn('500');
                $('.tooltiptopicevent').fadeTo('10', 1.9);
            }).mousemove(function (e) {
                $('.tooltiptopicevent').css('top', e.pageY + 10);
                $('.tooltiptopicevent').css('left', e.pageX + 20);
            });


        },

        eventMouseout: function (data, event, view) {
            $(this).css('z-index', 8);

            $('.tooltiptopicevent').remove();

        },
        eventResizeStart: function () {
            tooltip.hide()
        },

        eventDragStart: function () {
            tooltip.hide()
        },

        viewDisplay: function () {
            tooltip.hide()
        },

      select: function(start){
        start=moment(start.format());
        $('#date_start').val(start.format('YYYY-MM-DD'));
        $('#date_end').val(start.format('YYYY-MM-DD'));
        $('#responsive-modal').modal('show');
      },

      events: BASEURL_DOS,

      eventClick: function(event, jsEvent, view){
        var date_end = moment(event.end).format('YYYY-MM-DD'); 
        var date_start = moment(event.start).format('YYYY-MM-DD'); 

        if(date_end == 'Invalid date'){

          date_end = date_start;
        }

        $('#delete').attr('data-id', event.id);
        $('#_title').val(event.title);
        $('#_start').val(date_start);
        $('#_end').val(date_end);
        $('#modal-event').modal('show');
      }

    });
    
  });


  $('#date_end').bootstrapMaterialDatePicker({ 
    date: true,
    shortTime: false,
    time: false,
    format: 'YYYY-MM-DD'
  });


  $('#delete').on('click', function(){
    var x = $(this);
    var delete_url = x.attr('data-href') + '/' + x.attr('data-id');

    $.ajax({

      url: delete_url,
      type: 'DELETE',

      success: function(result){
      },

      error: function(result){
        
      }

    });
  });

</script>

@section('js')
  <script>

      $('.select-tag').chosen({
        placeholder_text_multiple:'Seleccione los periodos de reserva',
        width: '100%'

      });

      $('.select-category').chosen({
        placeholder_text_single:'Seleccione el ambiente',
        width: '100%'
      });

  </script>
@endsection

@endsection





