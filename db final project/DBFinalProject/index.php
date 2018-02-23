<?php

require_once './resources/php/db_connect.php';

//get restaurant info from DB
$restaurant_query = "SELECT business.business_name, business.business_id, ROUND(AVG(review.stars),1) AS avg_rating, COUNT(review.review_id) AS num_reviews
                      FROM restaurant.business 
                      LEFT JOIN restaurant.review ON business.business_id = review.business_id
                      GROUP BY business.business_id
                      ORDER BY avg_rating DESC;";
$restaurant__stmt = $mysqli->prepare($restaurant_query);
$restaurant__stmt->execute();
$restaurant_result = $restaurant__stmt->get_result();

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
                <li class="active"><a>Home</a></li>
                <li><a href="./write_review.php">Write Review</a></li>
                <li><a href="./about.php">About</a></li>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1>Restaurant Reviews!</h1>
        <p>This is a simple example website for a restaurant review system created by our group for 6160 DB Systems</p>
        <p><a class="btn btn-primary btn-lg" href="./about.php" role="button">Learn more &raquo;</a></p>
    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <?php
            while($restaurant_info = $restaurant_result->fetch_assoc()){ ?>
                <div class="col-md-4">
                    <div class="well">
                        <h4><?php echo $restaurant_info["business_name"]; ?></h4>
                        <p>Average Rating: <?php echo $restaurant_info["avg_rating"]; ?> <span class="glyphicon glyphicon-star"></span></p>
                        <p>Number of Reviews: <?php echo $restaurant_info["num_reviews"]; ?></p>
                        <p><a class="btn btn-default" href="./view_restaurant.php?id=<?php echo $restaurant_info["business_id"]; ?>" role="button">View Reviews &raquo;</a></p>
                    </div>
                </div>
        <?php
            }//end while
        ?>
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
