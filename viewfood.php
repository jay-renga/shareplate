<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "share_plate_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the food item ID from the URL
$food_id = isset($_GET['id']) ? intval($_GET['id']) : 0;



// Handle form submission
// Process request form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    // Retrieve form data
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];
    $food_id = $_POST["food_id"];
    $qty = $_POST["req_qty"];
    $posted = date('Y-m-d H:i:s');
    $location = $_POST['location'];
    // Save request to database
    $sql = "INSERT INTO requests (name, phone, message, food_id, posted_on, req_qty, location) VALUES ('$name', '$phone', '$message','$food_id', '$posted', '$qty', '$location')";
    $sql1= "UPDATE food_items SET req_quantity = req_quantity + ".$qty." WHERE id = ".$food_id.";";
    if ($conn->query($sql) === TRUE) {
     $conn->query($sql1);
        echo "<p class='alert alert-success'>Request submitted successfully!</p>";
    } else {
        echo "<p class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}
// Fetch the food item from the database
$sql = "SELECT * FROM food_items WHERE id = $food_id";


$result = $conn->query($sql); 
// Fetch comments (requests) from database
$sql = "SELECT * FROM requests where food_id='$food_id'";
$result1 = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Food Deatils - Share Plate </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Yummy
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Updated: Jun 02 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
         <img src="assets/img/ .png" alt="">  <!-- change the small logo-->
        <h1 class="sitename">Share Plate</h1>
        <span></span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
        <li><a href="index.html#hero" class="">Home<br></a></li>
          <li><a href="index.html#about">About us</a></li>
          <li><a href="index.html#why-us">Why us</a></li>
        <!--  <li><a href="index.html#chefs">Our Team</a></li>-->
          <li><a href="index.html#testimonials">Feedback</a></li>
          <li><a href="index.html#events">Events</a></li>
          <li><a href="index.html#contact">Contact Us</a></li>
  
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="foods.php "> Food List</a>
      <a class="btn-getstarted" href="index.html#book-a-table ">Post Food</a>
      <a class="btn-getstarted" href="index.html#donate "> Donate</a>

    </div>
  </header>

  <main class="main">
  <div class="container">
        <h1 class="my-4">Food Details</h1>
        
        <!-- Display food details here -->
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): 
              $req_qty =$row['req_quantity'];
              $qty = $row['quantity'];?>
                   
                        <div class="card h-100">
                            
                            <div class="card-body">                                
                                <div class="row"> 
                                    
                                    <div class="col-md-8 mb-4">
                                        <p class="card-text">
                                        <h2 class="description-title card-title"><?php echo htmlspecialchars($row['contact_name']); ?></h2>
                                            <strong>Phone:</strong> <?php echo htmlspecialchars($row['contact_phone']); ?><br>
                                            <strong>Type of Food:</strong> <?php echo htmlspecialchars($row['type_of_food']); ?><br>
                                            <strong>Quantity:</strong> <?php echo htmlspecialchars($row['quantity']); ?><br>
                                            <strong>Time of Preparation:</strong> <?php echo htmlspecialchars($row['time_of_preparation']); ?><br>
                                            <strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?><br>
                                            <strong>Message:</strong> <?php echo htmlspecialchars($row['message']); ?><br>
                                            <strong>Posted on:</strong> <?php echo htmlspecialchars($row['created_on']); ?>
                                            <div class="col-md-6 mb-4"><br/>
                                              <table class="table table-bordered"><tr>
                                              <td class="align-middle">
                                               <div class="col-md-12 d-flex justify-content-center text-info"><strong class="text-warning  justify-content-center" ><span style="font-size: 40px;"><?php if(($row['quantity']) !=0){ ?><i class="bi bi-basket2-fill"></i>  <?php }else { ?> <i class="bi bi-basket3"></i>  <?php } ?><?php echo htmlspecialchars($row['quantity']); ?></br></span>   Posted</strong></div>
                                                </td><td class="align-middle">
                                               <div class="col-md-12 d-flex justify-content-center text-success"><strong class="text-success  justify-content-center" ><span style="font-size: 40px;"><?php if(($row['quantity']-$row['req_quantity']) !=0){ ?><i class="bi bi-basket2-fill"></i>  <?php }else { ?> <i class="bi bi-basket3"></i>  <?php } ?><?php echo htmlspecialchars($row['quantity']-$row['req_quantity']); ?></br></span>   Available</strong></div>
                                                </td>
                                                <td class="align-middle">
                                               <div class="col-md-12 d-flex justify-content-center text-danger"><strong class="text-danger  justify-content-center" ><span style="font-size: 40px;"><?php if($row['req_quantity'] !=0){ ?><i class="bi bi-basket2-fill"></i>  <?php }else { ?> <i class="bi bi-basket3"></i>  <?php } ?><?php echo htmlspecialchars($row['req_quantity']); ?></br></span>   Requested</strong></div>
                                                </td>
                                                </tr>
                                                </table>
                                            </div>
                                        </p>
                                    </div>
                                    <div class="col-md-4 mb-4">   
                                    <?php if (!empty($row['photo'])): ?>                                
                                    <img class="card-img-top" src="forms/<?php echo $row['photo']; ?>" alt="Food Image">
                                    <?php else: ?>  
                                    <img class="card-img-top" src="assets/img/menu/sample.png" alt="Food Image">
                                    <?php endif; ?> 
                                    </div>
                                    <div class="col-md-12 mb-4" id="map-<?php echo $row['id']; ?>" style="height: 400px;">
                                        <div class="mb-5">
                                        <?php
                                           $loc = explode(' ',htmlspecialchars($row['location']));
                                           $map_location ="https://maps.google.com/maps?q=". implode("+",$loc)."&t=&z=13&ie=UTF8&iwloc=&output=embed";?>
                                        <div class="mapouter"><div class="gmap_canvas"><iframe style="width: 100%; height: 400px;" id="gmap_canvas" src=<?php echo $map_location;?> frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://textcaseconvert.com"></a><br><a href="https://www.intimer.net"></a><br><style>.mapouter{position: relative;text-align: right;height: 400px;width: 100%;}</style><style>.gmap_canvas{overflow: hidden;background: none !important;height: 400px;width: 100%;}</style></div></div>
                                        
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                            
                    <script>
                        function initMap<?php echo $row['id']; ?>() {
                            var location = {lat: <?php echo $row['lat']; ?>, lng: <?php echo $row['longi']; ?>};
                            var map = new google.maps.Map(document.getElementById('map-<?php echo $row['id']; ?>'), {
                                zoom: 15,
                                center: location
                            });
                            var marker = new google.maps.Marker({
                                position: location,
                                map: map
                            });
                        }
                        google.maps.event.addDomListener(window, 'load', initMap<?php echo $row['id']; ?>);
                    </script>
                <?php endwhile; ?>
          
        <?php endif; ?>
       
        <hr>

        <h2 class="my-4">Request Food</h2>
        <?php if($req_qty < $qty){ ?>
        <form action="viewfood.php?id=<?php echo $food_id;?>" class="row g-3" method="post">
        <div class="form-group col-md-6">              
                <input type="hidden" class="form-control" id="food_id" name="food_id" value="<?php echo $food_id;?>">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group col-md-6">              
                <input type="text" class="form-control" id="location" name="location" placeholder="Location" required>
            </div>
            <div class="form-group col-md-6">              
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" required>
            </div>
            <div class="form-group col-md-6">               
                <input type="number" class="form-control" id="req_qty" name="req_qty" placeholder="Required Quantity" required max="<?php echo $qty-$req_qty;?>">
            </div>
            <div class="form-group">
                <label for="message">Message (Optional)</label>
                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
            </div>
            <br/>
            <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
        <?php }else{ ?>
            "Sorry we already we have recived maximum requests."
        <?php } ?>
        <hr>

        <h2 class="my-4">Responses</h2>
        <?php if (isset($result1->num_rows) && $result1->num_rows > 0): ?>
            <ul class="list-group">
                <?php while($row = $result1->fetch_assoc()): ?>
                    <li class="list-group-item">
                        <strong><?php echo $row["name"]; ?></strong>  has requested <?php echo $row["req_qty"]; ?>  quantity, from  <?php echo $row["location"]; ?>                      
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No Responses yet.</p>
        <?php endif; ?>
        
    </div>
</div>
<br/>
</main>

<footer id="footer" class="footer">

  <div class="container">
    <div class="row gy-3">
      <div class="col-lg-3 col-md-6 d-flex">
        <i class="bi bi-geo-alt icon"></i>
        <div class="address">
          <h4>Address</h4>
          <p>A108 Adam Street</p>
          <p>New York, NY 535022</p>
          <p></p>
        </div>

      </div>

      <div class="col-lg-3 col-md-6 d-flex">
        <i class="bi bi-telephone icon"></i>
        <div>
          <h4>Contact</h4>
          <p>
            <strong>Phone:</strong> <span>+1 5589 55488 55</span><br>
            <strong>Email:</strong> <span>info@example.com</span><br>
          </p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-flex">
        <i class="bi bi-clock icon"></i>
        <div>
          <h4>Opening Hours</h4>
          <p>
            <strong>Mon-Sat:</strong> <span>11AM - 23PM</span><br>
            <strong>Sunday</strong>: <span>Closed</span>
          </p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <h4>Follow Us</h4>
        <div class="social-links d-flex">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>

    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© <span>Copyright</span> <strong class="px-1 sitename">Yummy</strong> <span>All Rights Reserved</span></p>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you've purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>
<?php
$conn->close();
?>