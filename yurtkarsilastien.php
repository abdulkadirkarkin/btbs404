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
                  <option value="">Select</option>
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
            <div class="image-gallery" id="image-gallery1">Picture Gallery</div>
            <div class="info" id="info1">
                <p>Wifi in Room: <span id="wifi1">Pulled from the database</span></p>
                <p>Air Conditioning in the Dormitory: <span id="klima1">Pulled from the database</span></p>
                <p>Number of Baths: <span id="banyo1">Pulled from the database</span></p>
                <p>Number of Beds: <span id="yatak1">Pulled from the database</span></p>
                <p>Room with Balcony: <span id="balkon1">Pulled from the database</span></p>
                <p>Television in the Room: <span id="televizyon1">Pulled from the database</span></p>
                <p>Personal Locker: <span id="dolap1">Pulled from the database</span></p>
                <p>Phone in Room: <span id="telefon1">Pulled from the database</span></p>
            </div>
      </div>
        <div class="comparison-box">
          <p class="select-container">
              <select name="yurt-select2" id="yurt-select2" onchange="fetchDetails(2)">
                    <option value="">Select</option>
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
            <div class="image-gallery" id="image-gallery2">Picture Gallery</div>
            <div class="info" id="info2">
                <p>Wifi in Room<span id="wifi2">Pulled from the database</span></p>
                <p>Air Conditioning in the Dormitory: <span id="klima2">Pulled from the database</span></p>
                <p>Number of Baths <span id="banyo2">Pulled from the database</span></p>
                <p>Number of Beds:  <span id="yatak2">Pulled from the database</span></p>
                <p>Room with Balcony: <span id="balkon2">Pulled from the database</span></p>
                <p>Television in the Room: <span id="televizyon2">Pulled from the database</span></p>
                <p>Personal Locker: <span id="dolap2">Pulled from the database</span></p>
                <p>Phone in Room: <span id="telefon2">Pulled from the database</span></p>
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
