<nav class="navbar navbar-expand-lg bg-body-tertiary d-print-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a wire:navigate class="nav-link {{Route::is('home') ? 'active' : ''}}" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a wire:navigate class="nav-link {{Route::is('programs') ? 'active' : ''}}" aria-current="page" href="{{route('programs')}}">Programs</a>
                </li>
                <li class="nav-item">
                    <a wire:navigate class="nav-link {{Route::is('tools') ? 'active' : ''}}" href="{{route('tools')}}">Tools</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
