<html>
<body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
        // Retrieve form data
        $height = $_GET["height"]; 
        $weight = $_GET["weight"];
        $exercisePlan = $_GET["exercise"]; 
        $dietPlan = $_GET["diet"]; 

        // Display the bill calculator details
        echo "<h3>Health & Fitness Plan:</h3>";
        echo"<ol>";
        echo "<li>Your height: $height</li><br/>";
        echo "<li>Your weight: $weight</li><br/>";
        echo "<li>Your Exercise Plan: $exercisePlan</li><br/>";
        echo "<li>Your Diet Plan: $dietPlan</li><br/>";
        echo"</ol>";
    }
?>

</body>
</html>
