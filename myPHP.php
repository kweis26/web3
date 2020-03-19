<?php

if($_POST['send'] == 'Отправить'){
	// Проверяем галочку
	if ($_POST['check'] == ''){
		print('Пожалуйста, ознакомьтесь с контрактом!');
		exit();
	}
	
    foreach($_POST as $key => $val){
        // Проверяем, чтоб все поля были заполнены.
        if(empty($val)){
			print('Не все значения заполнены.');
			exit();
        }
    }
    
    extract($_POST);
    
	
	// Подключаемся к базе данных
	$user = 'u20292';
	$pass = '1232183';
	$db = new PDO('mysql:host=localhost;dbname=u20292', $user, $pass);

	$name = $_POST['field-name'];
	$email = $_POST['field-email'];
	$date = $_POST['field-date'];
	$gender = $_POST['radio-sex'];
	$limb = $_POST['radio-kon'];
	$super = $_POST['field-superpowers'];
	$message = $_POST['field-name-2'];

	try {
		$stmt = $db->prepare("INSERT INTO anketa (name, email, date, gender, limb, super, message) VALUES (:name, :email, :date, :gender, :limb, :super, :message)");
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':date', $date);
		$stmt->bindParam(':gender', $gender);
		$stmt->bindParam(':limb', $limb);
		$stmt->bindParam(':super', $super);
		$stmt->bindParam(':message', $message);
		$stmt->execute();
		print('Спасибо, результаты сохранены.');
		exit();
	}
	catch(PDOException $e){
		print('Error : ' . $e->getMessage());
		exit();
	}
}

header('Location: /web3');
?>