
<?php
$username = $_POST['username'];
$email= $_POST['email'];
$phone = $_POST['phone'];
$room_type = $_POST['room_type'];
$no of rooms = $_POST['no of rooms'];
$no of guest = $_POST['no of guest'];
$date = $_POST['date'];
if (!empty($username) || !empty($email) || !empty($phone_number) || !empty($room_type) || !empty($no of rooms) || !empty($no of guest)|| !empty($date)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "two";
     //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into Booking (username,email,phone_number,room_type,no of rooms,no of guest,dates) values(?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $username, $email, $phone_number, $room_type, $no of rooms, $no of guest, $dates);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>