<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAÜ Yurt Yönetim Sistemi</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_yurt'])) {
                $yurtadi = $_POST['update_yurtadi'];
                $kontenjan = $_POST['update_kontenjan'];
                $odatipi = $_POST['update_odatipi'];
                $odalani = $_POST['update_odalani'];
                $fiyat = $_POST['update_fiyat'];
                $fiyat2023 = $_POST['update_fiyat2023'];
                $fiyat2022 = $_POST['update_fiyat2022'];
                $fiyat2021 = $_POST['update_fiyat2021'];
                $fiyat2020 = $_POST['update_fiyat2020'];
                $internet = $_POST['update_internet'];
                $mutfak = $_POST['update_mutfak'];
                $kafeterya = $_POST['update_kafeterya'];
                $kampus = $_POST['update_kampus'];

                $updateQuery = "UPDATE yurtlar SET 
                    yurtadi='$yurtadi', 
                    kontenjan='$kontenjan', 
                    odatipi='$odatipi', 
                    odalani='$odalani', 
                    fiyat='$fiyat', 
                    fiyat2023='$fiyat2023', 
                    fiyat2022='$fiyat2022', 
                    fiyat2021='$fiyat2021', 
                    fiyat2020='$fiyat2020', 
                    internet='$internet', 
                    mutfak='$mutfak', 
                    kafeterya='$kafeterya', 
                    kampus='$kampus' 
                    WHERE yurtadi='$yurtadi' AND odatipi='$odatipi'";

                if ($baglanti->query($updateQuery) === TRUE) {
                    echo "<p>Yurt başarıyla güncellendi!</p>";
                } else {
                    echo "<p>Güncelleme sırasında hata oluştu: " . $baglanti->error . "</p>";
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
                    <option value="yok">Yok</option>
                </select>

                <label for="kafeterya">Kafeterya:</label>
                <select id="kafeterya" name="kafeterya" class="filter-input">
                    <option value="">Tümü</option>
                    <option value="var">Var</option>
                    <option value="yok">Yok</option>
                </select>

                <label for="kampus">Kampüs:</label>
                <select id="kampus" name="kampus" class="filter-input">
                    <option value="">Tümü</option>
                    <option value="kuzey">Kuzey</option>
                    <option value="güney">Güney</option>
                </select>

                <button type="submit">Filtrele</button>
            </p>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Yurt Adı</th>
                    <th>Kontenjan</th>
                    <th>Oda Tipi</th>
                    <th>Oda Alanı</th>
                    <th>Fiyat</th>
                    <th>Fiyat 2023</th>
                    <th>Fiyat 2022</th>
                    <th>Fiyat 2021</th>
                    <th>Fiyat 2020</th>
                    <th>İnternet</th>
                    <th>Mutfak</th>
                    <th>Kafeterya</th>
                    <th>Kampüs</th>
                    <th>Düzenle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['yurtadi']}</td>
                                <td>{$row['kontenjan']}</td>
                                <td>{$row['odatipi']}</td>
                                <td>{$row['odalani']}</td>
                                <td>{$row['fiyat']}</td>
                                <td>{$row['fiyat2023']}</td>
                                <td>{$row['fiyat2022']}</td>
                                <td>{$row['fiyat2021']}</td>
                                <td>{$row['fiyat2020']}</td>
                                <td>{$row['internet']}</td>
                                <td>{$row['mutfak']}</td>
                                <td>{$row['kafeterya']}</td>
                                <td>{$row['kampus']}</td>
                                <td><button class='edit-button' data-yurtadi='{$row['yurtadi']}'>Düzenle</button></td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='14'>Sonuç bulunamadı.</td></tr>";
                    }
                    $baglanti->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Yurt Bilgilerini Düzenle</h2>
            <form id="updateForm" method="POST" action="">
                <input type="hidden" id="yurt_id" name="yurt_id">
                <label for="update_yurtadi">Yurt Adı:</label>
                <input type="text" id="update_yurtadi" name="update_yurtadi" required>

                <label for="update_kontenjan">Kontenjan:</label>
                <input type="number" id="update_kontenjan" name="update_kontenjan" required>

                <label for="update_odatipi">Oda Tipi:</label>
                <input type="text" id="update_odatipi" name="update_odatipi" required>

                <label for="update_odalani">Oda Alanı:</label>
                <input type="number" id="update_odalani" name="update_odalani" required>

                <label for="update_fiyat">Fiyat:</label>
                <input type="number" id="update_fiyat" name="update_fiyat" required>

                <label for="update_fiyat2023">Fiyat 2023:</label>
                <input type="number" id="update_fiyat2023" name="update_fiyat2023" required>

                <label for="update_fiyat2022">Fiyat 2022:</label>
                <input type="number" id="update_fiyat2022" name="update_fiyat2022" required>

                <label for="update_fiyat2021">Fiyat 2021:</label>
                <input type="number" id="update_fiyat2021" name="update_fiyat2021" required>

                <label for="update_fiyat2020">Fiyat 2020:</label>
                <input type="number" id="update_fiyat2020" name="update_fiyat2020" required>

                <label for="update_internet">İnternet:</label>
                <input type="text" id="update_internet" name="update_internet" required>

                <label for="update_mutfak">Mutfak:</label>
                <input type="text" id="update_mutfak" name="update_mutfak" required>

                <label for="update_kafeterya">Kafeterya:</label>
                <input type="text" id="update_kafeterya" name="update_kafeterya" required>

                <label for="update_kampus">Kampüs:</label>
                <input type="text" id="update_kampus" name="update_kampus" required>

                <button type="submit" name="update_yurt">Güncelle</button>
            </form>
        </div>
    </div>

    <script>
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        document.querySelectorAll('.edit-button').forEach(button => {
            button.onclick = function() {
                var id = this.getAttribute('data-id');
                fetch(`get_yurt.php?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('yurt_id').value = data.id;
                        document.getElementById('update_yurtadi').value = data.yurtadi;
                        document.getElementById('update_kontenjan').value = data.kontenjan;
                        document.getElementById('update_odatipi').value = data.odatipi;
                        document.getElementById('update_odalani').value = data.odalani;
                        document.getElementById('update_fiyat').value = data.fiyat;
                        document.getElementById('update_fiyat2023').value = data.fiyat2023;
                        document.getElementById('update_fiyat2022').value = data.fiyat2022;
                        document.getElementById('update_fiyat2021').value = data.fiyat2021;
                        document.getElementById('update_fiyat2020').value = data.fiyat2020;
                        document.getElementById('update_internet').value = data.internet;
                        document.getElementById('update_mutfak').value = data.mutfak;
                        document.getElementById('update_kafeterya').value = data.kafeterya;
                        document.getElementById('update_kampus').value = data.kampus;
                    });
                modal.style.display = "block";
            }
        });

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
