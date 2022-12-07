<?php
require_once 'db.php';
require_once 'header.php';

$id = $_GET['id'];

$community = $db->prepare("SELECT * FROM `communities_and_working_groups` WHERE `id` = '$id'");
$community->execute();
$comm = $community->fetch(PDO::FETCH_ASSOC);
?>

<!-- <section class="mt-10">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="aaa" style="background-color: aqua; width: 200px; height: 200px;">Deneme Deneme Deneme</div>
                <div class="aaa" style="background-color: turquoise; width: 200px; height: 200px;">Deneme Deneme Deneme</div>
            </div>
        </div>
    </div>
</section> -->

<section class="mt-10 mb-5">
    <div class="container">
        <div class="row justify-content-center-2 p-3">
            <div class="col-8 text-center">
                <a target="_Blank" href="<?php echo $comm['logo_url']?>"><img class="rounded" width="300px" src="<?php echo $comm['logo_url']?>" alt=""></a>
            </div>
        </div>
        <div class="row logos justify-content-end">
            <div class="col-3">
                <div class="social-links">
					<ul class="clearfix display-felx" style="font-size: 25px;">
						<li><a href="https://twitter.com/neu_acengizmf"><span class="fab fa-twitter mr-3 color-text"></span></a></li>
						<li><a href="https://www.facebook.com/groups/2008198646125525"><span class="fab fa-facebook-square mr-3 color-text"></span></a></li>
						<li><a href="https://www.instagram.com/neu_acengizmf/"><span class="fab fa-instagram mr-3 color-text"></span></a></li>
						<li><a href="index.php"><span class="fab fa-youtube mr-3 color-text"></span></a></li>
					</ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center-2">
            <div class="col-10">
                <h3 class="mb-3 pt-3 text-center font-weight-bold">
                    <?php echo $comm['name']?>
                </h3>
                <hr class="horizontal">
            </div>
        </div>
        <div class="row justify-content-center-2">
            <div class="col-9">
                <p class="mb-3 pt-3 font-weight-bold" style="text-align: justify;">
                    <?php echo $comm['detail']?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'footer.html';
?>