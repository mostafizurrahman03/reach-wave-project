<section class="relative overflow-hidden bg-gradient-to-b from-[#f8f9fb] to-white py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-16">

            <!-- Left Content -->
            <div class="max-w-xl">

                <div class="mb-12 text-left">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-6">
                        Great tech 
                        <span class="text-[#0F7B71] relative">
                            support
                            <span class="absolute left-0 -bottom-1 w-full h-1 bg-[#0F7B71]/20 rounded"></span>
                        </span>
                    </h2>

                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed mb-10">
                        Get all the information you need in our knowledge base.
                        E-mail us or chat instantly with our support team via WhatsApp.
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex flex-wrap items-center gap-4 mb-4">

                    <!-- Chat Button -->
                    <a href="https://wa.me/8801712345678?text=Hello%20I%20need%20support"
                    target="_blank"
                    class="group relative px-8 py-3 rounded-full bg-gray-900 text-white font-medium
                            transition-all duration-300 ease-out
                            hover:bg-[#0F7B71] hover:shadow-2xl hover:-translate-y-1">

                        <span class="relative z-10 px-2 py-1">CHAT WITH SUPPORT</span>
                    </a>

                    <!-- Knowledge Base -->
                    <!-- <button wire:click="knowledgeBase"
                        class="px-8 py-3 rounded-full border border-gray-300 text-gray-800 font-medium
                               transition-all duration-300 ease-out
                               hover:border-[#0F7B71] hover:text-[#0F7B71] hover:shadow-md hover:-translate-y-1">
                        <span class="relative z-10 px-2 py-1">KNOWLEDGE BASE</span>
                    </button> -->

                </div>

                <!-- Email Link -->
                <a href="mailto:support@example.com"
                   class="inline-flex text-[#0F7B71] font-semibold tracking-wide text-left
                          group transition-all duration-300">

                    E-MAIL US

                    <span class="ml-2 transition-transform duration-300 group-hover:translate-x-2">
                        →
                    </span>
                </a>

            </div>

            <!-- Right Illustration -->
            <div class="flex justify-center lg:justify-end">
                <img src="{{ asset('storage/images/support.png') }}"
                     alt="Support Illustration"
                     class="max-w-md lg:max-w-lg w-full transition-all duration-500 hover:scale-105">
            </div>

        </div>

    </div>

    <!-- Optional subtle background blob -->
    <div class="absolute -top-20 -right-20 w-72 h-72 bg-[#0F7B71]/5 rounded-full blur-3xl"></div>
</section>