<?php
include "./simple_html_dom.php";
$search_keyword = $_GET['Title'];
$search_keyword=str_replace(' ','+',$search_keyword);
$newhtml = file_get_html("https://www.google.com/search?q=".$search_keyword."&tbm=isch");
$result_image_source = $newhtml->find('img', 0)->src;

?>
<!DOCTYPE html>
    <head>
    	<link rel="stylesheet" href="styles.css">
    </head>
        <body>
    	<div id = "wrapper">
    	<h2 style="color: black"><?php echo $_GET['Title']; ?></h2>
    	<?php echo '<img src="'.$result_image_source.'">' ?>
    	<br>
        <h2>Directed by: </h2>
        <?php echo $_GET['Creator']; ?>
        <br>
        <h2>Description:</h2>
        <?php echo $_GET['Description']; ?>
        <br>
        <h2>Price: </h2>
        <?php echo "$" . $_GET['Price']; ?>
        <h2>Quantity:</h2>
        <?php echo $_GET['Quantity']; ?>
        <br><br>
        <?php 
            if($_GET['Quantity'] == 0){
                echo "<td> Out of Stock </td>";
            } else {
                echo "<td><a href=\"add-to-cart.php?name=".$_GET['name']. "&id=" .
                    $_GET['id']."\">Add to cart</a></td>";
            } ?>
        <br><br>
        <form form action="./index.php" method="get" >
            <input type="submit" value="Click to Go Back Home Page!">
        </form>
        <center></center>
        
        </body>
</html>