<?php
include 'db.php';

// Xử lý Xóa giảng viên
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Xóa ảnh trong thư mục uploads để tránh rác server
    $sql_img = "SELECT Image FROM GiangVien WHERE IDGV = $id";
    $res_img = $conn->query($sql_img);
    if($res_img && $row_img = $res_img->fetch_assoc()) {
        if(!empty($row_img['Image']) && file_exists($row_img['Image'])) {
            unlink($row_img['Image']);
        }
    }

    $sql = "DELETE FROM GiangVien WHERE IDGV = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi xóa: " . $conn->error;
    }
}

// Lấy danh sách giảng viên
$sql = "SELECT * FROM GiangVien ORDER BY IDGV ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Học Phần</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 0;
        }
        .navbar-brand-custom {
            font-weight: 800;
            font-size: 1.25rem;
            color: #1e3a8a;
            text-decoration: none;
        }
        .teacher-item-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .teacher-item-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.05);
            border-color: #cbd5e1;
        }
        .avatar-img {
            width: 75px;
            height: 75px;
            object-fit: cover;
            border-radius: 14px;
            border: 2px solid #e2e8f0;
        }
        .btn-add-new {
            background-color: #2563eb;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            padding: 10px 20px;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
            transition: all 0.2s;
        }
        .btn-add-new:hover {
            background-color: #1d4ed8;
            color: #fff;
        }
        .badge-gv {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 700;
            font-size: 0.8rem;
            padding: 4px 10px;
            border-radius: 6px;
        }
        .badge-class {
            background-color: #eff6ff;
            color: #2563eb;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 50rem;
            font-size: 0.85rem;
            border: 1px solid #dbeafe;
        }
    </style>
</head>
<body>

    <nav class="navbar-custom">
        <div class="container d-flex align-items-center">
            <a class="navbar-brand-custom d-flex align-items-center" href="index.php">
                <span class="fs-3 me-2">🎓</span> 
                <span>HỆ THỐNG QUẢN LÝ HỌC PHẦN</span>
            </a>
        </div>
    </nav>

    <div class="container my-5" style="max-width: 900px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Danh Sách Giảng Viên</h3>
                <p class="text-muted mb-0 small">Quản lý thông tin chi tiết và phân công lớp học</p>
            </div>
            <a href="add.php" class="btn-add-new">
                <i class="bi bi-plus-lg"></i> Thêm Giảng Viên Mới
            </a>
        </div>

        <div class="d-flex flex-column gap-3">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="teacher-item-card p-3 p-md-4">
                        <div class="row align-items-center g-3">
                            
                            <!-- Ảnh đại diện -->
                            <div class="col-auto">
                                <?php if (!empty($row['Image']) && file_exists($row['Image'])): ?>
                                    <img src="<?php echo $row['Image']; ?>" alt="Avatar" class="avatar-img">
                                <?php else: ?>
                                    <div class="avatar-img d-flex align-items-center justify-content-center bg-light text-secondary">
                                        <i class="bi bi-person fs-3"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Mã GV & Họ tên -->
                            <div class="col">
                                <div class="mb-1">
                                    <span class="badge-gv">GV<?php echo str_pad($row['IDGV'], 2, '0', STR_PAD_LEFT); ?></span>
                                </div>
                                <h5 class="fw-bold text-dark mb-0"><?php echo htmlspecialchars($row['Fullname']); ?></h5>
                            </div>

                            <!-- Tổng số lớp -->
                            <div class="col-auto text-center px-md-4">
                                <span class="text-muted small d-block mb-1">Phụ trách</span>
                                <span class="badge-class">
                                    <i class="bi bi-journal-text me-1"></i> <?php echo $row['SumClass']; ?> lớp
                                </span>
                            </div>

                            <!-- Nút Thao tác -->
                            <div class="col-auto">
                                <div class="d-flex gap-2">
                                    <a href="edit.php?id=<?php echo $row['IDGV']; ?>" class="btn btn-outline-primary btn-sm px-3 py-2 rounded-2 fw-semibold">
                                        <i class="bi bi-pencil-square me-1"></i> Sửa
                                    </a>
                                    <a href="index.php?delete=<?php echo $row['IDGV']; ?>" class="btn btn-outline-danger btn-sm px-3 py-2 rounded-2 fw-semibold" onclick="return confirm('Bạn có chắc chắn muốn xóa giảng viên này không?');">
                                        <i class="bi bi-trash me-1"></i> Xóa
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center py-5 bg-white rounded-4 border shadow-sm">
                    <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                    <h5 class="text-muted">Chưa có dữ liệu giảng viên trong hệ thống.</h5>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>