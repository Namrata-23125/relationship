<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Materials</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Include the CSRF token meta tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        .draggable-item {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            cursor: move;
        }

        #assign-users-container {
            min-height: 100px;
            border: 2px dashed #ccc;
            padding: 10px;
        }

        .assigned-user {
            margin: 5px;
            padding: 5px;
            border: 1px solid #ccc;
            background-color: #e0e0e0;
        }

        .delete-button {
            cursor: pointer;
            color: #FF0000;
            margin-left: 5px;
        }
    </style>
</head>
<body>

<h1>Course Materials</h1>

<div>
    <h2>Available Materials</h2>
    @foreach($courseMaterials as $material)
        <div class="draggable-item" data-id="{{ $material->id }}">
            {{ $material->name }}
        </div>
    @endforeach
</div>

<div>
    <h2>Assigned Users</h2>
    <div id="assign-users-container" class="dropzone">
        <!-- Assigned users will appear here -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
    $(function () {
        $(".draggable-item").draggable({
            helper: "clone",
            revert: "invalid",
            start: function (event, ui) {
                // Set the drop target when the drag starts
                ui.helper.data("dropTarget", null);
            },
            stop: function (event, ui) {
                // Check if the drop target is #assign-users-container
                var dropTarget = ui.helper.data("dropTarget");
                if (dropTarget === '#assign-users-container') {
                    $(this).remove();
                }
            }
        });
        $("#assign-users-container").droppable({
         drop: function (event, ui) {
            // Set the drop target when an item is dropped into the container
            ui.helper.data("dropTarget", '#' + this.id);

            var materialId = ui.helper.data("id");

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                $.ajax({
                    url: "/assign-users/store",
                    type: "POST",
                    data: { material_course_id: materialId },
                    success: function (response) {
                        if (response.success) {
                            var materialName = ui.helper.text();
                                var assignedUserHtml = '<div class="assigned-user draggable-item" draggable="true" >' +
                                    materialName +
                                    '<span class="delete-button" data-material-id="' + materialId + '"></span>' +
                                    '</div>';
                            $("#assign-users-container").append(assignedUserHtml);

                        } else {
                            alert('Failed to assign user. Please try again.');
                        }
                    },
                    error: function (error) {
                        console.error("Error:", error);
                        alert('An error occurred. Please check the console.');
                    }
                });
            }
        });

        $("#assign-users-container").on('drag', '.delete-button', function () {
            var materialId = $(this).data('material-id');
            var deleteButton = $(this);

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
            url: "/assign-users/destroy",
            type: "DELETE", // Use uppercase for the HTTP method
            data: { material_course_id: materialId },
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            success: function (response) {
                if (response.success) {
                    deleteButton.closest('.assigned-user').remove(); // Use closest() instead of parent() to ensure proper element removal
                } else {
                    alert('Failed to delete assigned user. Please try again.');
                }
            },
            error: function (error) {
                console.error("Error:", error);
                alert('An error occurred. Please check the console.');
            }
        });

        });
    });
</script>

</body>
</html>
