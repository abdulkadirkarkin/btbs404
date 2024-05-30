<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="s1.css">
</head>
<body>
    <div class="header">
    </div>
    <div class="tabs">
        <button class="tablink" onclick="openTab(event, 'Mesajlarim')">My Messages</button>
        <button class="tablink" onclick="openTab(event, 'anasayfa')"><a href="ana_sayfaen.php">Home Page</a></button>
    </div>
    <div id="Mesajlarim" class="tabcontent">
        <?php
            session_start();

            if(isset($_SESSION['isim']) && isset($_SESSION['soyisim']) && isset($_SESSION['ogrno'])) {
                echo "Welcome: " . $_SESSION['isim'] . " " . $_SESSION['soyisim'] . " " . $_SESSION['ogrno'] . " ";
            }

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "btbs404";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Bağlantı hatası: " . $conn->connect_error);
            }

            $ogrno = $_SESSION['ogrno'];

            $sql = "SELECT gondogrno, gondogradi, gondogrsoyadi, aliciogrno, mesaj FROM mesaj WHERE aliciogrno='$ogrno'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='message'>";
                    echo "<img src='default-avatar.png' alt='Avatar' class='avatar'>";
                    echo "<div class='message-text'>";
                    echo "<strong>" . $row["gondogradi"] . " " . $row["gondogrsoyadi"] . "</strong><br>";
                    echo $row["mesaj"];
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "0 sonuç";
            }
            $conn->close();
        ?>
    </div>
    <div id="Mesajlar" class="tabcontent">
    </div>
    
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        
        document.getElementsByClassName('tablink')[0].click();
    </script>
</body>
</html>
