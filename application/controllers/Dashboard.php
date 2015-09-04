<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }


    /**
	 * View recent posts and sidebar
     */
	function index()
	{
        $data['page_title'] = 'Welcome to Batichalan';

        $this->public_view('dashboard/index', $data);
	}

}
