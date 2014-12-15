<?php $active = "index"; ?>
<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<link rel="stylesheet" href="css/dark_styles.css"/>

<!--
 There is nothing clever about this code -- it is copied exactly from the example in the Twitter Bootstrap
 developer notes at http://getbootstrap.com/javascript/#carousel
 -->
<div id="main-carousel" class="carousel slide" data-ride="carousel"
     style="width:800px; height: 120px; margin: 0 auto">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#main-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#main-carousel" data-slide-to="1"></li>
        <li data-target="#main-carousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="img/carousel/1.png" alt="image1">

            <div class="carousel-caption">
                Gilgamesh fights the dragon
            </div>
        </div>
        <div class="item">
            <img src="img/carousel/2.png" alt="image2">

            <div class="carousel-caption">
                Epic struggle for survival
            </div>
        </div>
        <div class="item">
            <img src="img/carousel/3.png" alt="image3">

            <div class="carousel-caption">
                Clan vs clan, armed to the teeth!
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#main-carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="row">
    <div class="col-md-3" style="padding: 5px">
        <h3>We offer your favorites</h3>

        <p>Your choice of skins!</p>

        <p>League of Legends is a fast-paced, competitive online game that blends the speed
            and intensity of an RTS with RPG elements. Two teams of powerful champions, each with
            a unique design and playstyle, battle head-to-head across multiple battlefields and game
            modes. With an ever-expanding roster of champions, frequent updates and a thriving tournament
            scene, League of Legends offers endless replayability for players of every skill level..
        </p>
    </div>
    <div class="col-md-7 col-md-offset-1" style="padding: 5px">
        <?php
        $sql = <<<SQL
    SELECT *
    FROM news
    ORDER BY date_created DESC
SQL;

        if (!$result = mysqli_query($db_connection, $sql)) {
            die('There was an error running the query [' . mysqli_error($db_connection) . ']');
        }
        while ($row = $result->fetch_assoc()) {
            echo '<div>';
            echo '<h4>' . date("F j, Y", strtotime($row['date_created'])) . '</h4>';
            echo '<p>' . $row['message'] . '</p>';
            echo '</div>';
        }?>

    </div>
</div>

<script>
    $(document).ready(function () {
        $('.carousel').carousel();
    });
</script>

<?php include '_footer.php'; ?>
