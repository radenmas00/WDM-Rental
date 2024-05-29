<?php	
	// Update modul
	if ($act=='update'){
			
		$username = $_POST['username'];
		
		if($_POST['password_lama']!=$_POST['password']){
			$pass     = md5($_POST['password']);
		}else{
			$pass     = $_POST['password_lama'];
		}
            
            
            $datas = array(
                'nama_lengkap' => $_POST["nama_lengkap"],
                'email' => $_POST["email"],
                'no_telp' => $_POST["no_telp"] ,
                'username' => $username,
                'password' => $pass,
            
            );
            
            $db->update("admin", $datas , "id = '$_POST[id]' ");
				  
			
			
		echo "<script>alert('Data Admin berhasil diedit'); window.location = 'logout'</script>";
	}
?>
