<?php
  require_once('database.php');
  date_default_timezone_set("America/New_York");

  $select_order_query = "SELECT o.order_id, o.first_name, o.last_name, o.email, o.phone_number, o.comment, i.item_name, i.price, o.time_stamp
                  FROM orders AS o
                  INNER JOIN items as i
                  ON o.order_id = i.order_id";

  try {
    $results = $db->query($select_order_query);
    $orders = $results->fetchAll(PDO::FETCH_ASSOC);
  } catch(Exception $e){
    echo $e -> getMessage();
    die();
  }
?>

  <!DOCTYPE html>
  <html>
    <head>
      <title>AJ's Pub | Home</title>
      <link rel="stylesheet" href="stylesheet.css" />
      <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    </head>

    <body>
      <!-- ****** -->
      <!-- HEADER -->
      <!-- ****** -->
      <header>
        <h1 id ="logo">AJ's Pub</h1>
        <div id = "socialmedia">
          <a href="http://www.facebook.com"><img src="images/facebook.svg" alt="facebook"></a>
          <a href="http://www.twitter.com"><img src="images/twitter.svg" alt="twitter"></a>
          <a href="http://www.instagram.com"><img src="images/instagram.svg" alt="instagram"></a>
        </div>
        <nav>
          <ul id ="nav">
            <li><a href="index.html">Home</a></li>
            <li><a href="food.html">Food</a></li>
            <li><a href="drinks.html">Drinks</a></li>
            <li><a href="orderfood.html">Order Food</a></li>
          </ul>
        </nav>
      </header>

      <!-- ********* -->
      <!-- MAIN BODY -->
      <!-- ********* -->

      <h1>Order Management</h1>
      <table>
        <tr>
          <th>OrderID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Item</th>
          <th>Price</th>
          <th>Comment</th>
          <th>Time</th>
        </tr>
        <?php
        foreach($orders as $order){
          echo "<tr>";
          echo "<td><p>" . $order['order_id'] ."</p></td>";
          echo "<td><p>" . $order['first_name'] ."</p></td>";
          echo "<td><p>" . $order['last_name'] ."</p></td>";
          echo "<td><p>" . $order['email'] ."</p></td>";
          echo "<td><p>" . $order['phone_number'] ."</p></td>";
          echo "<td><p>" . $order['item_name'] ."</p></td>";
          echo "<td><p>" . "$". $order['price'] ."</p></td>";
          echo "<td><p>" . $order['comment'] ."</p></td>";
          echo "<td><p>" . date('m-d-Y // H:i:s A', $order['time_stamp']) ."</p></td>";
          echo "</tr>";
        }
        ?>
      <table>


      <!-- ****** -->
      <!-- FOOTER -->
      <!-- ****** -->

      <footer>
        <div id ="footerleft">
          <h2>Hours:</h2>
    				<p>Monday thru Friday, 11:00AM - 2:00AM</p>
    				<p>Saturday 11:00AM - 2:30PM</p>
    				<p>Sunday 11:00AM - 12:00PM</p>
        </div>

        <div id="footerright">
          <h2>Contact Us!</h2>
          <h3>AJ Bar is located at:</h3>
          <p>1234 Peachtree Road</p>
          <p>Atlanta, GA 30360</p>
          <p>(770) 123-4567</p>
        </div>

        <div id="footercenter">
          <ul id ="fmenu">
            <li><a href="index.html">Home</a></li>
            <li><a href="food.html">Food</a></li>
            <li><a href="drinks.html">Drinks</a></li>
            <li><a href="orderfood.html">Order Food</a></li>
          </ul>
        </div>
      </footer>
    </body>
  </html>
