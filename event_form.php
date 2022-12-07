<?php 
ob_start();
require_once 'header.php'
?>

<div ng-app="donationApp" ng-controller="donationCtrl" class="mt-15">
    <div class="container mt-15 mb-5">
        <div class="row justify-content-center-2 mb-4">
            <h1>Etkinlik Kayıt Formu</h1>
        </div>
        <form action="" method="POST">
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
                    <label for="student_no">Öğrenci Numarası</label>
                    <input type="text" class="form-control" name="student_no" id="student_no" placeholder="Öğrenci Numarası" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="department">Bölüm</label>
                    <input type="text" class="form-control" name="department" id="department" placeholder="Bölüm" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-special" >Gönder</button>



        </form>

    </div>
</div>

<?php 
require_once 'db.php';
$event_id = $_GET['event_id'];


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['firstname'] . ' ' . $_POST['lastname'] ;
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $student_no = $_POST['student_no'];
    $department = $_POST['department'];

    
    $sql = $db->prepare("INSERT INTO `event_registration`(`event_id`, `name`, `phone`, `email`, `student_no`, `department`) VALUES ('$event_id', '$name', '$phone', '$email', '$student_no', '$department')");
    $ekle = $sql->execute();
    if ($ekle)
        echo '<div class="succes" ><span class="text-center badge badge-complete badge-pill">Kayıt Başarılı</span></div>';

}





?>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }//Tarayıcının input geçmişini siler.

</script>

<?php require_once 'footer.html';?>
