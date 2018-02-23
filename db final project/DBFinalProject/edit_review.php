<?php
/**
 * Created by PhpStorm.
 * User: keljo
 * Date: 4/27/2017
 * Time: 3:35 PM
 */

require_once './resources/php/db_connect.php';

$review_id = $_GET['id'];

//get reviews
$review_query = "SELECT review.review_id, review.content, review.stars, business.business_name, business.business_id
                  FROM restaurant.review 
                  LEFT JOIN restaurant.business ON review.business_id = business.business_id
                  WHERE review.review_id = ?;";
$review__stmt = $mysqli->prepare($review_query);
$review__stmt->bind_param('i',$review_id);
$review__stmt->execute();
$review_result = $review__stmt->get_result();
$review_info = $review_result->fetch_assoc();
$review__stmt->close();

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

<div class="jumbotron">
    <div class="container">
        <h1>
            Update your review!
        </h1>
        <p>Change your review rating and/or content!</p>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

            <form method="POST" action="./resources/php/update_review.php">

                <div class="form-group">
                    <label for="restaurant">Restaurant:</label>
                    <input type="text" class="form-control" readonly value="<?php echo $review_info["business_name"]; ?>" />
                </div>

                <div class="form-inline">
                    <div class="form-group">
                        <label for="rating">Your Rating: </label>
                        <select class="form-control" id="rating" name="rating">
                            <?php $i = 0;
                            while($i <= 5){
                                if($review_info["stars"] == $i){
                                    echo '<option value="',$i,'" selected>',$i,'</option>';
                                }else{
                                    echo '<option value="',$i,'">',$i,'</option>';
                                }
                                $i++;
                            }
                            ?>
                        </select><span class="glyphicon glyphicon-star"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="review">Update your Review:</label>
                    <textarea class="form-control" name="review" id="review" rows="5"><?php echo $review_info["content"]; ?></textarea>
                </div>

                <input type="hidden" name="review_id" value="<?php echo $review_info["review_id"]; ?>" />
                <input type="hidden" name="restaurant_id" value="<?php echo $review_info["business_id"]; ?>" />
                <button type="submit" class="btn btn-primary pull-right">Submit Changes &nbsp; <span class="glyphicon glyphicon-send"></span></button>

            </form>

            <form method="POST" action="./resources/php/delete_review.php">
                <input type="hidden" name="review_id" value="<?php echo $review_info["review_id"]; ?>" />
                <input type="hidden" name="restaurant_id" value="<?php echo $review_info["business_id"]; ?>" />
                <button type="submit" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-trash"></span> &nbsp; Delete Review</button>&nbsp;
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

