
<li class="nav-item">
    <a href="{{ route('contactos.index') }}" class="nav-link {{ Request::is('contactos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Contactos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('tareaEstados.index') }}" class="nav-link {{ Request::is('tareaEstados*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Tarea Estados</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('tareaPrioridads.index') }}" class="nav-link {{ Request::is('tareaPrioridads*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Tarea Prioridads</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('casoPenalEtapas.index') }}" class="nav-link {{ Request::is('casoPenalEtapas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Caso Penal Etapas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('casoPenalDelitos.index') }}" class="nav-link {{ Request::is('casoPenalDelitos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Caso Penal Delitos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('casoTipos.index') }}" class="nav-link {{ Request::is('casoTipos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Caso Tipos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('personas.index') }}" class="nav-link {{ Request::is('personas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Personas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('casoFamiliarJuicioEtapas.index') }}" class="nav-link {{ Request::is('casoFamiliarJuicioEtapas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Caso Familiar Juicio Etapas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('casoEstados.index') }}" class="nav-link {{ Request::is('casoEstados*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Caso Estados</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('doctoPublicoEscrituras.index') }}" class="nav-link {{ Request::is('doctoPublicoEscrituras*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Docto Publico Escrituras</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('documentoEstados.index') }}" class="nav-link {{ Request::is('documentoEstados*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Documento Estados</p>
    </a>
</li>
