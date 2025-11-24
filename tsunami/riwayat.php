<?php
// Include koneksi database
include 'koneksi.php';

// Query untuk mengambil data kejadian tsunami - DIPERBAIKI
$sql = "SELECT id_kejadian, tanggal, lokasi, magnitudo, status, deskripsi 
        FROM kejadian 
        ORDER BY tanggal DESC";

$result = $conn->query($sql);

// Hitung statistik - DIPERBAIKI
$stats = [
    'total' => 0,
    'active' => 0,
    'monitoring' => 0,
    'completed' => 0
];

if ($result) {
    $stats['total'] = $result->num_rows;
    
    // Reset pointer untuk iterasi ulang
    $result->data_seek(0);
    
    while($row = $result->fetch_assoc()) {
        switch($row['status']) {
            case 'Aktif':
                $stats['active']++;
                break;
            case 'Pemantauan':
                $stats['monitoring']++;
                break;
            case 'Selesai':
                $stats['completed']++;
                break;
        }
    }
    
    // Reset pointer lagi untuk tampilan data
    $result->data_seek(0);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Waver — Riwayat Kejadian Tsunami</title>

    <!-- FONT & LIBRARY -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0057ff;
            --secondary: #007bff;
            --dark: #001b44;
            --light: #f8faff;
            --accent: #00d4ff;
            --danger: #e74c3c;
            --success: #2ecc71;
            --warning: #f39c12;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", sans-serif;
            background: linear-gradient(135deg, #f8faff 0%, #e6f0ff 100%);
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        /* ===== NOTIFICATION BAR ===== */
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

        @keyframes slideDown {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
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

        /* ===== HERO SECTION ===== */
        .hero {
            height: 40vh;
            background: linear-gradient(135deg, rgba(0, 23, 45, 0.9) 0%, rgba(0, 87, 255, 0.7) 100%), 
                        url('img/riwayat.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            margin-top: 0;
            padding-top: 120px;
            margin-bottom: 40px;
        }

        .hero.notif-active {
            padding-top: 180px;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 900;
            color: white;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.8);
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 20px;
            color: white;
            font-weight: 600;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
            max-width: 600px;
        }

        /* ===== MAIN CONTENT ===== */
        main {
            padding: 0 10% 80px;
            flex: 1;
        }

        .content-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            margin-bottom: 40px;
        }

        h2 {
            font-size: 36px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .section-description {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
            max-width: 800px;
        }

        /* ===== TABLE STYLING ===== */
        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 15px;
            overflow: hidden;
        }

        th, td {
            padding: 18px 20px;
            text-align: center;
            border-bottom: 1px solid #eaeaea;
        }

        th {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 14px;
        }

        tr {
            transition: all 0.3s ease;
        }

        tr:hover {
            background-color: #f8faff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        tr:nth-child(even) {
            background-color: #fafcff;
        }

        tr:nth-child(even):hover {
            background-color: #f4f8ff;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-aktif {
            background: linear-gradient(135deg, var(--danger), #ff6b6b);
            color: white;
            box-shadow: 0 3px 10px rgba(231, 76, 60, 0.3);
        }

        .status-selesai {
            background: linear-gradient(135deg, var(--success), #2ecc71);
            color: white;
            box-shadow: 0 3px 10px rgba(46, 204, 113, 0.3);
        }

        .status-pemantauan {
            background: linear-gradient(135deg, var(--warning), #f1c40f);
            color: white;
            box-shadow: 0 3px 10px rgba(243, 156, 18, 0.3);
        }

        .daftar-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 87, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 0 auto;
            min-width: 140px;
        }

        .daftar-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 87, 255, 0.4);
        }

        .daftar-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .daftar-btn:disabled:hover {
            transform: none;
            box-shadow: none;
        }

        /* ===== STATISTICS SECTION ===== */
        .stats-section {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            margin-bottom: 40px;
        }

        .stats-section h2 {
            margin-bottom: 30px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 36px;
            }
            
            .hero p {
                font-size: 18px;
            }

            main {
                padding: 0 5% 60px;
            }

            .content-container, .stats-section {
                padding: 30px 20px;
            }

            h2 {
                font-size: 28px;
            }

            th, td {
                padding: 12px 15px;
                font-size: 14px;
            }

            .daftar-btn {
                padding: 8px 15px;
                font-size: 13px;
                min-width: 120px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
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
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            th, td {
                padding: 10px 12px;
                font-size: 13px;
            }
            
            #notification {
                padding: 12px 40px;
                font-size: 16px;
            }

            #backToTop {
                bottom: 20px;
                right: 20px;
                padding: 10px 14px;
                font-size: 18px;
            }
        }

        .loading {
            text-align: center;
            padding: 20px;
            color: #666;
        }
    </style>
</head>

<body>
    <!-- ===== SCROLL PROGRESS BAR ===== -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- ===== NOTIFICATION BAR ===== -->
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
            <a href="riwayat.php" style="color: #a9d6ff;">Riwayat</a>
            <a href="maps2.php">Pantau</a>
            <a href="artikel.php">Artikel</a>
            <a href="volunteer.php">Volunteer</a>
            <a href="about.php">Tentang</a>
        </div>
    </div>

    <!-- ===== HERO SECTION ===== -->
    <section class="hero" id="hero">
        <div class="hero-content" data-aos="fade-up">
            <h1>Riwayat Kejadian Tsunami</h1>
            <p>Pelajari dan pantau kejadian tsunami di Indonesia untuk meningkatkan kesiapsiagaan</p>
        </div>
    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <main>
        <!-- Statistics Section -->
        <section class="stats-section" data-aos="fade-up">
            <h2>Statistik Kejadian Tsunami</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-wave-square"></i>
                    </div>
                    <div class="stat-value"><?php echo $stats['total']; ?></div>
                    <div class="stat-label">Total Kejadian</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stat-value"><?php echo $stats['active']; ?></div>
                    <div class="stat-label">Aktif</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-value"><?php echo $stats['completed']; ?></div>
                    <div class="stat-label">Selesai</div>
                </div>
            </div>
        </section>

        <!-- Riwayat Table Section -->
        <section class="content-container" data-aos="fade-up" data-aos-delay="200">
            <h2>Daftar Kejadian Tsunami</h2>
            <p class="section-description">Lihat daftar kejadian tsunami terbaru beserta status dan ketersediaan volunteer untuk membantu.</p>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Magnitudo</th>
                            <th>Status</th>
                            <th>Volunteer</th>
                        </tr>
                    </thead>
                    <tbody id="riwayat-table">
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <?php
                                // Format tanggal
                                $tanggal = date('d M Y', strtotime($row['tanggal']));
                                
                                // Tentukan badge status - DIPERBAIKI
                                $status_badge = '';
                                $volunteer_btn = '';
                                
                                switch($row['status']) {
                                    case 'Aktif':
                                        $status_badge = '<span class="status-badge status-aktif">Aktif</span>';
                                        $volunteer_btn = '<button class="daftar-btn" onclick="daftarVolunteer(' . $row['id_kejadian'] . ', \'' . htmlspecialchars($row['lokasi']) . '\')"><i class="fas fa-user-plus"></i> Daftar</button>';
                                        break;
                                    case 'Pemantauan':
                                        $status_badge = '<span class="status-badge status-pemantauan">Pemantauan</span>';
                                        $volunteer_btn = '<button class="daftar-btn" onclick="daftarVolunteer(' . $row['id_kejadian'] . ', \'' . htmlspecialchars($row['lokasi']) . '\')"><i class="fas fa-user-plus"></i> Daftar</button>';
                                        break;
                                    case 'Selesai':
                                    default:
                                        $status_badge = '<span class="status-badge status-selesai">Selesai</span>';
                                        $volunteer_btn = '<button class="daftar-btn" disabled><i class="fas fa-ban"></i> Tidak Tersedia</button>';
                                        break;
                                }
                                ?>
                                <tr>
                                    <td><?php echo $tanggal; ?></td>
                                    <td><?php echo htmlspecialchars($row['lokasi']); ?></td>
                                    <td><?php echo $row['magnitudo']; ?> SR</td>
                                    <td><?php echo $status_badge; ?></td>
                                    <td><?php echo $volunteer_btn; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 30px;">
                                    <i class="fas fa-info-circle" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
                                    <p style="color: #666; font-size: 16px;">Belum ada data kejadian tsunami</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer data-aos="fade-up">
        <h4>Waver Project © 2025</h4>
        <p>Created by Waver | Stay Safe, Stay Prepared</p>
    </footer>

    <!-- ===== BACK TO TOP BUTTON ===== -->
    <button id="backToTop" aria-label="Kembali ke atas">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS
        AOS.init({ 
            duration: 1000, 
            once: true,
            offset: 100
        });

        const navbar = document.getElementById("navbar");
        const hero = document.getElementById("hero");
        const notif = document.getElementById("notification");
        const closeNotifBtn = document.getElementById("closeNotifBtn");
        const backToTop = document.getElementById("backToTop");
        const scrollProgress = document.getElementById("scrollProgress");

        // === SCROLL EFFECTS ===
        window.addEventListener("scroll", () => {
            const scrollY = window.scrollY;
            
            // Navbar scroll effect
            navbar.classList.toggle("scrolled", scrollY > 100);
            
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

        // === BACK TO TOP FUNCTION ===
        backToTop.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });

        // === FUNGSI MENAMPILKAN NOTIFIKASI ===
        function showNotification() {
            notif.style.display = "block";
            navbar.classList.add("notif-active");
            hero.classList.add("notif-active");
        }

        // === FUNGSI CLOSE NOTIFIKASI ===
        function closeNotification() {
            notif.style.transition = "opacity 0.5s ease";
            notif.style.opacity = "0";
            setTimeout(() => {
                notif.style.display = "none";
                notif.style.opacity = "1";
                navbar.classList.remove("notif-active");
                hero.classList.remove("notif-active");
            }, 500);
            localStorage.setItem("notifClosed", "true");
            localStorage.setItem("notifActive", "false");
        }

        closeNotifBtn.addEventListener("click", closeNotification);

        // === CEK NOTIFIKASI SAAT HALAMAN DIMUAT ===
        window.addEventListener("DOMContentLoaded", () => {
            console.log('🎯 Halaman riwayat dimuat');
            
            const notifActive = localStorage.getItem("notifActive");
            const notifClosed = localStorage.getItem("notifClosed");

            if ((notifActive === "true" && notifClosed === "false") || 
                (notifActive === null && notifClosed === null)) {
                showNotification();
            } else {
                notif.style.display = "none";
                navbar.classList.remove("notif-active");
                hero.classList.remove("notif-active");
            }
        });

        // === Fungsi untuk menuju halaman volunteer - DIPERBAIKI ===
        function daftarVolunteer(idKejadian, lokasi) {
            if (confirm("Anda akan diarahkan untuk mendaftar volunteer di lokasi: " + lokasi + "\n\nLanjutkan?")) {
                window.location.href = "volunteer.php?id_kejadian=" + idKejadian + "&lokasi=" + encodeURIComponent(lokasi);
            }
        }

        // === AUTO REFRESH DATA ===
        function startAutoRefresh() {
            setInterval(() => {
                console.log('🔄 Auto refresh data...');
                window.location.reload();
            }, 60000);
        }

        startAutoRefresh();

        // Debug info
        console.log('✅ Halaman riwayat tsunami berhasil dimuat');
        console.log('📊 Total data: <?php echo $stats['total']; ?> kejadian');
    </script>
</body>
</html>

<?php
// Tutup koneksi database
if (isset($conn)) {
    $conn->close();
}
?>
