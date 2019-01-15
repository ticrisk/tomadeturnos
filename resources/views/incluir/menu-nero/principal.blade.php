<li><a href="/">Inicio</a></li>
<li class="has-dropdown">
    <a href="#">Supermercados</a>
    <ul>
        <li><a href="{{ url('local') }}">Locales</a></li>
        <li><a href="{{ url('postulaciones') }}">Postulaciones</a></li>
        <li><a href="{{ url('tutoriales') }}">Tutoriales</a></li>
        <li><a href="{{ url('alianzas') }}">Alianzas</a></li>
    </ul>
</li>
<li class="has-dropdown">
    <a href="#">Interés</a>
    <ul>
        <li><a href="{{ url('blog') }}">Blog</a></li>
        <li><a href="{{ url('album/memes') }}">Memes</a></li>
        <li><a href="{{ url('album/frases') }}">Frases</a></li>
    </ul>
</li>
<li><a href="{{ url('tarifas') }}">Tarifas</a></li>
<li><a href="{{ url('contacto') }}">Contacto</a></li>



<li class="hidden-lg-up"><a href="{{ url('login') }}">Login</a></li>
<li class="hidden-lg-up"><a href="{{ url('registro') }}">Registro</a></li>
