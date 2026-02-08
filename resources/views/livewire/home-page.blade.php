<div class="relative overflow-hidden">
    <!-- Hero Section -->
    <section class="relative overflow-hidden">

        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="/storage/images/hero-bg.png" 
                class="w-full h-full object-cover"
                alt="Background">
            <!-- Gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-[#0F7B71]/90 via-white/70 to-[#0F7B71]/90"></div>
        </div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-6 py-16 sm:py-24 grid lg:grid-cols-2 gap-10 items-center">

            <!-- LEFT -->
            <div>
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#0F7B71]/20 text-white text-xs font-semibold">
                    Omnichannel Communication Platform
                </span>

                <h1 class="mt-4 text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900">
                    Reach Customers Across<br>
                    <span class="text-[#0F7B71]">WhatsApp, SMS & Voice</span>
                </h1>

                <p class="mt-5 text-lg text-gray-700 max-w-xl">
                    Engage your audience through WhatsApp messaging, non-masking bulk SMS,
                    and voice broadcasting — all from a single, powerful platform with automation
                    and real-time delivery insights.
                </p>

                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('features') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-[#0F7B71] hover:bg-[#0F7B71]/90 text-white font-semibold shadow-lg">
                        Get Started
                    </a>

                    <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-white/80 backdrop-blur border border-white hover:bg-white text-gray-800 font-semibold shadow">
                        Talk to Sales
                    </a>
                </div>

                <div class="mt-8 flex items-center gap-6 text-sm text-gray-800">
                    <div class="flex items-center gap-2">
                        <span class="inline-block h-2.5 w-2.5 rounded-full bg-[#0F7B71]"></span>
                        High-delivery rate
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="inline-block h-2.5 w-2.5 rounded-full bg-[#0F7B71]"></span>
                        Multi-channel campaigns
                    </div>
                    <div class="hidden sm:flex items-center gap-2">
                        <span class="inline-block h-2.5 w-2.5 rounded-full bg-[#0F7B71]"></span>
                        API & automation ready
                    </div>
                </div>
            </div>

            <!-- RIGHT CARD -->
            <!-- <div class="bg-white/90 backdrop-blur rounded-2xl shadow-2xl border border-white p-6">
                <div class="flex items-center justify-between pb-4 border-b">
                    <div class="flex items-center gap-3">
                        <div class="h-9 w-9 rounded-lg bg-[#0F7B71] text-white flex items-center justify-center font-bold">WR</div>
                        <div>
                            <div class="font-semibold">Campaign: Promo Week</div>
                            <div class="text-xs text-gray-500">Scheduled · 10:00 AM</div>
                        </div>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full bg-[#0F7B71]/10 text-[#0F7B71]">Active</span>
                </div>

                <div class="grid sm:grid-cols-3 text-center divide-y sm:divide-y-0 sm:divide-x mt-4">
                    <div class="py-3">
                        <div class="text-2xl font-extrabold text-gray-900">12.4k</div>
                        <div class="text-xs text-gray-500">Sent</div>
                    </div>
                    <div class="py-3">
                        <div class="text-2xl font-extrabold text-[#0F7B71]">96%</div>
                        <div class="text-xs text-gray-500">Delivered</div>
                    </div>
                    <div class="py-3">
                        <div class="text-2xl font-extrabold text-[#0F7B71]">82%</div>
                        <div class="text-xs text-gray-500">Read</div>
                    </div>
                </div>

                <div class="mt-4 rounded-xl bg-gray-50 p-4 text-sm text-gray-600">
                    “Personalized offers boosted our response rate. Setup was simple and delivery was instant.”
                </div>
            </div> -->

        </div>
    </section>


    <!-- Quick Features -->
    <section class="py-14 bg-gradient-to-b from-white to-[#0F7B71]/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-10 text-center">
                <span class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md bg-[#0F7B71]/10 text-[#0F7B71] text-xs font-semibold">
                    Core capabilities
                </span>
                <h2 class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-gray-900">
                    Built for omnichannel communication at scale
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Run WhatsApp, SMS, and voice campaigns with automation, personalization,
                    and enterprise-grade reliability.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">

                <!-- WhatsApp Messaging -->
                <div class="group bg-white rounded-xl border border-gray-100 p-6 shadow-sm transition
                            hover:shadow-md hover:-translate-y-0.5 hover:border-[#0F7B71]/40">
                    <div class="w-11 h-11 rounded-lg bg-[#0F7B71]/5 text-[#0F7B71]
                                flex items-center justify-center text-2xl mb-3">💬</div>
                    <h3 class="font-semibold mb-1 text-gray-900 group-hover:text-[#0F7B71]">
                        WhatsApp Messaging
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Send bulk and personalized WhatsApp messages with templates,
                        variables, media, and high delivery rates.
                    </p>
                </div>

                <!-- Bulk SMS -->
                <div class="group bg-white rounded-xl border border-gray-100 p-6 shadow-sm transition
                            hover:shadow-md hover:-translate-y-0.5 hover:border-[#0F7B71]/40">
                    <div class="w-11 h-11 rounded-lg bg-[#0F7B71]/5 text-[#0F7B71]
                                flex items-center justify-center text-2xl mb-3">📨</div>
                    <h3 class="font-semibold mb-1 text-gray-900 group-hover:text-[#0F7B71]">
                        Bulk SMS
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Deliver non-masking SMS campaigns instantly with fast throughput,
                        real-time reports, and API integration.
                    </p>
                </div>

                <!-- Voice Broadcasting -->
                <div class="group bg-white rounded-xl border border-gray-100 p-6 shadow-sm transition
                            hover:shadow-md hover:-translate-y-0.5 hover:border-[#0F7B71]/40">
                    <div class="w-11 h-11 rounded-lg bg-[#0F7B71]/5 text-[#0F7B71]
                                flex items-center justify-center text-2xl mb-3">📞</div>
                    <h3 class="font-semibold mb-1 text-gray-900 group-hover:text-[#0F7B71]">
                        Voice Broadcasting
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Broadcast pre-recorded voice calls for alerts, promotions,
                        and reminders with high reach and clarity.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <x-benefits-section />
    <x-solutions />
    <x-customers-love />
    <x-faq /> 
</div>



