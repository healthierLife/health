<html>
<body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        // Retrieve form data
        $firstName = $_POST["fname"]; 
        $lastName = $_POST["lname"];
        $fullName = $firstName . " " . $lastName;
        $email = $_POST["email"];
        $gender = $_POST["gender"];
        $age = $_POST["select_age"]; 
        $feedback = $_POST["feedback"]; 
        $check = isset($_POST["check"]) ? $_POST["check"] : "";

        // Display the questionnaire details
        echo "<h3>Questionnaire:</h3>";
        echo "<dt>Your name: </dt><dd>$fullName</dd>";
        echo "<dt>Your email: </dt><dd>$email</dd>";
        echo "<dt>Your gender: </dt><dd>$gender</dd>";
        echo "<dt>Your age: </dt><dd>$age</dd>";
        echo "<dt>Your feedback: </dt><dd>$feedback</dd>";
        echo "<dt>Do you agree that your feedback is voluntary and truthful and may be used for analytical purposes? : </dt>";
        echo $check ? "<dd>Yes" : "<dd>No"; 
        echo "</dd><br/>";
    }
?>

</body>
</html>
