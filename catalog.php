<?php $active = "catalog"; ?>
<?php
/**
 * This page will list all champions in the game (filterable) and allow you to drill down to a specific champion page.
 */

include '_header.php';
include '_connect.php';
include 'css/_common_styles.php';

$sql = <<<SQL
SELECT * FROM champions
SQL;

if (!$result = mysqli_query($db_connection, $sql)) {
    die('There was an error running the query [' . mysqli_error($db_connection) . ']');
}

$num_champions = $result->num_rows;
?>

<div class="page-body">
    <div class="title-header">
        <select>
            <option value="all">All</option>
            <option value="myList">My List</option>
            <option value="myCollection">My Collection</option>
            <option value="myWishList">My Wish List</option>
        </select>
    </div>
    <div class="catalog-list">
        <table>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-2 champion-icon">';
                echo '<figure>';
                echo '<div style="width: 120px">';
                echo '<a href="champion.php?id=' . $row['id'] . '">';
                echo '<img src=' . $row['icon_img_url'] . ' href="" style="align-content: center">';
                echo '</a>';
                echo '<figcaption style="align-content: center">' . $row['name'] . '</figcaption>';
                echo '</div>';
                echo '</figure>';
                echo '</div>';
            }
            ?>
        </table>
    </div>
</div>