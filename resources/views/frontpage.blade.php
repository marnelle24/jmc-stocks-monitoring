<x-guest-layout>
    <div class="bg-gray-50 sm:px-6 lg:px-8">
        <header class="max-w-7xl mx-auto flex items-start justify-end">
            @if (Route::has('login'))
                <nav class="flex mt-1">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-gray-100 hover:bg-[#6776f5] hover:shadow-lg hover:translate-y-0.5 text-sm border border-zinc-500/50 shadow-xl text-black/50 rounded-full px-4 py-1 ring-1 ring-transparent transform duration-300 hover:text-white focus:outline-none font-bold font-sans">Log in</a>
                    @endauth
                </nav>
            @endif
        </header>
    </div>
    <div class="flex flex-col justify-center items-center bg-gray-50">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 opacity-70">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
        </svg>
        <p class="text-xl font-sans font-extrabold opacity-70">PMS</p>
    </div>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto xl:px-8 lg:px-8 md:px-6 sm:px-6 px-6">
            @livewire('front-page')
        </div>
    </div>
</x-guest-layout>
