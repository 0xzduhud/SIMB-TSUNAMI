<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Peta Posko & Daerah Rawan - Waver</title>

    <!-- Font & Library -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
      :root {
        --primary: #0057ff;
        --secondary: #007bff;
        --dark: #001b44;
        --light: #f8faff;
        --accent: #00d4ff;
        --danger: #ff3333;
        --success: #28a745;
        --warning: #ffc107;
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: "Inter", sans-serif;
        background: linear-gradient(135deg, #f8faff 0%, #e6f0ff 100%);
        scroll-behavior: smooth;
        opacity: 0;
        animation: fadeIn 1.2s ease forwards;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
      }

      @keyframes fadeIn {
        to {
          opacity: 1;
        }
      }

      /* ===== SCROLL PROGRESS BAR ===== */
      .scroll-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        z-index: 3000;
        transition: width 0.1s ease;
      }

      /* ===== NAVBAR ===== */
      .navbar-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 2000;
        backdrop-filter: blur(12px);
        background: rgba(0, 0, 0, 0.3);
        padding: 15px 10%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.4s ease;
      }

      .navbar-container.notif-active {
        top: 60px;
      }

      .navbar-container.scrolled {
        background: rgba(0, 0, 50, 0.95);
        padding: 12px 8%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      }

      .logo-item img {
        width: 80px;
        height: auto;
        transition: transform 0.3s ease;
      }

      .logo-item:hover img {
        transform: scale(1.08);
      }

      .navbar-links {
        display: flex;
        gap: 35px;
      }

      .navbar-links a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        text-transform: uppercase;
        transition: all 0.3s ease;
        font-size: 15px;
        letter-spacing: 0.5px;
        position: relative;
        padding: 8px 0;
      }

      .navbar-links a::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--secondary), var(--primary));
        transition: width 0.3s ease;
      }

      .navbar-links a:hover {
        color: #a9d6ff;
      }

      .navbar-links a:hover::after {
        width: 100%;
      }

      /* ===== GLOBAL NOTIFICATION ===== */
      #notification {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: linear-gradient(90deg, #ff0000, #ff4d4d);
        color: white;
        padding: 18px 50px;
        text-align: center;
        font-weight: 800;
        font-size: 18px;
        letter-spacing: 1px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
        z-index: 3000;
        animation: slideDown 0.6s ease, blink 1.2s infinite;
      }

      #notification button.close-btn {
        position: absolute;
        right: 20px;
        top: 10px;
        background: transparent;
        border: none;
        color: white;
        font-size: 22px;
        font-weight: 900;
        cursor: pointer;
        transition: 0.3s;
      }

      #notification button.close-btn:hover {
        transform: scale(1.2);
        color: #ffcccc;
      }

      @keyframes blink {
        0%,
        100% {
          opacity: 1;
        }
        50% {
          opacity: 0.7;
        }
      }

      @keyframes slideDown {
        from {
          transform: translateY(-50px);
          opacity: 0;
        }
        to {
          transform: translateY(0);
          opacity: 1;
        }
      }

      /* ===== HERO ===== */
      .hero {
        height: 40vh;
        background: linear-gradient(135deg, rgba(0, 23, 45, 0.9) 0%, rgba(0, 87, 255, 0.7) 100%), 
                    url(img/pantau.webp);
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        padding-top: 120px;
        margin-bottom: 40px;
      }

      .hero-content h1 {
        font-size: 48px;
        font-weight: 900;
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.8);
        margin-bottom: 15px;
      }

      .hero-content p {
        font-size: 20px;
        font-weight: 600;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
        max-width: 600px;
      }

      /* ===== FILTER BUTTONS ===== */
      .filter-section {
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin: 0 auto 40px;
        width: 90%;
        max-width: 1200px;
      }

      .filter-section h3 {
        font-size: 24px;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 20px;
        text-align: center;
      }

      .filter-buttons {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
      }

      .filter-buttons button {
        border: none;
        padding: 12px 28px;
        border-radius: 30px;
        font-weight: 600;
        color: white;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        box-shadow: 0 5px 15px rgba(0, 87, 255, 0.3);
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .filter-buttons button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 87, 255, 0.4);
      }

      .filter-buttons button.danger {
        background: linear-gradient(90deg, var(--danger), #ff6666);
      }

      .filter-buttons button.success {
        background: linear-gradient(90deg, var(--success), #34ce57);
      }

      .filter-buttons button.warning {
        background: linear-gradient(90deg, var(--warning), #ffd351);
        color: var(--dark);
      }

      /* ===== MAP CONTAINER ===== */
      .map-container {
        background: white;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin: 0 auto 70px;
        width: 90%;
        max-width: 1200px;
      }

      .map-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
      }

      .map-header h2 {
        font-size: 28px;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
      }

      .map-legend {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
      }

      .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
      }

      .legend-color {
        width: 16px;
        height: 16px;
        border-radius: 50%;
      }

      .legend-color.posko {
        background: var(--success);
      }

      .legend-color.rawan {
        background: var(--warning);
      }

      /* ===== MAP ===== */
      #map {
        height: 70vh;
        width: 100%;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
      }

      /* ===== STATISTICS SECTION ===== */
      .stats-section {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin: 0 auto 70px;
        width: 90%;
        max-width: 1200px;
      }

      .stats-section h2 {
        font-size: 32px;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 30px;
        text-align: center;
      }

      .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
      }

      .stat-card {
        background: linear-gradient(135deg, #f8faff 0%, #e6f0ff 100%);
        padding: 25px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
      }

      .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      }

      .stat-icon {
        font-size: 36px;
        margin-bottom: 15px;
        color: var(--primary);
      }

      .stat-value {
        font-size: 32px;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 5px;
      }

      .stat-label {
        font-size: 16px;
        color: #666;
        font-weight: 600;
      }

      /* ===== BACK TO TOP BUTTON ===== */
      #backToTop {
        display: none;
        position: fixed;
        bottom: 35px;
        right: 35px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        padding: 14px 18px;
        border-radius: 12px;
        font-size: 22px;
        cursor: pointer;
        z-index: 1000;
        box-shadow: 0 6px 20px rgba(0, 87, 255, 0.3);
        transition: all 0.3s ease;
      }

      #backToTop:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0, 87, 255, 0.4);
      }

      /* ===== FOOTER ===== */
      footer {
        background: linear-gradient(135deg, var(--dark) 0%, #002855 100%);
        color: white;
        text-align: center;
        padding: 60px 20px;
        margin-top: auto;
        position: relative;
      }

      footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--secondary), var(--primary));
      }

      footer h4 {
        font-weight: 700;
        font-size: 22px;
        margin-bottom: 10px;
      }

      footer p {
        font-size: 15px;
        opacity: 0.9;
        margin-bottom: 0;
      }

      .chart-container {
        width: 200px;
        height: 120px;
      }

      /* Responsive */
      @media (max-width: 768px) {
        .hero-content h1 {
          font-size: 36px;
        }
        
        .hero-content p {
          font-size: 18px;
        }

        .filter-buttons {
          flex-direction: column;
          align-items: center;
        }

        .filter-buttons button {
          width: 100%;
          max-width: 280px;
        }

        .map-header {
          flex-direction: column;
          align-items: flex-start;
        }

        .map-legend {
          justify-content: center;
          width: 100%;
        }

        .navbar-links {
          display: none;
        }

        .navbar-container {
          padding: 15px 5%;
        }

        #backToTop {
          bottom: 25px;
          right: 25px;
          padding: 12px 16px;
          font-size: 20px;
        }
      }

      @media (max-width: 480px) {
        #backToTop {
          bottom: 20px;
          right: 20px;
          padding: 10px 14px;
          font-size: 18px;
        }
      }
    </style>
  </head>

  <body>
    <!-- ===== SCROLL PROGRESS BAR ===== -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- ===== GLOBAL NOTIFICATION ===== -->
    <div id="notification">
      ⚠️ PERINGATAN DARURAT! Tsunami terdeteksi — Perkiraan tiba dalam 20 menit di Palu!
      <button class="close-btn" id="closeNotifBtn">×</button>
    </div>

    <!-- ===== NAVBAR ===== -->
    <div class="navbar-container" id="navbar">
      <div class="logo-item">
        <img src="img/tsunamelogo.png" alt="Tsuname Logo" />
      </div>
      <div class="navbar-links">
        <a href="index_tsunami_user.php">Beranda</a>
        <a href="riwayat.php">Riwayat</a>
        <a href="maps2.php" style="color: #a9d6ff;">Pantau</a>
        <a href="artikel.php">Artikel</a>
        <a href="volunteer.php">Volunteer</a>
        <a href="about.php">Tentang</a>
      </div>
    </div>

    <!-- ===== HERO ===== -->
    <section class="hero">
      <div class="hero-content">
        <h1>Peta Posko & Daerah Rawan</h1>
        <p>Pantau lokasi evakuasi dan potensi tsunami di seluruh Indonesia</p>
      </div>
    </section>

    <!-- ===== FILTER SECTION ===== -->
    <section class="filter-section">
      <h3>Filter Peta</h3>
      <div class="filter-buttons">
        <button onclick="showAll()">
          <i class="fas fa-layer-group"></i>
          Tampilkan Semua
        </button>
        <button onclick="showPosko()" class="success">
          <i class="fas fa-home"></i>
          Hanya Posko
        </button>
        <button onclick="showRawan()" class="warning">
          <i class="fas fa-exclamation-triangle"></i>
          Hanya Daerah Rawan
        </button>
        <button onclick="startSimulation()" class="danger">
          <i class="fas fa-bolt"></i>
          Simulasi Tsunami
        </button>
      </div>
    </section>

    <!-- ===== STATISTICS SECTION ===== -->
    <section class="stats-section">
      <h2>Statistik Kesiapsiagaan</h2>
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <div class="stat-value" id="total-posko">0</div>
          <div class="stat-label">Posko Evakuasi</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">
            <i class="fas fa-exclamation-circle"></i>
          </div>
          <div class="stat-value" id="total-rawan">0</div>
          <div class="stat-label">Daerah Rawan</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">
            <i class="fas fa-users"></i>
          </div>
          <div class="stat-value" id="total-kapasitas">0</div>
          <div class="stat-label">Kapasitas Evakuasi</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <div class="stat-value" id="kesiapsiagaan">0%</div>
          <div class="stat-label">Kesiapsiagaan</div>
        </div>
      </div>
    </section>

    <!-- ===== MAP CONTAINER ===== -->
    <section class="map-container">
      <div class="map-header">
        <h2>Peta Interaktif</h2>
        <div class="map-legend">
          <div class="legend-item">
            <div class="legend-color posko"></div>
            <span>Posko Evakuasi</span>
          </div>
          <div class="legend-item">
            <div class="legend-color rawan"></div>
            <span>Daerah Rawan</span>
          </div>
        </div>
      </div>
      <div id="map"></div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer>
      <h4>Waver Project © 2025</h4>
      <p>Created by Waver | Stay Safe, Stay Prepared</p>
    </footer>

    <!-- ===== BACK TO TOP BUTTON ===== -->
    <button id="backToTop" aria-label="Kembali ke atas">
      <i class="fas fa-arrow-up"></i>
    </button>

    <!-- ===== SCRIPT ===== -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
      // ===== DOM Elements =====
      const navbar = document.getElementById("navbar");
      const notif = document.getElementById("notification");
      const closeNotifBtn = document.getElementById("closeNotifBtn");
      const backToTop = document.getElementById("backToTop");
      const scrollProgress = document.getElementById("scrollProgress");

      // ===== Global Variables =====
      let map;
      let poskoMarkers = [];
      let rawanMarkers = [];
      let tsunamiCircle = null;
      let tsunamiMarker = null;

      // ===== Data from Admin Dashboard =====
      function loadMapDataFromAdmin() {
        // Load data from localStorage (sync from admin dashboard)
        const poskoData = JSON.parse(localStorage.getItem('userMapPosko')) || [];
        const rawanData = JSON.parse(localStorage.getItem('userMapRawan')) || [];

        console.log('Loaded data from admin:', { poskoData, rawanData });

        return { poskoData, rawanData };
      }

      // ===== Initialize Map =====
      function initializeMap() {
        map = L.map("map").setView([-2.5, 118], 5);
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
          maxZoom: 19,
          attribution: "© OpenStreetMap contributors",
        }).addTo(map);

        // Load and display data from admin
        const { poskoData, rawanData } = loadMapDataFromAdmin();
        displayMapData(poskoData, rawanData);
        updateStatistics(poskoData, rawanData);
      }

      // ===== Display Map Data =====
      function displayMapData(poskoData, rawanData) {
        // Clear existing markers
        clearAllMarkers();

        // Create custom icons
        const poskoIcon = L.divIcon({
          html: '<i class="fas fa-home" style="color: #28a745; font-size: 20px;"></i>',
          className: 'custom-posko-icon',
          iconSize: [20, 20],
          iconAnchor: [10, 10]
        });

        const rawanIcon = L.divIcon({
          html: '<i class="fas fa-exclamation-triangle" style="color: #ffc107; font-size: 20px;"></i>',
          className: 'custom-rawan-icon',
          iconSize: [20, 20],
          iconAnchor: [10, 10]
        });

        // Add posko markers
        poskoData.forEach((p) => {
          const marker = L.marker([p.lat, p.lng], { icon: poskoIcon }).addTo(map);
          marker.bindPopup(`
            <div style="min-width: 200px;">
              <h6 style="color: #28a745; margin-bottom: 10px;"><b>${p.name}</b></h6>
              <p style="margin-bottom: 5px;"><i class="fas fa-map-marker-alt" style="color: #0057ff;"></i> <b>Lokasi:</b> ${p.location}</p>
              <p style="margin-bottom: 5px;"><i class="fas fa-users" style="color: #0057ff;"></i> <b>Kapasitas:</b> ${p.capacity} orang</p>
              <p style="margin-bottom: 0;"><i class="fas fa-phone" style="color: #0057ff;"></i> <b>Kontak:</b> ${p.contact}</p>
            </div>
          `);
          poskoMarkers.push(marker);
        });

        // Add rawan markers
        rawanData.forEach((r) => {
          const marker = L.marker([r.lat, r.lng], { icon: rawanIcon }).addTo(map);
          const dangerLevelText = {
            'rendah': 'Rendah',
            'sedang': 'Sedang', 
            'tinggi': 'Tinggi'
          }[r.dangerLevel] || r.dangerLevel;

          const dangerLevelClass = {
            'rendah': 'status-active',
            'sedang': 'status-warning',
            'tinggi': 'status-danger'
          }[r.dangerLevel] || 'status-pending';

          marker.bindPopup(`
            <div style="min-width: 250px;">
              <h6 style="color: #ffc107; margin-bottom: 10px;"><b>${r.name}</b></h6>
              <p style="margin-bottom: 5px;"><i class="fas fa-map-marker-alt" style="color: #0057ff;"></i> <b>Lokasi:</b> ${r.location}</p>
              <p style="margin-bottom: 10px;"><span class="status-badge ${dangerLevelClass}">${dangerLevelText}</span></p>
              <div class="chart-container"><canvas id="chart-${r.name.replace(/\s/g, '')}"></canvas></div>
            </div>
          `);
          
          marker.on("popupopen", () => {
            const chartId = `chart-${r.name.replace(/\s/g, '')}`;
            const ctx = document.getElementById(chartId);
            if (ctx) {
              new Chart(ctx, {
                type: "line",
                data: {
                  labels: ["06:00", "09:00", "12:00", "15:00", "18:00"],
                  datasets: [
                    {
                      label: "Ketinggian Gelombang (m)",
                      data: [0.5, 1.2, 0.8, 1.6, 0.9],
                      borderColor: "#007bff",
                      backgroundColor: "rgba(0,123,255,0.2)",
                      fill: true,
                      tension: 0.4,
                    },
                  ],
                },
                options: { 
                  plugins: { legend: { display: false } }, 
                  scales: { 
                    y: { 
                      beginAtZero: true,
                      title: {
                        display: true,
                        text: 'Meter'
                      }
                    },
                    x: {
                      title: {
                        display: true,
                        text: 'Waktu'
                      }
                    }
                  } 
                },
              });
            }
          });
          rawanMarkers.push(marker);
        });
      }

      // ===== Clear All Markers =====
      function clearAllMarkers() {
        poskoMarkers.forEach(marker => map.removeLayer(marker));
        rawanMarkers.forEach(marker => map.removeLayer(marker));
        
        poskoMarkers = [];
        rawanMarkers = [];
      }

      // ===== Update Statistics =====
      function updateStatistics(poskoData, rawanData) {
        const totalPosko = poskoData.length;
        const totalRawan = rawanData.length;
        const totalKapasitas = poskoData.reduce((sum, posko) => sum + (posko.capacity || 0), 0);
        
        // Calculate preparedness percentage (example calculation)
        const kesiapsiagaan = Math.min(100, Math.round((totalPosko / Math.max(totalRawan, 1)) * 100));

        document.getElementById('total-posko').textContent = totalPosko;
        document.getElementById('total-rawan').textContent = totalRawan;
        document.getElementById('total-kapasitas').textContent = totalKapasitas.toLocaleString();
        document.getElementById('kesiapsiagaan').textContent = kesiapsiagaan + '%';
      }

      // ===== Filter Functions =====
      function showAll() {
        const { poskoData, rawanData } = loadMapDataFromAdmin();
        displayMapData(poskoData, rawanData);
      }
      
      function showPosko() {
        const { poskoData } = loadMapDataFromAdmin();
        displayMapData(poskoData, []);
      }
      
      function showRawan() {
        const { rawanData } = loadMapDataFromAdmin();
        displayMapData([], rawanData);
      }

      // ===== Scroll Effects =====
      window.addEventListener("scroll", () => {
        const scrollY = window.scrollY;
        
        // Navbar scroll effect
        navbar.classList.toggle("scrolled", scrollY > 50);
        
        // Back to Top button
        backToTop.style.display = scrollY > 300 ? "block" : "none";
        
        // Scroll progress bar
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        if (scrollProgress) {
          scrollProgress.style.width = scrolled + "%";
        }
      });

      // ===== Back to Top Function =====
      backToTop.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
      });

      // ===== Notifikasi Global =====
      function activateNotification() {
        localStorage.setItem("notifActive", "true");
        localStorage.setItem("notifClosed", "false");
        showGlobalNotification();
      }

      function showGlobalNotification() {
        notif.style.display = "block";
        navbar.classList.add("notif-active");
      }

      function closeNotification() {
        notif.style.transition = "opacity 0.5s ease";
        notif.style.opacity = "0";
        setTimeout(() => {
          notif.style.display = "none";
          notif.style.opacity = "1";
          navbar.classList.remove("notif-active");
        }, 500);
        localStorage.setItem("notifClosed", "true");
        localStorage.setItem("notifActive", "false");
        
        // Hapus marker dan circle tsunami dari peta
        if (tsunamiCircle) {
          map.removeLayer(tsunamiCircle);
          tsunamiCircle = null;
        }
        if (tsunamiMarker) {
          map.removeLayer(tsunamiMarker);
          tsunamiMarker = null;
        }
      }

      closeNotifBtn.addEventListener("click", closeNotification);

      // ===== Simulasi Tsunami =====
      function startSimulation() {
        // Aktifkan notifikasi global
        activateNotification();
        // Jalankan simulasi tsunami di peta
        simulateTsunami();
      }

      function simulateTsunami() {
        const tsunamiLocation = { lat: -0.9, lng: 119.87 }; // Palu
        
        // Hapus tsunami sebelumnya jika ada
        if (tsunamiCircle) map.removeLayer(tsunamiCircle);
        if (tsunamiMarker) map.removeLayer(tsunamiMarker);
        
        tsunamiCircle = L.circle(tsunamiLocation, {
          color: "red",
          fillColor: "#f03",
          fillOpacity: 0.4,
          radius: 60000,
        }).addTo(map);

        tsunamiMarker = L.marker(tsunamiLocation)
          .addTo(map)
          .bindPopup("<b>🚨 Tsunami terdeteksi di Palu!</b><br>Perkiraan tiba: 20 menit.<br><b>Segera evakuasi ke tempat yang lebih tinggi!</b>")
          .openPopup();

        map.setView(tsunamiLocation, 7);
      }

      // ===== Initialize Default Data if Empty =====
      function initializeDefaultData() {
        const poskoData = JSON.parse(localStorage.getItem('userMapPosko'));
        const rawanData = JSON.parse(localStorage.getItem('userMapRawan'));

        if (!poskoData || poskoData.length === 0) {
          const defaultPosko = [
            { name: "Posko Banda Aceh", location: "Banda Aceh", lat: 5.55, lng: 95.32, capacity: 250, contact: "0812-5555-8888" },
            { name: "Posko Cilacap", location: "Cilacap", lat: -7.72, lng: 109.01, capacity: 180, contact: "0813-1234-5678" },
            { name: "Posko Padang", location: "Padang", lat: -0.95, lng: 100.35, capacity: 220, contact: "0814-8888-9999" },
            { name: "Posko Palu", location: "Palu", lat: -0.89, lng: 119.87, capacity: 300, contact: "0812-9999-1212" },
            { name: "Posko Manado", location: "Manado", lat: 1.49, lng: 124.84, capacity: 150, contact: "0822-3210-4321" }
          ];
          localStorage.setItem('userMapPosko', JSON.stringify(defaultPosko));
        }

        if (!rawanData || rawanData.length === 0) {
          const defaultRawan = [
            { name: "Daerah Rawan Padang", location: "Padang", lat: -0.95, lng: 100.35, dangerLevel: "tinggi" },
            { name: "Daerah Rawan Palu", location: "Palu", lat: -0.9, lng: 119.87, dangerLevel: "tinggi" },
            { name: "Daerah Rawan Bengkulu", location: "Bengkulu", lat: -3.8, lng: 102.26, dangerLevel: "sedang" },
            { name: "Daerah Rawan Banten", location: "Banten", lat: -6.3, lng: 106.1, dangerLevel: "sedang" }
          ];
          localStorage.setItem('userMapRawan', JSON.stringify(defaultRawan));
        }
      }

      // ===== Saat Halaman Dimuat =====
      window.addEventListener("DOMContentLoaded", () => {
        const notifActive = localStorage.getItem("notifActive");
        const notifClosed = localStorage.getItem("notifClosed");

        // Initialize default data if empty
        initializeDefaultData();

        // Initialize map
        initializeMap();

        // Tampilkan notifikasi jika aktif dan belum ditutup
        if (notifActive === "true" && notifClosed === "false") {
          showGlobalNotification();
        } else {
          notif.style.display = "none";
          navbar.classList.remove("notif-active");
        }
      });

      // ===== Auto-refresh data every 30 seconds =====
      setInterval(() => {
        const { poskoData, rawanData } = loadMapDataFromAdmin();
        updateStatistics(poskoData, rawanData);
        console.log('Data refreshed from admin dashboard');
      }, 30000);
    </script>
  </body>

</html>

