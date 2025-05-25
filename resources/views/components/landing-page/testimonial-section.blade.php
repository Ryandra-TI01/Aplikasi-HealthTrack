<div class="bg-gradient-to-b from-primary to-secondary-3 py-12 px-6 text-white text-center">
    <h2 class="text-xl md:text-3xl font-semibold max-w-3xl mx-auto">
        “With HealthTrack, every step towards health becomes easier and more targeted.”
    </h2>
</div>

<section id="feedbacks" class="bg-white py-16 px-6 lg:px-20 relative overflow-hidden">
    {{-- Dekorasi titik-titik kiri-kanan --}}
    <div class="absolute left-0 bottom-0 hidden md:block">
        <img src="{{ asset('images/dots-left.png') }}" alt="" class="w-1/2 opacity-60">
    </div>
    <div class="absolute right-0 bottom-0 hidden md:block">
        <img src="{{ asset('images/dots-vertikal.png') }}" alt="" class="w-24 opacity-60">
    </div>

    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-primary text-3xl font-bold mb-1">Real Stories, Real Impact</h2>
        <p class="text-gray-500 mb-10">Discover how HealthTrack is improving lives every day.</p>

        <div class="relative">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($feedbacks as $feedback)
                        <div class="swiper-slide">
                            <div class="bg-white border border-gray-200 rounded-2xl shadow-xl p-10 max-w-2xl mx-auto text-center">
                                <div class="w-32 h-32 rounded-full mx-auto bg-secondary-3 flex items-center justify-center mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
                                    </svg>
                                </div>
                                <p class="text-primary font-semibold text-lg">{{ $feedback->user->name }}</p>

                                {{-- Rating --}}
                                <div class="flex justify-center mt-1 mb-4 text-yellow-500">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $i <= $feedback->rating ? '' : 'text-gray-300' }}" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 .587l3.668 7.431 8.2 1.193-5.934 5.781 1.4 8.178L12 18.896l-7.334 3.855 1.4-8.178L.132 9.211l8.2-1.193z"/>
                                        </svg>
                                    @endfor
                                </div>

                                <p class="text-gray-600 italic leading-relaxed">“{{ $feedback->message }}”</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Navigasi panah --}}
            <div class="absolute -left-6 top-1/2 transform -translate-y-1/2">
                <button class="swiper-button-prev-custom bg-primary text-white p-2 rounded-full shadow hover:bg-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rotate-180" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
            <div class="absolute -right-6 top-1/2 transform -translate-y-1/2">
                <button class="swiper-button-next-custom bg-primary text-white p-2 rounded-full shadow hover:bg-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>


