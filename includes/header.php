  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">OpenNotes</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <form class="form-inline my-2 my-lg-0" action="./php/search.php" method="POST">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

        <!-- Right-aligned links on the navbar -->
        <ul class="navbar-nav ml-auto">
	  	  <li class="nav-item">
                <a class="nav-link" href="upload.php">Upload</a>
            </li>
          <li class="nav-item">
                <a class="nav-link" href="login.html">Account</a>
          </li>

        </ul>
    </div>
</nav>
