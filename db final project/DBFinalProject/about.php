<?php

require_once './resources/php/db_connect.php';

//get restaurant info from DB
$restaurant_query = "SELECT business.business_name, business.business_id, ROUND(AVG(review.stars),1) AS avg_rating 
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
            background: url("resources/img/code.jpg");
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
                <li><a href="./index.php">Home</a></li>
                <li><a href="./write_review.php">Write Review</a></li>
                <li class="active"><a href="./about.php">About</a></li>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<div class="jumbotron">
    <div class="container">
        <h1>About our project</h1>
        <p>Example website for a restaurant review system created for 6160 DB Systems</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">
            <div class="well">
                <h2>Group Members</h2><hr />
                <ul class="list-group">
                    <li class="list-group-item">Kasey Eljoundi</li>
                    <li class="list-group-item">Sai Kiran Mankena</li>
                    <li class="list-group-item">Varchasvi Verma</li>
                    <li class="list-group-item">Amulya Kamshetty</li>
                    <li class="list-group-item">Jasleen Arora</li>
                    <li class="list-group-item">Pooja Reddy Nathala</li>
                </ul>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="well">
                <h2>Implementation Info</h2><hr />
                <div class="list-group">
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">Database</h4>
                        <p class="list-group-item-text">MYSQL database</p>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">Server Language</h4>
                        <p class="list-group-item-text">PHP backend</p>
                        <p class="list-group-item-text">DB connection uses mysqli and prepared statements</p>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">Web Design</h4>
                        <p class="list-group-item-text">HTML written from scratch, CSS Styling provided by <a href="http://getbootstrap.com">Twitter Bootstrap</a></p>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">Miscellaneous</h4>
                        <p class="list-group-item-text">All photos are free, stock photos from <a href="http://pexels.com">Pexels</a></p>
                    </div>
                </div>
            </div>
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
