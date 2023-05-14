<?php
// Get the task description, priority, and category from the AJAX request
$task = $_POST["task"];
$priority = $_POST["priority"];
$category = $_POST["category"];

// Insert the new task into the database
$sql = "INSERT INTO tasks (description, priority, category) VALUES ('$task', '$priority', '$category')";

if ($conn->query($sql) === TRUE) {
  // If the query was successful, return a success message
  echo "Task added successfully";
} else {
  // If the query failed, return an error message
  echo "Error adding task: " . $conn->error;
}
?>
