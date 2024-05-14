<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>OpenNotes</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/styles.css" rel="stylesheet">
  </head>

  <body>


  <?php include 'includes/header.php'; ?>

<main role="main" class="container">

         <div class="container mt-5">
        <h2 class="mb-4">Select a Subject</h2>
        <div class="row subject-grid">
            <!-- Each subject as a form submission button -->
            <div class="col-md-4">
                <form action="./php/loadSubject.php" method="get">
                    <button type="submit" name="subject" value="Sociology" class="subject-button">Sociology</button>
                </form>
            </div>
            <div class="col-md-4">
                <form action="./php/loadSubject.php" method="get">
                    <button type="submit" name="subject" value="Informatics" class="subject-button">Informatics</button>
                </form>
            </div>
            <div class="col-md-4">
                <form action="./php/loadSubject.php" method="get">
                    <button type="submit" name="subject" value="Mathematics" class="subject-button">Mathematics</button>
                </form>
            </div>
            <div class="col-md-4">
                <form action="./php/loadSubject.php" method="get">
                    <button type="submit" name="subject" value="History" class="subject-button">History</button>
                </form>
            </div>
            <div class="col-md-4">
                <form action="./php/loadSubject.php" method="get">
                    <button type="submit" name="subject" value="Philosophy" class="subject-button">Philosophy</button>
                </form>
            </div>
            <div class="col-md-4">
                <form action="./php/loadSubject.php" method="get">
                    <button type="submit" name="subject" value="Biology" class="subject-button">Biology</button>
                </form>
            </div>
            <!-- Add more subjects as needed -->
            <div class="col-md-4">
                <form action="./php/loadSubject.php" method="get">
                    <button type="submit" name="subject" value="Chemistry" class="subject-button">Chemistry</button>
                </form>
            </div>
            <div class="col-md-4">
                <form action="./php/loadSubject.php" method="get">
                    <button type="submit" name="subject" value="Physics" class="subject-button">Physics</button>
                </form>
            </div>
            <div class="col-md-4">
                <form action="./php/loadSubject.php" method="get">
                    <button type="submit" name="subject" value="Medicine" class="subject-button">Medicine</button>
                </form>
            </div>
     <div class="col-md-4">
    <form action="./php/loadSubject.php" method="get">
        <button type="submit" name="subject" value="Economics" class="subject-button">Economics</button>
    </form>
</div>
<div class="col-md-4">
    <form action="./php/loadSubject.php" method="get">
        <button type="submit" name="subject" value="Law" class="subject-button">Law</button>
    </form>
</div>
<div class="col-md-4">
    <form action="./php/loadSubject.php" method="get">
        <button type="submit" name="subject" value="Science" class="subject-button">Science</button>
    </form>
</div>
<div class="col-md-4">
    <form action="./php/loadSubject.php" method="get">
        <button type="submit" name="subject" value="Psychology" class="subject-button">Psychology</button>
    </form>
</div>
<div class="col-md-4">
    <form action="./pages/loadSubject.php" method="ge">
        <button type="submit" name="subject" value="Art" class="subject-button">Art</button>
    </form>
</div>
<div class="col-md-4">
    <form action="./pages/loadSubject.php" method="get">
        <button type="submit" name="subject" value="Engineering" class="subject-button">Engineering</button>
    </form>
</div>
<div class="col-md-4">
    <form action="./pages/loadSubject.php" method="get">
        <button type="submit" name="subject" value="Business" class="subject-button">Business</button>
    </form>
</div>

        </div>
    </div>
</main>

 <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
