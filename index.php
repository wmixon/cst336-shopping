<?php 
include 'dbConnection.php';

$con = getDatabaseConnection('heroku_87e7042268995be');

function getItems(){
    global $con;
    $namedParameters = array();
    $results = null;
    if(isset($_GET['submit'])){
        $sql = "select * from films union select * from games union select * from music ";
        if(isset($_GET['category'])){
            $value = $_GET['category'];
            if($value == "films"){
                $sql = "select * from films";
            }elseif($value == "games"){
                $sql = "select * from games";
            }elseif($value == "music"){
                $sql = "select * from music";
            }
        }
        
        //Show only items that are available
        if (isset($_GET['status']) ) { 
            $sql .= " WHERE Quantity > 0  ";
        }
        //order items by price asc or desc
        if(isset($_GET['price'])){
            if($_GET['price'] == "asc"){
                $sql .=  " order by Price";
            }
            else{
                $sql .= " order by Price desc";
            }
        }

        $stmt = $con -> prepare ($sql);
        $stmt -> execute($namedParameters);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<table id=\"table1\">
            <tr>
 	        <th>Title</th>
         	<th>Creator</th>
         	<th>Quantity (in stock)</th>
         	<th>Price</th>
         	<th></th>
         </tr>";
        foreach($results as $result) {
            echo "<tr>";
            echo "<td><a href=\"info.php?name=".$result['name']. "&id=" . 
                $result['id'] . "&Title=" . 
                $result['Title'] . "&Creator=" . 
                $result['Creator'] . "&Description=" . 
                $result['Description'] . "&Quantity=" . 
                $result['Quantity'] . "&Price=" . 
                $result['Price']."\">" . $result['Title'] . "</a></td>";
            echo "<td>".$result['Creator']."</td>";
            echo "<td>".$result['Quantity']."</td>";
            echo "<td>".$result['Price']."</td>";
            echo "<td><a href=\"add-to-cart.php?name=".$result['name']. "&id=" .
                    $result['id']."\">Add to cart</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

?>
<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div id = "wrapper">
	<h2 style="color: black"> Games, Movies, and Music</h2></h2>
<form id="indexForm">
	<br /> <br />
    
    <!--I was thinking we can use category to pick the table, but I just get errors when I try to use a variable-->
    <!--or named parameter for table in sql statement-->
    Category: <input type="radio" name="category" value="films" ><label for="films"> Films </label>
            <input type="radio" name="category" value="games" > <label for="games">  Games </label>
            <input type="radio" name="category" value="music" > <label for="music">  Music </label>
    <br />
    <input type="checkbox" name="status" id="status"/>
    <label for="status"> Show Available Items Only </label>

    <br />
    <label for="price">Sort by:</label>
    <input type="radio" name="price" value="asc"> Ascending
  	<input type="radio" name="price" value="desc"> Descending
  	<input type="submit" value="Search" name="submit" />

</form>
<form id='cart' form action="./cart.php" method="get" >
            <input type="submit" value="Cart">
</form>

<br />
<br />
<br />
<center>

 	<?php 
 	  getItems();
    ?>
	
 </center>

 </div>
</body>

 </html>
