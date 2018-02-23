<?php

require_once './db_connect.php';

//get post variables
$review_id =  $_POST["review_id"];
$restaurant_id =  $_POST["restaurant_id"];
$rating = $_POST["rating"];
$content = $_POST["review"];

//if review text is empty skip DB insertion
if( empty($content) || $content == "" ){
    header("Location: ../../edit_review.php?id=".$review_id);
}

/*
 * update review record to DB
 */
$review_query = "UPDATE restaurant.review SET content = ?, stars = ? WHERE  review_id = ?;";
$review__stmt = $mysqli->prepare($review_query);
$review__stmt->bind_param('sii',$content,$rating,$review_id);
$review__stmt->execute();
$review__stmt->close();

header("Location: ../../view_restaurant.php?id=".$restaurant_id);

require_once './db_disconnect.php';