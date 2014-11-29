<?php
/**
 * Created by PhpStorm.
 * User: Brandon
 * Date: 11/28/2014
 * Time: 5:58 PM
 *
 * This page will list all champion in the game (filterable) to allow you to drill down to a specific champion page.
 */

include '_header.php';
include 'css/_common_styles.php';

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
            <tr>
                <td class="champion-icon">
                    <figure>
                        <img src="http://www.mobafire.com/images/champion/icon/leona.png" href="champion.php">
                        <figcaption style="align-content: center">Leona</figcaption>
                    </figure>
                </td>
                <td class="champion-icon">
                    <figure>
                        <img src="http://www.mobafire.com/images/champion/icon/ahri.png" href="champion.php">
                        <figcaption style="align-content: center">Ahri</figcaption>
                    </figure>
                </td>
                <td class="champion-icon">
                    <figure>
                        <img src="http://www.mobafire.com/images/champion/icon/diana.png" href="champion.php">
                        <figcaption style="align-content: center">Diana</figcaption>
                    </figure>
                </td>
                <td class="champion-icon">
                    <figure>
                        <img src="http://www.mobafire.com/images/champion/icon/jarvan-iv.png" href="champion.php">
                        <figcaption style="align-content: center">Jarvan</figcaption>
                    </figure>
                </td>
                <td class="champion-icon">
                    <figure>
                        <img src="http://www.mobafire.com/images/champion/icon/vi.png" href="champion.php">
                        <figcaption style="align-content: center">Vi</figcaption>
                    </figure>
                </td>
                <td class="champion-icon">
                    <figure>
                        <img src="http://www.mobafire.com/images/champion/icon/morgana.png" href="champion.php">
                        <figcaption style="align-content: center">Morgana</figcaption>
                    </figure>
                </td>
                <td class="champion-icon">
                    <figure>
                        <img src="http://www.mobafire.com/images/champion/icon/varus.png" href="champion.php">
                        <figcaption style="align-content: center">Varus</figcaption>
                    </figure>
                </td>
                <td class="champion-icon">
                    <figure>
                        <img src="http://www.mobafire.com/images/champion/icon/kalista.png" href="champion.php">
                        <figcaption style="align-content: center">Kalista</figcaption>
                    </figure>
                </td>
            </tr>
        </table>
    </div>
</div>