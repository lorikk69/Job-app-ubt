<?php
session_start();
include 'users.php';
include 'jobs.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo "You need to log in as an admin before having access to this page!";
    exit();
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
    <main>
        <div class="sidebar">
            <div class="sidebar-icons">
                <a href="#users">
                    <i class="fas fa-users"></i> Users
                </a>
                <a href="#jobs">
                    <i class="fas fa-briefcase"></i> Job Listings
                </a>
                <a href="../Index/index.php" class="back-home">Return Home</a>
            </div>
        </div>

        <div class="main-content">
            <div id="users" class="user-list">
                <h2>Users</h2>
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
                        <?php $usersList->displayUsers(); ?> 
                    </tbody>
                </table>
            </div>
            <div id="jobs" class="job-list">
                <h2>Job Listings</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>City</th>
                            <th>Schedule</th>
                            <th>Position</th>
                            <th>Description</th>
                            <th>Salary</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jobList->getJobs() as $job) { ?>
                            <tr>
                                <td><?php echo $job->getId(); ?></td>
                                <td><?php echo $job->getCompanyName(); ?></td>
                                <td><?php echo $job->getCity(); ?></td>
                                <td><?php echo $job->getSchedule(); ?></td>
                                <td><?php echo $job->getPosition(); ?></td>
                                <td><?php echo $job->getDescription(); ?></td>
                                <td><?php echo $job->getSalary(); ?></td>
                                <td>
                                    
    <div class="action-buttons">
        <a href="javascript:void(0);" onclick="showEditPopup(<?php echo $job->getId(); ?>, '<?php echo $job->getCompanyName(); ?>', '<?php echo $job->getCity(); ?>', '<?php echo $job->getSchedule(); ?>', '<?php echo $job->getPosition(); ?>', '<?php echo $job->getDescription(); ?>', '<?php echo $job->getSalary(); ?>')">
            <i class="fas fa-pencil-alt"></i>
        </a>
        <a href="javascript:void(0);" onclick="showDeletePopup1(<?php echo $job->getId(); ?>)">
            <i class="fas fa-trash-alt"></i>
        </a>
    </div>
</td>



                            </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="editPopup" class="edit-popup" style="display: none;">
        <div class="edit-popup-content">
            <h2>Edit Job</h2>
            <form id="editForm" method="post" action="edit_jobs.php">
                <input type="hidden" id="editJobId" name="job_id">
                <label for="editCompanyName">Company Name:</label>
                <input type="text" id="editCompanyName" name="kompania">
                <label for="editCity" class="city-popup" class="city-1">City:</label>
                <input type="text" id="editCity" name="Qyteti">
                <label for="editSchedule">Schedule:</label>
                <input type="text" id="editSchedule" name="orari">
                <label for="editPosition" class="position-1">Position:</label>
                <input type="text" id="editPosition" name="pozita">
                <label for="editDescription" class="description-1">Description:</label>
                <textarea id="editDescription" name="about_us" class="description-2"></textarea>
                <label for="editSalary" class="salary-1">Salary:</label>
                <input type="text" id="editSalary" name="paga" class="salary-1">
                <button type="submit" id="update-btn">Update Job</button>
            </form>
            <button onclick="cancelEdit()" id="cancel-btn">Cancel</button>
        </div>
    </div>



    </main>

    <div id="deletePopup" class="delete-popup">
        <div class="delete-popup-content">
            <p>Are you sure you want to delete this user?</p>
            <div class="delete-popup-buttons">
                <button onclick="cancelDelete()">Cancel</button>
                <button onclick="confirmDelete()">Delete</button>
            </div>
        </div>
    </div>

    <div id="deletePopup1" class="delete-popup">
    <div class="delete-popup-content">
        <p>Are you sure you want to delete this job?</p>
        <div class="delete-popup-buttons">
            <button onclick="cancelDelete1()">Cancel</button>
            <button onclick="confirmDelete1()">Delete</button>
        </div>
    </div>
</div>

<input type="hidden" id="deleteJobId1">

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

        function showDeletePopup1(jobId) {
        document.getElementById('deletePopup1').style.display = 'block';
        document.getElementById('deleteJobId1').value = jobId;
    }

    function cancelDelete1() {
        document.getElementById('deletePopup1').style.display = 'none';
    }

    function confirmDelete1() {
        var jobId = document.getElementById('deleteJobId1').value;
        window.location.href = 'delete_jobs.php?id=' + jobId;
    }

   

        function showEditPopup(jobId, companyName, city, schedule, position, description, salary) {
        document.getElementById('editPopup').style.display = 'block';
        document.getElementById('editJobId').value = jobId;
        document.getElementById('editCompanyName').value = companyName;
        document.getElementById('editCity').value = city;
        document.getElementById('editSchedule').value = schedule;
        document.getElementById('editPosition').value = position;
        document.getElementById('editDescription').value = description;
        document.getElementById('editSalary').value = salary;
    }

    function cancelEdit() {
        document.getElementById('editPopup').style.display = 'none';
    }
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".main-content > div:not(:first-child)").forEach(function(section) {
            section.style.display = "none";
        });

        document.querySelectorAll(".sidebar-icons a").forEach(function(link) {
            link.addEventListener("click", function(event) {
                event.preventDefault(); 

                document.querySelectorAll(".main-content > div").forEach(function(section) {
                    section.style.display = "none";
                });

                var targetId = this.getAttribute("href").substring(1);
                document.getElementById(targetId).style.display = "block";
            });
        });
    });
    </script>
</body>

</html>
