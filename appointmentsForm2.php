<html>
    <body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        // Retrieve form data
        $email = $_GET["email"];
        $number = $_GET["number"];

        // Display the appointment cancellation details
        echo "<h3>Appointment Cancellation Details: </h3>";
        echo"<ul>";
        echo "<li>Email: $email</li><br/>";
        echo "<li>Phone Number: $number</li>";
        echo"</ul>";
}
?>

    </body>
</html>