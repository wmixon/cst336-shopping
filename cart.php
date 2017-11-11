<?php
    session_start();
    echo "<link rel='stylesheet' href='styles.css'>";
    include 'dbConnection.php';

    $con = getDatabaseConnection('heroku_87e7042268995be');
        
        $id = implode(',' , $_SESSION['cart']);
        
            echo"Item from Music category";
            $sql1 = "select * from music
                WHERE id IN ($id)";
            display($sql1, $con);
            
            echo"Item from Games category";
            $sql2 = "select * from games
                WHERE id IN ($id)";
            display($sql2, $con);
            
            echo"Item from Films category";
            $sql3 = "select * from films
                WHERE id IN ($id)";
            display($sql3, $con);
        
        //function to display table in the shoping cart
        function display($sql, $con){
            
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
                // this will be where we display the description
                // "<td><a href=\"itemInfo.php?name=".$result['Title']. "&id=" ."\">" . $result['Creator'] ."</a></td>";
                echo "<td>".$result['id']."</td>";
                echo "<td>".$result['Title']."</td>";
                echo "<td>".$result['Creator']."</td>";
                echo "<td>".$result['Quantity']."</td>";
                echo "<td>".$result['Price']."</td>";
                
                echo "</tr>";
            }
            echo "</table>";
        }
    
?>
<form form action="./index.php" method="get" >
            <input type="submit" value="Click to Go Back Home Page!">
</form>