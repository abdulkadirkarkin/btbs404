<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Yurt Derecelendirme Sistemi</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }
    .rating input {
        display: none;
    }
    .rating label {
        cursor: pointer;
        color: #ffa500;
        font-size: 30px;
    }
    .rating label:hover,
    .rating label:hover ~ label {
        color: #ffdb58;
    }
    .rating input:checked ~ label {
        color: #ffdb58;
    }
    textarea {
        width: 100%;
        height: 100px;
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .question {
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 15px;
        text-align: left;
    }
</style>
</head>
<body>
    <h1>Eastern Mediterranean University Dormitory Management System Evaluation and Feedback Survey</h1>
        <h2><a href="ana_sayfaen.php">Return to Home Page</a></h2>
        <h2>Ratings and Comments</h2>



    <?php
    session_start();
    if(isset($_SESSION['isim']) && isset($_SESSION['soyisim']) && isset($_SESSION['ogrno'])) {
        echo "Hoşgeldiniz: " . $_SESSION['isim'] . " " . $_SESSION['soyisim'] . " " . $_SESSION['ogrno'] . " ";
    } else {
        
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "btbs404";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rating = isset($_POST['rating']) ? $_POST['rating'] : null;
        $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
        $isim = $_SESSION['isim'];
        $soyisim = $_SESSION['soyisim'];

        if ($rating !== null) {
            $sql = "INSERT INTO derece (isim, soyisim, rating, yorum) VALUES ('$isim', '$soyisim', '$rating', '$comment')";

            if ($conn->query($sql) === TRUE) {
                echo "";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Lütfen bir derecelendirme seçin.";
        }
    }

    $sql = "SELECT * FROM derece";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>İsim</th><th>Soyisim</th><th>Rating</th><th>Yorum</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["isim"]. "</td><td>" . $row["soyisim"]. "</td><td>" . $row["rating"]. "</td><td>" . $row["yorum"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 sonuc";
    }

    $conn->close();
    ?>
    <form action="" method="POST">
        <div class="question">
            <h3>Did You Like the Interface of Our Website?</h3>
            <div class="rating">
                <input type="radio" id="ui-star5" name="rating" value="5">
                <label for="ui-star5"><i class="fas fa-star"></i></label>
                <input type="radio" id="ui-star4" name="rating" value="4">
                <label for="ui-star4"><i class="fas fa-star"></i></label>
                <input type="radio" id="ui-star3" name="rating" value="3">
                <label for="ui-star3"><i class="fas fa-star"></i></label>
                <input type="radio" id="ui-star2" name="rating" value="2">
                <label for="ui-star2"><i class="fas fa-star"></i></label>
                <input type="radio" id="ui-star1" name="rating" value="1">
                <label for="ui-star1"><i class="fas fa-star"></i></label>
            </div>
        </div>
        <textarea name="comment" placeholder="Yorumunuzu buraya yazabilirsiniz..."></textarea>
        <button type="submit">Send</button>
    </form>
    <h2>&nbsp;</h2>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
