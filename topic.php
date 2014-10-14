<?php require('core/init.php'); ?>

<?php
//Create Topic Object
$topic = new Topic;

//Get ID From URL
$topic_id = $_GET['id'];

//Process Reply
//Process Reply
if(isset($_POST['do_reply'])){
	//Create Data Array
	$data = array();
	$data['topic_id'] = $_GET['id'];
	$data['body'] = $_POST['body'];
	$data['user_id'] = getUser()['user_id'];

	//Create Validator Object
	$validate = new Validator;
	
	//Required Fields
	$field_array = array('body');
	
	if($validate->isRequired($field_array)){
		//Register User
		if($topic->reply($data)){
			redirect('topic.php?id='.$topic_id, 'Your reply has been posted', 'success');
		} else {
			redirect('topic.php?id='.$topic_id, 'Something went wrong with your reply', 'error');
		}
	} else {
		redirect('topic.php?id='.$topic_id, 'Your reply form is blank!', 'error');
	}
} 

//Get Template & Assign Vars
$template = new Template('templates/topic.php');

//Assign Vars
$template->topic = $topic->getTopic($topic_id);
$template->replies = $topic->getReplies($topic_id);
$template->title = $topic->getTopic($topic_id)->title;

//Display template
echo $template;