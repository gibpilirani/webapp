$(document).ready(function () {
  //Edit data
  $('.edit_data').click(function () {
    //Edit data with this id
    var updateid = $(this).data('id');

    // AJAX request
    $.ajax({
      url: 'updateUser.php',
      type: 'GET',
      data: {
        updateid: updateid
      },
      success: function (response) {
        // Add response in Modal body
        $('.modal-body').html(response);
        // Display Modal
        $('#update').modal('show');
      }
    });
  });

  //View data
  $('.view_data').click(function () {

    var view_id = $(this).data('id');

    // AJAX request
    $.ajax({
      url: 'fetch.php',
      type: 'POST',
      data: {
        view_id: view_id
      },
      success: function (response) {
        // Add response in Modal body
        $('.modal-body').html(response);
        // Display Modal
        $('#view').modal('show');
      }
    });
  });

  //Add user
  $(".add-user").click(function () {
    $.ajax({
      url: "addUser.php",
      success: function (response) {
        $('#myModal').modal('show');

        $('.modal-body').html(response);
        $('#add_user').modal('show');
      }
    });
  });
});