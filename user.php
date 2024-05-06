<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>

    <style>

        body {background-color: rgb(232, 223, 213); }

        h1 {color: rgb(49, 89, 0);
            text-align: center;
            font-size: 50px;}

        h2 {color: rgb(49, 89, 0);}

    </style>

</head>
<body>
    <br><br>
    <h1 style="color: ">User Management</h1>
    <hr/>
    <br>
    
    
    <!-- Search Form -->
    <h2>Search User</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="search_query">Search:</label>
        <input type="text" id="search_query" name="search_query">
        <input type="submit" name="search_submit" value="Search">
    </form>
    <br><hr/><br>

    <!-- Insert Form -->
    <h2>Add User</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name"><br><br>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name"><br><br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br><br>
        <label for="age">Age:</label>
        <input type="text" id="age" name="age"><br><br>
        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender"><br><br>
        <label for="is_student">Is Student:</label>
        <input type="text" id="is_student" name="is_student"><br><br>
        <label for="height">Height:</label>
        <input type="text" id="height" name="height"><br><br>
        <label for="weight">Weight:</label>
        <input type="text" id="weight" name="weight"><br><br>
        <input type="submit" name="insert_submit" value="Add User">
    </form>
    <br><hr/><br>

    <!-- Delete Form -->
    <h2>Delete User</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="delete_name">Enter First Name to Delete:</label>
        <input type="text" id="delete_name" name="delete_name">
        <input type="submit" name="delete_submit" value="Delete">
    </form>
    <br><hr/><br>

    <!-- Update Form -->
    <!-- Update Form -->
<h2>Update User</h2>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="update_name">Enter First Name to Update:</label>
    <input type="text" id="update_name" name="update_name"><br><br>
    <label for="new_email">New Email:</label>
    <input type="text" id="new_email" name="new_email"><br><br>
    <label for="new_age">New Age:</label>
    <input type="text" id="new_age" name="new_age"><br><br>
    <label for="new_gender">New Gender:</label>
    <input type="text" id="new_gender" name="new_gender"><br><br>
    <label for="new_is_student">Is Student:</label>
    <input type="text" id="new_is_student" name="new_is_student"><br><br>
    <label for="new_height">New Height:</label>
    <input type="text" id="new_height" name="new_height"><br><br>
    <label for="new_weight">New Weight:</label>
    <input type="text" id="new_weight" name="new_weight"><br><br>
    <input type="submit" name="update_submit" value="Update">
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
    $tableExists = $conn->query("SHOW TABLES LIKE 'User'");

    // Check if the query returned any rows
    if ($tableExists->num_rows == 0) {
        die("Table 'User' doesn't exist in the database.");
    } else {
        echo "User table exists<br>";
    }

// Function to handle search operation and display results as a table
function searchUsers($conn, $search_query) {
    // Construct SQL query to search across multiple columns
    $sql = "SELECT * FROM `User` WHERE 
        first_name LIKE '%$search_query%' OR
        last_name LIKE '%$search_query%' OR
        email LIKE '%$search_query%' OR
        age LIKE '%$search_query%' OR
        gender LIKE '%$search_query%' OR
        is_student LIKE '%$search_query%' OR
        height LIKE '%$search_query%' OR
        weight LIKE '%$search_query%'";


    $result = $conn->query($sql);

    // Display search results as a table
    if ($result->num_rows > 0) {
        echo "<h3>Search Results:</h3>";
        echo "<table border='1'>";
        echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Age</th><th>Gender</th><th>Is Student</th><th>Height</th><th>Weight</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["first_name"]. "</td>";
            echo "<td>" . $row["last_name"]. "</td>";
            echo "<td>" . $row["email"]. "</td>";
            echo "<td>" . $row["age"]. "</td>";
            echo "<td>" . $row["gender"]. "</td>";
            echo "<td>" . ($row["is_student"] ? 'Yes' : 'No') . "</td>";
            echo "<td>" . $row["height"]. "</td>";
            echo "<td>" . $row["weight"]. "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No results found";
    }
}

    // Function to handle insert operation
    function insertUser($conn, $first_name, $last_name, $email, $age, $gender, $is_student, $height, $weight) {
        $sql = "INSERT INTO User (first_name, last_name, email, age, gender, is_student, height, weight)
        VALUES ('$first_name', '$last_name', '$email', '$age', '$gender', '$is_student', '$height', '$weight')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Function to handle delete operation
    function deleteUser($conn, $delete_name) {
        $sql = "DELETE FROM User WHERE first_name='$delete_name'";

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Function to handle update operation
    function updateUser($conn, $update_name, $new_email, $new_age, $new_gender, $new_is_student, $new_height, $new_weight) {
        $sql = "UPDATE User SET 
            email = '$new_email',
            age = '$new_age',
            gender = '$new_gender',
            is_student = '$new_is_student',
            height = '$new_height',
            weight = '$new_weight'
            WHERE first_name='$update_name'";
    
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    // Handling form submissions
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['search_submit'])) {
            $search_query = $_POST['search_query'];
            // Call the search function when search form is submitted
            searchUsers($conn, $search_query);
        }
    elseif (isset($_POST['insert_submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $is_student = $_POST['is_student'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        insertUser($conn, $first_name, $last_name, $email, $age, $gender, $is_student, $height, $weight);
    } 
    elseif (isset($_POST['delete_submit'])) {
        $delete_name = $_POST['delete_name'];
        deleteUser($conn, $delete_name);
    } 
    elseif (isset($_POST['update_submit'])) {
        $update_name = $_POST['update_name'];
        $new_email = $_POST['new_email'];
        $new_age = $_POST['new_age'];
        $new_gender = $_POST['new_gender'];
        $new_is_student = $_POST['new_is_student'];
        $new_height = $_POST['new_height'];
        $new_weight = $_POST['new_weight'];
        updateUser($conn, $update_name, $new_email, $new_age, $new_gender, $new_is_student, $new_height, $new_weight);
    }
}

    ?>

</body>
</html>

   