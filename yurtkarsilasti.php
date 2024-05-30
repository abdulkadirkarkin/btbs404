<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yurt Karşılaştırma Sayfası</title>
    <link rel="stylesheet" href="style.css">
    <style type="text/css">
    .details-container {
        width: 50%;
        padding: 20px;
    }
    .select-container {
        width: 50%;
        padding: 20px;
    }
    .comparison-box {
        margin-bottom: 20px;
    }
    .image-gallery img {
        max-width: 100%;
        height: auto;
    }
    </style>
</head>
<body>

    <div class="container">
        <div class="comparison-box">
          <p class="select-container">
            <select name="yurt-select" id="yurt-select" onchange="fetchDetails(1)">
                  <option value="">Seçiniz</option>
                  <?php
                        // Veritabanına bağlanma
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "btbs404";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Bağlantı hatası: " . $conn->connect_error);
                        }

                        $sql = "SELECT yurtadi FROM yurtkars";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["yurtadi"] . "'>" . $row["yurtadi"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Yurt bulunamadı</option>";
                        }

                        $conn->close();
                    ?>
            </select>
          </p>
            <div class="image-gallery" id="image-gallery1">Resim Galerisi</div>
            <div class="info" id="info1">
                <p>Yurtta Wifi: <span id="wifi1">Veritabanından çekiliyor</span></p>
                <p>Yurtta Klima: <span id="klima1">Veritabanından çekiliyor</span></p>
                <p>Banyo Sayısı: <span id="banyo1">Veritabanından çekiliyor</span></p>
                <p>Yatak Sayısı: <span id="yatak1">Veritabanından çekiliyor</span></p>
                <p>Balkonlu Oda: <span id="balkon1">Veritabanından çekiliyor</span></p>
                <p>Odada Televizyon: <span id="televizyon1">Veritabanından çekiliyor</span></p>
                <p>Kişisel Dolap: <span id="dolap1">Veritabanından çekiliyor</span></p>
                <p>Odada Telefon: <span id="telefon1">Veritabanından çekiliyor</span></p>
            </div>
      </div>
        <div class="comparison-box">
          <p class="select-container">
              <select name="yurt-select2" id="yurt-select2" onchange="fetchDetails(2)">
                    <option value="">Seçiniz</option>
                    <?php
                        // Veritabanına bağlanma
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "btbs404";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Bağlantı hatası: " . $conn->connect_error);
                        }

                        $sql = "SELECT yurtadi FROM yurtkars";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["yurtadi"] . "'>" . $row["yurtadi"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Yurt bulunamadı</option>";
                        }

                        $conn->close();
                    ?>
            </select>
          </p>
            <div class="image-gallery" id="image-gallery2">Resim Galerisi</div>
            <div class="info" id="info2">
                <p>Yurtta Wifi: <span id="wifi2">Veritabanından çekiliyor</span></p>
                <p>Yurtta Klima: <span id="klima2">Veritabanından çekiliyor</span></p>
                <p>Banyo Sayısı: <span id="banyo2">Veritabanından çekiliyor</span></p>
                <p>Yatak Sayısı: <span id="yatak2">Veritabanından çekiliyor</span></p>
                <p>Balkonlu Oda: <span id="balkon2">Veritabanından çekiliyor</span></p>
                <p>Odada Televizyon: <span id="televizyon2">Veritabanından çekiliyor</span></p>
                <p>Kişisel Dolap: <span id="dolap2">Veritabanından çekiliyor</span></p>
                <p>Odada Telefon: <span id="telefon2">Veritabanından çekiliyor</span></p>
            </div>
        </div>
    </div>

    <script>
        function fetchDetails(selectNumber) {
            const yurtName = document.getElementById(`yurt-select${selectNumber === 1 ? '' : '2'}`).value;

            if (yurtName === '') return;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_details.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    document.getElementById(`wifi${selectNumber}`).innerText = response.wifi;
                    document.getElementById(`klima${selectNumber}`).innerText = response.klima;
                    document.getElementById(`banyo${selectNumber}`).innerText = response.banyo;
                    document.getElementById(`yatak${selectNumber}`).innerText = response.yatak;
                    document.getElementById(`balkon${selectNumber}`).innerText = response.balkon;
                    document.getElementById(`televizyon${selectNumber}`).innerText = response.televizyon;
                    document.getElementById(`dolap${selectNumber}`).innerText = response.dolap;
                    document.getElementById(`telefon${selectNumber}`).innerText = response.telefon;
                    document.getElementById(`image-gallery${selectNumber}`).innerHTML = `<img src="${response.resim_url}" alt="Yurt Resmi">`;
                }
            };
            xhr.send(`yurtadi=${yurtName}`);
        }
    </script>
    
</body>
</html>
