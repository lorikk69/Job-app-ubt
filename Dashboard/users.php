<?php

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

?>
