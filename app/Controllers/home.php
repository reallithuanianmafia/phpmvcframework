<?php 

class Home extends Controller
{
    public function index()
    {
        
    }
    public function user()
    {
        $user = $this->model('User');
        $user = User::where('id', 1)->firstOrFail();
        echo $user->username();
    }
}