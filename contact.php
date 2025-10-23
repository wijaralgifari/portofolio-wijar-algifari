<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>
    <div class="container">
        <div class="form-box box">

            <?php
            include "connection.php"; // Koneksi ke database
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Ambil data dari form
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);
                $subject = htmlspecialchars($_POST['subject']);
                $message = htmlspecialchars($_POST['message']);

                // Masukkan ke database
                $query = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
                $data = mysqli_query($conn, $query);

                if ($data) {
                    echo "<div class='message'>
                            <p>Message saved successfully in database ✨</p>
                          </div><br>";

                    // Kirim email
                    $to = "wijaralgifari@gmail.com, wijaralgifari@icloud.com";
                    $email_subject = "New Contact Form Submission: $subject";
                    $email_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
                    $headers = "From: $email";

                    if (mail($to, $email_subject, $email_body, $headers)) {
                        echo "<div class='message'>
                                <p>Email sent successfully ✉️</p>
                              </div><br>";
                    } else {
                        echo "<div class='message'>
                                <p>Failed to send email 😔</p>
                              </div><br>";
                    }

                    // Kirim ke WhatsApp
                    $whatsapp_number = "087796908765";
                    $whatsapp_message = urlencode("New Contact Form Submission:\n\nName: $name\nEmail: $email\nSubject: $subject\nMessage: $message");
                    $whatsapp_url = "wa.me/6287796908765";

                    echo "<a href='$whatsapp_url'><button class='btn'>Send to WhatsApp</button></a>";
                } else {
                    echo "<div class='message'>
                            <p>Failed to save message in database 😔</p>
                          </div><br>";
                }

                echo "<a href='index.php'><button class='btn'>Go Back</button></a>";
            }
            ?>
            <?php
            if (isset($_POST['submit'])) {
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);
                $subject = htmlspecialchars($_POST['subject']);
                $message = htmlspecialchars($_POST['message']);

                // Email Admin
                $admin_email = "wijaralgifari@gmail.com, wijaralgifari@icloud.com";
                $email_subject = "New Contact Form Submission: $subject";
                $email_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
                $headers = "From: $email";

                // Kirim Email ke Admin
                if (mail($admin_email, $email_subject, $email_body, $headers)) {
                    echo "<script>alert('Pesan berhasil dikirim ke email admin!');</script>";
                } else {
                    echo "<script>alert('Gagal mengirim email. Silakan coba lagi.');</script>";
                }

                // Kirim ke WhatsApp Admin
                $whatsapp_number = "6287796908765"; // Ganti dengan nomor admin (pakai format internasional, 62 untuk Indonesia)
                $whatsapp_message = urlencode("📩 Pesan Baru dari Website:\n\nNama: $name\nEmail: $email\nSubjek: $subject\nPesan: $message");

                // Redirect ke WhatsApp
                echo "<script>window.location.href = 'https://wa.me/$whatsapp_number?text=$whatsapp_message';</script>";
            }
            ?>

            <!-- Form Kontak -->
            <form action="" method="post">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message"
                            required></textarea>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" name="submit">Send Message</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</body>

</html>