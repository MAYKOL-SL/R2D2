 
 @extends('app')

@section('htmlheader_title')
    Cargar Calendario Academico
@endsection


@section('contentheader_title')
    Calendario
@endsection

@section('contentheader_description')
    Calendario
@endsection


@section('main-content')
  <div class="col-md-12">


      <div class="box box-primary">
                      <div class="box-header">
                        <h3 class="box-title">Cargar Calendario Academico</h3>
                      </div><!-- /.box-header -->
     
      <div id="notificacion_resul_fcdu"></div>

      <form  id="f_cargar_datos_usuarios" name="f_cargar_datos_usuarios" method="post"  action="cargar_calendario_academico" class="formarchivo" enctype="multipart/form-data" >                
      
      
       <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>"> 

      <div class="box-body">

     

      <div class="form-group col-xs-12"  >
             <label>Agregar Archivo de Excel</label>
              <input name="archivo" id="archivo" type="file"   class="archivo form-control"  required/><br /><br />
      </div>

     
      <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Cargar Calendario</button>
      </div>

       


      </div>

      </form>

      </div>

  </div>
@endsection
