<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Branch-Location page</title>

    <link rel="stylesheet" href="styles/branches-style.css" />
  </head>
  <?php include ('includes/header.php')?>
  <body>
    <div class="header">
        <br><br>
      <h1>Our Locations</h1>
    </div>
    <div class="top-section">
      <img src="images/branches/top-image.jpg" />
      <p>
        Our branches offer customer a comfortable and safer ride whether it's a
        quick one day trip or an extended long trip. We are always well-prepared
        to assist you with your travel needs, ensuring the enjoyable journey for
        our customers. Our company has a wide variety of vehicles including
        cars, vans and SUVs, which are very comfortable and affordable. We
        provide our vehicle pickup and dropoff services across the island,
        ensuring you have a seamless experience from start to finish. Join with
        us to make the most of your travel experience across the country with a
        peace of mind that comes from knowing that you are in safe hands.
      </p>
    </div>
    <br />

    <div class="last-section">
      <div class="map-container">
        <img id="map-image" src="images/branches/map.png" />
      </div>

      <div class="location-grid">
        <div class="location" id="colombo">
          <p class="title">Colombo</p>
          <div class="hidden-content">
            <img src="images/branches/location.png" />
            <p class="adress">No 45, Galle road, Colombo 06.</p>
          </div>
        </div>
        <div class="location" id="galle">
          <p class="title">Galle</p>
          <div class="hidden-content">
            <img src="images/branches/location.png" />
            <p class="adress">5km radius from the Galle/Unawatuna</p>
          </div>
        </div>
        <div class="location" id="matara">
          <p class="title">Matara</p>
          <div class="hidden-content">
            <img src="images/branches/location.png" />
            <p class="adress">No 25, Main street, Matara.</p>
          </div>
        </div>

        <div class="location" id="jaffna">
          <p class="title" id="jaffna">Jaffna</p>
          <div class="hidden-content">
            <img src="images/branches/location.png" />
            <p class="adress">No 12, KKS Road, Jaffna.</p>
          </div>
        </div>
        <div class="location" id="kandy">
          <p class="title">Kandy</p>
          <div class="hidden-content">
            <img src="images/branches/location.png" />
            <p class="adress">No 78, Peredeniya Road, Kandy.</p>
          </div>
        </div>
        <div class="location" id="anuradhapura">
          <p class="title">Anuradhapura</p>
          <div class="hidden-content">
            <img src="images/branches/location.png" />
            <p class="adress">No 10, Mihintale Road, Anuradhapura.</p>
          </div>
        </div>
        <div class="location" id="trincomalee">
          <p class="title">Trincomalee</p>
          <div class="hidden-content">
            <img src="images/branches/location.png" />
            <p class="adress">No 22, Dockyard Road, Trincomalee.</p>
          </div>
        </div>
        <div class="location" id="baticalo">
          <p class="title">Batticaloa</p>
          <div class="hidden-content">
            <img src="images/branches/location.png" />
            <p class="adress">No 33, Galle Road, Batticaloa.</p>
          </div>
        </div>
      </div>
    </div>

    <script src="js/branches-script.js"></script>
    <?php include ('includes/footer.php')?>
  </body>
</html>
