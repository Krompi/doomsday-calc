{{-- https://www.section.io/engineering-education/creating-a-responsive-navigation-bar-using-tailwind-css-and-javascript/https://www.section.io/engineering-education/creating-a-responsive-navigation-bar-using-tailwind-css-and-javascript/ --}}
<nav class="bg-white shadow-lg">
    <div class="max-w-6xl px-4 mx-auto">
        <div class="flex justify-between">
            <div class="flex space-x-7">
                <div>
                    <!-- Website Logo -->
                    <a href="{{ url('/') }}" class="flex items-center px-2 py-4">
                        Doomsday-Berechnung
                    </a>
                </div>
                <!-- Primary Navbar items -->
            </div>
            <div class="flex items-center md:hidden">
            @auth
                        <a href="{{ url('/dashboard') }}" class="px-2 py-2 font-medium text-gray-500 transition duration-300 rounded hover:bg-blue-400 hover:text-white">
                            {!! __('Dashboard') !!}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                            {{ csrf_field() }}
                            <button class="px-2 py-2 font-medium text-gray-500 transition duration-300 rounded hover:bg-blue-400 hover:text-white">
                                {!! __('Logout') !!}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-2 py-2 font-medium text-gray-500 transition duration-300 rounded hover:bg-blue-400 hover:text-white">
                            {!! __('Login') !!}
                        </a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-2 py-2 font-medium text-gray-500 transition duration-300 rounded hover:bg-blue-400 hover:text-white">
                            {!! __('Register') !!}
                        </a>
                        @endif
                    @endauth
            </button>
            </div>
        </div>
    </div>
</nav>