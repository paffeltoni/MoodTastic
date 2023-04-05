<?php include'../view/header.php'; ?>



<!DOCTYPE html>
<html>
  <head>
    <title>Responsive Page</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>Responsive Page</h1>
    
    <h2>Range Bars</h2>
    <input type="range" min="0" max="100" value="50">
    <input type="range" min="0" max="100" value="25">
    <input type="range" min="0" max="100" value="75">
    
    <h2>Graph Section</h2>
    <div class="graph-section">
      <div class="graph-value">80%</div>
    </div>
    
    <h2>Weather and Moon Information</h2>
    <div class="weather-section">
      <h2>Weather and Moon Information</h2>
      <div class="weather-info">
        <div class="weather-item">
          <h3>Temperature</h3>
          <p>25&deg;C</p>
        </div>
        <div class="weather-item">
          <h3>Moon Phase</h3>
          <p>Full Moon</p>
        </div>
      </div>
    </div>
  </body>
</html>


<!--Weather API-->



<?php include'../view/footer.php'; ?>
