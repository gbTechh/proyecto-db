<?php
class AdminController extends Controller {
    public function __construct() {
			parent::__construct();
			$this->layout->setLayout('admin');
			$this->layout->addStyle('admin');
    }

		protected function checkAuth() {
			// Implementar verificación de autenticación
			if (!isset($_SESSION['admin_id'])) {
					//header('Location: ' . URLROOT . '/admin/login');
					//exit;
			}
		}
}