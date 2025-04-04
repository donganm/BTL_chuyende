<?php
session_start();
include('../includes/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM images WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $description = $_POST['description'];

    // Xử lý upload ảnh mới nếu có
    if (!empty($_FILES['fileToUpload']['name'])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $image_path = $target_file;

        $sql = "UPDATE images SET image_path='$image_path', description='$description' WHERE id=$id";
    } else {
        $sql = "UPDATE images SET description='$description' WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='../pages/profile.php';</script>";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Ảnh</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        input[type="file"],
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #218838;
        }
    </style>
</head>

<body>
    <h2>Cập Nhật Ảnh</h2>
    <form action="update_image.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <p>Ảnh hiện tại:</p>
        <img src="<?php echo $row['image_path']; ?>" width="150">
        <p>Chọn ảnh mới:</p>
        <input type="file" name="fileToUpload">
        <p>Mô tả:</p>
        <input type="text" name="description" value="<?php echo $row['description']; ?>">
        <br>
        <button type="submit">Cập Nhật</button>

    </form>
</body>

</html>