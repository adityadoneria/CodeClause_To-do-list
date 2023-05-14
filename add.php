
  <?php

  // Check for POST request
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Retrieve task and priority values from request body
      $task = $_POST['task'];
      $priority = $_POST['priority'];

      // Validate task and priority values
      if (empty($task) || empty($priority)) {
          http_response_code(400);
          echo json_encode(array('success' => false, 'message' => 'Task and priority values are required.'));
          exit();
      }

      // Insert task and priority values into database
      $conn = new mysqli('localhost', 'root', 'password', 'todolist');
      $stmt = $conn->prepare('INSERT INTO tasks (task, priority) VALUES (?, ?)');
      $stmt->bind_param('ss', $task, $priority);
      $result = $stmt->execute();
      $stmt->close();
      $conn->close();

      // Check if database insert was successful
      if ($result) {
          $id = mysqli_insert_id($conn);
          echo json_encode(array('success' => true, 'id' => $id));
      } else {
          http_response_code(500);
          echo json_encode(array('success' => false, 'message' => 'Failed to insert task into database.'));
      }
      exit();
  }

  // Check for DELETE request
  if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
      // Retrieve ID value from URL query string
      parse_str($_SERVER['QUERY_STRING'], $params);
      $id = $params['id'];

      // Validate ID value
      if (empty($id)) {
          http_response_code(400);
          echo json_encode(array('success' => false, 'message' => 'ID value is required.'));
          exit();
      }

      // Delete task from database
      $conn = new mysqli('localhost', 'root', 'password', 'todolist');
      $stmt = $conn->prepare('DELETE FROM tasks WHERE id = ?');
      $stmt->bind_param('i', $id);
      $result = $stmt->execute();
      $stmt->close();
      $conn->close();

      // Check if database delete was successful
      if ($result) {
          echo json_encode(array('success' => true));
      } else {
          http_response_code(500);
          echo json_encode(array('success' => false, 'message' => 'Failed to delete task from database.'));
      }
      exit();
  }

  // If neither POST nor DELETE request, return 404 error
  http_response_code(404);
  echo json_encode(array('success' => false, 'message' => 'Page not found.'));
  