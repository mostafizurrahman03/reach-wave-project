<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'WhatsApp Automation' }}</title>
    @vite('resources/css/app.css') {{-- Tailwind --}}
    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-p5..." crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-gray-50 text-gray-900">

<nav class="sticky top-0 z-50 bg-white/90 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex h-16 items-center justify-between">
            <!-- Brand -->
            <!-- <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-[#0F7B71] text-white font-bold">RW</span>
                <span class="text-2xl font-extrabold tracking-tight text-gray-900 group-hover:text-[#0F7B71] transition-colors">ReachWave</span>
            </a> -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <!-- Logo Image -->
                <img src="/storage/images/logo.png" alt="ReachWave Logo" class="h-14 w-14 rounded-lg object-cover">

                <!-- Brand Name -->
                <!-- <span class="text-2xl font-extrabold tracking-tight text-gray-900 group-hover:text-[#0F7B71] transition-colors">
                    ReachWave
                </span> -->
            </a>


            <!-- Desktop Nav -->
            <div class="hidden sm:flex items-center gap-6">
                <ul class="flex items-center gap-6 text-lg font-medium">
                    <li>
                        <a href="{{ route('whats-app-integration') }}" class="px-1.5 py-1 rounded transition-colors {{ request()->routeIs('whats-app-integration') ? 'text-[#0F7B71]' : 'text-gray-700 hover:text-[#0F7B71]' }}">Whatsapp Integration</a>
                    </li>
                    <li>
                        <a href="{{ route('sms-sending') }}" class="px-1.5 py-1 rounded transition-colors {{ request()->routeIs('sms-sending') ? 'text-[#0F7B71]' : 'text-gray-700 hover:text-[#0F7B71]' }}">Sms Sending</a>
                    </li>
                    <li>
                        <a href="{{ route('features') }}" class="px-1.5 py-1 rounded transition-colors {{ request()->routeIs('features') ? 'text-[#0F7B71]' : 'text-gray-700 hover:text-[#0F7B71]' }}">Features</a>
                    </li>
                    <li>
                        <a href="{{ route('pricing') }}" class="px-1.5 py-1 rounded transition-colors {{ request()->routeIs('pricing') ? 'text-[#0F7B71]' : 'text-gray-700 hover:text-[#0F7B71]' }}">Pricing</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="px-1.5 py-1 rounded transition-colors {{ request()->routeIs('contact') ? 'text-[#0F7B71]' : 'text-gray-700 hover:text-[#0F7B71]' }}">Contact Us</a>
                    </li>
                </ul>
                  <!-- Login Button -->
                <a href="{{ route('filament.user.auth.login') }}"
                   class="inline-flex items-center gap-2 rounded-lg border border-[#0F7B71] px-3.5 py-2 text-[#0F7B71] text-lg font-semibold hover:bg-[#0F7B71]/10 transition">
                    Login
                </a>
                <a href="{{ route('filament.user.auth.register') }}" class="inline-flex items-center gap-2 rounded-lg bg-[#0F7B71] px-3.5 py-2 text-white text-lg font-semibold shadow hover:bg-[#0F7B71]/90 transition-colors">
                    Get Started
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <!-- Mobile Menu (pure HTML details/summary) -->
            <details class="sm:hidden relative">
                <summary class="list-none inline-flex items-center justify-center h-10 w-10 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </summary>
                <div class="absolute right-0 mt-2 w-48 rounded-lg border border-gray-200 bg-white shadow-lg py-2">
                    <a href="{{ route('features') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('features') ? 'text-[#0F7B71]' : 'text-gray-700 hover:bg-gray-50' }}">Features</a>
                    <a href="{{ route('pricing') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('pricing') ? 'text-[#0F7B71]' : 'text-gray-700 hover:bg-gray-50' }}">Pricing</a>
                    <a href="{{ route('contact') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('contact') ? 'text-[#0F7B71]' : 'text-gray-700 hover:bg-gray-50' }}">Contact</a>
                    <div class="px-4 pt-2">
                        <a href="{{ route('features') }}" class="w-full inline-flex items-center justify-center gap-2 rounded-md bg-[#0F7B71] px-3 py-2 text-white text-sm font-semibold hover:bg-[#0F7B71]/90">Start</a>
                    </div>
                </div>
            </details>
        </div>
    </div>
</nav>

<main>
    {{ $slot }}
</main>



<footer class="bg-gray-900 text-gray-300 mt-12">
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Brand -->
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-[#0F7B71] text-white font-bold text-md">WR</span>
                    <span class="font-extrabold text-xl text-white">Whats-Reach</span>
                </div>
                <p class="text-sm text-gray-400">WhatsApp bulk messaging made simple, reliable, and scalable for modern teams.</p>
                <!-- Socials -->
                
                @php
                    use App\Models\SocialLink;

                    // sort according to active and order_by
                    $socialLinks = SocialLink::where('is_active', true)
                        ->orderBy('order_by')
                        ->get();
                @endphp

                <div class="mt-4">
                    <h4 class="text-xs font-semibold text-white/80 mb-2 hover:text-white">Follow us</h4>
                    <div class="flex items-center gap-3">
                        @foreach($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" rel="noopener"
                            class="text-gray-400 hover:text-white" aria-label="{{ $link->platform }}">
                                <i class="{{ $link->icon_class }} w-5 h-5"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

                
            </div>
            <!-- Product -->
            <div>
                <h3 class="text-sm font-semibold text-white mb-3 text-xl">Product</h3>
                <ul class="space-y-2 text-sm">
                    <li><a class="relative transition duration-300 hover:text-[#6BBFA9] after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-[2px] after:bg-[#0F7B71] after:rounded-full hover:after:w-full after:transition-all after:duration-300"
                    href="{{ route('features') }}">Features</a></li>
                    <li><a class="relative transition duration-300 hover:text-[#6BBFA9] after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-[2px] after:bg-[#0F7B71] after:rounded-full hover:after:w-full after:transition-all after:duration-300" href="{{ route('pricing') }}">Pricing</a></li>
                    <li><a class="relative transition duration-300 hover:text-[#6BBFA9] after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-[2px] after:bg-[#0F7B71] after:rounded-full hover:after:w-full after:transition-all after:duration-300" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <!-- Resources -->
            <div>
                <h3 class="text-sm font-semibold text-white mb-3 text-xl">Resources</h3>
                <ul class="space-y-2 text-sm">
                    <li><a class="relative transition duration-300 hover:text-[#6BBFA9] after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-[2px] after:bg-[#0F7B71] after:rounded-full hover:after:w-full after:transition-all after:duration-300" href="#">Docs</a></li>
                    <li><a class="relative transition duration-300 hover:text-[#6BBFA9] after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-[2px] after:bg-[#0F7B71] after:rounded-full hover:after:w-full after:transition-all after:duration-300" href="#">Guides</a></li>
                    <li><a class="relative transition duration-300 hover:text-[#6BBFA9] after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-[2px] after:bg-[#0F7B71] after:rounded-full hover:after:w-full after:transition-all after:duration-300" href="#">Support</a></li>
                </ul>
            </div>
            <!-- Contact -->
            <div>
                <h3 class="text-sm font-semibold text-white mb-3 text-xl">Get in touch</h3>
                <ul class="space-y-2 text-sm">
                    <!-- Email -->
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25H4.5A2.25 2.25 0 0 1 2.25 17.25V6.75m19.5 0L12 12.75 2.25 6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5H4.5a2.25 2.25 0 0 0-2.25 2.25" />
                        </svg>
                        <a class="hover:text-white" href="mailto:support@example.com">{{$email}}</a>
                    </li>

                    <!-- WhatsApp -->
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                            <path d="M20.52 3.48A11.77 11.77 0 0 0 12 .75 11.77 11.77 0 0 0 3.48 3.48 11.77 11.77 0 0 0 .75 12c0 2.07.53 4.06 1.54 5.84L.75 23.25l5.58-1.48A11.82 11.82 0 0 0 12 23.25c2.07 0 4.06-.53 5.84-1.54A11.77 11.77 0 0 0 23.25 12a11.77 11.77 0 0 0-2.73-8.52zM12 21.2c-1.92 0-3.79-.51-5.43-1.49l-.39-.23-3.31.87.88-3.21-.25-.41A9.79 9.79 0 0 1 2.8 12a9.2 9.2 0 0 1 2.69-6.57A9.2 9.2 0 0 1 12 2.8a9.2 9.2 0 0 1 6.57 2.69A9.2 9.2 0 0 1 21.2 12c0 2.48-1 4.82-2.79 6.57A9.2 9.2 0 0 1 12 21.2zm5.13-7.27c-.28-.14-1.68-.83-1.94-.92s-.45-.14-.64.14-.74.92-.92 1.11-.34.21-.63.07a7.8 7.8 0 0 1-2.3-1.42 8.68 8.68 0 0 1-1.61-2.07c-.17-.29-.02-.45.12-.59.12-.12.29-.32.43-.48.14-.17.19-.28.29-.46s.05-.34-.02-.48c-.07-.14-.64-1.54-.88-2.11-.23-.55-.47-.49-.64-.5l-.55-.01c-.19 0-.48.07-.73.34-.25.28-.96.94-.96 2.3s.99 2.67 1.13 2.86 1.96 3 4.75 4.2c.66.29 1.18.46 1.58.59.66.21 1.26.18 1.73.11.53-.08 1.68-.69 1.92-1.36.24-.67.24-1.24.17-1.36-.07-.11-.25-.18-.52-.32z"/>
                        </svg>
                        <a class="hover:text-white" href="https://wa.me/1234567890" target="_blank" rel="noopener">{{$phone}}</a>
                    </li>

                    <!-- Address -->
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.75c4.97-5.29 7.5-9.2 7.5-12.36a7.5 7.5 0 1 0-15 0c0 3.16 2.53 7.07 7.5 12.36z" />
                            <circle cx="12" cy="9" r="2.5" fill="currentColor"/>
                        </svg>
                        <span class="hover:text-white">{{$address}}</span>
                    </li>
                </ul>

            </div>
        </div>
        <div class="mt-8 border-t border-white/10 pt-6 text-sm text-gray-400 flex flex-col sm:flex-row items-center justify-between relative">
            <p class="text-center sm:absolute sm:left-1/2 sm:-translate-x-1/2">&copy; {{ date('Y') }} Whats-Reach. All rights reserved.</p>
            <div class="flex gap-4 mt-3 sm:mt-0 sm:ml-auto">
                <a href="#" class="hover:text-white">Privacy</a>
                <a href="#" class="hover:text-white">Terms</a>
            </div>
        </div>
    </div>
</footer>
@stack('scripts')

@livewireScripts
</body>
</html>
