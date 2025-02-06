<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .deadline-input {
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        header {
            background: #333;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #77aaff 3px solid;
        }
        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }
        header ul {
            padding: 0;
            list-style: none;
        }
        header li {
            float: left;
            display: inline;
            padding: 0 20px 0 20px;
        }
        .main {
            padding: 20px;
            background: #fff;
            margin-top: 20px;
        }
        .task-form {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .task-form input[type="text"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .task-form input[type="submit"] {
            width: 18%;
            padding: 10px;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .task-list {
            list-style: none;
            padding: 0;
        }
        .task-list li {
            background: #f4f4f4;
            padding: 10px;
            margin-bottom: 10px;
            border-left: 5px solid #77aaff;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Task Management</h1>
        </div>
    </header>
    <div class="container main">
        <form class="task-form">
            <input type="text" placeholder="Add a new task...">
            <input type="submit" value="Add Task">
            
        </form>
        <ul class="task-list">
            
            
        </ul>
        <div class="form-group">
    <label for="deadline">Deadline:</label>
    <input type="datetime-local" id="deadline" name="deadline" class="deadline-input" required>
</div>
    </div>
</body>
</html>

