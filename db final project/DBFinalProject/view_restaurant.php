<?php
/**
 * Created by PhpStorm.
 * User: keljo
 * Date: 4/27/2017
 * Time: 3:35 PM
 */

require_once './resources/php/db_connect.php';

$restaurant_id = $_GET['id'];

//get restaurant info from DB
$restaurant_query = "SELECT business.business_name, business.hours, business.business_id,
                            (SELECT ROUND(AVG(stars),1) FROM restaurant.review WHERE review.business_id = ?) AS avg_rating 
                      FROM restaurant.business 
                      WHERE `business_id` = ?;";
$restaurant__stmt = $mysqli->prepare($restaurant_query);
$restaurant__stmt->bind_param('ii',$restaurant_id,$restaurant_id);
$restaurant__stmt->execute();
$restaurant_result = $restaurant__stmt->get_result();
$restaurant_info = $restaurant_result->fetch_assoc();

//get reviews
$review_query = "SELECT review.*, person.f_name, person.l_name
                  FROM restaurant.review 
                  LEFT JOIN restaurant.person ON review.user_id = person.user_id
                  WHERE review.business_id = ?;";
$review__stmt = $mysqli->prepare($review_query);
$review__stmt->bind_param('i',$restaurant_id);
$review__stmt->execute();
$review_result = $review__stmt->get_result();

require_once './resources/php/db_disconnect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Restaurant Reviews</title>

    <!-- Bootstrap core CSS -->
    <link href="./vendors/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .jumbotron{
            padding-top: 98px;
            background: url("resources/img/restaurant.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
        }
        .review-well{
            position: relative;
        }
        .review-well:hover .edit-review-btn{
            display: block;
        }
        .edit-review-btn{
            display: none;
            position: absolute;
            top: 0;
            right:0;
        }
    </style>

</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./index.php">6160 Restaurant Reviews</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./write_review.php">Write Review</a></li>
                <li><a href="./about.php">About</a></li>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1>
            <?php
                echo $restaurant_info["business_name"];
            ?>
        </h1>
        <p>Daily Hours: <?php echo $restaurant_info["hours"] ?></p>
        <p>Average Rating: <?php echo $restaurant_info["avg_rating"] ?></p>
    </div>
</div>

<div class="container">

    <div class="row">

        <div class="col-md-3">
            <a href="./write_review.php?id=<?php echo $restaurant_info["business_id"]; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Add a Review!</a>
        </div>

        <div class="col-md-6">

            <?php
                while($review = $review_result->fetch_assoc()){ ?>
                    <div class="row">
                        <div class="well review-well">
                            <a href="./edit_review.php?id=<?php echo $review["review_id"] ?>" class="btn btn-sm btn-warning edit-review-btn"><span class="glyphicon glyphicon-cog"></span></a>
                            <h3><?php $i=0; while($i<$review["stars"]){ echo '<span class="glyphicon glyphicon-star"></span>'; $i++; } ?></h3>
                            <h4>Review By: <?php echo $review["f_name"],' ',$review["l_name"]; ?></h4>
                            <p>
                                <?php echo $review["content"]; ?>
                            </p>
                            <p>
                                <small>
                                    Written <?php echo $review["published_date"]; ?>
                                </small>
                            </p>
                        </div>
                    </div>
                <?php
                }//end while
            ?>

        </div>
    </div>

    <hr>

    <footer>
        <p>&copy; 2016 Company, Inc.</p>
    </footer>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="./vendors/bootstrap-3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

