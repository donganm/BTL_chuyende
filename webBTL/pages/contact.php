<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1 {
            color: #333;
        }

        .contact-info {
            margin-bottom: 30px;
        }

        iframe {
            border: 0;
            width: 100%;
            height: 400px;
        }

        /*Phần thông tin liên hệ (Contact Info)*/
        .contact-info {
            margin-bottom: 30px;
            text-align: center;
        }

        .contact-info h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .contact-info p {
            font-size: 18px;
            color: #7f8c8d;
        }

        .contact-info a {
            font-size: 18px;
            color: #2980b9;
            text-decoration: underline;
        }


        /*Social Media*/
        .social-media {
            text-align: center;
            margin-top: 20px;
        }

        .social-media a {
            font-size: 18px;
            color: #2980b9;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-media a:hover {
            color: #1abc9c;
        }

        /*So dien thoai va thoi gian lam viec*/
        .contact-info p a {
            font-weight: bold;
            color: #e74c3c;
        }

        .contact-info p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include("../includes/header.php"); ?>
    <!-- End header -->

    <div class="container">
        <h1>Contact Us</h1>
        <!-- Địa chỉ công ty -->
        <div class="contact-info">
            <h2>Our Office</h2>
            <p>285 Đội Cấn, Ba Đình, Hà Nội</p>

            <!-- Google Maps Iframe -->
            <iframe
                src="https://maps.google.com/maps?q=Aptech%20Computer%20Education&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>

        <!-- Liên kết Email -->
        <div class="contact-info">
            <h2>Email Us</h2>
            <p>If you have any questions, feel free to send us an email at:
                <a href="mailto:khanhnh309@gmail.com">nhom09@gmail.com</a>
            </p>
        </div>

        <!--So dien thoai lien he -->
        <div class="contact-info">
            <h2>Call Us</h2>
            <p>Phone: <a href="tel:+84987654321">+84 987654322</a></p>
        </div>

        <!--Mang xa hoi-->
        <div class="social-media">
            <h2>Follow Us</h2>
            <a href="#">Facebook</a>
            <a href="#">LinkedIn</a>
            <a href="#">Twitter</a>
        </div>

        <!--Thoi gian lam viec-->
        <div class="contact-info">
            <h2>Working Hours</h2>
            <p>Monday - Friday: 9 AM - 6 PM</p>
            <p>Saturday: 9 AM - 12 PM</p>
            <p>Sunday: Closed</p>
        </div>
    </div>

    <!-- Footer  -->
    <?php include("../includes/footer.php"); ?>

    <!-- End Footer -->
</body>

</html>