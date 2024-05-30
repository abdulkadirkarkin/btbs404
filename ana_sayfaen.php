<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMU Dormitory Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <div class="container">
            <h1>EMU Dormitory Management System</h1>
            <h2 align="right"><?php
                session_start();

                if(isset($_SESSION['isim']) && isset($_SESSION['soyisim']) && isset($_SESSION['ogrno'])) {
                    echo "Welcome: " . $_SESSION['isim'] . " " . $_SESSION['soyisim'] . " " . $_SESSION['ogrno'] . " ";
                }
            ?></h2>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="ana_sayfa.php">Türkçe</a></li
                    <li><a href="yurtaraen.php">Search Dormitory</a></li>
                    <li>
                        <a href="mesajen.php">My Messages
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "btbs404";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection error: " . $conn->connect_error);
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
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <section class="hero">
        <div class="container">
            <h2>Welcome to the EMU Dormitory Management System!</h2>
            <p>Simplify the process of finding suitable dormitories and manage your campus life better.</p>
            <a href="yurtaraen.php" class="btn">Search Dormitory</a>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>Features and Functions</h2>
            <div class="feature">
                <i class="fas fa-user"></i>
                <h3><a href="loginen.html">Student Registration and Login</a></h3>
                <p>Students can create an account and log in to our system.</p>
            </div>
            <div class="feature">
                <i class="fas fa-user"></i>
                <h3><a href="yurtsahiploginen.html">Dormitory Owner Registration and Login</a></h3>
                <p>Dormitory owners can create an account and log in to our system.</p>
            </div>
            <div class="feature">
                <i class="fas fa-search"></i>
                <h3><a href="yurtaraen.php">Search Dormitory</a></h3>
                <p>Search dormitories by location, price, and preferences.</p>
            </div>
            <div class="feature">
                <i class="fas fa-search"></i>
                <h3><a href="yurtkarsilastien.php">Service Comparison</a></h3>
                <p>Students can make informed decisions by comparing services side by side.</p>
            </div>
            <div class="feature">
                <i class="fas fa-search"></i>
                <h3><a href="ogresen.php">Student Matching</a></h3>
                <p>The chat feature will facilitate communication between students who want to share the same room.</p>
            </div>
            <div class="feature">
                <i class="fas fa-search"></i>
                <h3><a href="derecelendiren.php">Rating and Feedback System</a></h3>
                <p>Students can provide ratings and written feedback about the dormitories they have stayed in.</p>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 EMU Dormitory Management System</p>
        </div>
    </footer>
</body>
</html>
