<!DOCTYPE html>
<html lang="en">
    <?php
    include('std_header.php');
    ?>

<body>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

<div class="card" style="width: 18rem;"><div class="form-check">
  <div class="card-header">
  Question(echo variable $no++):
  (echo $question_txt from table quiz_question)
  </div>
  
  
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    echo option from option table[0]
  </label></li>


    <li class="list-group-item"><input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  echo option from option table[1]
  </label></li>


    <li class="list-group-item"><input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  echo option from option table[2]
  </label></li>

  
  <li class="list-group-item"><input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  echo option from option table[3]
  </label></li>
</ul>
</div>
    

<br><br><button type="next" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Next</button></form></div>
                </body>
</html>