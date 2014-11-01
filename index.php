<?php include '_header.php'; ?>

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
    <div class="col-md-3 col-md-offset-1" style="background-color: #91A5F2; padding: 5px">
        <h3>We offer your favorites</h3>

        <p>Your choice of skins!</p>

        <p>Quo ut movet sonet. Est et omnium imperdiet tincidunt. Illum tollit euismod ut est. Menandri accommodare vix
            cu, no mel agam utamur salutandi, ea consulatu disputando interpretaris pro. Id vitae scripta vim, quem
            causae detraxit ei his. Molestiae accommodare ut vim, ut est graece possit disputationi.

            Omnis sonet putent te nec, ex cum tale bonorum. Malis fugit ius te, vis quem stet urbanitas te, usu cu movet
            appareat. Mel ex dicta quidam neglegentur, est dico laudem pertinacia an. Qui albucius persecuti neglegentur
            id, no agam paulo integre duo. Eu malis phaedrum pri. An nam quaeque repudiandae philosophia.</p>
    </div>

    <div class="col-md-6 col-md-offset-1" style="background-color: #91A5F2; padding: 5px">
        <h3>All skins are battle-tested and league-approved!</h3>

        <p>Cu vidit falli sed, cibo sale errem ne duo, sea nonumy civibus indoctum ea. At odio mediocrem pro, meis
            scripta accusamus mel ea. Nam ea graeco sapientem aliquando, feugiat ponderum philosophia id est, eripuit
            platonem patrioque in eam. Nusquam consulatu ad qui, odio dicat molestiae ei his, omnes explicari cu vel.

            Reque legere fierent est an, eam te movet atomorum, sed fabellas vulputate te. Id qui accusam evertitur, at
            splendide consetetur pro. Ius no quaerendum interpretaris, eam no sensibus tractatos efficiendi, qui at
            conceptam mediocritatem. Has in fabulas assueverit signiferumque. Cum explicari persequeris cu.
        </p>

        <p>Eligendi aliquando sit no, eu nostrum salutandi honestatis nam. Has no errem option aliquip. No vis similique
            forensibus, cum ea modo falli movet. Adhuc eligendi adipisci pri et, nam vivendo probatus ex. Et eos aeque
            homero, quo dolores accusamus id.

            Solum necessitatibus id eum, nostrud percipitur eu sea, causae latine corrumpit mei cu. Modus putent ne vim,
            mei cu pertinax erroribus. Ne aliquam nominavi pri, illud audire blandit eos in. Iudico primis dissentiet ut
            eos, cu aperiri ocurreret scriptorem usu.</p>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.carousel').carousel();
    });
</script>

<?php include '_footer.php'; ?>
