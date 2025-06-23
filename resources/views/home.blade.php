<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard LOKA POM TOBA</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* Background animasi gradient bergerak */
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .bg-animated {
            background: linear-gradient(-45deg, #f1f5f9, #bfdbfe, #bae6fd, #bbf7d0, #ecfdf5);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
        }
        
        
        /* Animasi masuk dengan bounce */
        @keyframes bounceIn {
            0% { 
                opacity: 0; 
                transform: scale(0.3) translateY(-50px); 
            }
            50% { 
                opacity: 0.8; 
                transform: scale(1.05) translateY(10px); 
            }
            70% { 
                transform: scale(0.95) translateY(-5px); 
            }
            100% { 
                opacity: 1; 
                transform: scale(1) translateY(0); 
            }
        }
        
        .animate-bounceIn {
            animation: bounceIn 1.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        /* Animasi slide dari kiri */
        @keyframes slideInLeft {
            0% { 
                opacity: 0; 
                transform: translateX(-100px); 
            }
            100% { 
                opacity: 1; 
                transform: translateX(0); 
            }
        }
        
        .animate-slideInLeft {
            animation: slideInLeft 1.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Animasi slide dari kanan */
        @keyframes slideInRight {
            0% { 
                opacity: 0; 
                transform: translateX(100px); 
            }
            100% { 
                opacity: 1; 
                transform: translateX(0); 
            }
        }
        
        .animate-slideInRight {
            animation: slideInRight 1.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            animation-delay: 0.3s;
            animation-fill-mode: both;
        }
        
        /* Efek glassmorphism */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-effect-dark {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Animasi floating untuk elemen dekoratif */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(1deg); }
            66% { transform: translateY(-10px) rotate(-1deg); }
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        /* Animasi pulse untuk logo */
        @keyframes pulse-glow {
            0%, 100% { 
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
                transform: scale(1);
            }
            50% { 
                box-shadow: 0 0 40px rgba(59, 130, 246, 0.6);
                transform: scale(1.02);
            }
        }
        
        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }
        
        /* Efek shimmer untuk teks */
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .text-shimmer {
            background: linear-gradient(90deg, #ffffff, #3b82f6, #ffffff);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s ease-in-out infinite;
        }
        
        /* Partikel dekoratif */
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }
        
        .particle-1 {
            width: 8px;
            height: 8px;
            background: rgba(59, 130, 246, 0.6);
            top: 20%;
            left: 10%;
            animation: float 4s ease-in-out infinite;
        }
        
        .particle-2 {
            width: 12px;
            height: 12px;
            background: rgba(34, 197, 94, 0.4);
            top: 70%;
            right: 15%;
            animation: float 5s ease-in-out infinite reverse;
        }
        
        .particle-3 {
            width: 6px;
            height: 6px;
            background: rgba(168, 85, 247, 0.5);
            top: 40%;
            right: 25%;
            animation: float 3.5s ease-in-out infinite;
        }
        
        .particle-4 {
            width: 10px;
            height: 10px;
            background: rgba(249, 115, 22, 0.4);
            top: 80%;
            left: 20%;
            animation: float 4.5s ease-in-out infinite reverse;
        }
        
        /* Hover effect untuk tombol dengan ripple */
        .btn-ripple {
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-ripple:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transition: width 0.6s, height 0.6s, top 0.6s, left 0.6s;
            transform: translate(-50%, -50%);
        }
        
        .btn-ripple:hover:before {
            width: 300px;
            height: 300px;
        }

        /* Hover effect untuk carousel navigation */
        .carousel-nav:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: scale(1.1);
        }

        /* Typography enhancements */
        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: clamp(1.1rem, 2.5vw, 1.5rem);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-container {
                flex-direction: column;
                text-align: center;
            }
            
            .hero-left {
                order: 2;
                margin-top: 2rem;
            }
            
            .hero-right {
                order: 1;
            }
        }
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .animate-marquee {
            display: inline-block;
            min-width: 100%;
            animation: marquee 15s linear infinite;
        }

    </style>
</head>
<body class="min-h-screen bg-animated relative overflow-x-hidden">

    
    <!-- Partikel dekoratif floating -->
    <div class="particle particle-1"></div>
    <div class="particle particle-2"></div>
    <div class="particle particle-3"></div>
    <div class="particle particle-4"></div>
    
    <!-- Elemen dekoratif tambahan -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-white bg-opacity-10 rounded-full floating blur-sm"></div>
    <div class="absolute bottom-20 right-20 w-16 h-16 bg-blue-300 bg-opacity-20 rounded-lg floating" style="animation-delay: -2s;"></div>
    <div class="absolute top-1/2 left-8 w-12 h-12 bg-green-400 bg-opacity-15 rounded-full floating" style="animation-delay: -1s;"></div>

        <!-- Running Text - Anti Gratifikasi -->
                    <div class="w-full bg-red-600 text-white py-2 px-5 rounded-xl shadow-md mb-4 animate-slideInLeft overflow-hidden relative">
                        <div class="whitespace-nowrap animate-marquee font-semibold text-sm md:text-base">
                            Tolak dan Lapor Gratifikasi !!! Mari bersama kita dukung Kementerian Keuangan bebas gratifikasi.
                        </div>
                    </div>


    <!-- Hero Section -->
    <div class="min-h-screen flex items-center justify-center p-4 relative z-10">
        <div class="max-w-7xl w-full mx-auto">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-center hero-container">
                
                <!-- Bagian Kiri - Sambutan -->
                <div class="hero-left animate-slideInLeft space-y-6">
                    <div class="glass-effect-dark rounded-3xl p-8 lg:p-12 text-black">
                        <!-- Logo dan Badge -->
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="pulse-glow rounded-2xl p-3 bg-white/20">
                                <div class="h-12 w-12 rounded-lg flex items-center justify-center">
                                    <img src="/image/lokapom.png" alt="Logo Badan POM" class= "h-50 w-auto mx-auto block">
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-black-200">Badan POM RI</span>
                                <span class="text-xs text-black/70">Loka POM Toba</span>
                            </div>
                        </div>

                        <!-- Judul Utama -->
                        <h1 class="hero-title font-bold text-shimmer mb-4">
                            Selamat Datang
                        </h1>
                        
                        <!-- Garis dekoratif -->
                        <div class="w-24 h-1 bg-gradient-to-r from-blue-400 to-green-400 mb-6 rounded-full"></div>
                        
                        <!-- Subjudul -->
                        <h2 class="hero-subtitle font-semibold text-black/90 mb-6">
                            Sistem Ticketing Loka POM Toba
                        </h2>
                        
                        <!-- Deskripsi -->
                        <p class="text-black/80 text-lg leading-relaxed mb-8">
                            Portal digital untuk pengelolaan layanan pengawasan obat dan makanan di Loka POM Toba.
                            Sistem ini mendukung pelayanan pengaduan masyarakat, pendampingan UMKM, serta penyampaian informasi produk dengan cepat, mudah, dan terpercaya.
                        </p>
                        
                        <!-- Features List -->
                        <div class="space-y-3 mb-8">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-green-400 rounded-full"></div><span>✅</span>
                                <span class="text-black/80">Pengelolaan Tiket Layanan Terintegrasi</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-blue-400 rounded-full"></div><span>📅</span>
                                <span class="text-black/80">Penjadwalan Pendampingan via Zoom Otomatis</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-purple-400 rounded-full"></div><span>📊</span>
                                <span class="text-black/80">Survei Kepuasan Terstruktur dan Analitik</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-purple-400 rounded-full"></div><span>💬</span>
                                <span class="text-black/80">Notifikasi via WhatsApp</span>
                            </div>
                        </div>
                        
                        <!-- Tombol LOGIN -->
                        <a href="{{ route('account.login') }}" 
                           class="btn-ripple inline-flex items-center justify-center bg-gradient-to-r from-green-500 to-green-600 
                                  text-white font-bold py-4 px-8 rounded-2xl shadow-lg transition-all duration-300 transform
                                  hover:scale-105 hover:from-green-600 hover:to-green-700 
                                  hover:shadow-xl hover:shadow-green-400/50
                                  focus:from-blue-500 focus:to-blue-600 active:scale-95
                                  border border-green-400/20 relative group">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Masuk ke Sistem
                            </span>
                        </a>
                    </div>
                </div>
                    {{-- <!-- Running Text - Anti Gratifikasi -->
                    <div class="w-full bg-red-600 text-white py-2 px-4 rounded-xl shadow-md mb-4 animate-slideInLeft overflow-hidden relative">
                        <div class="whitespace-nowrap animate-marquee font-semibold text-sm md:text-base">
                            Tolak dan Lapor Gratifikasi !!! Mari bersama kita dukung Kementerian Keuangan bebas gratifikasi.
                        </div>
                    </div> --}}

                    <!-- Bagian Kanan - Carousel -->
                    <div class="hero-right animate-slideInRight">
                    <div class="glass-effect rounded-3xl p-4 shadow-2xl">
                        <div class="relative w-full rounded-2xl overflow-hidden shadow-lg">
                        <div class="w-full h-[400px] lg:h-[500px] flex items-center justify-center overflow-hidden bg-white">
                            <div class="flex transition-transform duration-700 ease-in-out" id="carousel-images">

                            <!-- Slide 1 -->
                            <div class="w-full flex items-center justify-center flex-shrink-0">
                                <img src="/image/banner.png" class="w-full h-full object-cover" alt="Banner Loka POM Toba">
                            </div>

                            <!-- Slide 2 -->
                            <div class="w-full flex items-center justify-center gap-6 flex-shrink-0">
                                <img src="/image/gambar1.jpg" style="width: 270px;" alt="gambar1.jpg">
                                <img src="/image/gambar2.jpg" style="width: 270px;" alt="gambar2.jpg">
                            </div>

                            <!-- Slide 3 -->
                            <div class="w-full flex items-center justify-center flex-shrink-0">
                                <img src="/image/gambar3.jpg" style="width: 400px;" alt="gambar3.jpg">
                            </div>

                            </div>
                        </div>

                            <!-- Navigation buttons -->
                            <div class="absolute top-1/2 left-4 transform -translate-y-1/2 z-10">
                                <button onclick="prevSlide()" 
                                        class="carousel-nav bg-white/60 hover:bg-white/90 p-3 rounded-full shadow-lg 
                                               transition-all duration-300 hover:scale-110 backdrop-blur-sm">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="absolute top-1/2 right-4 transform -translate-y-1/2 z-10">
                                <button onclick="nextSlide()" 
                                        class="carousel-nav bg-white/60 hover:bg-white/90 p-3 rounded-full shadow-lg 
                                               transition-all duration-300 hover:scale-110 backdrop-blur-sm">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Slide indicators -->
                            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                                <button onclick="goToSlide(0)" class="w-3 h-3 bg-white/50 rounded-full cursor-pointer transition-all duration-300 hover:bg-white/80" id="indicator-0"></button>
                                <button onclick="goToSlide(1)" class="w-3 h-3 bg-white/50 rounded-full cursor-pointer transition-all duration-300 hover:bg-white/80" id="indicator-1"></button>
                                <button onclick="goToSlide(2)" class="w-3 h-3 bg-white/50 rounded-full cursor-pointer transition-all duration-300 hover:bg-white/80" id="indicator-2"></button>
                            </div>

                            <!-- Overlay info -->
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-6">
                                <div class="text-white">
                                    <h3 class="font-semibold text-lg mb-1" id="slide-title">Informasi Kontak</h3>
                                    <p class="text-sm text-white/80" id="slide-description">Hubungi kami untuk layanan terbaik</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Script untuk carousel dan efek interaktif -->
    <script>
        let currentIndex = 0;
        const images = document.getElementById("carousel-images");
        const totalSlides = images.children.length;
        let autoSlideInterval;

        // Data untuk setiap slide
        const slideData = [
            {
                title: "Loka POM Toba",
                description: "Pengawasan obat dan makanan terpercaya"
            },
            {
                title: "Loka POM Toba",
                description: "Pengawasan obat dan makanan terpercaya"
            },
            {
                title: "Loka POM Toba",
                description: "Pengawasan obat dan makanan terpercaya"
            }
        ];

        function updateCarousel() {
            images.style.transform = `translateX(-${currentIndex * 100}%)`;
            updateIndicators();
            updateSlideInfo();
        }

        function updateIndicators() {
            for (let i = 0; i < totalSlides; i++) {
                const indicator = document.getElementById(`indicator-${i}`);
                if (i === currentIndex) {
                    indicator.classList.add('bg-white');
                    indicator.classList.remove('bg-white/50');
                    indicator.style.transform = 'scale(1.2)';
                } else {
                    indicator.classList.remove('bg-white');
                    indicator.classList.add('bg-white/50');
                    indicator.style.transform = 'scale(1)';
                }
            }
        }

        function updateSlideInfo() {
            const titleElement = document.getElementById('slide-title');
            const descElement = document.getElementById('slide-description');
            
            titleElement.style.opacity = '0';
            descElement.style.opacity = '0';
            
            setTimeout(() => {
                titleElement.textContent = slideData[currentIndex].title;
                descElement.textContent = slideData[currentIndex].description;
                titleElement.style.opacity = '1';
                descElement.style.opacity = '1';
            }, 150);
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateCarousel();
            resetAutoSlide();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateCarousel();
            resetAutoSlide();
        }

        function goToSlide(index) {
            currentIndex = index;
            updateCarousel();
            resetAutoSlide();
        }

        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 4000);
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        // Initialize
        updateCarousel();
        startAutoSlide();
        
        // Pause auto-slide on hover
        const carousel = document.getElementById('carousel');
        carousel.addEventListener('mouseenter', () => {
            clearInterval(autoSlideInterval);
        });
        
        carousel.addEventListener('mouseleave', () => {
            startAutoSlide();
        });
        
        // Efek mouse movement parallax
        document.addEventListener('mousemove', (e) => {
            const particles = document.querySelectorAll('.particle');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            particles.forEach((particle, index) => {
                const speed = (index + 1) * 0.3;
                const x = (mouseX - 0.5) * speed * 15;
                const y = (mouseY - 0.5) * speed * 15;
                particle.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            switch(e.key) {
                case 'ArrowLeft':
                    prevSlide();
                    break;
                case 'ArrowRight':
                    nextSlide();
                    break;
                case 'Enter':
                    document.querySelector('a[href="#"]').click();
                    break;
            }
        });
        

        // Smooth scroll untuk animasi
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
