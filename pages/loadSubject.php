<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>OpenNotes</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
      <?php include '../includes/header.php'; ?>

    <main role="main" class="container mt-5 pt-5">
        <h2>Notes List</h2>
        <form method="GET" action="">
            <div class="form-group">
                <label for="orderBy">Order By:</label>
                <select name="orderBy" class="form-control" onchange="this.form.submit()">
                    <option value="Title" <?php echo ($_GET['orderBy'] ?? 'Title') === 'Title' ? 'selected' : ''; ?>>Title</option>
                    <option value="Author" <?php echo ($_GET['orderBy'] ?? '') === 'Author' ? 'selected' : ''; ?>>Author</option>
                    <option value="DateN" <?php echo ($_GET['orderBy'] ?? '') === 'DateN' ? 'selected' : ''; ?>>Date</option>
                </select>
                <input type="hidden" name="subject" value="<?php echo htmlspecialchars($_GET['subject'] ?? ''); ?>">
            </div>
        </form>

        <ul class="list-group">
            <?php
            $host = '127.0.0.1';
            $username = 'guest';
            $password = 'password';
            $database = 'OpenNotes';

            // Create connection
            $conn = new mysqli($host, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $orderBy = $_GET['orderBy'] ?? 'Title';  // Default order
            $validOrderBys = ['Title', 'Author', 'DateN'];  // Preventing SQL injection by validation
            if (!in_array($orderBy, $validOrderBys)) {
                $orderBy = 'Title';
            }

            $subject = $_GET['subject'] ?? 'default_subject';  // Securely fetch the subject

            $sql = $conn->prepare("SELECT Title, Author, DateN, PDF_Path FROM Note WHERE Subject = ? ORDER BY $orderBy");
            $sql->bind_param("s", $subject);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="list-group-item">';
                    echo '<strong>Title:</strong> ' . htmlspecialchars($row['Title']) . '<br>';
                    echo '<strong>Author:</strong> ' . htmlspecialchars($row['Author']) . '<br>';
                    echo '<strong>Date:</strong> ' . htmlspecialchars($row['DateN']);
                    echo '</div>';
                    echo '<div><a href=".' . htmlspecialchars($row['PDF_Path']) . '" download><i class="fas fa-file-pdf"></i> Download</a></div>';
                    echo '</li>';
                }
            } else {
                echo '<li class="list-group-item">No notes found</li>';
            }

            $sql->close();
            $conn->close();
            ?>
        </ul>
    </main>

 <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
