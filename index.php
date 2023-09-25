<!DOCTYPE html>
<html>

<head>
    <title>One-Page Blog</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>One-Page Blog</h1>

        <!-- Comments Section -->
        <div id="commentsSection">
            <!-- Display comments here -->
        </div>

        <?php
        session_start();
        $isAdmin = isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : false;

        if ($isAdmin) {
            echo '<p>You are logged in as admin.</p>';
            echo '<button id="adminLogoutButton" class="btn btn-primary">Logout</button>';
        } else {
            echo '
        <form id="adminLoginForm" method="POST" action="admin_login.php" class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="password" placeholder="Admin Password" id="adminPassword" name="adminPassword" required>
          <button class="btn btn-primary my-2 my-sm-0" type="submit">Admin Login</button>
        </form>
        ';
        }
        ?>

        <!-- Add Comment Form (for public users) -->
        <h3>Add Comment</h3>
        <form id="addCommentForm" method="POST" action="add_comment.php">
            <div class="form-group">
                <label for="commentName">Name</label>
                <input type="text" class="form-control" id="commentName" name="commentName" required>
            </div>
            <div class="form-group">
                <label for="commentText">Comment</label>
                <textarea class="form-control" id="commentText" name="commentText" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Edit Comment Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editCommentId">
                    <div class="form-group">
                        <label for="editCommentText">Comment</label>
                        <textarea class="form-control" id="editCommentText" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChangesButton">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include your custom script.js file -->
    <script src="script.js"></script>
</body>

</html>