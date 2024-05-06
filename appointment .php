<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Management</title>

    <style>

        body {background-color: rgb(232, 223, 213); }

        h1 {color: rgb(89, 0, 85);
            text-align: center;
            font-size: 50px;}

        h2 {color: rgb(89, 0, 85);}

    </style>

</head>
<body>
    <br><br>
    <h1>Appointment Management</h1>
    <hr/>
    <br>
    
    <!-- Search Form -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="search_query">Search Appointment:</label>
        <input type="text" id="search_query" name="search_query">
        <input type="submit" name="search_submit" value="Search">
    </form>

    <!-- Insert Form -->
    <h2>Add Appointment</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>u6
        </select><br><br>
        <label for="governorate">Governorate:</label>
        <input type="text" id="governorate" name="governorate"><br><br>
        <label for="reason">Reason:</label>
        <input type="text" id="reason" name="reason"><br><br>
        <label for="appointment_date">Appointment Date:</label>
        <input type="date" id="appointment_date" name="appointment_date"><br><br>
        <label for="is_online">Is Online:</label>
        <select id="is_online" name="is_online">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select><br><br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br><br>
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number"><br><br>
        <input type="submit" name="insert_submit" value="Add Appointment">
    </form>

    <!-- Delete Form -->
    <h2>Delete Appointment</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="delete_id">Enter Appointment ID to Delete:</label>
        <input type="text" id="delete_id" name="delete_id">
        <input type="submit" name="delete_submit" value="Delete Appointment">
    </form>

    <!-- Update Form -->
    <h2>Update Appointment</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="update_id">Enter Appointment ID to Update:</label>
        <input type="text" id="update_id" name="update_id"><br><br>
        <label for="update_name">Name:</label>
        <input type="text" id="update_name" name="update_name"><br><br>
        <label for="update_gender">Gender:</label>
        <select id="update_gender" name="update_gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>
        <label for="update_governorate">Governorate:</label>
        <input type="text" id="update_governorate" name="update_governorate"><br><br>
        <label for="update_reason">Reason:</label>
        <input type="text" id="update_reason" name="update_reason"><br><br>
        <label for="update_appointment_date">Appointment Date:</label>
        <input type="date" id="update_appointment_date" name="update_appointment_date"><br><br>
        <label for="update_is_online">Is Online:</label>
        <select id="update_is_online" name="update_is_online">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select><br><br>
        <label for="update_email">Email:</label>
        <input type="text" id="update_email" name="update_email"><br><br>
        <label for="update_phone_number">Phone Number:</label>
        <input type="text" id="update_phone_number" name="update_phone_number"><br><br>
        <input type="submit" name="update_submit" value="Update Appointment">
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
$tableExists = $conn->query("SHOW TABLES LIKE 'Appointment'");

// Check if the query returned any rows
if ($tableExists->num_rows == 0) {
    die("Table 'Appointment' doesn't exist in the database.");
} else {
    echo "Appointment table exists<br>";
}

// Function to handle search operation for appointments
function searchAppointments($conn, $search_query) {
    $search_query = $conn->real_escape_string($search_query);
    $sql = "SELECT * FROM `Appointment` WHERE 
        id='$search_query' OR
        name LIKE '%$search_query%' OR
        email LIKE '%$search_query%' OR
        phone_number LIKE '%$search_query%'";

    $result = $conn->query($sql);

    // Display search results as a table
    if ($result->num_rows > 0) {
        echo "<h3>Search Results:</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Gender</th><th>Governorate</th><th>Reason</th><th>Appointment Date</th><th>Is Online</th><th>Email</th><th>Phone Number</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["name"]). "</td>";
            echo "<td>" . htmlspecialchars($row["gender"]). "</td>";
            echo "<td>" . htmlspecialchars($row["governorate"]). "</td>";
            echo "<td>" . htmlspecialchars($row["reason"]). "</td>";
            echo "<td>" . htmlspecialchars($row["appointment_date"]). "</td>";
            echo "<td>" . ($row["is_online"] ? 'Yes' : 'No') . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]). "</td>";
            echo "<td>" . htmlspecialchars($row["phone_number"]). "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No results found";
    }
}

// Function to handle insert operation for appointments
function insertAppointment($conn, $name, $gender, $governorate, $reason, $appointment_date, $is_online, $email, $phone_number) {
    $stmt = $conn->prepare("INSERT INTO Appointment (name, gender, governorate, reason, appointment_date, is_online, email, phone_number)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $gender, $governorate, $reason, $appointment_date, $is_online, $email, $phone_number);

    if ($stmt->execute()) {
        echo "New appointment created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Function to handle delete operation for appointments
function deleteAppointment($conn, $delete_id) {
    $stmt = $conn->prepare("DELETE FROM Appointment WHERE id=?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Function to handle update operation for appointments
function updateAppointment($conn, $update_id, $update_data) {
    $update_query = "UPDATE Appointment SET ";
    $params = array();

    foreach ($update_data as $key => $value) {
        $update_query .= "$key=?, ";
        $params[] = &$update_data[$key];
    }

    // Remove the trailing comma and space
    $update_query = rtrim($update_query, ", ");
    $update_query .= " WHERE id=?";

    // Append the update_id to the parameters array
    $params[] = &$update_id;

    $stmt = $conn->prepare($update_query);
    $types = str_repeat("s", count($params)); // Assuming all fields are strings
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Handling form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['search_submit'])) {
        $search_query = $_POST['search_query'];
        searchAppointments($conn, $search_query);
    } 
    elseif (isset($_POST['insert_submit'])) {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $governorate = $_POST['governorate'];
        $reason = $_POST['reason'];
        $appointment_date = $_POST['appointment_date'];
        $is_online = $_POST['is_online'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];

        // Sanitize inputs
        $name = htmlspecialchars($name);
        $gender = htmlspecialchars($gender);
        $governorate = htmlspecialchars($governorate);
        $reason = htmlspecialchars($reason);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $phone_number = filter_var($phone_number, FILTER_SANITIZE_NUMBER_INT);

        insertAppointment($conn, $name, $gender, $governorate, $reason, $appointment_date, $is_online, $email, $phone_number);
    }
    elseif (isset($_POST['delete_submit'])) {
        $delete_id = $_POST['delete_id'];

        // Sanitize input
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_NUMBER_INT);

        deleteAppointment($conn, $delete_id);
    }
    elseif (isset($_POST['update_submit'])) {
        $update_id = $_POST['update_id'];
        $update_name = $_POST['update_name'];
        $update_gender = $_POST['update_gender'];
        $update_governorate = $_POST['update_governorate'];
        $update_reason = $_POST['update_reason'];
        $update_appointment_date = $_POST['update_appointment_date'];
        $update_is_online = $_POST['update_is_online'];
        $update_email = $_POST['update_email'];
        $update_phone_number = $_POST['update_phone_number'];

        // Sanitize inputs
        $update_id = filter_var($update_id, FILTER_SANITIZE_NUMBER_INT);
        $update_name = htmlspecialchars($update_name);
        $update_gender = htmlspecialchars($update_gender);
        $update_governorate = htmlspecialchars($update_governorate);
        $update_reason = htmlspecialchars($update_reason);
        $update_email = filter_var($update_email, FILTER_SANITIZE_EMAIL);
        $update_phone_number = filter_var($update_phone_number, FILTER_SANITIZE_NUMBER_INT);

        $update_data = array(
            "name" => $update_name,
            "gender" => $update_gender,
            "governorate" => $update_governorate,
            "reason" => $update_reason,
            "appointment_date" => $update_appointment_date,
            "is_online" => $update_is_online,
            "email" => $update_email,
            "phone_number" => $update_phone_number
        );
        updateAppointment($conn, $update_id, $update_data);
    }
}
?>

</body>
</html>