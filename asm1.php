<?php
// filepath: d:\XAMPP\htdocs\php demo\asm1.php

require_once 'db.php'; // Kết nối cơ sở dữ liệu

// Xử lý form thêm sinh viên
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Xử lý upload ảnh
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // Thêm dữ liệu vào cơ sở dữ liệu
    try {
        $stmt = $pdo->prepare("INSERT INTO students (name, email, phone, address, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $address, $image]);
        header('Location: asm1.php'); // Chuyển hướng để tránh gửi lại form
        exit;
    } catch (PDOException $e) {
        die("Lỗi thêm dữ liệu: " . $e->getMessage());
    }
}

// Truy vấn danh sách sinh viên
try {
    $stmt = $pdo->query("SELECT * FROM students");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi truy vấn cơ sở dữ liệu: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Quản lý sinh viên</h1>

        <!-- Form thêm sinh viên -->
        <form action="asm1.php" method="POST" enctype="multipart/form-data" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="name" class="form-control" placeholder="Tên" required>
                </div>
                <div class="col-md-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="address" class="form-control" placeholder="Địa chỉ" required>
                </div>
                <div class="col-md-1">
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm sinh viên</button>
        </form>

        <!-- Danh sách sinh viên -->
        <table class="table table-hover table-bordered fade-in">
            <thead class="table-dark">
                <tr>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($student['image']) ?>" alt="Ảnh" class="img-thumbnail" width="50"></td>
                            <td><?= htmlspecialchars($student['name']) ?></td>
                            <td><?= htmlspecialchars($student['email']) ?></td>
                            <td><?= htmlspecialchars($student['phone']) ?></td>
                            <td><?= htmlspecialchars($student['address']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Không có sinh viên nào trong danh sách.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>