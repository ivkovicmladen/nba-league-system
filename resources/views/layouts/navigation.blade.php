<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-white">
                        🏀 NBA League
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-white">
                        {{ __('Home') }}
                    </x-nav-link>

                    @if(Auth::user()->isAdmin())
                    <x-nav-link :href="route('games.create')" :active="request()->routeIs('games.create')" class="text-gray-300 hover:text-white">
                        {{ __('Complete Game') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contracts.create')" :active="request()->routeIs('contracts.create')" class="text-gray-300 hover:text-white">
                        {{ __('Create Contract') }}
                    </x-nav-link>
                    @endif

                    @if(Auth::user()->isTeam())
                    <x-nav-link :href="route('contracts.create')" :active="request()->routeIs('contracts.create')" class="text-gray-300 hover:text-white">
                        {{ __('Create Contract') }}
                    </x-nav-link>
                    @endif

                    @if(Auth::user()->isPerson())
                    <x-nav-link :href="route('contracts.index')" :active="request()->routeIs('contracts.index')" class="text-gray-300 hover:text-white">
                        {{ __('My Contracts') }}
                    </x-nav-link>
                    @endif
                    @endauth

                    <x-nav-link :href="route('games.public')" :active="request()->routeIs('games.public')" class="text-gray-300 hover:text-white">
                        {{ __('Games') }}
                    </x-nav-link>

                    <x-nav-link :href="route('stats.public')" :active="request()->routeIs('stats.public')" class="text-gray-300 hover:text-white">
                        {{ __('Stats') }}
                    </x-nav-link>

                    @guest
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-gray-300 hover:text-white">
                        {{ __('Login') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="text-gray-300 hover:text-white">
                        {{ __('Register') }}
                    </x-nav-link>
                    @endguest

                    @guest
                    <x-nav-link :href="route('search.index')" :active="request()->routeIs('search.*')" class="text-gray-300 hover:text-white">
                        {{ __('Search Players & Teams') }}
                    </x-nav-link>
                    @endguest
                    @auth
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-white">
                        {{ __('Home') }}
                    </x-nav-link>

                    <!-- Add this line -->
                    <x-nav-link :href="route('search.index')" :active="request()->routeIs('search.*')" class="text-gray-300 hover:text-white">
                        {{ __('Search') }}
                    </x-nav-link>

                    @if(Auth::user()->isAdmin())
                    <!-- admin links -->
                    @endif
                    @endauth

                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">

                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:text-white focus:outline-none transition ease-in-out duration-150">
                            @if(Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                alt="{{ Auth::user()->full_name }}"
                                class="rounded-circle me-2"
                                style="width: 32px; height: 32px; object-fit: cover;">
                            @else
                            <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center me-2"
                                style="width: 32px; height: 32px; font-size: 14px;">
                                {{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}
                            </div>
                            @endif
                            <div>{{ Auth::user()->full_name }}</div>

                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.show')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Edit Profile') }}
                        </x-dropdown-link>

                        @if(Auth::user()->isAdmin() || Auth::user()->isTeam())
                        <x-dropdown-link :href="route('contracts.my-offers')">
                            {{ __('My Offers') }}
                        </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-800">
        <div class="pt-2 pb-3 space-y-1">
            @auth
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-white hover:bg-gray-700">
                {{ __('Home') }}
            </x-responsive-nav-link>

            @if(Auth::user()->isAdmin())
            <x-responsive-nav-link :href="route('games.create')" :active="request()->routeIs('games.create')" class="text-gray-300 hover:text-white hover:bg-gray-700">
                {{ __('Complete Game') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contracts.create')" :active="request()->routeIs('contracts.create')" class="text-gray-300 hover:text-white hover:bg-gray-700">
                {{ __('Create Contract') }}
            </x-responsive-nav-link>
            @endif

            @if(Auth::user()->isTeam())
            <x-responsive-nav-link :href="route('contracts.create')" :active="request()->routeIs('contracts.create')" class="text-gray-300 hover:text-white hover:bg-gray-700">
                {{ __('Create Contract') }}
            </x-responsive-nav-link>
            @endif

            @if(Auth::user()->isPerson())
            <x-responsive-nav-link :href="route('contracts.index')" :active="request()->routeIs('contracts.index')" class="text-gray-300 hover:text-white hover:bg-gray-700">
                {{ __('My Contracts') }}
            </x-responsive-nav-link>
            @endif
            @endauth

            <x-responsive-nav-link :href="route('games.public')" :active="request()->routeIs('games.public')" class="text-gray-300 hover:text-white hover:bg-gray-700">
                {{ __('Games') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('stats.public')" :active="request()->routeIs('stats.public')" class="text-gray-300 hover:text-white hover:bg-gray-700">
                {{ __('Stats') }}
            </x-responsive-nav-link>

            @guest
            <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-gray-300 hover:text-white hover:bg-gray-700">
                {{ __('Login') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')" class="text-gray-300 hover:text-white hover:bg-gray-700">
                {{ __('Register') }}
            </x-responsive-nav-link>
            @endguest
        </div>

        @auth
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-200">{{ Auth::user()->full_name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.show')" class="text-gray-300 hover:text-white hover:bg-gray-700">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300 hover:text-white hover:bg-gray-700">
                    {{ __('Edit Profile') }}
                </x-responsive-nav-link>

                @if(Auth::user()->isAdmin() || Auth::user()->isTeam())
                <x-responsive-nav-link :href="route('contracts.my-offers')" class="text-gray-300 hover:text-white hover:bg-gray-700">
                    {{ __('My Offers') }}
                </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-gray-300 hover:text-white hover:bg-gray-700">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>