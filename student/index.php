<?php
include("std_header.php");
include('../inc/database.php');
?>

<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>

<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}
</style>
</head>


<h2>Let's checkout your learning journey</h2>


<div class="row">
  <div class="column">
    <div class="card">
      <h3>1</h3>
      <p>Choose your subject</p>
      <p>Choose your favourite subject from the vast selection of subjects and continue your journey</p>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <h3>2</h3>
      <p>Select the difficulty</p>
      <p>Select difficulty of your choice and get the difficulty of questions according to your difficulty</p>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <h3>3</h3>
      <p>Increasing difficulty</p>
      <p>Difficulty of questions will increase for the upcoming question irrespective of result of a previous question</p>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <h3>4</h3>
      <p>Detailed overview of scores</p>
      <p>Get the detailed overview of your question answer session and tips on how you can improve</p>
    </div>
  </div>
</div>


<?php
include("std_footer.php");
?>