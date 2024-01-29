<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>To Do App </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="col">

            <table class="table">
              <tr>
                <td class="column" id="pending">
                  <h1>All Tasks</h1>

                  @foreach($pending_tasks as $task)
                    <div class="card mt-2" data-id="{{ $task->id }}">
                        <div class="card-body">
                            <div class="list-group-item" draggable="true">Name:{{ $task->name }}</div>
                            <div class="list-group-item" draggable="true">Task:{{ $task->task }}</div>
                            <div class="list-group-item" draggable="true">Description:{{ $task->description }}</div>
                      </div>
                    </div>
                  @endforeach
                </td>

                <td class="column" id="progress">
                  <h1>In progress</h1>
                  @foreach($progress_tasks as $task)
                    <div class="card mt-2" data-id="{{ $task->id }}">
                      <div class="card-body">
                        <div class="list-group-item" draggable="true">Name:{{ $task->name }}</div>
                        <div class="list-group-item" draggable="true">Task:{{ $task->task }}</div>
                        <div class="list-group-item" draggable="true">Description:{{ $task->description }}</div>
                      </div>
                    </div>
                  @endforeach
                </td>

                <td class="column" id="complete">
                  <h1>Completed</h1>
                  @foreach($complete_tasks as $task)
                    <div class="card mt-2" data-id="{{ $task->id }}">
                      <div class="card-body">
                        <div class="list-group-item" draggable="true">Name:{{ $task->name }}</div>
                        <div class="list-group-item" draggable="true">Task:{{ $task->task }}</div>
                        <div class="list-group-item" draggable="true">Description:{{ $task->description }}</div>
                      </div>
                    </div>
                  @endforeach
                </td>
              </tr>
            </table>
        </div>
    </div>

  <!-- Add the jQuery UI code at the end of your HTML body -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $(document).ready(function () {
      $(".column").sortable({
        connectWith: ".column",
        items: "> div", // Only select div elements inside .column
        cancel: "h1", // Exclude h1 elements from being draggable
        receive: function (event, ui) {
          var taskID = ui.item.data("id");
          var newStatus = $(this).attr("id");
          $.ajax({
            type: "PATCH",
            url: "/task/" + taskID,
            data: { _token: "{{ csrf_token() }}", status: newStatus },
          });
        },
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qy
