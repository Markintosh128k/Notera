<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Notes</title>
    <link href="../assets/css/form.css" rel="stylesheet">
</head>
<body>!
      <?php include '../includes/header.php'; ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
    <!-- Subject Selection Dropdown -->
    <div class="form-outline mb-4">
        <label for="subjectSelect" class="form-label">Subject</label>
        <select id="subjectSelect" class="form-control" name="subject">
            <option value="">Select Subject</option>
            <!-- Dynamically retain the selected subject -->
            <?php
            $subjects = ["Sociology", "Informatics", "Mathematics", "History", "Philosophy", "Biology", "Chemistry", "Physics", "Medicine", "Economics", "Law", "Science", "Psychology", "Art", "Engineering", "Business"];
            $selectedSubject = $_POST['subject'] ?? '';
            foreach ($subjects as $subject) {
                echo "<option value='$subject'" . ($selectedSubject === $subject ? ' selected' : '') . ">$subject</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-outline mb-4">
        <label for="languageSelect" class="form-label">Language</label>
        <select id="languageSelect" class="form-control" name="language">
            <option value="">Select Language</option>
            <!-- Dynamically retain the selected language -->
            <?php
            $languages = ["English", "Mandarin Chinese", "Spanish", "Hindi", "Arabic", "Portuguese", "Bengali", "Russian", "Japanese", "Punjabi", "German", "Javanese", "Wu Chinese", "Malay/Indonesian", "Telugu", "Vietnamese", "Korean", "French", "Marathi", "Tamil", "Urdu", "Turkish", "Italian", "Yue Chinese", "Thai"];
            $selectedLanguage = $_POST['language'] ?? '';
            foreach ($languages as $language) {
                echo "<option value='$language'" . ($selectedLanguage === $language ? ' selected' : '') . ">$language</option>";
            }
            ?>
        </select>
    </div>

    <!-- Title of the Notes -->
    <div class="form-outline mb-4">
        <label for="noteTitle" class="form-label">Title of the Notes</label>
        <input type="text" id="noteTitle" class="form-control" name="title" value="<?php echo $_POST['title'] ?? ''; ?>" required>
    </div>

    <!-- Author Name -->
    <div class="form-outline mb-4">
        <label for="authorName" class="form-label">Author Name</label>
        <input type="text" id="authorName" class="form-control" name="author" value="<?php echo $_POST['author'] ?? ''; ?>" required>
    </div>

    <!-- File Upload -->
    <div class="form-outline mb-4">
        <label for="fileUpload" class="form-label">Upload PDF</label>
        <input type="file" id="fileToUpload" class="form-control" name="file" accept="application/pdf" required>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Upload</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $conn = mysqli_connect("127.0.0.1", "guest", "password", "OpenNotes");
    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $title = $_POST['title'];
    $language = $_POST['language'];
    $author = $_POST['author'];
    $subject = $_POST['subject'];
    $dateN = date('Y-m-d'); // Current date

    $file = $_FILES["file"];
    if ($file["error"] === 0) {
        $allowedTypes = ['application/pdf'];
        if (in_array($file["type"], $allowedTypes)) {
            $fileTmpPath = $file["tmp_name"];
            $fileName = md5(time() . $file["name"]) . '-' . basename($file["name"]);
            $destPath = './uploads/' . $fileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $stmt = $conn->prepare("INSERT INTO Note (Title, DateN, Language, Author, PDF_Path, Subject) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $title, $dateN, $language, $author, $destPath, $subject);
                if ($stmt->execute()) {
                    echo "<p>The file " . htmlspecialchars(basename($file["name"])) . " has been uploaded successfully.</p>";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error: There was an issue moving the uploaded file.";
            }
        } else {
            echo "Error: Only PDF files are allowed.";
        }
    } else {
        echo "Error: File upload error. Code: " . $file["error"];
    }
    mysqli_close($conn);
}
?>
</body>
</html>
