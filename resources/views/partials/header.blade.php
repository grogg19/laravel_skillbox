
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">

            <div class="col-10 text-center">
                <a class="blog-header-logo text-dark" href="{{ route('article.main') }}">Skillbox Laravel</a>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center">
                <a class="text-muted" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                </a>

                @guest()
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-light" href="{{ route('login') }}" role="button">Вход</a>
                            <a class="btn btn-light" href="{{ route('register') }}" role="button">Регистрация</a>
                        </div>
                    </div>
                @endguest
                @auth()
                <!-- Settings Dropdown -->
                    <div class="dropdown">
                        <a id="navbarDropdown" class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </header>
