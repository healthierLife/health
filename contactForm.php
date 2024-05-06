<html>
<body>

<?php

// Define a class for personal information
class PersonalInfo {
    private $firstname;
    private $lastname;
    private $email;
    private $phone;
    private $gender;
    private $message;

    // Constructor 
    public function __construct($firstname, $lastname, $email, $phone, $gender, $message) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->gender = $gender;
        $this->message = $message;
    }

    // Getter and setter methods

    public function getFirstName() {
        return $this->firstname;
    }

    public function setFirstName($firstname) {
        $this->firstname = $firstname;
    }

    public function getLastName() {
        return $this->lastname;
    }

    public function setLastName($lastname) {
        $this->lastname = $lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }
}

// Function to display personal information in table format
function displayPersonalInfoTable($personalInfos) {
    echo "<table border='border'>";
    echo "<thead><tr><th>Full Name</th><th>Email</th><th>Phone Number</th><th>Gender</th><th>Message</th></tr></thead>";
    echo "<tbody>";

    foreach ($personalInfos as $info) {
        echo "<tr>";
        echo "<td>{$info->getFirstName()} {$info->getLastName()}</td>";
        echo "<td>{$info->getEmail()}</td>";
        echo "<td>{$info->getPhone()}</td>";
        echo "<td>{$info->getGender()}</td>";
        echo "<td>{$info->getMessage()}</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // Create an array of objects
    $personalInfos = array();

    // Retrieve form data
    $firstname = $_GET["firstname"];
    $lastname = $_GET["lastname"];
    $email = $_GET["email"];
    $phone = $_GET["phone"];
    $gender = $_GET["gender"];
    $message = $_GET["message"];

    // Create a new PersonalInfo object
    $personalInfo = new PersonalInfo($firstname, $lastname, $email, $phone, $gender, $message);

    // Add the object to the array
    $personalInfos[] = $personalInfo;

    // Call the function to display personal information in table format
    displayPersonalInfoTable($personalInfos);
}
?>
</body>
</html>


