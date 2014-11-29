<?php include '_header.php'; ?>
<?php include '_connect.php'; ?>

<h2>Our skin types are:</h2>

<div class="row">
    <?php
    $sql = <<<SQL
    SELECT *
    FROM skins
SQL;

    if (!$result = mysqli_query($db_connection, $sql)) {
        die('There was an error running the query [' . mysqli_error($db_connection) . ']');
    }
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-3">';
        echo '<h4>' . $row['name'] . '</h4>';
        echo '</br>';
        echo '<img src="img/skins/' . $row['img_url'] . '"/>';
        echo '</div>';
    }?>
</div>

<h3><?php echo 'Total skin types: ' . $result->num_rows; ?></h3>

<p>Diam tation no duo. Ad maiorum deterruisset pri, diam verear vocibus ea vim. Ius ea habemus voluptaria, ignota
    labores maiestatis vel an. Mei te quidam fierent, te quo atqui tollit lobortis. Ullum volutpat an eos. Has essent
    disputationi ne, usu ne percipitur intellegebat. Cu rebum augue cetero vim, partiendo forensibus ut sed.

    Vocent alienum eligendi ad duo, qui ea graece pertinacia. Magna malorum definitionem et vel, nam harum percipitur
    reprehendunt id. Ei usu facilisi explicari conclusionemque, mollis antiopam te his, persius fuisset mandamus at vis.
    No cum affert explicari scriptorem. Ei natum dissentiet nam. Dolore forensibus ad cum, iudico melius cu sed.</p>

<?php include '_footer.php'; ?>
