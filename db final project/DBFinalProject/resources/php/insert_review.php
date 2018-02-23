<?php

require_once './db_connect.php';

//get post variables
$restaurant_id =  $_POST["restaurant_id"];
$rating = $_POST["rating"];
$content = $_POST["content"];

//if review text is empty skip DB insertion
if( empty($content) || $content == "" ){
    header("Location: ../../write_review.php");
}

/*
 * insert review record to DB
 */
//uses user_id=1230 by default b/c we do not have login,etc set up for the scope of this project
$review_query = "INSERT INTO restaurant.review (business_id, user_id, content, published_date, stars) 
                  VALUES(?, 1230,?,NOW(),?);";
$review__stmt = $mysqli->prepare($review_query);
$review__stmt->bind_param('isi',$restaurant_id,$content,$rating);
$review__stmt->execute();
$review__stmt->close();

header("Location: ../../view_restaurant.php?id=".$restaurant_id);

require_once './db_disconnect.php';