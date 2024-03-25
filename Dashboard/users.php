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

$servername = "localhost";
$username = "root";
$password = "";
$database = "tc_db"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, email, password, created_at FROM users";
$result = $conn->query($sql);

$usersList = new UsersList();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user = new User($row['id'], $row['email'], $row['password'], $row['created_at']);
        $usersList->addUser($user);
    }
} else {
    echo "No users found";
}

$conn->close();
?>
