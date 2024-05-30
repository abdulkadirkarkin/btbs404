<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAÜ Yurt Yönetim Sistemi</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <div class="container">
            <h1>DAÜ Yurt Yönetim Sistemi</h1>
            <h2 align="right"><?php
                session_start();

                if(isset($_SESSION['isim']) && isset($_SESSION['soyisim']) && isset($_SESSION['ogrno'])) {
                    echo "Hoşgeldiniz: " . $_SESSION['isim'] . " " . $_SESSION['soyisim'] . " " . $_SESSION['ogrno'] . " ";
                }
            ?></h2>
            <nav>
                <ul>
                    <li><a href="#">Anasayfa</a></li>
                    <li><a href="ana_sayfaen.php">English</a></li
                    <li><a href="yurtara.php">Yurt Ara</a></li>
                    <li>
                        <a href="mesaj.php">Mesajlarım
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "btbs404";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Bağlantı hatası: " . $conn->connect_error);
                            }

                            if(isset($_SESSION['ogrno'])) {
                                $ogrno = $_SESSION['ogrno'];
                                $sql = "SELECT COUNT(*) as mesaj_sayisi FROM mesaj WHERE aliciogrno='$ogrno'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $mesaj_sayisi = $row['mesaj_sayisi'];
                                    echo "<span class='notification-badge'>$mesaj_sayisi</span>";
                                } else {
                                    echo "<span class='notification-badge'>0</span>";
                                }
                            }

                            $conn->close();
                            ?>
                        </a>
                    </li>
                    <li><a href="logout.php">Çıkış Yap</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <section class="hero">
        <div class="container">
            <h2>DAÜ Yurt Yönetim Sistemi'ne Hoş Geldiniz!</h2>
            <p>Uygun yurt bulma sürecini kolaylaştırın ve kampüs hayatınızı daha iyi bir şekilde yönetin.</p>
            <a href="yurtara.php" class="btn">Yurt Ara</a>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>Özellikler ve İşlevler</h2>
            <div class="feature">
                <i class="fas fa-user"></i>
                <h3><a href="login.html">Öğrenci Kaydı ve Girişi</a></h3>
                <p>Öğrenciler sistemimize hesap oluşturabilir ve giriş yapabilir.</p>
            </div>
            <div class="feature">
                <i class="fas fa-user"></i>
                <h3><a href="yurtsahiplogin.html">Yurt Sahibi Kaydı ve Girişi</a></h3>
                <p>Yurt Sahipleri sistemimize hesap oluşturabilir ve giriş yapabilir.</p>
            </div>
            <div class="feature">
                <i class="fas fa-search"></i>
                <h3><a href="yurtara.php">Yurt Arama</a></h3>
                <p>Konuma, fiyata ve tercihlere göre yurtları arayın.</p>
            </div>
            <div class="feature">
                <i class="fas fa-search"></i>
                <h3><a href="yurtkarsilasti.php">Hizmet Karşılaştırması</a></h3>
                <p>Öğrenciler bilinçli kararlar vermek için hizmetleri yan yana karşılaştırabilirler</p>
            </div>
            <div class="feature">
                <i class="fas fa-search"></i>
                <h3><a href="ogres.php">Öğrenci Eşleştirme</a></h3>
                <p>Sohbet özelliği, aynı odayı paylaşmak isteyen öğrenciler arasındaki iletişimi kolaylaştıracaktır.</p>
            </div>
            <div class="feature">
                <i class="fas fa-search"></i>
                <h3><a href="derecelendir.php">Derecelendirme ve Geri Bildirim Sistemi</a></h3>
                <p>Öğrenciler kaldıkları yurtlara ilişkin puan ve yazılı geri bildirimde bulunabilirler.</p>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 DAÜ Yurt Yönetim Sistemi</p>
        </div>
    </footer>
</body>
</html>
