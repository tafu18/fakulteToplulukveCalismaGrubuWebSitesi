<?php 
ob_start();
session_start();
require_once 'header.php';
?>
	<section class="main-slider mt-15 mb-15">
		<div class="container">
			<div style="justify-content: center;"  class="row">
				<div class="col-12">
					<div class="sec-title light centered">
						<h2 style="color: black;">Giriş</h2>
						<div class="text">Giriş Paneli</div>
					</div>
					<form class="needs-validation" action="" method="POST">
						<div style="justify-content: center;" class="form-row">
							<div class="col-md-4 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">123</span>
									</div>
									<input type="text" class="form-control" name="student_no" placeholder="Öğrenci Numaranız..." required>
								</div>
							</div>
							<div class="col-md-4 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">***</span>
									</div>
									<input type="password" class="form-control" name="password"  placeholder="Şifreniz..." required>
								</div>
							</div>
						</div>
						</div>
						<button class="btn btn-primary col-8" type="submit">Giriş Yap</button>
					</form>
				</div>  
			</div>
		</div>
	</section>
<?php
	
	require_once 'db.php';
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$student = $_POST['student_no'];
		$password = $_POST['password'];

		
		$query = $db->prepare("SELECT * FROM `admin` WHERE `student_no` = " . $student);
		$query->execute();
		$admin = $query->fetch(PDO::FETCH_ASSOC);

        //$_SESSION['name'] = $_POST[''];
        

		if($password == $admin['password']){
			$name = $admin['firstname'] . ' ' . $admin['lastname'];
            $_SESSION['name'] = $name; 
			
			//echo "Giriş Başarılı.";
			header('Location: admin.php');
			
		}
		else{
            
			echo '<script language="javascript">';
			echo 'alert("Şifre Hatalı\nLütfen Tekrar Deneyiniz.")';
			echo '</script>';
		}
	}
	require_once 'footer.html';


?>
