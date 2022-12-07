<?php 
require_once 'header.php';
require_once 'db.php';

$events = $db->prepare("SELECT * FROM `content` WHERE `type` = 0 ORDER BY `id` DESC");//Etkinlik
$events->execute();
$event = $events->fetchAll(PDO::FETCH_ASSOC);

$annoucements = $db->prepare("SELECT * FROM `content` WHERE `type` = 1 ORDER BY `id` DESC");//Duyuru
$annoucements->execute();
$annoucement = $annoucements->fetchAll(PDO::FETCH_ASSOC);

$communities = $db->prepare("SELECT * FROM `communities_and_working_groups` WHERE `type` = 0");//Topluluk
$communities->execute();
$community = $communities->fetchAll(PDO::FETCH_ASSOC);

$working_groups = $db->prepare("SELECT * FROM `communities_and_working_groups` WHERE `type` = 1");//Çalışma Grubu
$working_groups->execute();
$working_group = $working_groups->fetchAll(PDO::FETCH_ASSOC);

?>
<html ng-app="toplulukApp" ng-controller="toplulukCtrl">
<style>
body{
    background-color: #e9ecef;
    background-image: url(images/title-bar-light-transparent.png)
}
html{
    background-color: #e9ecef;
    background-image: url(images/title-bar-light-transparent.png)
}
</style>
<div class="container mt-10 mb-3">
    <h1 class="text-center" style="font-weight:700; margin: auto;">
            Topluluk ve Çalışma Grubu Duyuru Paneli
    </h1>   
</div>
<div class="container switch-container" style="text-align:center; ">
    <div class="row">
        <div class="topluluk"><span class="badge badge-primary badge-detail shadow" style="border-radius: 1rem; font-size: 75%!important">Topluluklar</span></div>
        <label class="switch">
            <input ng-click="toggle()" type="checkbox">
            <span class="slider shadow"></span>
        </label>
        <div class="calisma "><span class="badge badge-primary badge-detail shadow" style="border-radius: 1rem; font-size: 75%!important">Çalışma Grupları</span></div>
    </div>
</div>
<!-- Slider main container -->
<div ng-show="isSelectTopluluk" class="container swiper shadow community">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    
    <?php foreach($community as $comm) {?>
    <div class="swiper-slide" style="text-align: center;">
        <a href="community.php?id=<?php echo $comm['id'];?>">
            <div class="container">
                <div class="row justify-content-center-2 p-3">
                    <h5 class="title_com"><b><?php echo $comm['name']?></b></h5>
                </div>
            </div>
            <div class="row justify-content-center-2">
                <img class="image_deneme" style="padding:1rem;" src="<?php echo $comm['logo_url'];?>" alt="">
            </div>
            <div class="container">
                <div class="row p-3 justify-content-center-2">
                    <p class="detail"><b> Topluluk Amacı:</b><?php echo ' ' . $comm['detail']?></p>
                    <p class="admin_name"><b> Topluluk Başkanı:</b><?php echo ' ' . $comm['admin_name']?></p>
                </div>
            </div>
        </a>
    </div>


    <?php }?>
  </div>
    
  <div class="swiper-pagination"></div>
  
  <div class="swiper-button-prev"></div>
  
  <div class="swiper-button-next"></div>
</div>

<!-- Slider main container -->
<div ng-show="isSelect" class=" container swiper shadow working">
  <div class="swiper-wrapper">
    <!-- Slides -->

    <?php foreach($working_group as $working)  {?>
        <div class="swiper-slide" style="text-align: center;">
            <a href="community.php?id=<?php echo $working['id'];?>">
                <div class="container">
                    <div class="row justify-content-center-2 p-3">
                        <h5 class="title_com"><b><?php echo $working['name']?></b></h5>
                    </div>
                </div>
                <div class="row justify-content-center-2">            
                    <img class="image_deneme" style="padding:1rem;" src="<?php echo $working['logo_url'];?>" alt="">
                </div>
                <div class="container">
                    <div class="row p-3 justify-content-center-2">
                        <p class="detail"><b> Çalışma Grubunu Amacı:</b><?php echo ' ' . $working['detail']?></p>
                        <p class="admin_name"><b> Çalışma Grubunu Başkanı:</b><?php echo ' ' . $working['admin_name']?></p>
                    </div>
                </div>
            </a>
        </div>


    <?php }?>
  </div>
    
  <div class="swiper-pagination"></div>
  
  <div class="swiper-button-prev"></div>
  
  <div class="swiper-button-next"></div>
</div>

<div style="margin-bottom: 0!important; background-image: url(images/title-bar-light-transparent.png)" class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Duyurular</h1>
    </div>
</div>

<div class="container shadow" style="background-image:url(images/title-bar-light-transparent.png); background-color:#0593b5; padding-top: 1rem; border-radius: 2rem; position:relative">
    <div style="width: 85%!important;" class="container">

        <!-- Slider main container -->
        <div style="overflow: hidden;" class="swiper_duyuru rounded-lg">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper duyuru">
                <!-- Slides -->

                <?php foreach($annoucement as $annouce) {?>
                <div class="swiper-slide width-donation donation-card shadow rounded-lg align-items-center display-flex flex-column p-3 grocer-list">
                        <a href = "events.php?event_id=<?php echo $annouce['id'];?>">
                            <div class="display-flex flex-column justify-content-around align-items-center">
                                <img
                                    width = 150
                                    height = 150
                                    class="rounded-lg mx-auto mx-md-0 align-items-center"
                                    src="<?php echo $annouce['image'];?>"
                                    alt=""
                                />
                                <div style="color: #526b84; margin: auto;"class="source-info media-body text-center align-items-center h-100">
                                    <h5 class="mb-2"><h3><?php echo $annouce['title']?></h3></h5>
                                    <div><?php date_default_timezone_set('Europe/Istanbul'); echo date("d.m.Y", strtotime($annouce['start'])) . ' - ' .date("d.m.Y", strtotime($annouce['end']));?></div>
                                </div>
                            </div>
                        </a>
                </div>
                <?php }?>
            </div>
            <!-- If we need pagination -->
            <div style="text-align: center;" class="swiper-pagination-duyuru"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev pre-next-top"></div>
            <div class="swiper-button-next pre-next-top"></div>

            <!-- If we need scrollbar -->
            <!-- <div class="swiper-scrollbar"></div> -->
        </div>
    </div>
</div>

<div style="margin-bottom: 0!important;  background-image: url(images/title-bar-light-transparent.png)" class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Etkinlikler</h1>
    </div>
</div>

<div class="container shadow" style="background-image:url(images/library-bg.png); background-color:#0593b5; padding-top: 1rem; border-radius: 2rem; position:relative; margin-bottom: 4rem;">
    <div style="width: 85%!important;" class="container">

        <!-- Slider main container -->
        <div style="overflow: hidden;" class="swiper_etkinlik rounded-lg">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper duyuru">
                <!-- Slides -->

                <?php foreach($event as $evnt) {?>
                <div class="swiper-slide width-donation donation-card shadow rounded-lg align-items-center display-flex flex-column p-3 grocer-list">
                    <a href = "events.php?event_id=<?php echo $evnt['id'];?>">
                            <div class="display-flex flex-column justify-content-around align-items-center">
                                <img
                                    width = 150
                                    height = 150
                                    class="rounded-lg mx-auto mx-md-0 align-items-center"
                                    src="<?php echo $evnt['image'];?>"
                                    alt=""
                                />
                                <div style="color: #526b84; margin: auto;"class="source-info media-body text-center align-items-center h-100">
                                    <h5 class="mb-2"><h3><?php echo $evnt['title'];?></h3></h5>
                                    <div><?php date_default_timezone_set('Europe/Istanbul'); echo date("d.m.Y", strtotime($evnt['start'])) . ' - ' .date("d.m.Y", strtotime($evnt['end']));?></div>
                                </div>
                            </div>
                        </a>
                </div>
                <?php }?>
            </div>
            <!-- If we need pagination -->
            <div style="text-align: center;" class="swiper-pagination-duyuru"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev pre-next-top"></div>
            <div class="swiper-button-next pre-next-top"></div>

            <!-- If we need scrollbar -->
            <!-- <div class="swiper-scrollbar"></div> -->
        </div>
    </div>
</div>


<?php 
    require_once 'footer.html';
?>


<script>


const swiper = new Swiper('.swiper', {
  slidesPerView: 1,
  direction: 'horizontal',
  loop: true,

   pagination: {
    el: '.swiper-pagination',
  },

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

const swiper_duyuru = new Swiper('.swiper_duyuru', {

    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        500: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        800: {
            slidesPerView: 4,
            spaceBetween: 20,
        }
    },
    direction: 'horizontal',
    loop: true,

    pagination: {
    el: '.swiper-pagination-duyuru',
    },

    navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
    },
});

const swiper_etkinlik = new Swiper('.swiper_etkinlik', {

    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        500: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        800: {
            slidesPerView: 4,
            spaceBetween: 20,
        }
    },
    direction: 'horizontal',
    loop: true,

    pagination: {
    el: '.swiper-pagination-duyuru',
    },

    navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
    },
});



</script>