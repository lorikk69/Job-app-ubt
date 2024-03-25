<?php


class Contact {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function submitForm($name, $email, $message) {
        $name = $this->conn->real_escape_string($name);
        $email = $this->conn->real_escape_string($email);
        $message = $this->conn->real_escape_string($message);

        $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "tc_db"; 

$contact = new Contact($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $result = $contact->submitForm($name, $email, $message);

    if ($result === true) {
        echo "<script>alert('Message sent successfully!');</script>";
    } else {
        echo "<script>alert('Error: $result');</script>";
    }

    $contact->closeConnection();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
    <link rel="stylesheet" type="text/css" href="Contact.css">
</head>
<body>

<div class="container">
    <h2>Contact Form</h2>
    <form id="contactForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>

        <input type="submit" name="submit" value="Submit">
    </form>
</div>

<script>
document.getElementById("contactForm").addEventListener("submit", function(event) {
    const email = document.getElementById("email").value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
        alert("Shkruaj nje email valide.");
        event.preventDefault(); 
    }
});
</script>

</body>
</html>
