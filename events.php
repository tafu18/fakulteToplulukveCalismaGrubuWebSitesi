<?php 
require_once 'header.php';
require_once 'db.php';
 
$id = $_GET['event_id'];

$query = $db->prepare("SELECT * FROM `content` WHERE `id` = $id");
$query->execute();
$eventById = $query->fetch(PDO::FETCH_ASSOC); 
?>


<section class="mt-10 mb-5">
    <div class="container">
        <?php if($eventById['end'] < date("Y-m-d") && $eventById['type'] == 0){?>
        <div class="row justify-content-center-2 p-3">
            <h3 class="mb-3 pt-3 text-center font-weight-bold">!!!   Süresi Dolmuştur   !!!</h3>
        </div>
        <?php }?>
        <div class="row justify-content-center-2 p-3">
            <div class="col-8 text-center">
                <a target="_Blank" href="<?php echo $eventById['image']?>"><img class="rounded" width="300px" src="<?php echo $eventById['image']?>" alt=""></a>
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
                    <?php echo $eventById['title']?>
                </h3>
                <hr class="horizontal">
            </div>
        </div>
        <div class="row justify-content-center-2">
            <div class="col-9">
                <p class="mb-3 pt-3 font-weight-bold" style="text-align: justify;">
                    <?php echo $eventById['detail']?>
                </p>
            </div>
        </div>
        <?php if($eventById['type'] == 0){
            if($eventById['end'] >= date("Y-m-d")){?>
        <div class="row justify-content-center-2">
            <div class="col-6">
                <a href="event_form.php?event_id=<?php echo $eventById['id']?>">Etkinliğe Kayıt İçin Tıklayınız</a>
            </div>
            <div class="col-6">
                <div class="text" style="text-align: right;"><?php echo '<b>Etkinlik Başlangıç: </b>' . date("d.m.Y", strtotime($eventById['start'])) . ' ' . $eventById['start_time'] . " <b>Etkinlik Bitiş: </b>" . date("d.m.Y", strtotime($eventById['end'])) . ' ' . $eventById['end_time'];?></div>
            </div>
            <?php }}?>
        </div>
        
    </div>
</section>

<?php require_once 'footer.html';?>