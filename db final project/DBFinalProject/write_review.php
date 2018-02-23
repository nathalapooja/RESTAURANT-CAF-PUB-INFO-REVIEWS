<?php
/**
 * Created by PhpStorm.
 * User: keljo
 * Date: 4/27/2017
 * Time: 3:35 PM
 */

require_once './resources/php/db_connect.php';

$restaurant_id = $_GET["id"];

//get restaurants info from DB
$restaurant_query = "SELECT business.business_name, business.business_id
                      FROM restaurant.business;";
$restaurant_stmt = $mysqli->prepare($restaurant_query);
$restaurant_stmt->execute();
$restaurant_result = $restaurant_stmt->get_result();

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
            background: url("resources/img/writing.jpg");
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
                <li class="active"><a href="./write_review.php">Write Review</a></li>
                <li><a href="./about.php">About</a></li>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1>
            Contribute!
        </h1>
        <p>Add a review of a restaurant you've visited!</p>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

            <form method="POST" action="resources/php/insert_review.php">

                <div class="form-group">
                    <label for="restaurant">Select a Restaurant:</label>
                    <select class="form-control" name="restaurant_id" id="restaurant_id">
                        <?php
                            while($restaurant_info = $restaurant_result->fetch_assoc()){
                                if( $restaurant_info["business_id"] == $restaurant_id ){
                                    echo '<option value="',$restaurant_info["business_id"],'" selected>',$restaurant_info["business_name"],'</option>';
                                }else{
                                    echo '<option value="',$restaurant_info["business_id"],'">',$restaurant_info["business_name"],'</option>';
                                }

                            }
                        ?>
                    </select>
                </div>

                <div class="form-inline">
                    <div class="form-group">
                        <label for="rating">Your Rating: </label>
                        <select class="form-control" id="rating" name="rating">
                            <?php $i = 0;
                                while($i <= 5){
                                    echo '<option value="',$i,'">',$i,'</option>';
                                    $i++;
                                }
                            ?>
                        </select><span class="glyphicon glyphicon-star"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">Write your Review:</label>
                    <textarea class="form-control" name="content" id="content" rows="5" placeholder="Write your review here.."></textarea>
                </div>

                <button type="submit" class="btn btn-primary pull-right">Submit Review &nbsp; <span class="glyphicon glyphicon-send"></span></button>

            </form>

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

