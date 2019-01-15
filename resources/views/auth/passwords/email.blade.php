@extends('layouts.global-externo')

<!-- Main Content -->
@section('content')
<section>
    <div class="container">

        <h5 class="text-center">Password</h5>
        <p class="m-b-25 text-center">Restablecer Contraseña</p>

        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Recuperar</h5>
            </div>
            <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 text-md-right">E-Mail Registrado</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success">
                                    Enviar Contraseña al E-mail
                                </button>
                            </div>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</section>

@endsection
