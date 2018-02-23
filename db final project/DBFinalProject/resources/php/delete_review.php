<?php

require_once './db_connect.php';

//get post variables
$review_id =  $_POST["review_id"];
$restaurant_id =  $_POST["restaurant_id"];


/*
 * delete review record from DB
 */
$review_query = "DELETE FROM restaurant.review  WHERE review_id = ? LIMIT 1;";
$review__stmt = $mysqli->prepare($review_query);
$review__stmt->bind_param('i',$review_id);
$review__stmt->execute();
$review__stmt->close();

header("Location: ../../view_restaurant.php?id=".$restaurant_id);

require_once './db_disconnect.php';