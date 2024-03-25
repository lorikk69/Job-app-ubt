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
    <link rel="stylesheet" href="dashboard.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
</head>

<body>
    <?php
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

        <input type="hidden" id="deleteUserId">

        <script>
            function showDeletePopup(userId) {
                document.getElementById('deletePopup').style.display = 'block';
                document.getElementById('deleteUserId').value = userId;
            }

            function cancelDelete() {
                document.getElementById('deletePopup').style.display = 'none';
            }

            function confirmDelete() {
                var userId = document.getElementById('deleteUserId').value;
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
