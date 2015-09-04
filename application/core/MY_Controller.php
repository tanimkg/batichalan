<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    /**
     * Common data
     */
    public $user;
    public $settings;
    public $includes;
    public $current_uri;
    public $theme;
    public $template;
    public $error;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // get current uri
        $this->current_uri = "/" . uri_string();

        // get current user
        $this->user = $this->session->userdata('logged_in');

        // enable the profiler?
        $this->output->enable_profiler($this->config->item('profiler'));
    }

    function _view($folder, $view_file, $data = NULL, $include_container = TRUE){
        if (is_array($data))
        {
            if (!in_array('site_title', $data)) $data['site_title'] = lang('core site name');
        }

        $this->load->view('_templates/'. $folder .'/header', $data);
        $this->load->view('_templates/'. $folder .'/navbar', $data);
        if ($include_container) $this->load->view('_templates/'. $folder .'/container_start', $data);
        $this->load->view('_templates/'. $folder .'/notifications', $data);
        $this->load->view('_templates/'. $folder .'/page_title', $data);
        $this->load->view($view_file, $data);
        if ($include_container) $this->load->view('_templates/'. $folder .'/container_end', $data);
        $this->load->view('_templates/'. $folder .'/footer', $data);
    }


    function private_view($view_file, $data = NULL, $include_container = TRUE){

        $this->_view('private', $view_file, $data, $include_container);
    }


    function public_view($view_file, $data = NULL, $include_container = TRUE){

        $this->_view('public', $view_file, $data, $include_container);
    }
}


/**
 * Base Public Class - used for all public pages
 */
class Public_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

    }


}


/**
 * Base Private Class - used for all private pages
 */
class Private_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // must be logged in
        if ( ! $this->user)
        {
            if (current_url() != base_url())
            {
                // store requested URL to session - will load once logged in
                $data = array('redirect' => current_url());
                $this->session->set_userdata($data);
            }

            redirect('login');
        }

    }


}


/**
 * Base Admin Class - used for all administration pages
 */
class Admin_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // must be logged in
        if ( ! $this->user)
        {
            if (current_url() != base_url())
            {
                //store requested URL to session - will load once logged in
                $data = array('redirect' => current_url());
                $this->session->set_userdata($data);
            }

            redirect('login');
        }

        // make sure this user is setup as admin
        if ( ! $this->user['is_admin'])
        {
            redirect(base_url());
        }

        // load the admin language file
        $this->lang->load('admin');

    }


    function admin_view($view_file, $data = NULL, $include_container = TRUE){

        parent::_view('admin', $view_file, $data, $include_container);
    }

}


/**
 * Base API Class - used for all API calls
 */
class API_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

}
