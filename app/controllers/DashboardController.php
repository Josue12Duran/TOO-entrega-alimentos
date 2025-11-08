<?php
class DashboardController extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $user = [];
        if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
        if (!empty($_SESSION['user'])) { $user = $_SESSION['user']; }
        $this->view('dashboard/index', ['user' => $user]);
    }
}
