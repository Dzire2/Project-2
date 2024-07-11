<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Approval Status</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

<!-- Your form goes here -->
<!-- Example of a button to trigger the form submission -->
<form method="post" action="your_php_script.php">
  <input type="hidden" name="item_id" value="1">
  <input type="hidden" name="comment" value="Example comment">
  <button type="submit" name="approve" class="btn btn-success">Approve</button>
  <button type="submit" name="reject" class="btn btn-danger">Reject</button>
</form>

<!-- Bootstrap Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statusModalLabel">Approval Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="statusMessage"></p>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  // Handle form submission with AJAX
  $('form').submit(function(event) {
    event.preventDefault();
    var form = $(this);

    $.ajax({
      type: form.attr('method'),
      url: form.attr('action'),
      data: form.serialize(),
      dataType: 'json',
      success: function(response) {
        $('#statusMessage').text(response.message);
        $('#statusModal').modal('show');
      },
      error: function(xhr, status, error) {
        var errorMessage = xhr.status + ': ' + xhr.statusText;
        $('#statusMessage').text('Error - ' + errorMessage);
        $('#statusModal').modal('show');
      }
    });
  });
</script>

</body>
</html>
