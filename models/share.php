<?php
	class ShareModel extends Model{
		public function Index(){
			//return;

			$this->query('SELECT * FROM shares ORDER BY create_date DESC'); // in descending order so newest post appears at the top
			$rows = $this->resultSet(); //resultSet is defined in classes/Model.php
			return $rows;
		}

		public function add(){
			//return;

			// Sanitize POST
			$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			if($post['submit']){
				//check for submission fields
				if($post['title'] == '' || $post['body'] == '' || $post['link'] == ''){
					Messages::setMsg('Please Fill In All Fields', 'error'); ////setMsg defined in classes/Messages.php
					return;
				}
				// Insert into MySQL
				$this->query('INSERT INTO shares (title, body, link, user_id) VALUES(:title, :body, :link, :user_id)');
				//data bind
				$this->bind(':title', $post['title']);
				$this->bind(':body', $post['body']);
				$this->bind(':link', $post['link']);
				$this->bind(':user_id', 1);
				$this->execute(); //execute is defined in classes/Model.php
				// Verify
				if($this->lastInsertId()){ //lastInsertId is defined in classes/Model.php
					// Redirect
					header('Location: '.ROOT_URL.'shares'); //ROOT_URL is defined in config.php
				}
			}
			return;
		}
	}
?>
