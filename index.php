<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Error Logging Example</title>
</head>
<body>
    <h2>Insert New Customer</h2>
    <form action="process.php" method="POST">
        Name: <input type="text" name="name" required><br>
        Sex:  
        <select name="sex">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br>
        <button type="submit">Insert</button>
    </form>
    <hr>

    <h2>Error Log</h2>
    <button onclick="window.location.href='view_errors.php'">View Errors</button>
</body>
</html>
