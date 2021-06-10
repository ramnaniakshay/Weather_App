<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
<style>
.center-i {
    display: flex;
    align-items: center;
    justify-content: center;
}
.bg-w
{
    background-color: #ff9a9e;
}
.bord-r
{
    border: 2px solid black;
}
</style>
</head>
<body style="background-color: #121212;">
<?php
$status="";
if(isset($_GET['submit']))
{
    $city=$_GET['city'];
    $url="https://api.openweathermap.org/data/2.5/weather?q=$city&appid=716063ac1a50a778165b4cef73faae39";
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);


    $result=curl_exec($ch);
    curl_close($ch);
    $result=json_decode($result,true);
    $status="yes";
}


?>

<form class="form-inline center-i"  method="GET">
  <div class="form-group">
    <input type="text" class="form-control" id="loc" name="city" placeholder="Enter your city">
    <input type="submit" value="submit" class="btn btn-success" name="submit"/>
    <!-- <a href="" class="btn btn-success" value="submit" name="submit" >Search</a> -->
  </div>
</form>
<br/>
<br/>
<?php
    if($status=="yes")
    {
?>

<div style="padding: 5%" class="bg-w container">
    <div class="row center-i">
        <div class="col-12">
            <img class="" src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon']?>@2x.png" />
        </div>
    </div>
    <div  class="row">
        <div class="bord-r">
        <div class=" col-xl-3 col-md-3">
            <h2><?php echo round($result['main']['temp']-273.15) ?> °C</h2>
        </div>
        <div class=" col-xl-3 col-md-3">
            <h2><?php echo $result['weather'][0]['main'] ?></h2>
            <h5><?php echo $result['name'] ?></h5>
        </div>
        <div class=" col-xl-3 col-md-3">
            <h2>Wind</h2>
            <h5><?php echo $result['wind']['speed'] ?></h5>
        </div>
        <div class=" col-xl-3 col-md-3">
            <h2><?php echo date('d M', $result['dt']) ?></h2>
        </div>
        </div>
    </div>
</div>

<?php } else
{
    echo "<h2> Invalid city </h2>";
}
?>
</body>
</html>