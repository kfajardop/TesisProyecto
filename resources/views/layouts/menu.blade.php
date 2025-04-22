
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
