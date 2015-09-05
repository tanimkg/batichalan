<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }


    /**
	 * Default
     */
	function index()
	{
        $data['site_title'] = 'Welcome to';

//        $this->public_view('welcome', $data, FALSE);

		$this->load->view('_templates/public/header', $data);
		$this->load->view('_templates/public/navbar', $data);
		$this->load->view('welcome', $data);
		$this->load->view('_templates/public/footer', $data);
	}

}
