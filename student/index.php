<?php
include("std_header.php");
include('../inc/database.php');
?>
<link href="carousel.css" rel="stylesheet">

<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
</style>

<title>Student Front Page</title>

<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../assets/student_studying1.jpg" alt="">

        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Quizzies made easier.</h1>
            <p>Start your quiz now by pressing this button!</p>
            <p><a class="btn btn-lg btn-primary shadow" href="quiz.php">Start quiz!</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
      <img src="../assets/student_studying2.png" alt="">

        <div class="container">
          <div class="carousel-caption">
            <h1>Not your ordinary quiz app.</h1>
            <p>What if I say we're not like the others. What if I say we're not just another one.</p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../assets/student_studying3.png" alt="">
        <div class="container">
          <div class="carousel-caption text-end">
            <h1>One more for good measure.</h1>
            <p>You can check your marks history on quizzes that you have answered.</p>
            <p><a class="btn btn-lg btn-primary" href="history.php">Browse history</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

<section id="learn">
  <div class="container marketing">

  <!-- START THE FEATURETTES -->

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7">
      <h2 class="featurette-heading">First full-blown quiz website. <span class="text-muted">More leniency for students.</span></h2>
      <p class="lead">Forgot how many marks you get from your quizzes? Worry not, we got you covered with our history page for your quizzes.</p>
    </div>
    <div class="col-md-5">
      <img src="../assets/history_icon.png" alt="" width="500" height="500" role="img" class="featurette-image img-fluid mx-auto">
    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7 order-md-2">
      <h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
      <p class="lead">You can check everything, from A to Z all your quizzes that you have done.</p>
    </div>
    <div class="col-md-5 order-md-1">
      <img src="../assets/pencil_notebook.png" alt="" width="500" height="500" role="img" class="featurette-image img-fluid mx-auto">
    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7">
      <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
      <p class="lead">The quizzes are very lenient. You can speed run your quizzes like there is no tomorrow with the <b>time given</b> from your lecturer.</p>
    </div>
    <div class="col-md-5">
      <img src="../assets/timer.png" alt="" width="500" height="500" role="img" class="featurette-image img-fluid mx-auto">
    </div>
  </div>

  <hr class="featurette-divider">

  <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->

</section>
<?php
include("std_footer.php");
?>