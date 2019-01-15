<li class="has-dropdown mega-menu">
  <a href="#">Inicio</a>
  <ul style="background-image: url('img/menu/mega-menu.png');">
    <li>
      <div class="container">
        <div class="row">
          <div class="col">
            <span class="title">Home</span>
            <a href="/"><i class="fa fa-home"></i> Inicio</a>
            <a href="{{ url('local') }}"><i class="fa fa-flag"></i> Locales</a>
            <a href="{{ url('tutoriales') }}"><i class="fa fa-video-camera"></i> Tutoriales</a>
          </div>
          <div class="col">
            <span class="title">Comunicación</span>
            <a href="{{ url('tarifas') }}"><i class="fa fa-usd"></i> Tarifas</a>
            <a href="{{ url('contacto') }}"><i class="fa fa-envelope"></i> Contacto</a>
            <a href="{{ url('alianzas') }}"><i class="fa fa-users"></i> Alianzas</a>
          </div>
          <div class="col">
            <span class="title">Interes</span>
            <a href="{{ url('blog') }}"><i class="fa fa-align-justify"></i> Blog</a>
            <a href="{{ url('album/memes') }}"><i class="fa fa-address-book-o"></i> Memes</a>
            <a href="{{ url('album/frases') }}"><i class="fa fa-font"></i> Frases</a>
          </div>
          <div class="col">
            <span class="title">Trabajar</span>
            <a href="{{ url('postulaciones') }}"><i class="fa fa-chevron-circle-right"></i> Postulaciones</a>
            <a href="{{ url('postulaciones/aspirante') }}"><i class="fa fa-user-o"></i> Aspirante</a>
            <a href="{{ url('local/vincular') }}"><i class="fa fa-link"></i> Vincularme</a>
          </div>

        </div>
      </div>
    </li>
  </ul>
</li>
<li class="has-dropdown">
  <a href="#">Turnos</a>
  <ul>
    <li><a href="{{ url('turno/') }}">Tomar Turnos</a></li>
    <li><a href="{{ url('turno/mis-turnos') }}">Mis Turnos</a></li>
  </ul>
</li>
<li class="has-dropdown mega-menu">
  <a href="#">Retail</a>
  <ul style="background-image: url('img/menu/mega-menu.png');">
    <li>
      <div class="container">
        <div class="row">
          <div class="col">
            <span class="title">Empaques</span>
            <a href="{{ url('admin/usuario/listado') }}"><i class="fa fa-user-o"></i> Ver Empaques</a>
          </div>
          <div class="col">
            <span class="title">Locales</span>
            <a href="{{ url('admin/local/listado') }}"><i class="fa fa-flag"></i> Ver Locales Admin</a>
            <a href="{{ url('usuario/mis-locales') }}"><i class="fa fa-flag-checkered"></i> Mis Locales</a>
            <a href="{{ url('admin/local/agregar') }}"><i class="fa fa-bookmark-o"></i> Agregar Local</a>
          </div>
          <div class="col">
            <span class="title">Cadenas</span>
            <a href="{{ url('cadena') }}"><i class="fa fa-th"></i> Ver Cadenas</a>
            <a href="{{ url('cadena/create') }}"><i class="fa fa-th-list"></i> Agregar Cadena</a>
          </div>
          <div class="col">
            <span class="title">Organizaciones</span>
            <a href="{{ url('organizacion') }}"><i class="fa fa-tasks"></i> Ver Organizaciones</a>
            <a href="{{ url('organizacion/create') }}"><i class="fa fa-tags"></i> Agregar Organización</a>
          </div>

        </div>
      </div>
    </li>
  </ul>
</li>

