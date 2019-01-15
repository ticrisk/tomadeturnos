@extends('layouts.global-externo')

@section('content')
    <section>
        <div class="container-fluid">

            <h4 class="text-center">Locales</h4>
            <b class="text-center">@include('incluir/mensajes')</b>


            <listado-locales></listado-locales>


        </div>
    </section>
@endsection



@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script><!-- Vue js -->
@endsection


