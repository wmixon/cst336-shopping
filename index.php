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
        echo "<table id=\"t01\">
            <tr>
            <th>Id</th>
 	        <th>Title</th>
         	<th>Creator</th>
         	<th>Quantity (in stock)</th>
         	<th>Price</th>
         	<th></th>
         </tr>";
        foreach($results as $result) {
            echo "<tr>";
            echo "<td>".$result['id']."</td>";
            // this will be where we display the description
            echo "<td><a href=\"itemInfo.php?name=".$result['Title']. "&id=" .
                        $result['id']."\">" . $result['Title'] ."</a></td>";
            echo "<td>".$result['Creator']."</td>";
            echo "<td>".$result['Quantity']."</td>";
            echo "<td>".$result['Price']."</td>";
            echo "<td><a href=\"cart.php?name=".$result['name']. "&id=" .
                    $result['id']."\">Add to cart</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

?>
<!DOCTYPE html>
