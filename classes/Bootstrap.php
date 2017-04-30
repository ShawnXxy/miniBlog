<?php
	class Bootstrap {
		private $controller;
		private $action;
		private $request;

		public function __construct($request) {
			$this->request = $request;
			//check controller accessibility
			if ($this->request['controller'] == "") {
				$this->controller = 'home'; //redirect to home page if no controller
			} else { //if there is controller, redirect to whatever controller is
				$this->controller = $this->request['controller'];
			}
			//check action
			if($this->request['action'] == "") {
				$this->action = 'index'; //if no action, redirect to index
			} else { //if there is action, redirect to action
				$this->action = $this->request['action'];
			}

			//test
			// echo $this->controller;
			// echo $this->action;
		}

		public function createController() {
			// Check Class, make sure controller is class
			if (class_exists($this->controller)) {
				$parents = class_parents($this->controller);
				// Check if Extended
				if (in_array("Controller", $parents)) {
					//check if controller includes actions passed in
					if (method_exists($this->controller, $this->action)) {
						//return whatever the controller is
						return new $this->controller($this->action, $this->request);
					} else {
						// Method Does Not Exist
						echo '<h1>Method does not exist</h1>';
						return;
					}
				} else {
					// Base Controller Does Not Exist
					echo '<h1>Base controller not found</h1>';
					return;
				}
			} else {
				// Controller Class Does Not Exist
				echo '<h1>Controller class does not exist</h1>';
				return;
			}
		}
	}
?>
