<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Title</title>
    <!--    StyleSheet links.-->
    <?php
      include 'php/custom/included_pages/meta_data.php';
      include 'php/custom/sessions.php';
      include 'php/custom/included_pages/common_styles.php';
    ?>
    <!-- Custom Style Sheets. -->
    <link rel="stylesheet" href="css/custom/cart.css">
</head>
<body>
    <?php
        // Nav Bar.
        include 'php/custom/included_pages/nav.php';

      if(isset($_GET['msg'])){
        echo '
        <div id="error-alert" class="alert alert-danger text-center" role="alert">
          '. $_GET['msg'] .'
        </div>
        ';
      }
    ?>


    <div id="wrapper" class="container">
          <?php
          // Get array from sessions iterate through array and display
          // in table along with price and other meta data.
          include 'php/custom/included_pages/db_connection.php';

          if(!isset($_SESSION['cart-items'])){
            // Show empty message and encourage, users to shop.
            echo '<div class="style-caption"><p class="lead">Shopping cart.</p></div>
                  <div class="empty-cart">
                    <img src="media/images/cart.svg" alt="cart-image" height="170vh" width="170vw">
                    <p class="lead empty-cart-text">Empty Cart</p>
                  </div>';
          }else{
            $cart_items = $_SESSION['cart-items'];
            // unset($_SESSION['cart-items']);
            // session_destroy();

            if(empty($cart_items)){
              echo '<div class="style-caption"><p class="lead">Shopping cart.</p></div>
                    <div class="empty-cart">
                      <img src="media/images/cart.svg" alt="cart-image" height="170vh" width="170vw">
                      <p class="lead empty-cart-text">Empty Cart</p>
                    </div>';
            } else{


              $placeholder = "";
              $quanties = [];
              foreach ($cart_items as $value) {
                $placeholder .= json_decode($value, true)['id'].",";
                array_push($quanties, json_decode($value, true)['quantity']);
              }
              $placeholder = trim($placeholder, ',');

              $sql = "SELECT * FROM brand WHERE brand_id in ($placeholder);";

              $stmt = $pdo->prepare($sql);
              $stmt->execute();
              $stmt = $stmt->fetchAll();

              $total = 0;

              $element = '<div class="style-caption"><p class="lead">Shopping cart.</p></div>

                          <table class="table table-hover table-responsive-sm">
                            <thead class="thead-light">
                              <tr>
                                <th class="table-items" scope="col">Items</th>
                                <th class="table-price" scope="col">Price</th>
                                <th class="table-quantity" scope="col">Quantity</th>
                                <th class="table-total" scope="col">Total</th>
                                <th class="remove" scope="col">Remove</th>
                              </tr>
                            </thead>

                            <tbody>';

              if ($stmt !== null){
                $rows = [];
                foreach ($stmt as $row) {
                  array_push($rows, $row);
                }
                  for ($i=0; $i < sizeof($stmt); $i++) { 
                    # code...
                  $element .= '<tr>
                                  <td class="table-items">'.$rows[$i]['brand_name'].'</td>
                                  <td class="table-price">Ghc '.$rows[$i]['brand_price'].'</td>
                                  <td class="table-quantity">'.$quanties[$i].'</td>
                                  <td class="table-total">Ghc '.($rows[$i]['brand_price']*$quanties[$i]).'</td>
                                  <td class="remove">
                                    <form class="" action="php/custom/cart-processor.php?action=remove&item_id='.$row['brand_id'].'" method="post">
                                      <button class="btn remove-btn" type="submit" name="button">
                                       <img src="media/images/dustbin.png" alt="remove-item" width="32px" height="32px">
                                      </button>
                                    </form>
                                  </td>
                                </tr>';
                  $total += $rows[$i]['brand_price'] * $quanties[$i];
                }

              $element .= '</tbody>
                            <tfoot>
                              <tr class="table-footer">
                                <td colspan="2"></td>
                                <th class="text-center">Total</th>
                                <th class="text-center">Ghc ';

              $element .= $total;

              $element .=  '</th>
                                  <td class="remove clear-btn-container">
                                    <form class="remove-all-form" action="php/custom/cart-processor.php?action=remove_all" method="post">
                                      <button class="btn cart-remove-button" type="submit" name="button">Clear Cart</button>
                                    </form>
                                  </td>
                                </tr>
                              </tfoot>
                            </table>';
            }
            $element .= '<p class="float-right">
                          <a href="checkout.php" class="">Check Out &#x2192;</a>
                        </p>
                        <br />';

            echo $element;
          }

          // Storing total price in SESSIONS.
          if (!isset($_SESSION['total_price'])) {
            $_SESSION['total_price'] = $total;
          }

          }

          ?>


</div>



    <!-- Do not remove this footer page and replace with included footer using .php file yet yet. -->
    <?php
        // TODO: Must fix the positioning of the footer to work universally in all templates.
        // Footer.
        include 'php/custom/included_pages/footer.php';
    ?>

    <!-- JavaScript Frameworks and libraries. -->
    <?php include 'php/custom/included_pages/common_js.php'; ?>
    <script src="js/custom/modal.js" charset="utf-8"></script>

    <!-- JavaScript Frameworks and libraries. -->
    <?php include 'php/custom/included_pages/common_js.php'; ?>
    <script src="js/custom/modal.js" charset="utf-8"></script>
</body>
  </body>
</html>
