<div class="text-center mt-5">
    <h1 class="text-danger">Error 403 - Usuario no autorizado</h1>
    <p>No tenés permiso para acceder a esta página.</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <a href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </a>
    </form>
</div>
