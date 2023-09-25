$(document).ready(function() {
  // Function to load comments
  function loadComments() {
    $.ajax({
      url: 'get_comments.php',
      success: function(response) {
        $('#commentsSection').html(response);
      }
    });
  }

  // Load comments on page load
  loadComments();

  // Submit add comment form
  $('#addCommentForm').submit(function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var formData = form.serialize();

    $.ajax({
      type: 'POST',
      url: url,
      data: formData,
      success: function(response) {
        // Clear form fields
        form[0].reset();
        // Refresh comments section after successful submission
        loadComments();
      }
    });
  });

  // Edit button click event
  $(document).on('click', '.editButton', function() {
    var commentId = $(this).data('comment-id');
    var commentText = $(this).siblings('.card-text').text();
    
    // Show the modal
    $('#editModal').modal('show');
    
    // Set the comment ID and text in the modal
    $('#editCommentId').val(commentId);
    $('#editCommentText').val(commentText);
  });

  // Save changes button click event
  $('#saveChangesButton').click(function() {
    var commentId = $('#editCommentId').val();
    var commentText = $('#editCommentText').val();

    $.ajax({
      type: 'POST',
      url: 'update_comment.php',
      data: { commentId: commentId, commentText: commentText },
      success: function(response) {
        // Hide the modal
        $('#editModal').modal('hide');
        // Refresh comments section after successful update
        loadComments();
      }
    });
  });

  // Admin Logout button click event
  $(document).on('click', '#adminLogoutButton', function(e) {
    e.preventDefault();
    // Clear the isAdmin session variable
    $.ajax({
      type: 'POST',
      url: 'admin_logout.php',
      success: function(response) {
        // Reload the page after logout
        window.location.reload();
      }
    });
  });

  // Delete button click event
  $(document).on('click', '.deleteButton', function() {
    var commentId = $(this).data('comment-id');

    $.ajax({
      type: 'POST',
      url: 'delete_comment.php',
      data: { commentId: commentId },
      success: function(response) {
        // Refresh comments section after successful deletion
        loadComments();
      }
    });
  });
});
