<header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
    @if (Route::has('login'))
        <nav class="flex items-center justify-between gap-4">

            <div class="logo flex justify-between gap-4">
                <a href="{{ url('/') }}" >
                    <img src="{{ asset('favicon.png') }}" title="Neden Boykot?" alt="Neden Boykot Logo" class="w-16"> 
                </a>
            </div>

            <div class="flex justify-end gap-4">
            @auth
                <div class="inline-block px-5 py-1.5 border text-white rounded-sm text-sm leading-normal" >
                    {{ Auth::user()->member_id }}
                </div>
                <a
                    href="{{ route('logout') }}"
                    class="inline-block px-5 py-1.5 border hover:border-[#19140035] text-white rounded-sm text-sm leading-normal"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >   
                    Çıkış
            </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <a
                    href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 text-white border hover:border-[#19140035] rounded-sm text-sm leading-normal"
                >
                    Giriş
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 border hover:border-[#19140035] text-white rounded-sm text-sm leading-normal">
                        Kayıt
                    </a>
                @endif
            @endauth
            </div>
        </nav>
    @endif
</header>