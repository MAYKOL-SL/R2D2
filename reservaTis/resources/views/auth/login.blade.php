@extends('auth.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<body class="fondo">
    <div class="login-box ">

        <div class="login-logo">
            <a  href="{{ url('/home') }}"><b class="re">Reserva Ambiente</a>
        </div><!-- /.login-logo -->

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Hubo un error!</strong>Verifique los datos ingrasados .
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


      <div class="container signupSection">
        <div class="info">
          <h2>WEBSOFT</h2>
           <br><br><br>
            <a href="#" class="imglogo"><img src="../img/logotec.jpg" alt="" width="100px"></a>
            <br><br><br><br><br>
          <p>Cochabamba-Bolivia</p>
        </div>
        <form action="{{ url('/auth/login') }}" method="POST" class="signupForm" name="signupform">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <h2>Iniciar Sesi&oacute;n</h2>
          <ul class="noBullet">

            <div class="has-feedback">
              <li>
                <label for="email"></label>
                <input type="email" class="inputFields" id="email" name="email" placeholder="Email" value="" />
              </li>
            </div>
            <div class="has-feedback">
              <li>
                <label for="password"></label>
                <input type="password" class="inputFields" id="password" name="password" placeholder="Password" value="" oninput="return passwordValidation(this.value)" />
              </li>
            </div>
            <li id="center-btn">
              <input type="submit" id="join-btn" name="join" alt="Join" value="Iniciar Sesi&oacute;n">
            </li>
          </ul>

          <a href="{{ url('/auth/register') }}" class="text-center">Registrar nuevo</a>
        </form>


      </div>


</div><!-- /.login-box -->

    @include('auth.scripts')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
