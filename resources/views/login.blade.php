<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Sistem Informasi BPOM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  
  <style>
    /* Enhanced Background Styles */
    body {
      background: linear-gradient(-45deg, #f1f5f9, #bfdbfe, #bae6fd, #bbf7d0, #ecfdf5);
      background-size: 400% 400%;
      animation: gradientShift 15s ease infinite;
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Floating geometric shapes */
    .bg-decoration {
      position: fixed;
      pointer-events: none;
      z-index: 1;
    }

    .shape-1 {
      top: 10%;
      left: 10%;
      width: 100px;
      height: 100px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    .shape-2 {
      top: 20%;
      right: 15%;
      width: 80px;
      height: 80px;
      background: rgba(33, 150, 243, 0.15);
      transform: rotate(45deg);
      animation: float 8s ease-in-out infinite reverse;
    }

    .shape-3 {
      bottom: 20%;
      left: 20%;
      width: 120px;
      height: 120px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
      animation: float 10s ease-in-out infinite;
    }

    .shape-4 {
      bottom: 30%;
      right: 10%;
      width: 60px;
      height: 60px;
      background: rgba(25, 118, 210, 0.2);
      clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
      animation: float 7s ease-in-out infinite reverse;
    }

    .shape-5 {
      top: 60%;
      left: 5%;
      width: 90px;
      height: 90px;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
      animation: float 9s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(10deg); }
    }

    /* Particle effect */
    .particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 1;
    }

    .particle {
      position: absolute;
      width: 4px;
      height: 4px;
      background: rgba(255, 255, 255, 0.8);
      border-radius: 50%;
      animation: particleFloat 20s linear infinite;
    }

    @keyframes particleFloat {
      0% {
        transform: translateY(100vh) translateX(0px);
        opacity: 0;
      }
      10% {
        opacity: 1;
      }
      90% {
        opacity: 1;
      }
      100% {
        transform: translateY(-100px) translateX(100px);
        opacity: 0;
      }
    }

    /* Enhanced card styles */
    .main-content {
      position: relative;
      z-index: 10;
    }

    .password-toggle {
      position: absolute;
      top: 50%;
      right: 1rem;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6c757d;
    }

    .password-toggle:hover {
      color: #0d6efd;
    }

    .material-symbols-outlined {
      font-size: 24px;
      user-select: none;
    }

    .error-text {
      color: #dc3545;
      font-size: 0.9rem;
      margin-top: 0.25rem;
      text-align: left;
    }

    .bpom-info {
      background: linear-gradient(135deg, rgba(187, 222, 251, 0.95) 0%, rgba(144, 202, 249, 0.95) 100%);
      color: black;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .info-card {
      background-color: #ffffff;
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      transition: all 0.3s ease;
    }

    .info-card:hover {
      transform: translateY(-5px);
      background-color: #ffffff;
      box-shadow: 0 10px 30px rgba(25, 118, 210, 0.2);
    }

    .login-card {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(25, 118, 210, 0.1);
      box-shadow: 0 20px 40px rgba(25, 118, 210, 0.1);
      margin-left: 70px;
    }

    .info-right-card { 
      background-color: #ffffff;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(25, 118, 210, 0.1);
      box-shadow: 0 20px 40px rgba(25, 118, 210, 0.1);
    }

    .bpom-logo {
      width: 80px;
      height: 80px;

      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
      color: white;
      font-size: 2rem;
      font-weight: bold;
      box-shadow: 0 10px 20px rgba(25, 118, 210, 0.3);
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: bold;
      color: #ffc107;
    }

    .stat-label {
      font-size: 0.9rem;
      opacity: 0.9;
    }

    /* Enhanced button */
    .btn-primary {
      background: linear-gradient(135deg, #1976d2, #0d47a1);
      border: none;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(25, 118, 210, 0.4);
    }

    /* Wave effect */
    .wave-bg {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100px;
      background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' opacity='.25' fill='%23ffffff'%3E%3C/path%3E%3Cpath d='M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z' opacity='.5' fill='%23ffffff'%3E%3C/path%3E%3Cpath d='M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z' fill='%23ffffff'%3E%3C/path%3E%3C/svg%3E") repeat-x;
      background-size: 1200px 120px;
      opacity: 0.1;
      animation: wave 10s linear infinite;
    }

    @keyframes wave {
      0% { background-position-x: 0; }
      100% { background-position-x: 1200px; }
    }
  </style>
</head>
<body>
  <!-- Background Decorations -->
  <div class="bg-decoration shape-1"></div>
  <div class="bg-decoration shape-2"></div>
  <div class="bg-decoration shape-3"></div>
  <div class="bg-decoration shape-4"></div>
  <div class="bg-decoration shape-5"></div>
  <div class="wave-bg"></div>

  <!-- Particles -->
  <div class="particles" id="particles"></div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Login Section -->
    <section class="p-3 p-md-4 p-xl-5">
      <div class="container">
        <div class="row justify-content-between align-items-center">
            <!-- Kolom Kiri: Form Login -->
            <div class="col-md-6" style="margin-left: -70px;">
              <div class="card border-0 shadow rounded-4 login-card">
                <div class="card-body p-4 p-md-5">
                  <div class="mb-4 text-center">
                    <div class="bpom-logo mb-3">
                      <img src="assets/img/lokapom.png" alt style="width: 100px;">
                      <img src="/image/lokapom.png" alt="Logo Badan POM" class= "h-100 w-auto mx-auto block">
                    </div>
                    <h4 class="fw-bold">Masuk ke Sistem BPOM</h4>
                    <p class="text-muted">Badan Pengawas Obat dan Makanan</p>
                  </div>

                <form action="{{ route('account.authenticate') }}" method="POST">
                  @csrf

                  <!-- Email -->
                  <div class="form-floating mb-1">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ old('email') }}">
                    <label for="email">Alamat email</label>
                  </div>
                  @error('email')
                    <div class="error-text">{{ $message }}</div>
                  @enderror
                  @if(session('error_email'))
                    <div class="error-text">{{ session('error_email') }}</div>
                  @endif

                  <!-- Password -->
                  <div class="form-floating mb-1 position-relative mt-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                    <label for="password">Kata sandi</label>
                    <span class="password-toggle" onclick="togglePassword()" id="toggleIcon" style="position: absolute; top: 50%; right: 1rem; transform: translateY(-50%); cursor: pointer;">
                      <span class="material-symbols-outlined" id="icon-eye">visibility</span>
                    </span>
                  </div>
                  @error('password')
                    <div class="error-text">{{ $message }}</div>
                  @enderror
                  @if(session('error_password'))
                    <div class="error-text">{{ session('error_password') }}</div>
                  @endif

                  @if(session('error'))
                    <div class="error-text mt-2">{{ session('error') }}</div>
                  @endif

                  <!-- Submit Button -->
                  <div class="d-grid mt-4 mb-3">
                    <button class="btn btn-primary py-3" type="submit">Masuk sekarang</button>
                  </div>
                  

                  <div class="text-center mt-4">
                    <a href="{{ route('account.register') }}" class="text-decoration-none text-secondary">Buat akun</a>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Kolom Kanan: Info BPOM -->
          <div class="col-md-6">
            <div class="card border-0 shadow rounded-4 h-100 info-right-card">
              <div class="card-body p-4">
                <img src="/image/wilayah.png" alt="Peta Wilayah Kerja BPOM" class="img-fluid mb-3 rounded" style="border: 1px solid #ddd;">
                <p style="font-size: 0.9rem; text-align: justify;">
                Berdasarkan Peraturan Badan POM RI Nomor 22 tahun 2020 tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis di Lingkungan Badan POM tanggal 04 September 2020, Loka POM di Kabupaten Toba merupakan salah satu Unit Pelaksana Teknis Badan POM yang dibentuk tahun 2018 dari 40 Unit Pelaksana Teknis yang tersebar di seluruh Indonesia. Sesuai Peraturan BPOM tersebut, di Provinsi Sumatera Utara terdapat 3 Unit Pelaksana Teknis yaitu Balai Besar POM di Medan, Loka Pengawas Obat dan Makanan di Kota Tanjungbalai dan Loka Pengawas Obat dan Makanan di Kabupaten Toba.<br>
                Loka POM di Kabupaten Toba yang beralamat di Jl. Pematang Siantar, Gedung B, Kel. Sibolahotang Sas, Balige, Sumatera Utara, Indonesia 22312, memiliki tugas dan fungsi Sama seperti Balai POM atau Balai Besar POM yaitu melakukan inspeksi dan sertifikasi sarana atau fasilitas produksi maupun distribusi obat dan makanan, sertifikasi produk, pengujian obat dan makanan hingga pengawasan fasilitas kefarmasian di wilayah kerjanya. Loka POM di Kabupaten Toba dipimpin oleh seorang Kepala Loka POM yang berada di bawah dan bertanggung jawab kepada Kepala Badan POM, secara teknis dibina oleh Deputi I dan secara administratif dibina oleh Sekretaris Utama.<br>
                Adapun total catchment area Loka POM di Kabupaten Toba terdiri dari 9 Kabupaten/Kota, yaitu Kabupaten Toba, Kabupaten Samosir, Kabupaten Tapanuli Utara, Kabupaten Humbang Hasundutan, Kabupaten Tapanuli Selatan, Kabupaten Tengah, Kabupaten Madinah, Kota Padangsidimpuan dan Kota Sibolga
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- BPOM Information Section -->
    <section class="bpom-info py-5">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center mb-5">
            <h2 class="fw-bold mb-3">Tentang BPOM</h2>
            <p class="lead">Badan Pengawas Obat dan Makanan Republik Indonesia</p>
          </div>
        </div>

        <div class="row g-4 mb-5">
          <div class="col-md-4">
            <div class="info-card p-4 rounded-4 text-center h-100">
              <span class="material-symbols-outlined mb-3" style="font-size: 3rem;">health_and_safety</span>
              <h5 class="fw-bold mb-3">Visi</h5>
              <p>Obat dan Makanan aman, bermutu, dan berdaya saing untuk mewujudkan Indonesia Maju yang Berdaulat, Mandiri, dan Berkepribadian berlandaskan Gotong-Royong.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info-card p-4 rounded-4 text-center h-100">
              <span class="material-symbols-outlined mb-3" style="font-size: 3rem;">gavel</span>
              <h5 class="fw-bold mb-3">Misi</h5>
              <p>BPOM melaksanakan misi Presiden dan Wakil Presiden dengan membangun SDM unggul di bidang Obat dan Makanan melalui kemitraan nasional, mendukung percepatan usaha khususnya UMKM untuk kemandirian ekonomi, memperkuat pengawasan serta penindakan kejahatan Obat dan Makanan melalui sinergi pusat dan daerah, serta mewujudkan pemerintahan yang bersih dan efektif demi pelayanan publik yang prima.
              </p> 
            </div>
          </div>
          <div class="col-md-4">
            <div class="info-card p-4 rounded-4 text-center h-100">
              <span class="material-symbols-outlined mb-3" style="font-size: 3rem;">security</span>
              <h5 class="fw-bold mb-3">Tugas</h5>
              <p>Berdasarkan Pasal 2 Peraturan Presiden Nomor 80 Tahun 2017 tentang Badan Pengawas Obat dan Makanan, Unit Pelaksana Teknis Badan POM mempunyai tugas melaksanakan tugas teknis operasional di bidang pengawasan Obat dan Makanan pada wilayah kerja masing-masing sesuai dengan ketentuan perundang-undangan. </p>
            </div>
          </div>
        </div>

            <!-- Tambahkan ini di dalam <section class="bpom-info py-5"> sebelum tag penutup </section> -->
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3 text-center">
                    <h5 class="card-title mb-0 fw-bold">Survey Kepuasan Masyarakat</h5>
                    <small class="text-muted">Tingkat kepuasan terhadap layanan BPOM</small>
                </div>
                <div class="card-body p-4">
                    <div class="chart-container d-flex justify-content-center" style="position: relative; height: 250px;">
                        <canvas id="surveyChartInSection"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <div class="row g-4">
          <div class="col-12">
            <div class="info-card p-4 rounded-4">
              <div class="row">
                <div class="col-md-16">
                    <h4 class="fw-bold mb-4 text-center">Fungsi Utama BPOM</h4>
                    <div class="row">
                      <div class="col-md-4">
                        <ul class="list-unstyled">
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Penyusunan rencana, program, dan anggaran di bidang pengawasan Obat dan Makanan
                          </li>
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan pemeriksaan fasilitasi produksi Obat dan Makanan
                          </li>
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan pemeriksaan fasilitas distribusi Obat dan Makanan dan fasilitas pelayanan kefarmasian
                          </li>
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan sertifikasi produk dan fasilitasi produksi dan distribusi Obat dan Makanan
                          </li>
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan sampling Obat dan Makanan
                          </li>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        <ul class="list-unstyled">
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan pemantuan label dan iklan Obat dan Makanan
                          </li>
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan pengujian rutin Obat dan Makanan
                          </li>
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan pengujian Obat dan Makanan dalam rangka investigasi dan penyidikan
                          </li>
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan cegah tangkal, intelijen dan penyidikan terhadap pelanggaran ketentuan peraturan perundang-undangan di bidang pengawasan Obat dan Makanan
                          </li>
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan pemantauan peredaran Obat dan Makanan melalui siber
                          </li>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        <ul class="list-unstyled">
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pengelolaan komunikasi, informasi, edukasi, dan pengaduan masyarakat di bidang pengawasan Obat dan Makanan
                          </li>
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan kerja sama di bidang pengawasan Obat dan Makanan
                          </li>
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan pemantauan, evaluasi, dan pelaporan di bidang pengawasan Obat dan Makanan
                          </li>
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan urusan tata usaha dan rumah tangga
                          </li>
                          <li class="mb-3">
                            <span class="material-symbols-outlined me-2 text-primary">check_circle</span>
                            Pelaksanaan fungsi lain yang diberikan oleh Kepala Badan
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      const icon = document.getElementById("icon-eye");

      const isHidden = passwordInput.type === "password";
      passwordInput.type = isHidden ? "text" : "password";
      icon.textContent = isHidden ? "visibility_off" : "visibility";
    }

    // Create floating particles
    function createParticles() {
      const particlesContainer = document.getElementById('particles');
      const particleCount = 50;

      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 20 + 's';
        particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
        particlesContainer.appendChild(particle);
      }
    }

    
    
    
    // Add smooth scrolling animation
    document.addEventListener('DOMContentLoaded', function() {
      createParticles();
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }
        });
      });
      
      document.querySelectorAll('.info-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
      });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <script>
    var ctxSurvey = document.getElementById('surveyChartInSection')?.getContext('2d');
    if (ctxSurvey) {
      var surveyChart = new Chart(ctxSurvey, {
        type: 'doughnut',
        data: {
          labels: ['Sangat Baik', 'Baik', 'Kurang Baik', 'Tidak Baik'],
          datasets: [{
            data: [
              {{ $surveyData['Sangat Baik'] ?? 0 }},
              {{ $surveyData['Baik'] ?? 0 }},
              {{ $surveyData['Kurang Baik'] ?? 0 }},
              {{ $surveyData['Tidak Baik'] ?? 0 }}
            ],
            backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#dc3545'],
            borderColor: '#fff',
            borderWidth: 2
          }]
        }
      });
    }
  </script>


</body>
</html>