<html>
<body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
        // Retrieve form data
        $subscriptionType = isset($_GET["subscriptionType"]) ? $_GET["subscriptionType"] : "";
        $age = isset($_GET["age"]) ? $_GET["age"] : "";
        $isStudent = isset($_GET["isStudent"]) ? $_GET["isStudent"] : "";

        // Display the bill calculator details
        echo "<h3>Bill Calculator:</h3>";
        echo "<h2>Your selected type of subscription: $subscriptionType</h2><br/>";
        echo "<h2>Your age: $age</h2><br/>";
        echo "<h2>Are you a student?: ";
        echo $isStudent ? "Yes" : "No"; 
        echo "</h2><br/>";
}
?>

</body>
</html>
