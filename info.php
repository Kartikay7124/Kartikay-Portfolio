<?php

if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $message = $_POST['message'];

   $host = 'localhost';
   $user = 'root';
   $pass = '';
   $dbname = 'portfolio';

    // Create connection
   $conn = new mysqli($host, $user, $pass, $dbname);

    // Check connection
   if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
   }

    // Use prepared statements to prevent SQL injection
   $stmt = $conn->prepare("INSERT INTO registration (name, email, message) VALUES (?, ?, ?)");
   if ($stmt) {
   $stmt->bind_param("sss", $name, $email, $message);

        // Execute the statement
      if ($stmt->execute()) {
            echo "Message Sent Successfully";
      } else {
            echo "Error: " . $stmt->error;
      }

        // Close the statement
      $stmt->close();
   } else {
      echo "Error preparing statement: " . $conn->error;
   }

    // Close the connection
   $conn->close();
}
?>


