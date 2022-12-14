<?php
    session_start();
    if(!isset($_SESSION['status'])){
        echo "<script>alert('Please sign back in')</script>";
        header("location:index.php");
    }
    $user_id = $_SESSION['s_id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sys";
    $total =0;

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>eCommerce | Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid py-5  bg-primary text-white text-center">
        <h1>PC MasteRace.COM</h1>
            <p>Buy All You Need To Build Your Perfect PC</p> 
        </div>
        <div>
        <nav class=".container-fluid navbar navbar-expand-sm navbar-light sticky-top" style="background-color: #e3f2fd">
            <div class="container-fluid">
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav-pills nav-fills " id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="../User/catalog.php">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="cart_user.php">Cart</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../index.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container col-9  p-3 ">
        <?php
            $sql = "SELECT * FROM cart JOIN product ON cart.p_id=product.p_id WHERE cart.u_id=$user_id";

            $result = mysqli_query($conn, $sql);

                if ($result->num_rows > 0) { 
                $list = 0;
                // output data of each row
                echo '<table class="table table-hover my-3 text-center">
                <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price (RM)</th>
                <th class="">Descriptions</th>
                <th>Images</th>
                <th class="">Action</th>
                </tr>';
                while($row = mysqli_fetch_assoc($result))
                {   
                    $pic= $row["p_image"];
                    $qtyprice = $row["p_price"];
                    $total += $qtyprice*$row["c_qty"];
                    echo '<tr>
                    <td>'.$row["p_name"].'</td>
                    <td>'.$row["c_qty"].' X '.$row["p_price"].'</td>
                    <td>'.$qtyprice*$row["c_qty"].'</td>
                    <td class="text-start mx-4">'.$row["p_details"].'</td>
                    <td><img src="../../eComProd/'.$pic.'" style="width:100px"></td>
                    <td> '
                    ?>
                    <form method="post" action="cartdelete.php">
                        <input class="btn btn-danger  " type="submit" name="action" value="Remove"/>
                        <input type="hidden" name="iddelete" value="<?php echo $row['c_id']; ?>"/>
                    </form>    
                    <?php 
                    '</td></tr>';
                    
                }
                echo '</table>';
            } else {
                echo "<h4>No Item in Cart</h4>";
            }   
        ?>
        <p><b>Price to Checkout: RM <?php echo $total ?></b> </p>
        <form action="receipt.php" method="post">
            <input type="submit" class="btn btn-warning float-end my-2" name=checkout value="Checkout >">
        </form>
    </div>
    
</body>
</html>