<?php
// Include User and UsersList classes
class User {
    private $id;
    private $email;
    private $password;
    private $createdAt;

    public function __construct($id, $email, $password, $createdAt) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function displayUser() {
        echo "<tr>";
        echo "<td>" . $this->id . "</td>";
        echo "<td>" . $this->email . "</td>";
        echo "<td>" . $this->createdAt . "</td>";
        echo "<td class='action-icons'>
                <i class='fas fa-trash-alt' onclick='showDeletePopup(" . $this->id . ")'></i>
              </td>";
        echo "</tr>";
    }
}

class UsersList {
    private $users = [];

    public function addUser(User $user) {
        $this->users[] = $user;
    }

    public function displayUsers() {
        foreach ($this->users as $user) {
            $user->displayUser();
        }   
    }
}

// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$database = "tc_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch users
$sql = "SELECT id, email, password, created_at FROM users";
$result = $conn->query($sql);

// Instantiate UsersList object
$usersList = new UsersList();

// Check if users were found
if ($result->num_rows > 0) {
    // Loop through each row in the result set
    while ($row = $result->fetch_assoc()) {
        // Create a User object for each row and add it to the UsersList
        $user = new User($row['id'], $row['email'], $row['password'], $row['created_at']);
        $usersList->addUser($user);
    }
} else {
    echo "No users found";
}

// Close database connection
$conn->close();
?>
