<?php
ob_start();
session_start();
if($_SESSION['name'] == null) header("Location:login.php");
$admin_name = $_SESSION['name'];
require_once 'header.php';  require_once 'db.php';

$query = $db->prepare("SELECT * FROM `content`WHERE `admin` = '$admin_name' ORDER BY `id` DESC LIMIT 5");
$query->execute();
$lists = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="admin mt-10">
    <div class="container">
        <div class="justify-content-right form-row">
            <form method="get">
                <button type="submit" name="close" class="btn btn-special col-12 mt-2" >Çıkış Yap</button>
            </form>
        </div>
        <div class="row">
            <div class="col-md-3 mb-5">
                <div class="mt-3 container">
                    <div class="row justify-content-center-2">
                    <h5 class="display-4 mb-2" style="font-size: 1.5rem;">Etkinlikler Katılımcılar</h5>
                        <ul class="list-group list-group-flush" style="width: 100%;">
                            <?php foreach($lists as $list){
                                if($list['type'] == 0 ){?>
                                    <a style="color: white!important;" href="participants.php?event_id=<?php echo $list['id'];?>"><li class="list-group-item rounded" style="background-color: #007bff;"><?php echo $list['title'];?></li></a>
                                <?php }}  ?>
                        </ul>
                    </div>
                </div>
                <div class="mt-3 container">
                    <div class="row justify-content-center-2">
                    <h5 class="display-4 mb-2" style="font-size: 1.7rem;">Etkinlikler/Duyurular</h5>
                        <ul class="list-group list-group-flush" style="width: 100%;">
                            <?php foreach($lists as $list){
                                if($list['type'] == 0 ){?>
                                    <a style="color: white!important;" href="events.php?event_id=<?php echo $list['id'];?>"><li class="list-group-item rounded" style="background-color: #007bff;"><?php echo $list['title'];?></li></a>
                                <?php } else{ ?>
                                    <!-- <li class="list-group-item rounded" style="background-color: #28a745;"><a style="color: white!important;" href="events.php?event_id=<?php echo $list['id'];?>"><?php echo $list['title'];?></a></li> -->
                                    <a style="color: white!important;" href="events.php?event_id=<?php echo $list['id'];?>"><li class="list-group-item rounded" style="background-color: #28a745;"><?php echo $list['title'];?></li></a>
                                <?php }}?>
                        </ul>
                    </div>
                </div>
            </div>
            <div ng-app="toplulukApp" ng-controller="toplulukCtrl" class="col-md-9">
                <div class="container mb-5">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Ad</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Adınız" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname">Soyad</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Soyadınız" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">Telefon Numarası</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="5XXXXXXXXX" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Mail Adresi</label>
                                <input type="mail" class="form-control" name="email" id="email" placeholder="Mail Adresiniz" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">Başlık</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Başlık" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type">Etkinlik/Duyuru</label>
                                <select class="form-select form-control" ng-model="type" name="type" aria-label=".form-select-lg example" required>
                                    <option ng-selected="true" ng-disabled="true" value="">Seçiniz...</option>
                                    <option value="0">Etkinlik</option>
                                    <option value="1">Duyuru</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="start">Başlangıç Tarihi</label>
                                <input type="date" class="form-control" name="start" id="start" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="start_time">Başlangıç Saati</label>
                                <input type="time" class="form-control" name="start_time" id="start_time" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="end">Bitiş Tarihi</label>
                                <input type="date" class="form-control" name="end" id="end" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="end_time">Bitiş Saati</label>
                                <input type="time" class="form-control" name="end_time" id="end_time" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="file">Fotoğraf</label>
                                <input type="file" class="form-control" name="file" id="file" accept="image/*"  required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Adres</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Adresiniz" required>
                        </div>
                        <div class="form-group">
                            <label for="detail">Ayrıntılar</label>
                            <textarea type="text" class="form-control" name="detail" id="detail" placeholder="Ayrıntılar"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-special col-md-12" >Gönder</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>




<?php 
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['close'])){
        session_destroy();
        header("Location: index.php");
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST"){

//name, phone, email, title, type, start, end, address, detail, image

    $name = $_POST['firstname'] . ' ' .  $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $type = $_POST['type'];
    $start = $_POST['start'];
    $start_time = $_POST['start_time'];
    $end = $_POST['end'];
    $end_time = $_POST['end_time'];
    $address = $_POST['address'];
    $detail = $_POST['detail'];
    $admin = $_SESSION['name'];

    $file = $_FILES["file"]["tmp_name"];
    $file_name = $_FILES["file"]["name"];
    $file_type = $_FILES["file"]["type"];
    $file_type_2 = explode("/",$file_type);
    $control = substr($file_type, 0,5);
    if ($control=="image") {
        $file_upload_name = md5(date('d.m.Y H:i:s')).".".$file_type_2[1];
        $upload = move_uploaded_file($file, "images"."/".$file_upload_name);
        $image = "images/".$file_upload_name;
    }


    $sql = $db->prepare("INSERT INTO `content`(`name`,`phone`, `email`, `title`, `type`, `start`, `start_time`, `end`, `end_time`, `address`, `detail`, `image`, `admin`) VALUES ('$name', '$phone', '$email', '$title', '$type', '$start', '$start_time', '$end', '$end_time', '$address', '$detail', '$image', '$admin')");
    $ekle = $sql->execute();
    if ($ekle)
        echo '<div class="succes" ><span class="text-center badge badge-complete badge-pill">İçerik Eklendi</span></div>';





}

?>


<?php
require_once 'footer.html';
?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }//Tarayıcının input geçmişini siler.

</script>
