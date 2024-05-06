<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Management</title>
</head>

<style>

        body {background-color: rgb(232, 223, 213); }

        h1 {color: rgb(42, 0, 132);
            text-align: center;
            font-size: 50px;}

        h2 {color: rgb(42, 0, 132);}

    </style>


<body>
    <br><br>
    <h1>Subscription Management</h1>
    <hr/>
    <br>
    
    <!-- Search Form -->
    <!-- Search Form -->
    <h2>Search Subscription</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="search_value">Enter Search Value:</label>
        <input type="text" id="search_value" name="search_value">
        <input type="submit" name="search_submit" value="Search">
    </form>
    <br><hr/><br>

    <!-- Insert Form -->
    <h2>Add Subscription</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id"><br><br>
        <label for="subscription_type">Subscription Type:</label>
        <select id="subscription_type" name="subscription_type">
            <option value="1 Month">1 Month</option>
            <option value="6 Months">6 Months</option>
            <option value="1 Year">1 Year</option>
        </select><br><br>
        <label for="subscription_price">Subscription Price:</label>
        <input type="text" id="subscription_price" name="subscription_price"><br><br>
        <label for="exercise_plan">Exercise Plan:</label>
        <select id="exercise_plan" name="exercise_plan">
            <option value="No Exercise Plan">No Exercise Plan</option>
            <option value="Basic Exercise Plan">Basic Exercise Plan</option>
            <option value="Advanced Exercise Plan">Advanced Exercise Plan</option>
        </select><br><br>
        <label for="diet_plan">Diet Plan:</label>
        <select id="diet_plan" name="diet_plan">
            <option value="No Diet Plan">No Diet Plan</option>
            <option value="Basic Diet Plan">Basic Diet Plan</option>
            <option value="Premium Diet Plan">Premium Diet Plan</option>
        </select><br><br>
        <label for="total_bill">Total Bill:</label>
        <input type="text" id="total_bill" name="total_bill"><br><br>
        <label for="discount_code">Discount Code:</label>
        <input type="text" id="discount_code" name="discount_code"><br><br>
        <input type="submit" name="insert_submit" value="Add Subscription">
    </form>
    <br><hr/><br>

    <!-- Delete Form -->
    <h2>Delete Subscription</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="delete_id">Enter Subscription ID to Delete:</label>
        <input type="text" id="delete_id" name="delete_id">
        <input type="submit" name="delete_submit" value="Delete Subscription">
    </form>
    <br><hr/><br>

    <!-- Update Form -->
    <h2>Update Subscription</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="update_id">Enter Subscription ID to Update:</label>
        <input type="text" id="update_id" name="update_id"><br><br>
        <label for="update_user_id">User ID:</label>
        <input type="text" id="update_user_id" name="update_user_id"><br><br>
        <label for="update_subscription_type">Subscription Type:</label>
        <select id="update_subscription_type" name="update_subscription_type">
            <option value="1 Month">1 Month</option>
            <option value="6 Months">6 Months</option>
            <option value="1 Year">1 Year</option>
        </select><br><br>
        <label for="update_subscription_price">Subscription Price:</label>
        <input type="text" id="update_subscription_price" name="update_subscription_price"><br><br>
        <label for="update_exercise_plan">Exercise Plan:</label>
        <select id="update_exercise_plan" name="update_exercise_plan">
            <option value="No Exercise Plan">No Exercise Plan</option>
            <option value="Basic Exercise Plan">Basic Exercise Plan</option>
            <option value="Advanced Exercise Plan">Advanced Exercise Plan</option>
        </select><br><br>
        <label for="update_diet_plan">Diet Plan:</label>
        <select id="update_diet_plan" name="update_diet_plan">
            <option value="No Diet Plan">No Diet Plan</option>
            <option value="Basic Diet Plan">Basic Diet Plan</option>
            <option value="Premium Diet Plan">Premium Diet Plan</option>
        </select><br><br>
        <label for="update_total_bill">Total Bill:</label>
        <input type="text" id="update_total_bill" name="update_total_bill"><br><br>
        <label for="update_discount_code">Discount Code:</label>
        <input type="text" id="update_discount_code" name="update_discount_code"><br><br>
        <input type="submit" name="update_submit" value="Update Subscription">
    </form>

    <?php
// Database connection
$servername = "localhost";
$dbname = "projectpt4";
$username = "root"; 
$password = ""; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

// Check if the User table exists
$tableExists = $conn->query("SHOW TABLES LIKE 'Subscription'");

// Check if the query returned any rows
if ($tableExists->num_rows == 0) {
    die("Table 'Subscription' doesn't exist in the database.");
} else {
    echo "Subscription table exists<br>";
}

// Function to handle search operation for subscriptions
function searchSubscriptions($conn, $search_value) {
    $sql = "SELECT * FROM `Subscription` WHERE 
            user_id='$search_value' OR 
            subscription_type='$search_value' OR
            total_bill='$search_value'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Search Results:</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Subscription ID</th><th>User ID</th><th>Subscription Type</th><th>Subscription Price</th><th>Exercise Plan</th><th>Diet Plan</th><th>Total Bill</th><th>Discount Code</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"]. "</td>";
            echo "<td>" . $row["user_id"]. "</td>";
            echo "<td>" . $row["subscription_type"]. "</td>";
            echo "<td>$" . $row["subscription_price"]. "</td>";
            echo "<td>" . $row["exercise_plan"]. "</td>";
            echo "<td>" . $row["diet_plan"]. "</td>";
            echo "<td>$" . $row["total_bill"]. "</td>";
            echo "<td>" . ($row["discount_code"] ? $row["discount_code"] : "None") . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No results found";
    }
}


// Function to handle insert operation for subscriptions
function insertSubscription($conn, $user_id, $subscription_type, $subscription_price, $exercise_plan, $diet_plan, $total_bill, $discount_code) {
    $sql = "INSERT INTO Subscription (user_id, subscription_type, subscription_price, exercise_plan, diet_plan, total_bill, discount_code)
            VALUES ('$user_id', '$subscription_type', '$subscription_price', '$exercise_plan', '$diet_plan', '$total_bill', '$discount_code')";

    if ($conn->query($sql) === TRUE) {
        echo "New subscription created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to handle delete operation for subscriptions
function deleteSubscription($conn, $delete_id) {
    $sql = "DELETE FROM Subscription WHERE id='$delete_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to handle update operation for subscriptions
function updateSubscription($conn, $update_id, $update_data) {
    $sql = "UPDATE Subscription SET ";

    // Construct SQL query based on the received update data
    foreach ($update_data as $key => $value) {
        $sql .= "$key='$value', ";
    }

    // Remove the trailing comma and space
    $sql = rtrim($sql, ", ");

    // Add WHERE clause to update specific subscription
    $sql .= " WHERE id='$update_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handling form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['search_submit'])) {
        $search_value = isset($_POST['search_value']) ? $_POST['search_value'] : null;
        searchSubscriptions($conn, $search_value);
    } elseif (isset($_POST['insert_submit'])) {
        $user_id = $_POST['insert_user_id'];
        $subscription_type = $_POST['subscription_type'];
        $subscription_price = $_POST['subscription_price'];
        $exercise_plan = $_POST['exercise_plan'];
        $diet_plan = $_POST['diet_plan'];
        $total_bill = $_POST['total_bill'];
        $discount_code = $_POST['discount_code'];
        insertSubscription($conn, $user_id, $subscription_type, $subscription_price, $exercise_plan, $diet_plan, $total_bill, $discount_code);
    } elseif (isset($_POST['delete_submit'])) {
        $delete_id = $_POST['delete_id'];
        deleteSubscription($conn, $delete_id);
    } elseif (isset($_POST['update_submit'])) {
        $update_id = $_POST['update_id'];
        $update_data = array(
            "user_id" => $_POST['update_user_id'],
            "subscription_type" => $_POST['update_subscription_type'],
            "subscription_price" => $_POST['update_subscription_price'],
            "exercise_plan" => $_POST['update_exercise_plan'],
            "diet_plan" => $_POST['update_diet_plan'],
            "total_bill" => $_POST['update_total_bill'],
            "discount_code" => $_POST['update_discount_code']
        );
        updateSubscription($conn, $update_id, $update_data);
    }
}
?>

</body>
</html>