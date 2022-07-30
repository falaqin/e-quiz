<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<!DOCTYPE html>

<!-- @@@@@@@@@@please remember artist for vector art is Lina Leusenko -->
<html>
    <head>
    <link rel="icon" href="assets/logo_equiz_no_text_smallest.png">   
    <title>E-Quiz</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css">
    <!-- JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="py-3 navbar navbar-expand-lg fixed-top auto-hiding-navbar bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
            <img class="logo" src="./assets/logo_equiz_no_text.png"/> E-Quiz
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bi bi-eye-fill"><b></b></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php#hero">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#about-us">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminlogin.php">Admin</a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
        <!-- End Navbar -->
    
        <!-- Hero section -->
        <section id="hero">
        <div class="container">
            <div class="row">
            <div class="col">
                <h1>Welcome to<br>E-Quiz System</h1>
                <p>Created from a single passionate developer to bring the best quiz system to create a better solution for the students studying from home, or anywhere in the world.</p>
                <button type="button" class="btn btn-dark btn-large" id="btnlogin">Login</button>
                <script type="text/javascript">
                    document.getElementById("btnlogin").onclick = function () {
                        location.href = "studentlogin.php";
                    };
                </script>
            </div>
            <div class="col img-col">
                <img src="./assets/hero-img.png" class="img-fluid" alt="Software Development" style="width:400px;">
            </div>
            </div>

            <div class="row cards">

                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Flexibility</h5>
                        <p class="card-text">Gives both students and teachers complete flexibility in creating and answering quizzes.</p>
                    </div>
                    </div>
                </div>

                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Performance</h5>
                        <p class="card-text">Lightweight, and extremely fast for older PC or mobile phones, so every users can have blazing fast access on the system.</p>
                    </div>
                    </div>
                </div>

                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Security</h5>
                        <p class="card-text">Good security applied, so plagiarism will not happen often on the system.</p>
                    </div>
                    </div>
                </div>

            </div>
        </div>
        </section>
        <!-- End Hero section -->

        <!-- About us section -->
        <section id="about-us">
        <div class="container">
            <div class="row align-items-center">
            <div class="col">
                <img src="./assets/about-us.png" class="img-fluid" alt="About Us">
            </div>
            <div class="col text-col">
                <h1>About Us</h1>
                <p>As a developer, we are motivated and striving to create a completely flexible and a good system environment for the teachers and students to work with.</p>
            </div>
            </div>
        </div>
        </section>
        <!-- End About us section -->

        <!-- Contact section -->
        <section id="contact">
        <div class="container">
            <div class="row align-items-center">
            <div class="col">
                <h1>Developed For Jabatan Pendidikan Negeri Sembilan</h1>
                <h5>E-Quiz</h5>
                <p>All rights to JPNS</p>
                <p>Anas Nordin</p>
            </div>
            </div>
        </div>
        </section>
        <!-- End Contact section -->
    </body>
</html>