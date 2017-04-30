<?php
	abstract class Controller {
		protected $request;
		protected $action;

		public function __construct($action, $request) {
			$this->action = $action;
			$this->request = $request;
		}

		public function executeAction() {
			return $this->{
				$this->action
			}();
		}

		//inside controller, assign a view to user (e.g., register page, login pages)
		protected function returnView($viewmodel, $fullview) {
			$view = 'views/'. get_class($this). '/' . $this->action. '.php';
			if ($fullview) {
				//load main layout
				require('views/main.php');
			} else {
				//load individual view
				require($view);
			}
		}
	}
?>
