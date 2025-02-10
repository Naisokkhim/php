const api = "http://localhost/schoolTask/CRUD_API_Task/api/task.php";

// Fetch tasks when the page loads
document.addEventListener("DOMContentLoaded", async () => {
  const tasks = await fetchTasks();
  displayTasks(tasks);
});

// ✅ Fetch tasks from API
const fetchTasks = async () => {
  try {
    const res = await fetch(api, { method: "GET" });

    if (!res.ok) {
      throw new Error(`HTTP error! Status: ${res.status}`);
    }

    return await res.json();
  } catch (err) {
    console.error("Error fetching tasks:", err);
    return [];
  }
};

// ✅ Display tasks in the UI
const displayTasks = (tasks) => {
  const taskList = document.querySelector(".task-list");
  taskList.innerHTML = ""; // Clear the list before adding new tasks

  tasks.forEach((task) => {
    const li = document.createElement("li");
    li.innerHTML = `
        <div class="task-details">
        <span class="task-title">${task.tittle}</span>
        <span class="task-desc">${task.description}</span>
        <span class="task-deadline">Deadline: ${task.end}</span>
      </div>
      <button class="delete-btn" onclick="deleteTask(${task.id})">❌ Delete</button>
  `;

    taskList.appendChild(li);
  });
};

// ✅ Delete task from API
const deleteTask = async (taskId) => {
  if (!confirm("Are you sure you want to delete this task?")) return;

  try {
    const res = await fetch(`${api}?id=${taskId}`, { method: "DELETE" });

    if (!res.ok) throw new Error("Failed to delete task!");

    fetchTasks().then(displayTasks); // Refresh task list after deletion
  } catch (err) {
    console.error("Error deleting task:", err);
  }
};
