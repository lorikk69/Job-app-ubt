<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    $_SESSION['admin_logged_in'] = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css"> <!-- Include external CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Include Font Awesome -->
</head>

<body>
    <?php
    // Include users.php to use the $usersList variable
    include 'users.php';

    if ($_SESSION['admin_logged_in'] == true) { 
    ?>
        <main>
            <div class="sidebar">
                <div class="sidebar-icons">
                    <a href="#users">
                        <i class="fas fa-users"></i> Users
                    </a>
                    <a href="#jobs">
                        <i class="fas fa-briefcase"></i> Job Listings
                    </a>
                </div>
                <!-- You can add additional sidebar content here -->
            </div>

            <div class="main-content">
                <div id="users" class="user-list">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $usersList->displayUsers(); ?> <!-- Display users here -->
                        </tbody>
                    </table>
                </div>
                <!-- <div id="jobs">
                */qitu duhet mi shkru masnej < ? php include 'jobs.php'; ?>*/
                </div>
            </div>
        </main>

        <!-- Popup for deleting users -->
        <div id="deletePopup" class="delete-popup">
            <div class="delete-popup-content">
                <p>Are you sure you want to delete this user?</p>
                <div class="delete-popup-buttons">
                    <button onclick="cancelDelete()">Cancel</button>
                    <button onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>

        <!-- Hidden input to store user ID for deletion -->
        <input type="hidden" id="deleteUserId">

        <script>
            function showDeletePopup(userId) {
                // Show the delete popup
                document.getElementById('deletePopup').style.display = 'block';
                // Pass the user ID to a hidden input field if needed
                document.getElementById('deleteUserId').value = userId;
            }

            function cancelDelete() {
                // Hide the delete popup
                document.getElementById('deletePopup').style.display = 'none';
            }

            function confirmDelete() {
                // Retrieve user ID from a hidden input field or any other element
                var userId = document.getElementById('deleteUserId').value;
                // Redirect to delete_user.php with user ID as a parameter
                window.location.href = 'delete_user.php?id=' + userId;
            }
        </script>
    
    <?php
    } else {
        echo "You need to log in as an admin before having access to this page!";
    }
    ?>
</body>

</html>
