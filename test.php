<?php
$conn = new mysqli('localhost', 'root', 'root', 'ajax');

if ($conn->connect_error) {
    die("failed: " . $conn->connect_error);
}
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        $search = $conn->query("SELECT * FROM posts");
        if ($search->num_rows > 0) {
            echo "<div class='table-responsive-sm'><table class='table'>";
            echo "<thead><tr><th>姓名</th><th>Email</th><th>電話</th><th>內容</th></tr></thead>";
            foreach ($search as $key => $data) {
                echo "<tr>".
                    "<td>".$data['name']."</td>".
                    "<td>".$data['email']."</td>".
                    "<td>".$data['phone']."</td>".
                    "<td>".$data['message']."</td>".
                "</tr>";
            }
            echo "</table></div>";
        }
        break;
    case 'POST':
        $sql = "INSERT INTO posts (name, email, phone, message)
        VALUES ('".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["phone"]."', '".$_POST["message"]."')";
        if ($conn->query($sql) === true) {
            echo "sccessfully";
        } else {
            echo $sql . "<br>" . $conn->error;
        }
        $conn->close();
        break;
}
?>