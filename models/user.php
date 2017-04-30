<?php
	class UserModel extends Model {
		public function register() {
			//return;

			// Sanitize POST
			$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			//test
			// die('submitted');

			//MD5 validation
			$password = md5($post['password']);

			//check if all submission fields filled
			if($post['submit']){
				if($post['name'] == '' || $post['email'] == '' || $post['password'] == ''){
					Messages::setMsg('Please Fill In All Fields', 'error'); //setMsg defined in classes/Messages.php
					return;
				}

				// Insert into MySQL
				$this->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
				$this->bind(':name', $post['name']);
				$this->bind(':email', $post['email']);
				$this->bind(':password', $password);
				$this->execute(); //execute is defined in classes/Model.php
				// Verify
				if($this->lastInsertId()) { //lastInsertId is defined in classes/Model.php
					// Redirect
					header('Location: '.ROOT_URL.'users/login');
				}
			}
			return;
		}

		public function login() {
			//return;

			// Sanitize POST
			$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			//test
			//die('submitted');

			//MD5 VALIDATION
			$password = md5($post['password']);

			if($post['submit']) {
				// Compare Login info with SQL database
				$this->query('SELECT * FROM users WHERE email = :email AND password = :password');
				//data binding
				$this->bind(':email', $post['email']);
				$this->bind(':password', $password);

				$row = $this->single();//single() defined in classes/Model.php

				if($row) {
					//echo 'logged in';
					$_SESSION['is_logged_in'] = true;
					$_SESSION['user_data'] = array(
						"id" => $row['id'],
						"name" => $row['name'],
						"email" => $row['email']
					);
					//director to shares view once logged in
					header('Location: '.ROOT_URL.'shares');
				} else {
					// echo 'wrong';
					Messages::setMsg('Incorrect Login', 'error'); //setMsg defined in classes/Messages.php
				}
			}
			return;
		}
	}
?>
