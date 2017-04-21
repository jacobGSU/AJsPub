<?php
  require_once('database.php');

  date_default_timezone_set("America/New_York");
  $time_stamp = time();

  $first_name = $_POST["fname"];
  $last_name = $_POST["lname"];
  $email = $_POST["email"];
  $phone_number = $_POST["number1"] . $_POST["number2"] . $_POST["number3"];
  $comment = $_POST["comment"];

  switch($_POST["entre"]){
    case "ribeye_steak":
      $entre = "Ribeye Steak";
      $entre_price = 14.99;
      break;
    case "baby_back_ribs":
      $entre_db = "Baby Back Ribs";
      $entre_price = 11.99;
      break;
    case "crab_legs":
      $entre = "Crab Legs";
      $entre_price = 21.99;
      break;
    case "shrimp":
      $entre = "Shrimp";
      $entre_price = 15.99;
      break;
    case "oysters":
      $entre = "Oysters";
      $entre_price = 10.99;
      break;
    case "hungry_man_hamburger":
      $entre = "Hungry Man Hamburger";
      $entre_price = 13.99;
      break;
    case "grande_nachos":
      $entre = "Grande Nachos";
      $entre_price = 7.99;
      break;
    case "chef_salad":
      $entre = "Chef Salad";
      $entre_price = 9.99;
      break;
    case "sliders":
      $entre = "Sliders";
      $entre_price = 12.99;
      break;
    default:
      $entre = "nothing";
      $entre_price = 0.00;
  }

  switch($_POST["side"]){
    case "fries":
      $side = "Fries";
      $side_price = 1.99;
      break;
    case "chips":
      $side = "Chips";
      $side_price = 1.99;
      break;
    case "salad":
      $side = "Salad";
      $side_price = 2.99;
      break;
    case "mac_n_cheese":
      $side = "Mac N Cheese";
      $side_price = 3.99;
      break;
    case "cole_slaw":
      $side = "Cole Slaw";
      $side_price = 1.99;
      break;
    default:
      $side = "nothing";
      $side_price = 0.00;
  }

  switch($_POST["drink"]){
    case "water":
      $drink = "Bottled Water";
      $drink_price = 0.99;
      break;
    case "sweet_tea":
      $drink = "Sweet Tea";
      $drink_price = 1.99;
      break;
    case "unsweet_tea":
      $drink = "Unsweet Tea";
      $drink_price = 1.99;
      break;
    case "coca_cola":
      $drink = "Coca Cola";
      $drink_price = 1.99;
      break;
    case "diet_coke":
      $drink = "Diet Coke";
      $drink_price = 1.99;
      break;
  }

  $total_price = $entre_price + $side_price + $drink_price;

  // INSERT ORDER

  $insert_order = "INSERT INTO orders (first_name, last_name, email, phone_number, comment, time_stamp)
                VALUES (:first_name, :last_name, :email, :phone_number, :comment, :time_stamp)";
  $insert_order_array = array(
    "first_name" => $first_name,
    "last_name" => $last_name,
    "email" => $email,
    "phone_number" => $phone_number,
    "comment" => $comment,
    "time_stamp" => $time_stamp
  );

  try {
    $stmt_order = $db->prepare($insert_order);
    $stmt_order->execute($insert_order_array);
  } catch(Exception $e){
    echo $e -> getMessage();
    die();
  }

  // GET CURRENT ORDER ID

  $stmt_sql_oid = "SELECT max(order_id) FROM orders";
  $stmt_order_id = $db->query($stmt_sql_oid);
  $row = $stmt_order_id->fetch(PDO::FETCH_ASSOC);
  $current_order_id = (int)$row['max(order_id)'];

  // INSERT ENTRE

  $insert_entre = "INSERT INTO items (order_id, item_name, price) VALUES
    (:current_order_id, :entre, :entre_price)";
  $insert_entre_array = array(
    "current_order_id" => $current_order_id,
    "entre" => $entre,
    "entre_price" => $entre_price
  );

  try {
    $stmt_entre = $db->prepare($insert_entre);
    $stmt_entre->execute($insert_entre_array);
  } catch(Exception $e){
    echo $e -> getMessage();
    die();
  }

  // INSERT SIDE

  $insert_side = "INSERT INTO items (order_id, item_name, price) VALUES
    (:current_order_id, :side, :side_price)";
  $insert_side_array = array(
    "current_order_id" => $current_order_id,
    "side" => $side,
    "side_price" => $side_price
  );

  try {
    $stmt_side = $db->prepare($insert_side);
    $stmt_side->execute($insert_side_array);
  } catch(Exception $e){
    echo $e -> getMessage();
    die();
  }

  // INSERT DRINK

  $insert_drink = "INSERT INTO items (order_id, item_name, price) VALUES
    (:current_order_id, :drink, :drink_price)";
  $insert_drink_array = array(
    "current_order_id" => $current_order_id,
    "drink" => $drink,
    "drink_price" => $drink_price
  );

  try {
    $stmt_drink = $db->prepare($insert_drink);
    $stmt_drink->execute($insert_drink_array);
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

      <h1>Thank you, <?php echo $first_name . " " .$last_name . "!"?></h1>
      <h1>Your order was placed at: <?php echo(date("h:i A",$time_stamp)); ?></h1>
      <h2>Your Order: </h2>
      <ul>
        <li><h3><?php echo $entre . " - $" . $entre_price ?></h3></li>
        <li><h3><?php echo $side . " - $" . $side_price ?></h3></li>
        <li><h3><?php echo $drink . " - $" . $drink_price ?></h3></li>
      </ul>
      <h2>Comments: </h2>
      <h3><?php echo $comment ?></h3>
      <h2>Your Total: </h2>
      <h3>$<?php echo $total_price ?></h3>

      <h2>Your Info:</h2>
      <ul>
        <li><h3><?php echo $email ?></h3></li>
        <li><h3><?php echo "(" . $_POST["number1"] . ") " . $_POST["number2"] . "-" . $_POST["number3"] ?></h3></li>
      </ul>

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
