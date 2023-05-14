<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="container">
      <h1>To-Do List</h1>
      <form>
        <input type="text" id="task" placeholder="Task">
        <select id="priority">
          <option value="">Priority</option>
          <option value="Low">Low</option>
          <option value="Medium">Medium</option>
          <option value="High">High</option>
        </select>
        <button type="button" onclick="addTask()">Add</button>
      </form>
      <ul id="task-list">
      </ul>
    </div>
    <script src="script.js"></script>
  </body>
</html>
