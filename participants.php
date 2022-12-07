<?php
ob_start();
session_start();
if($_SESSION['name'] == null) header("Location:login.php");
require_once 'header.php';  require_once 'db.php';

$event_id = $_GET['event_id'];

$query = $db->prepare("SELECT * FROM `content` WHERE `id` = $event_id");
$query->execute();
$eventById = $query->fetch(PDO::FETCH_ASSOC); 

$query = $db->prepare("SELECT * FROM `event_registration` WHERE `event_id` = $event_id");
$query->execute();
$students = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="mt-10">
    <div class="container">
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
    </div>
    <div class="container">
        <div class="row justify-content-center-2">
            <div class="col-10">
                <h3 class="mb-3 pt-3 text-center font-weight-bold">
                    <?php echo "KATILIMCILAR"?>
                </h3>
                <hr class="horizontal">
            </div>
        </div>
        <div class="table-responsive" style="margin-bottom: 4rem!important;">
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Öğrenci No</th>
                    <th scope="col">Ad Soyad</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Bölüm</th>
                    <th scope="col">Kayıt Tarihi</th>
                </tr>
            </thead>
            <tbody>
                <?php   $counter = 1; 
                        foreach($students as $student){
                        if(count($students) > 0 ){
                        ?>
                <tr>
                    <th scope="row"><?php echo $counter;?></th>
                    <td><?php echo $student['student_no'];?></td>
                    <td><?php echo $student['name'];?></td>
                    <td><?php echo $student['phone'];?></td>
                    <td><?php echo $student['email'];?></td>
                    <td><?php echo $student['department'];?></td>
                    <td><?php echo $student['date_added'];?></td>
                </tr>
                <?php   $counter++;}}?>
            </tbody>
            </table>
            <?php if(count($students) <= 0){?>
            <h3 class="mb-3 pt-3 text-center font-weight-bold">--- Katılımcı Yok ---</h3>
            <?php }?>
        </div>
    </div>
</div>
<?php
require_once 'footer.html';
?>