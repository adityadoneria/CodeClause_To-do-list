// Define task list variable
let taskList = [];

// Retrieve task list from local storage (if available)
if (localStorage.getItem("taskList")) {
  taskList = JSON.parse(localStorage.getItem("taskList"));
}

// Define function to render task list
function renderTaskList() {
  const taskListElement = document.getElementById("task-list");
  taskListElement.innerHTML = "";
  for (let i = 0; i < taskList.length; i++) {
    const taskItem = taskList[i];
    const listItem = document.createElement("li");
    listItem.innerHTML = `
      <div class="task">${taskItem.task}</div>
      <div class="priority ${taskItem.priority.toLowerCase()}">${taskItem.priority}</div>
      <button type="button" onclick="deleteTask(${i})">Delete</button>
    `;
    taskListElement.appendChild(listItem);
  }
}

// Call function to render task list on page load
renderTaskList();

// Define function to add task to list
function addTask() {
  const taskInput = document.getElementById("task");
  const prioritySelect = document.getElementById("priority");
  const task = taskInput.value.trim();
  const priority = prioritySelect.value;
  if (!task) {
    alert("Please enter a task.");
    return;
  }
  if (!priority) {
    alert("Please select a priority.");
    return;
  }
  const taskItem = { task, priority };
  taskList.push(taskItem);
  localStorage.setItem("taskList", JSON.stringify(taskList));
  taskInput.value = "";
  prioritySelect.value = "";
  renderTaskList();
}

// Define function to delete task from list
function deleteTask(index) {
  taskList.splice(index, 1);
  localStorage.setItem("taskList", JSON.stringify(taskList));
  renderTaskList();
}
