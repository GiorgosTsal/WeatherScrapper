<?php


  if (array_key_exists('city', $_GET)){

    $found=true;
    $weather = $_GET['city'];
    $weather = str_replace(' ', '-', $weather);
    // Check if the url exists to remove warnings
      $file_headers = @get_headers('https://www.weather-forecast.com/locations/'.$weather.'/forecasts/latest');
      if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
          $exists = false;
          $wrongCity = $_GET['city'];
      }
      else {

        $exists = true  ;

        $forecastPage = file_get_contents('https://www.weather-forecast.com/locations/'.$weather.'/forecasts/latest');





          $pageArray = explode('<div class="b-forecast__overflow"><div class="b-forecast__wrapper b-forecast__wrapper--js"><table class="b-forecast__table js-forecast-table"><thead>', $forecastPage);

          $secondPageArray = explode('</span></p></td></tr>', $pageArray[1]);
          $prediction = $secondPageArray[0];

      }
      } else {
              $found=false;
          }


 ?>


 <!doctype html>
 <html lang="en">
   <head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link href="https://fonts.googleapis.com/css?family=Comfortaa|Roboto" rel="stylesheet">

     <style type="text/css">

     body {

       font-family: 'Comfortaa', cursive;
        background: url(weatherimg1.jpg) no-repeat center center fixed;
       -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

     }
     .container {
       width:800px;
       padding: 60px;
     }
     .head{
       text-align:center;
       color:white;
       position:relative;
       background: rgba(225, 225, 225, .2)
     }
     .row{
       margin-top: 5%;
     }

     #showresults{
       margin-top:20px;
     }

     #prediction{
       color:white;
       margin-top: 20px;

       padding:10px;
       font-size:12px;;
     }
     </style>



     <title>Weather Scraper</title>
   </head>
<body>


<div class="container">

<div class="head">
  <h1>Enter the name of your city to check the weather!</h1>
</div>

      <form>
           <div class="row">
            <div class="offset-md-3 col-md-6"">
              <div class="input-group">
                <span class="input-group-btn">
                  <button class="btn btn-info" type="Submit">Go!</button>
                </span>
                <input type="text" id="city" name="city" value="<?php if(array_key_exists('city', $_GET)){echo $_GET['city'];} ?>" class="form-control" placeholder="e.g London, Paris, Athens">
              </div>
            </div>

        </div>
      </form>




    <div id="showresults">
      <?php
      if($found)
{
          if(!$exists){
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.$wrongCity .' does not exist in our catalog.'.'</div>';
        } else {

          echo '<div class="alert alert-success" role="alert">' .$prediction .'</div>';

        }
      }
      ?>
      </div>



</div>

     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   </body>
 </html>
