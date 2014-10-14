<?php require('core/init.php'); ?>

<?php

//Create Topic Object
$topic = new Topic;

//Create Validator Object
$validate = new Validator;

if(isset($_POST['do_create'])){
	//Create Data Array
	$data = array();
	$data['title'] = $_POST['title'];
	$data['body'] = $_POST['body'];
	$data['category_id'] = $_POST['category'];
	$data['user_id'] = getUser()['user_id'];
	$data['last_activity'] = date("Y-m-d H:i:s");

	//Required Fields
	$field_array = array('title', 'body', 'category');

	if($validate->isRequired($field_array)){
		//Register User
		if($topic->create($data)){
			redirect('index.php', 'Your topic has been posted', 'success');
		} else {
			redirect('topic.php?id='.$topic_id, 'Something went wrong with your post', 'error');
		}
	} else {
		redirect('create.php', 'Please fill in all required fields', 'error');
	}	
}


//Get Template & Assign Vars
$template = new Template('templates/create.php');

//Assign Vars

//Display template
echo $template;