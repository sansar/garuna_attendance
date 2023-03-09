<div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4">
        @auth
            {{auth()->user()->name}}
            <div class="text-end">
                <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Гарах</a>
            </div>
        @endauth

        @guest
            <div class="text-end">
                <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
            </div>
        @endguest
    </div>
</div>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>


