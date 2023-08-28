@extends('layouts.loginp')

@section('content')


    <!-- /.login-logo -->
    <div class="card card-outline card-primary" style="background: #ffffff97 !important;">
        <div class="card-header text-center">
          <a href="../../index2.html" class="h1">Iniciar Sesión</a>{{-- <b>SGD</b> --}}
        </div>
        <div class="card-body">
          <p class="login-box-msg">Ingresa tus credencias para iniciar session</p>
    
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group mb-3">
                <input class="form-control {{ $errors->has('email')|| $errors->has('email') ? 'is-invalid':''}}" id="email" type="email" name="email" placeholder="Usuario..." aria-describedby="login-email" autofocus tabindex="1" value="{{ old('email')?:old('email') }}"  required/>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
              @if($errors->has('email')|| $errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email')?: $errors->first('email') }}</strong>
                                    </span>
                                @endif
            </div>
            <div class="input-group mb-3">
              <input class="form-control form-control-merge @error('password') is-invalid @enderror" id="login-password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              
            </div>
            <div class="row">
              <div class="col-6">
                <div class="icheck-primary">
                  
                  <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label for="remember">
                    Recordarme
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-6">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa-solid fa-circle-arrow-right"></i> Iniciar Sessión</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
    
          {{-- <div class="social-auth-links text-center mt-2 mb-3">
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
          </div>
          <!-- /.social-auth-links --> --}}
    
          {{-- <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
          </p>
          <p class="mb-0">
            <a href="register.html" class="text-center">Register a new membership</a>
          </p> --}}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <div class="card mt-1" style="background: #ffffff97 !important;">
        <div class="card-body">
          <div class="row">
            <div class="col-6 p-0 pr-1">
              
                <a href="/mesapartes" class="btn btn-block btn-secondary">
                  <i class="fa-solid fa-desktop"></i> Olvidé mi cuenta
                </a>
                
            </div>
            <div class="col-6 p-0">
              <a href="/register" class="btn btn-block btn-danger">
                <i class="fa-solid fa-users-gear"></i> Registro nuevo
              </a>
            </div>
          </div>
        </div>
    </div>
@endsection
