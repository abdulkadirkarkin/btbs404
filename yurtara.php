<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAÜ Yurt Yönetim Sistemi</title>
    <style>
        body {
            background-image: url(//lms23-24spring.emu.edu.tr/pluginfile.php/1/theme_space/loginbg/1714028976/bgound_image.jpg);
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #333333;
        }

        .container form label {
            display: block;
            margin-bottom: 8px;
            color: #333333;
            font-weight: bold;
            text-align: left;
        }

        .container form input[type="text"],
        .container form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 25px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .container form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }

        .container form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #dddddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Doğu Akdeniz Üniversitesi Yurt Yönetim Sistemi</h1>
        <p>Anasayfaya Dön <a href="ana_sayfa.php">Anasayfa</a></p>
        <?php
            session_start();

            if(isset($_SESSION['isim']) && isset($_SESSION['soyisim']) && isset($_SESSION['ogrno'])) {
                echo "Hoşgeldiniz: " . $_SESSION['isim'] . " " . $_SESSION['soyisim'] . " " . $_SESSION['ogrno'] . " ";
            }

            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "btbs404";

            $baglanti = new mysqli($servername, $username, $password, $database);

            if ($baglanti->connect_error) {
                die("Bağlantı hatası: " . $baglanti->connect_error);
            }

            $baglanti->set_charset("utf8");

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['yurtadi'])) {
                $isim = $_SESSION['isim'];
                $soyisim = $_SESSION['soyisim'];
                $ogrno = $_SESSION['ogrno'];
                $yurtadi = $_POST['yurtadi'];
                $odano = rand(1, 30);
                $kayitQuery = "INSERT INTO yurtkayit (ogradi, ogrsoyadi, ogrno, odano, yurtadi) VALUES ('$isim', '$soyisim', '$ogrno', '$odano', '$yurtadi')";

                if ($baglanti->query($kayitQuery) === TRUE) {
                    echo "<p>Kayıt başarıyla tamamlandı!</p>";
                } else {
                    echo "<p>Kayıt sırasında hata oluştu: " . $baglanti->error . "</p>";
                }
            }

            $odaTipi = $_POST['odaTipi'] ?? '';
            $odaAlaniMin = $_POST['odaAlaniMin'] ?? '';
            $odaAlaniMax = $_POST['odaAlaniMax'] ?? '';
            $fiyatMin = $_POST['fiyatMin'] ?? '';
            $fiyatMax = $_POST['fiyatMax'] ?? '';
            $internet = $_POST['internet'] ?? '';
            $mutfak = $_POST['mutfak'] ?? '';
            $kafeterya = $_POST['kafeterya'] ?? '';
            $kampus = $_POST['kampus'] ?? '';

            $query = "SELECT * FROM yurtlar WHERE 1=1";

            if (!empty($odaTipi)) {
                $query .= " AND odatipi='$odaTipi'";
            }
            if (!empty($odaAlaniMin)) {
                $query .= " AND odalani>='$odaAlaniMin'";
            }
            if (!empty($odaAlaniMax)) {
                $query .= " AND odalani<='$odaAlaniMax'";
            }
            if (!empty($fiyatMin)) {
                $query .= " AND fiyat>='$fiyatMin'";
            }
            if (!empty($fiyatMax)) {
                $query .= " AND fiyat<='$fiyatMax'";
            }
            if (!empty($internet)) {
                $query .= " AND internet='$internet'";
            }
            if (!empty($mutfak)) {
                $query .= " AND mutfak='$mutfak'";
            }
            if (!empty($kafeterya)) {
                $query .= " AND kafeterya='$kafeterya'";
            }
            if (!empty($kampus)) {
                $query .= " AND kampus='$kampus'";
            }

            $result = $baglanti->query($query);
        ?>
        <form id="filterForm" method="POST" action="">
            <p>
                <label for="odaTipi">Oda Tipi:</label>
                <select id="odaTipi" name="odaTipi" class="filter-input">
                    <option value="">Tümü</option>
                    <option value="Tek kişilik">Tek kişilik</option>
                    <option value="İki kişilik">İki kişilik</option>
                    <option value="1+1 Suit Oda Çift">1+1 Suit Oda Çift</option>
                </select>

                <label for="odaAlaniMin">Oda Alanı Min (m²):</label>
                <input type="number" id="odaAlaniMin" name="odaAlaniMin" class="filter-input">

                <label for="odaAlaniMax">Oda Alanı Max (m²):</label>
                <input type="number" id="odaAlaniMax" name="odaAlaniMax" class="filter-input">

                <label for="fiyatMin">Akademik Yıl Ücretleri Min (USD):</label>
                <input type="number" id="fiyatMin" name="fiyatMin" class="filter-input">

                <label for="fiyatMax">Akademik Yıl Ücretleri Max (USD):</label>
                <input type="number" id="fiyatMax" name="fiyatMax" class="filter-input">

                <label for="internet">Ücretsiz İnternet Hızı:</label>
                <select id="internet" name="internet" class="filter-input">
                    <option value="">Tümü</option>
                    <option value="sınırsız">Sınırsız</option>
                    <option value="10 mbps">10 mbps</option>
                    <option value="8 mbps">8 mbps</option>
                </select>

                <label for="mutfak">Mutfak:</label>
                <select id="mutfak" name="mutfak" class="filter-input">
                    <option value="">Tümü</option>
                    <option value="katta">Katta</option>
                    <option value="koridor">Koridor</option>
                    <option value="odada">Odada</option>
                </select>

                <label for="kafeterya">Kafeterya:</label>
                <select id="kafeterya" name="kafeterya" class="filter-input">
                    <option value="">Tümü</option>
                    <option value="var">Var</option>
                    <option value="yok">Yok</option>
                </select>

                <label for="kampus">Kampüs Bölgesi:</label>
                <select id="kampus" name="kampus" class="filter-input">
                    <option value="">Tümü</option>
                    <option value="Kuzey">Kuzey</option>
                    <option value="Güney">Güney</option>
                </select>
            </p>
            <button type="submit">Filtrele</button>
        </form>

        <table id="resultsTable">
            <thead>
                <tr>
                    <th>Yurt Adı</th>
                    <th>Kontenjan</th>
                    <th>Oda Tipi</th>
                    <th>Oda Alanı (m²)</th>
                    <th>Akademik Yıl Ücretleri (USD)</th>
                    <th>Ücretsiz İnternet Hızı</th>
                    <th>Mutfak</th>
                    <th>Kafeterya</th>
                    <th>Kampüs Bölgesi</th>
                    <th>Grafik</th>
                    <th>Kayıt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Sabit fiyat verilerini belirleme
                            $prices = [
                                "2020" => $row['fiyat2020'],
                                "2021" => $row['fiyat2021'],
                                "2022" => $row['fiyat2022'],
                                "2023" => $row['fiyat2023'],
                                "2024" => $row['fiyat']
                            ];
                            $priceTrendsJSON = json_encode($prices);

                            echo "<tr>";
                            echo "<td>" . $row['yurtadi'] . "</td>";
                            echo "<td>" . $row['kontenjan'] . "</td>";
                            echo "<td>" . $row['odatipi'] . "</td>";
                            echo "<td>" . $row['odalani'] . "</td>";
                            echo "<td>" . $row['fiyat'] . "</td>";
                            echo "<td>" . $row['internet'] . "</td>";
                            echo "<td>" . $row['mutfak'] . "</td>";
                            echo "<td>" . $row['kafeterya'] . "</td>";
                            echo "<td>" . $row['kampus'] . "</td>";
                            echo "<td><canvas id='chart-" . $row['yurtadi'] . "' width='400' height='200'></canvas></td>";
                            echo "<td><form method='POST' action=''><input type='hidden' name='yurtadi' value='" . $row['yurtadi'] . "'><button type='submit'>Kayıt Ol</button></form></td>";
                            echo "<script>
                                var ctx = document.getElementById('chart-" . $row['yurtadi'] . "').getContext('2d');
                                var chartData = $priceTrendsJSON;
                                new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: Object.keys(chartData),
                                        datasets: [{
                                            label: 'Fiyat Eğilimleri',
                                            data: Object.values(chartData),
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            </script>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>Sonuç bulunamadı</td></tr>";
                    }

                    $baglanti->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
