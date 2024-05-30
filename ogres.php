<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kat Planı</title>
    <link rel="stylesheet" href="styl.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="header">
        <div class="user-info">
		 <a href="ana_sayfa.php">Anasayfaya Dön         </a>
         
		 <?php
            session_start();

            if(isset($_SESSION['isim']) && isset($_SESSION['soyisim']) && isset($_SESSION['ogrno'])) {
                echo " " . $_SESSION['isim'] . " " . $_SESSION['soyisim'] . " " . $_SESSION['ogrno'] . " ";
            } ?></div>
    </div>

    <div class="modal">
        <div class="modal-content">
            <h2>Oda Arkadaşını Seç</h2>

            <form method="POST" action="ogres.php">
              <label for="yurtadi">Yurt Adı</label>
                <select id="yurtadi" name="yurtadi">
                    <option value="Alfam Vista">Alfam Vista</option>
                    <option value="Uğursal">Uğursal</option>
                    <option value="Longson">Longson</option>
                    <option value="Inn Dorm">Inn Dorm</option>
                    <option value="Ramen">Ramen</option>
                    <option value="Prime Living">Prime Living</option>
                    <option value="Golden Plus">Golden Plus</option>
                    <option value="Astra Plus">Astra Plus</option>
                    <option value="Popart">Popart</option>
                    <option value="Novel Centrepoint">Novel Centrepoint</option>
                    <option value="Nural Dorm">Nural Dorm</option>
                    <option value="Grand Aras">Grand Aras</option>
                </select>
                <button type="submit">Sorgula</button>
          </form>
            <div class="status-buttons"></div>
            <h3>Erkek Blok Kat Planları</h3>
            <div class="floor-plan">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $yurtadi = $_POST['yurtadi'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "btbs404";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        $sql = "SELECT odano FROM yurtkayit WHERE yurtadi = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $yurtadi);
        $stmt->execute();
        $result = $stmt->get_result();

        $rooms = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rooms[] = $row['odano'];
            }

            $uniqueRooms = array_unique($rooms);

            echo "<div class='rooms'>";
            foreach ($uniqueRooms as $room) {
                echo "<div class='room' data-odano='" . $room . "'>" . $room . "</div>";
            }
            echo "</div>";
        } else {
            echo "Sonuç bulunamadı";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</div>

      </div>
    </div>

    <div id="studentModal" class="student-modal">
        <div class="student-modal-content">
            <span class="close">&times;</span>
            <h2>Oda No: <span id="odaNo"></span></h2>
            <div id="studentList">
                <!-- Öğrenci bilgileri buraya gelecek -->
            </div>
            <form id="messageForm">
                <label for="message">Mesaj:</label>
                <textarea id="message" name="message" required></textarea>
                <input type="hidden" id="gondogradi" name="gondogradi" value="<?php echo $_SESSION['isim']; ?>">
                <input type="hidden" id="gondogrsoyadi" name="gondogrsoyadi" value="<?php echo $_SESSION['soyisim']; ?>">
                <input type="hidden" id="gondogrno" name="gondogrno" value="<?php echo $_SESSION['ogrno']; ?>">
                <input type="hidden" id="aliciogrno" name="aliciogrno">
                <button type="submit">Mesajı Gönder</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.room').click(function() {
                var odano = $(this).data('odano');
                $.ajax({
                    url: 'getStudents.php',
                    method: 'POST',
                    data: { odano: odano },
                    success: function(response) {
                        $('#odaNo').text(odano);
                        $('#studentList').html(response);
                        $('#studentModal').show();
                    }
                });
            });

            $('.close').click(function() {
                $('#studentModal').hide();
            });

            $('#studentList').on('click', '.send-message', function() {
                var aliciogrno = $(this).data('ogrno');
                $('#aliciogrno').val(aliciogrno);
            });

            $('#messageForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'sendMessage.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Mesaj gönderildi.');
                        $('#studentModal').hide();
                    }
                });
            });
        });
    </script>
</body>
</html>
