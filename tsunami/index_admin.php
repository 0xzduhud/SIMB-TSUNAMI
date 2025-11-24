<?php
include "koneksi.php";
session_start();

// Cek apakah user sudah login sebagai admin
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
//     header("Location: admin_login.php");
//     exit();
// }

// Query untuk mengambil data dari database
$query_incidents = "SELECT * FROM kejadian ORDER BY tanggal DESC";
$result_incidents = mysqli_query($conn, $query_incidents);

$query_articles = "SELECT * FROM artikel ORDER BY tanggal_publikasi DESC";
$result_articles = mysqli_query($conn, $query_articles);

$query_volunteers = "SELECT * FROM volunteer ORDER BY id_volunteer DESC";
$result_volunteers = mysqli_query($conn, $query_volunteers);

// Hitung statistik
$total_incidents = mysqli_num_rows($result_incidents);
$total_articles = mysqli_num_rows($result_articles);
$total_volunteers = mysqli_num_rows($result_volunteers);

// Hitung kejadian aktif
$query_active_incidents = "SELECT COUNT(*) as active FROM kejadian WHERE status = 'Aktif'";
$result_active = mysqli_query($conn, $query_active_incidents);
$active_incidents = mysqli_fetch_assoc($result_active)['active'];

// Proses form tambah kejadian
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_incident'])) {
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];
    $magnitudo = $_POST['magnitudo'];
    $kedalaman = $_POST['kedalaman'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];
    
    $query = "INSERT INTO kejadian (tanggal, lokasi, magnitudo, kedalaman, status, deskripsi) 
              VALUES ('$tanggal', '$lokasi', $magnitudo, $kedalaman, '$status', '$deskripsi')";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = "Kejadian berhasil ditambahkan!";
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: " . mysqli_error($conn);
    }
}

// Proses form edit kejadian
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_incident'])) {
    $id_kejadian = $_POST['id_kejadian'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];
    $magnitudo = $_POST['magnitudo'];
    $kedalaman = $_POST['kedalaman'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];
    
    $query = "UPDATE kejadian SET 
              tanggal = '$tanggal', 
              lokasi = '$lokasi', 
              magnitudo = $magnitudo, 
              kedalaman = $kedalaman, 
              status = '$status', 
              deskripsi = '$deskripsi' 
              WHERE id_kejadian = $id_kejadian";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = "Kejadian berhasil diperbarui!";
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: " . mysqli_error($conn);
    }
}

// Ambil data kejadian untuk edit
if (isset($_GET['edit_incident'])) {
    $id_kejadian = $_GET['edit_incident'];
    $query = "SELECT * FROM kejadian WHERE id_kejadian = $id_kejadian";
    $result = mysqli_query($conn, $query);
    $incident_to_edit = mysqli_fetch_assoc($result);
}

// Proses hapus kejadian
if (isset($_GET['delete_incident'])) {
    $id_kejadian = $_GET['delete_incident'];
    $query = "DELETE FROM kejadian WHERE id_kejadian = $id_kejadian";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = "Kejadian berhasil dihapus!";
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: " . mysqli_error($conn);
    }
}

// Proses form tambah artikel
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_article'])) {
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $tanggal_publikasi = $_POST['tanggal_publikasi'];
    $url_gambar = $_POST['url_gambar'];
    $link_artikel_eksternal = $_POST['link_artikel_eksternal'];
    $konten = $_POST['konten'];
    $id_admin = $_SESSION['admin_id'];
    
    $query = "INSERT INTO artikel (id_admin, judul, kategori, tanggal_publikasi, url_gambar, link_artikel_eksternal, konten) 
              VALUES ($id_admin, '$judul', '$kategori', '$tanggal_publikasi', '$url_gambar', '$link_artikel_eksternal', '$konten')";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = "Artikel berhasil ditambahkan!";
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: " . mysqli_error($conn);
    }
}

// Proses form edit artikel
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_article'])) {
    $id_artikel = $_POST['id_artikel'];
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $tanggal_publikasi = $_POST['tanggal_publikasi'];
    $url_gambar = $_POST['url_gambar'];
    $link_artikel_eksternal = $_POST['link_artikel_eksternal'];
    $konten = $_POST['konten'];
    $id_admin = $_SESSION['admin_id'];
    
    $query = "UPDATE artikel SET 
              judul = '$judul', 
              kategori = '$kategori', 
              tanggal_publikasi = '$tanggal_publikasi', 
              url_gambar = '$url_gambar', 
              link_artikel_eksternal = '$link_artikel_eksternal', 
              konten = '$konten' 
              WHERE id_artikel = $id_artikel";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = "Artikel berhasil diperbarui!";
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: " . mysqli_error($conn);
    }
}

// Ambil data artikel untuk edit
if (isset($_GET['edit_article'])) {
    $id_artikel = $_GET['edit_article'];
    $query = "SELECT * FROM artikel WHERE id_artikel = $id_artikel";
    $result = mysqli_query($conn, $query);
    $article_to_edit = mysqli_fetch_assoc($result);
}

// Proses hapus artikel
if (isset($_GET['delete_article'])) {
    $id_artikel = $_GET['delete_article'];
    $query = "DELETE FROM artikel WHERE id_artikel = $id_artikel";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = "Artikel berhasil dihapus!";
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: " . mysqli_error($conn);
    }
}

// Proses hapus volunteer
if (isset($_GET['delete_volunteer'])) {
    $id_volunteer = $_GET['delete_volunteer'];
    $query = "DELETE FROM volunteer WHERE id_volunteer = $id_volunteer";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = "Volunteer berhasil dihapus!";
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: " . mysqli_error($conn);
    }
}

// Ambil pesan notifikasi dari session
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';

// Hapus pesan notifikasi dari session setelah ditampilkan
unset($_SESSION['success_message']);
unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Waver — Admin Dashboard</title>

  <!-- FONT & LIBRARY -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <style>
    :root {
      --primary: #0057ff;
      --secondary: #007bff;
      --dark: #001b44;
      --light: #f8faff;
      --accent: #00d4ff;
      --success: #28a745;
      --danger: #dc3545;
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
      color: #333;
      min-height: 100vh;
      display: flex;
    }

    /* ===== SIDEBAR ===== */
    .sidebar {
      width: 280px;
      background: linear-gradient(135deg, var(--dark) 0%, #002855 100%);
      color: white;
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      padding: 30px 0;
      box-shadow: 5px 0 20px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      transition: all 0.3s ease;
      overflow-y: auto;
    }

    .sidebar-header {
      text-align: center;
      padding: 0 25px 30px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      margin-bottom: 30px;
    }

    .sidebar-header img {
      width: 100px;
      height: auto;
      margin-bottom: 15px;
    }

    .sidebar-header h2 {
      font-size: 22px;
      font-weight: 700;
      color: white;
    }

    .sidebar-menu {
      list-style: none;
      padding: 0;
    }

    .sidebar-menu li {
      margin-bottom: 5px;
    }

    .sidebar-menu a {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 15px 25px;
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      transition: all 0.3s ease;
      font-weight: 600;
      border-left: 4px solid transparent;
    }

    .sidebar-menu a:hover,
    .sidebar-menu a.active {
      background: rgba(255, 255, 255, 0.1);
      color: white;
      border-left-color: var(--accent);
    }

    .sidebar-menu i {
      font-size: 18px;
      width: 24px;
      text-align: center;
    }

    /* ===== MAIN CONTENT ===== */
    .main-content {
      flex: 1;
      margin-left: 280px;
      padding: 30px;
      transition: all 0.3s ease;
    }

    /* ===== HEADER ===== */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 1px solid #e0e0e0;
    }

    .header h1 {
      font-size: 32px;
      font-weight: 800;
      color: var(--primary);
      margin: 0;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .user-avatar {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 18px;
    }

    .user-details h4 {
      font-size: 16px;
      font-weight: 700;
      margin: 0;
      color: var(--dark);
    }

    .user-details p {
      font-size: 14px;
      color: #666;
      margin: 0;
    }

    /* ===== DASHBOARD CARDS ===== */
    .dashboard-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      margin-bottom: 40px;
    }

    .card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      padding: 25px;
      transition: all 0.3s ease;
      border: none;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    }

    .card-icon {
      width: 60px;
      height: 60px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      font-size: 24px;
      color: white;
    }

    .card-icon.primary {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
    }

    .card-icon.success {
      background: linear-gradient(135deg, var(--success), #2ecc71);
    }

    .card-icon.warning {
      background: linear-gradient(135deg, var(--warning), #f1c40f);
    }

    .card-icon.danger {
      background: linear-gradient(135deg, var(--danger), #e74c3c);
    }

    .card h3 {
      font-size: 28px;
      font-weight: 800;
      color: var(--dark);
      margin-bottom: 5px;
    }

    .card p {
      font-size: 14px;
      color: #666;
      margin: 0;
    }

    /* ===== CONTENT SECTIONS ===== */
    .content-section {
      background: white;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      padding: 30px;
      margin-bottom: 30px;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      padding-bottom: 15px;
      border-bottom: 1px solid #eaeaea;
    }

    .section-header h2 {
      font-size: 24px;
      font-weight: 700;
      color: var(--dark);
      margin: 0;
    }

    .btn {
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
      border: none;
      cursor: pointer;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 87, 255, 0.3);
    }

    .btn-success {
      background: linear-gradient(135deg, var(--success), #2ecc71);
      color: white;
    }

    .btn-danger {
      background: linear-gradient(135deg, var(--danger), #e74c3c);
      color: white;
    }

    .btn-warning {
      background: linear-gradient(135deg, var(--warning), #f1c40f);
      color: var(--dark);
    }

    /* ===== TABLE STYLING ===== */
    .table-container {
      overflow-x: auto;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 15px 20px;
      text-align: left;
      border-bottom: 1px solid #eaeaea;
    }

    th {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-size: 14px;
    }

    tr {
      transition: all 0.3s ease;
    }

    tr:hover {
      background-color: #f8faff;
    }

    .status-badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 12px;
      text-transform: uppercase;
    }

    .status-active {
      background: rgba(40, 167, 69, 0.1);
      color: var(--success);
      border: 1px solid var(--success);
    }

    .status-inactive {
      background: rgba(220, 53, 69, 0.1);
      color: var(--danger);
      border: 1px solid var(--danger);
    }

    .status-pending {
      background: rgba(255, 193, 7, 0.1);
      color: var(--warning);
      border: 1px solid var(--warning);
    }

    .status-danger {
      background: rgba(220, 53, 69, 0.1);
      color: var(--danger);
      border: 1px solid var(--danger);
    }

    .status-warning {
      background: rgba(255, 193, 7, 0.1);
      color: var(--warning);
      border: 1px solid var(--warning);
    }

    .action-buttons {
      display: flex;
      gap: 8px;
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 12px;
      border-radius: 6px;
    }

    /* ===== FORM PAGE STYLING ===== */
    .form-page {
      background: white;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      padding: 30px;
      margin-bottom: 30px;
    }

    .form-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 1px solid #eaeaea;
    }

    .form-header h2 {
      font-size: 24px;
      font-weight: 700;
      color: var(--dark);
      margin: 0;
    }

    .form-actions {
      display: flex;
      gap: 15px;
      justify-content: flex-end;
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid #eaeaea;
    }

    /* ===== DASHBOARD OVERVIEW ===== */
    .dashboard-overview {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 30px;
    }

    .recent-activity {
      background: white;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      padding: 30px;
    }

    .activity-list {
      list-style: none;
      padding: 0;
    }

    .activity-item {
      display: flex;
      align-items: flex-start;
      gap: 15px;
      padding: 15px 0;
      border-bottom: 1px solid #f0f0f0;
    }

    .activity-item:last-child {
      border-bottom: none;
    }

    .activity-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 16px;
      flex-shrink: 0;
    }

    .activity-content {
      flex: 1;
    }

    .activity-content h4 {
      font-size: 14px;
      font-weight: 600;
      margin: 0 0 5px;
      color: var(--dark);
    }

    .activity-content p {
      font-size: 13px;
      color: #666;
      margin: 0;
    }

    .activity-time {
      font-size: 12px;
      color: #999;
    }

    /* ===== FORM STYLING ===== */
    .form-group {
      margin-bottom: 25px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: var(--dark);
    }

    .form-control {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-family: "Inter", sans-serif;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(0, 87, 255, 0.1);
    }

    textarea.form-control {
      resize: vertical;
      min-height: 120px;
    }

    /* ===== NOTIFICATION STYLES ===== */
    .notification {
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 15px 20px;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      z-index: 9999;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      transform: translateX(150%);
      transition: transform 0.3s ease;
    }

    .notification.show {
      transform: translateX(0);
    }

    .notification.success {
      background: var(--success);
    }

    .notification.error {
      background: var(--danger);
    }

    .notification.warning {
      background: var(--warning);
      color: var(--dark);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
      .sidebar {
        width: 80px;
      }
      
      .sidebar-header h2,
      .sidebar-menu span {
        display: none;
      }
      
      .sidebar-menu a {
        justify-content: center;
        padding: 15px;
      }
      
      .main-content {
        margin-left: 80px;
      }
      
      .dashboard-overview {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 768px) {
      .main-content {
        padding: 20px;
      }
      
      .dashboard-cards {
        grid-template-columns: 1fr;
      }
      
      .header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }
      
      .user-info {
        align-self: flex-end;
      }
      
      .form-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }
      
      .form-actions {
        flex-direction: column;
      }
    }

    @media (max-width: 480px) {
      .sidebar {
        width: 60px;
      }
      
      .main-content {
        margin-left: 60px;
        padding: 15px;
      }
      
      .content-section {
        padding: 20px;
      }
      
      .form-page {
        padding: 20px;
      }
    }
  </style>
</head>

<body>
  <!-- ===== NOTIFICATION ===== -->
  <div id="notification" class="notification"></div>

  <!-- ===== SIDEBAR ===== -->
  <div class="sidebar">
    <div class="sidebar-header">
      <img src="img/tsunamelogo.png" alt="Tsuname Logo" />
      <h2>Admin Panel</h2>
    </div>
    
    <ul class="sidebar-menu">
      <li><a href="#" class="active" onclick="showSection('dashboard')"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
      <li><a href="#" onclick="showSection('incidents')"><i class="fas fa-history"></i> <span>Riwayat Kejadian</span></a></li>
      <li><a href="#" onclick="showSection('articles')"><i class="fas fa-newspaper"></i> <span>Artikel & Berita</span></a></li>
      <li><a href="#" onclick="showSection('volunteers')"><i class="fas fa-hands-helping"></i> <span>Volunteer</span></a></li>
      <li><a href="index_tsunami_user.php"><i class="fas fa-sign-out-alt"></i> <span>Kembali ke User</span></a></li>
      <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
    </ul>
  </div>

  <!-- ===== MAIN CONTENT ===== -->
  <div class="main-content">
    
    <!-- Header -->
    <div class="header">
      <h1 id="page-title">Dashboard Admin</h1>
      <div class="user-info">
        <div class="user-avatar">A</div>
        <div class="user-details">
          <h4>Admin Waver</h4>
          <p>Administrator</p>
        </div>
      </div>
    </div>

    <!-- Dashboard Overview (Default View) -->
    <div id="dashboard-section">
      <!-- Dashboard Cards -->
      <div class="dashboard-cards">
        <div class="card">
          <div class="card-icon primary">
            <i class="fas fa-wave-square"></i>
          </div>
          <h3><?php echo $active_incidents; ?></h3>
          <p>Kejadian Tsunami Aktif</p>
        </div>
        
        <div class="card">
          <div class="card-icon success">
            <i class="fas fa-users"></i>
          </div>
          <h3><?php echo $total_volunteers; ?></h3>
          <p>Volunteer Terdaftar</p>
        </div>
        
        <div class="card">
          <div class="card-icon warning">
            <i class="fas fa-newspaper"></i>
          </div>
          <h3><?php echo $total_articles; ?></h3>
          <p>Artikel Dipublikasi</p>
        </div>
        
        <div class="card">
          <div class="card-icon danger">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
          <h3><?php echo $active_incidents; ?></h3>
          <p>Peringatan Darurat</p>
        </div>
      </div>

      <!-- Dashboard Overview -->
      <div class="dashboard-overview">
        <div class="content-section">
          <div class="section-header">
            <h2>Aktivitas Terbaru</h2>
          </div>
          
          <ul class="activity-list" id="recent-activities">
            <?php
            // Ambil aktivitas terbaru dari database
            $recent_activities = [];
            
            // Ambil kejadian terbaru
            $query_recent_incidents = "SELECT * FROM kejadian ORDER BY tanggal DESC LIMIT 3";
            $result_recent_incidents = mysqli_query($conn, $query_recent_incidents);
            while ($incident = mysqli_fetch_assoc($result_recent_incidents)) {
                $recent_activities[] = [
                    'type' => 'incident',
                    'title' => 'Kejadian Tsunami Dilaporkan',
                    'description' => "Kejadian di {$incident['lokasi']} dengan magnitudo {$incident['magnitudo']}",
                    'time' => $incident['tanggal'],
                    'icon' => 'fas fa-wave-square',
                    'color' => 'var(--danger)'
                ];
            }
            
            // Ambil volunteer terbaru
            $query_recent_volunteers = "SELECT * FROM volunteer ORDER BY id_volunteer DESC LIMIT 2";
            $result_recent_volunteers = mysqli_query($conn, $query_recent_volunteers);
            while ($volunteer = mysqli_fetch_assoc($result_recent_volunteers)) {
                $recent_activities[] = [
                    'type' => 'volunteer',
                    'title' => 'Volunteer Baru Bergabung',
                    'description' => "{$volunteer['nama']} telah bergabung sebagai volunteer",
                    'time' => $volunteer['id_volunteer'], // Using ID as timestamp proxy
                    'icon' => 'fas fa-user-plus',
                    'color' => 'var(--success)'
                ];
            }
            
            // Tampilkan aktivitas
            foreach ($recent_activities as $activity) {
                $time_ago = date('d M Y', strtotime($activity['time']));
                echo "
                <li class='activity-item'>
                  <div class='activity-icon' style='background: {$activity['color']}'>
                    <i class='{$activity['icon']}'></i>
                  </div>
                  <div class='activity-content'>
                    <h4>{$activity['title']}</h4>
                    <p>{$activity['description']}</p>
                    <div class='activity-time'>{$time_ago}</div>
                  </div>
                </li>";
            }
            ?>
          </ul>
        </div>
        
        <div class="recent-activity">
          <div class="section-header">
            <h2>Statistik Cepat</h2>
          </div>
          
          <div class="quick-stats">
            <div class="stat-item" style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #f0f0f0;">
              <span>Kejadian Aktif</span>
              <strong><?php echo $active_incidents; ?></strong>
            </div>
            <div class="stat-item" style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #f0f0f0;">
              <span>Total Volunteer</span>
              <strong><?php echo $total_volunteers; ?></strong>
            </div>
            <div class="stat-item" style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #f0f0f0;">
              <span>Total Artikel</span>
              <strong><?php echo $total_articles; ?></strong>
            </div>
            <div class="stat-item" style="display: flex; justify-content: space-between; padding: 15px 0;">
              <span>Total Kejadian</span>
              <strong><?php echo $total_incidents; ?></strong>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Incidents Management Section -->
    <div class="content-section" id="incidents-section" style="display: <?php echo (isset($_GET['edit_incident']) || isset($incident_to_edit)) ? 'none' : 'block'; ?>;">
      <div class="section-header">
        <h2>Kelola Riwayat Kejadian</h2>
        <button class="btn btn-primary" onclick="showSection('add-incident')">
          <i class="fas fa-plus"></i>
          Tambah Kejadian
        </button>
      </div>
      
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Lokasi</th>
              <th>Magnitudo</th>
              <th>Kedalaman</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Reset pointer result
            mysqli_data_seek($result_incidents, 0);
            
            if (mysqli_num_rows($result_incidents) > 0) {
                while ($row = mysqli_fetch_assoc($result_incidents)) {
                    $status_class = '';
                    $status_text = '';
                    
                    switch ($row['status']) {
                        case 'Aktif':
                            $status_class = 'status-danger';
                            $status_text = 'Aktif';
                            break;
                        case 'Pemantauan':
                            $status_class = 'status-warning';
                            $status_text = 'Pemantauan';
                            break;
                        case 'Selesai':
                            $status_class = 'status-active';
                            $status_text = 'Selesai';
                            break;
                        default:
                            $status_class = 'status-pending';
                            $status_text = $row['status'];
                    }
                    
                    echo "
                    <tr>
                      <td>" . date('d M Y', strtotime($row['tanggal'])) . "</td>
                      <td>{$row['lokasi']}</td>
                      <td>{$row['magnitudo']} SR</td>
                      <td>{$row['kedalaman']} km</td>
                      <td><span class='status-badge {$status_class}'>{$status_text}</span></td>
                      <td>
                        <div class='action-buttons'>
                          <a href='admin_dashboard.php?edit_incident={$row['id_kejadian']}' class='btn btn-primary btn-sm'>
                            <i class='fas fa-edit'></i> Edit
                          </a>
                          <a href='admin_dashboard.php?delete_incident={$row['id_kejadian']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus kejadian ini?')\">
                            <i class='fas fa-trash'></i> Hapus
                          </a>
                        </div>
                      </td>
                    </tr>";
                }
            } else {
                echo "
                <tr>
                  <td colspan='6' style='text-align: center; padding: 20px;'>
                    <i class='fas fa-info-circle'></i> Belum ada data kejadian
                  </td>
                </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Add/Edit Incident Form Page -->
    <div class="form-page" id="add-incident-section" style="display: <?php echo (isset($_GET['edit_incident']) || isset($incident_to_edit)) ? 'block' : 'none'; ?>;">
      <div class="form-header">
        <h2 id="form-title"><?php echo isset($incident_to_edit) ? 'Edit Kejadian Tsunami' : 'Tambah Kejadian Tsunami Baru'; ?></h2>
        <button class="btn" onclick="showSection('incidents')">
          <i class="fas fa-arrow-left"></i>
          Kembali
        </button>
      </div>
      
      <form id="incident-form" method="POST" action="admin_dashboard.php">
        <?php if (isset($incident_to_edit)): ?>
            <input type="hidden" id="id_kejadian" name="id_kejadian" value="<?php echo $incident_to_edit['id_kejadian']; ?>">
        <?php endif; ?>
        
        <div class="form-group">
          <label for="tanggal">Tanggal Kejadian *</label>
          <input type="date" id="tanggal" name="tanggal" class="form-control" 
                 value="<?php echo isset($incident_to_edit) ? $incident_to_edit['tanggal'] : ''; ?>" required>
        </div>
        
        <div class="form-group">
          <label for="lokasi">Lokasi *</label>
          <input type="text" id="lokasi" name="lokasi" class="form-control" 
                 value="<?php echo isset($incident_to_edit) ? $incident_to_edit['lokasi'] : ''; ?>" 
                 placeholder="Masukkan lokasi kejadian" required>
        </div>
        
        <div class="form-group">
          <label for="magnitudo">Magnitudo *</label>
          <input type="number" id="magnitudo" name="magnitudo" class="form-control" 
                 value="<?php echo isset($incident_to_edit) ? $incident_to_edit['magnitudo'] : ''; ?>" 
                 placeholder="Masukkan magnitudo" step="0.1" min="0" required>
        </div>
        
        <div class="form-group">
          <label for="kedalaman">Kedalaman (km) *</label>
          <input type="number" id="kedalaman" name="kedalaman" class="form-control" 
                 value="<?php echo isset($incident_to_edit) ? $incident_to_edit['kedalaman'] : ''; ?>" 
                 placeholder="Masukkan kedalaman gempa" step="0.1" min="0" required>
        </div>
        
        <div class="form-group">
          <label for="status">Status *</label>
          <select id="status" name="status" class="form-control" required>
            <option value="">Pilih Status</option>
            <option value="Aktif" <?php echo (isset($incident_to_edit) && $incident_to_edit['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
            <option value="Pemantauan" <?php echo (isset($incident_to_edit) && $incident_to_edit['status'] == 'Pemantauan') ? 'selected' : ''; ?>>Pemantauan</option>
            <option value="Selesai" <?php echo (isset($incident_to_edit) && $incident_to_edit['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="deskripsi">Deskripsi</label>
          <textarea id="deskripsi" name="deskripsi" class="form-control" placeholder="Masukkan deskripsi kejadian tsunami"><?php echo isset($incident_to_edit) ? $incident_to_edit['deskripsi'] : ''; ?></textarea>
        </div>
        
        <div class="form-actions">
          <button type="button" class="btn" onclick="showSection('incidents')">
            <i class="fas fa-times"></i>
            Batal
          </button>
          <?php if (isset($incident_to_edit)): ?>
            <button type="submit" class="btn btn-primary" name="edit_incident">
              <i class="fas fa-save"></i>
              Update Kejadian
            </button>
          <?php else: ?>
            <button type="submit" class="btn btn-primary" name="add_incident">
              <i class="fas fa-save"></i>
              Simpan Kejadian
            </button>
          <?php endif; ?>
        </div>
      </form>
    </div>

    <!-- Articles Management Section -->
    <div class="content-section" id="articles-section" style="display: <?php echo (isset($_GET['edit_article']) || isset($article_to_edit)) ? 'none' : 'block'; ?>;">
      <div class="section-header">
        <h2>Kelola Artikel & Berita</h2>
        <button class="btn btn-primary" onclick="showSection('add-article')">
          <i class="fas fa-plus"></i>
          Tambah Artikel
        </button>
      </div>
      
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Judul</th>
              <th>Kategori</th>
              <th>Tanggal Publikasi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Reset pointer result
            mysqli_data_seek($result_articles, 0);
            
            if (mysqli_num_rows($result_articles) > 0) {
                while ($row = mysqli_fetch_assoc($result_articles)) {
                    echo "
                    <tr>
                      <td>{$row['judul']}</td>
                      <td>{$row['kategori']}</td>
                      <td>" . date('d M Y', strtotime($row['tanggal_publikasi'])) . "</td>
                      <td>
                        <div class='action-buttons'>
                          <a href='admin_dashboard.php?edit_article={$row['id_artikel']}' class='btn btn-primary btn-sm'>
                            <i class='fas fa-edit'></i> Edit
                          </a>
                          <a href='admin_dashboard.php?delete_article={$row['id_artikel']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus artikel ini?')\">
                            <i class='fas fa-trash'></i> Hapus
                          </a>
                        </div>
                      </td>
                    </tr>";
                }
            } else {
                echo "
                <tr>
                  <td colspan='4' style='text-align: center; padding: 20px;'>
                    <i class='fas fa-info-circle'></i> Belum ada data artikel
                  </td>
                </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Add/Edit Article Form Page -->
    <div class="form-page" id="add-article-section" style="display: <?php echo (isset($_GET['edit_article']) || isset($article_to_edit)) ? 'block' : 'none'; ?>;">
      <div class="form-header">
        <h2><?php echo isset($article_to_edit) ? 'Edit Artikel' : 'Tambah Artikel Baru'; ?></h2>
        <button class="btn" onclick="showSection('articles')">
          <i class="fas fa-arrow-left"></i>
          Kembali
        </button>
      </div>
      
      <form method="POST" action="admin_dashboard.php">
        <?php if (isset($article_to_edit)): ?>
            <input type="hidden" id="id_artikel" name="id_artikel" value="<?php echo $article_to_edit['id_artikel']; ?>">
        <?php endif; ?>
        
        <div class="form-group">
          <label for="judul">Judul Artikel *</label>
          <input type="text" id="judul" name="judul" class="form-control" 
                 value="<?php echo isset($article_to_edit) ? $article_to_edit['judul'] : ''; ?>" 
                 placeholder="Masukkan judul artikel" required>
        </div>
        
        <div class="form-group">
          <label for="kategori">Kategori *</label>
          <select id="kategori" name="kategori" class="form-control" required>
            <option value="">Pilih Kategori</option>
            <option value="Pencegahan" <?php echo (isset($article_to_edit) && $article_to_edit['kategori'] == 'Pencegahan') ? 'selected' : ''; ?>>Pencegahan</option>
            <option value="Edukasi" <?php echo (isset($article_to_edit) && $article_to_edit['kategori'] == 'Edukasi') ? 'selected' : ''; ?>>Edukasi</option>
            <option value="Berita" <?php echo (isset($article_to_edit) && $article_to_edit['kategori'] == 'Berita') ? 'selected' : ''; ?>>Berita</option>
            <option value="Penelitian" <?php echo (isset($article_to_edit) && $article_to_edit['kategori'] == 'Penelitian') ? 'selected' : ''; ?>>Penelitian</option>
            <option value="Kesiapsiagaan" <?php echo (isset($article_to_edit) && $article_to_edit['kategori'] == 'Kesiapsiagaan') ? 'selected' : ''; ?>>Kesiapsiagaan</option>
            <option value="Teknologi" <?php echo (isset($article_to_edit) && $article_to_edit['kategori'] == 'Teknologi') ? 'selected' : ''; ?>>Teknologi</option>
            <option value="Kisah Inspiratif" <?php echo (isset($article_to_edit) && $article_to_edit['kategori'] == 'Kisah Inspiratif') ? 'selected' : ''; ?>>Kisah Inspiratif</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="tanggal_publikasi">Tanggal Publikasi *</label>
          <input type="date" id="tanggal_publikasi" name="tanggal_publikasi" class="form-control" 
                 value="<?php echo isset($article_to_edit) ? $article_to_edit['tanggal_publikasi'] : ''; ?>" required>
        </div>
        
        <div class="form-group">
          <label for="url_gambar">URL Gambar</label>
          <input type="url" id="url_gambar" name="url_gambar" class="form-control" 
                 value="<?php echo isset($article_to_edit) ? $article_to_edit['url_gambar'] : ''; ?>" 
                 placeholder="Masukkan URL gambar">
        </div>
        
        <div class="form-group">
          <label for="link_artikel_eksternal">Link Artikel Eksternal</label>
          <input type="url" id="link_artikel_eksternal" name="link_artikel_eksternal" class="form-control" 
                 value="<?php echo isset($article_to_edit) ? $article_to_edit['link_artikel_eksternal'] : ''; ?>" 
                 placeholder="Masukkan link artikel eksternal">
        </div>
        
        <div class="form-group">
          <label for="konten">Konten Artikel *</label>
          <textarea id="konten" name="konten" class="form-control" placeholder="Masukkan konten artikel" rows="8" required><?php echo isset($article_to_edit) ? $article_to_edit['konten'] : ''; ?></textarea>
        </div>
        
        <div class="form-actions">
          <button type="button" class="btn" onclick="showSection('articles')">
            <i class="fas fa-times"></i>
            Batal
          </button>
          <?php if (isset($article_to_edit)): ?>
            <button type="submit" class="btn btn-primary" name="edit_article">
              <i class="fas fa-save"></i>
              Update Artikel
            </button>
          <?php else: ?>
            <button type="submit" class="btn btn-primary" name="add_article">
              <i class="fas fa-save"></i>
              Simpan Artikel
            </button>
          <?php endif; ?>
        </div>
      </form>
    </div>

    <!-- Volunteers Management Section -->
    <div class="content-section" id="volunteers-section" style="display: none;">
      <div class="section-header">
        <h2>Kelola Data Volunteer</h2>
      </div>
      
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>Telepon</th>
              <th>Keahlian</th>
              <th>Kejadian</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Reset pointer result
            mysqli_data_seek($result_volunteers, 0);
            
            if (mysqli_num_rows($result_volunteers) > 0) {
                while ($row = mysqli_fetch_assoc($result_volunteers)) {
                    // Get incident name
                    $incident_name = "Tidak ada";
                    if ($row['id_kejadian']) {
                        $query_incident = "SELECT lokasi FROM kejadian WHERE id_kejadian = {$row['id_kejadian']}";
                        $result_incident = mysqli_query($conn, $query_incident);
                        if ($incident = mysqli_fetch_assoc($result_incident)) {
                            $incident_name = $incident['lokasi'];
                        }
                    }
                    
                    echo "
                    <tr>
                      <td>{$row['nama']}</td>
                      <td>{$row['email']}</td>
                      <td>{$row['nomor_telpon']}</td>
                      <td>{$row['pengalaman']}</td>
                      <td>{$incident_name}</td>
                      <td>
                        <div class='action-buttons'>
                          <a href='admin_dashboard.php?delete_volunteer={$row['id_volunteer']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus volunteer ini?')\">
                            <i class='fas fa-trash'></i> Hapus
                          </a>
                        </div>
                      </td>
                    </tr>";
                }
            } else {
                echo "
                <tr>
                  <td colspan='6' style='text-align: center; padding: 20px;'>
                    <i class='fas fa-info-circle'></i> Belum ada data volunteer
                  </td>
                </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <script>
    // Function to show/hide sections
    function showSection(section) {
      // Hide all sections
      document.getElementById('dashboard-section').style.display = 'none';
      document.getElementById('incidents-section').style.display = 'none';
      document.getElementById('add-incident-section').style.display = 'none';
      document.getElementById('articles-section').style.display = 'none';
      document.getElementById('add-article-section').style.display = 'none';
      document.getElementById('volunteers-section').style.display = 'none';
      
      // Show selected section
      switch(section) {
        case 'dashboard':
          document.getElementById('dashboard-section').style.display = 'block';
          document.getElementById('page-title').textContent = 'Dashboard Admin';
          break;
        case 'incidents':
          document.getElementById('incidents-section').style.display = 'block';
          document.getElementById('page-title').textContent = 'Kelola Riwayat Kejadian';
          break;
        case 'add-incident':
          document.getElementById('add-incident-section').style.display = 'block';
          document.getElementById('page-title').textContent = 'Tambah Kejadian Baru';
          break;
        case 'articles':
          document.getElementById('articles-section').style.display = 'block';
          document.getElementById('page-title').textContent = 'Kelola Artikel & Berita';
          break;
        case 'add-article':
          document.getElementById('add-article-section').style.display = 'block';
          document.getElementById('page-title').textContent = 'Tambah Artikel Baru';
          break;
        case 'volunteers':
          document.getElementById('volunteers-section').style.display = 'block';
          document.getElementById('page-title').textContent = 'Kelola Data Volunteer';
          break;
      }
      
      // Update active menu
      updateActiveMenu(section);
    }
    
    // Function to update active menu
    function updateActiveMenu(section) {
      const menuItems = document.querySelectorAll('.sidebar-menu a');
      menuItems.forEach(item => {
        item.classList.remove('active');
      });
      
      // Set active based on section
      switch(section) {
        case 'dashboard':
        case 'add-incident':
          document.querySelector('.sidebar-menu a[onclick="showSection(\'dashboard\')"]').classList.add('active');
          break;
        case 'incidents':
          document.querySelector('.sidebar-menu a[onclick="showSection(\'incidents\')"]').classList.add('active');
          break;
        case 'articles':
        case 'add-article':
          document.querySelector('.sidebar-menu a[onclick="showSection(\'articles\')"]').classList.add('active');
          break;
        case 'volunteers':
          document.querySelector('.sidebar-menu a[onclick="showSection(\'volunteers\')"]').classList.add('active');
          break;
      }
    }
    
    // Show notification if there are messages
    <?php if (!empty($success_message)): ?>
      showNotification('<?php echo $success_message; ?>', 'success');
    <?php endif; ?>
    
    <?php if (!empty($error_message)): ?>
      showNotification('<?php echo $error_message; ?>', 'error');
    <?php endif; ?>
    
    // Function to show notification
    function showNotification(message, type) {
      const notification = document.getElementById('notification');
      notification.textContent = message;
      notification.className = `notification ${type} show`;
      
      setTimeout(() => {
        notification.classList.remove('show');
      }, 5000);
    }
    
    // Set current date as default for date fields
    document.addEventListener('DOMContentLoaded', function() {
      const today = new Date().toISOString().split('T')[0];
      
      // Only set default dates if not in edit mode
      <?php if (!isset($incident_to_edit)): ?>
        document.getElementById('tanggal').value = today;
      <?php endif; ?>
      
      <?php if (!isset($article_to_edit)): ?>
        document.getElementById('tanggal_publikasi').value = today;
      <?php endif; ?>
    });
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
