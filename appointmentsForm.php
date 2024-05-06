<html>
    <body>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            
            // Retrieve form data
            $name = $_GET["name"];
            $gender = $_GET["gender"];
            $age = $_GET["age"];
            $governorate = $_GET["governorate"];
            $reason = $_GET["reason"];
            $month = $_GET["month"];
            $day = $_GET["day"];
            $choice = $_GET["choice"];
            $email = $_GET["email"];
            $number = $_GET["number"];

            // Display the appointment booking details
            echo "<h3>Appointment Booking Details: </h3>";
            echo "<table border='1'>";
            echo "<tr><th>Name:</th><td>$name</td></tr>";
            echo "<tr><th>Age:</th><td>$age</td></tr>";
            echo "<tr><th>Gender:</th><td>$gender</td></tr>";
            echo "<tr><th>Email:</th><td>$email</td></tr>";
            echo "<tr><th>Phone Number:</th><td>$number</td></tr>";
            echo "<tr><th>Governorate:</th><td>$governorate</td></tr>";
            echo "<tr><th>Preferred Date:</th><td>$month $day</td></tr>";
            echo "<tr><th>Reason for Appointment:</th><td>$reason</td></tr>";
            echo "<tr><th>Online Consultation Preference:</th><td>$choice</td></tr>";
            echo "</table>";
}
?>








    </body>
</html>