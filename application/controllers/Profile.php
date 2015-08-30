<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Private_Controller {

    private $_uid;

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('users');

        // load the users model
        $this->load->model('users_model');
        $this->load->model('contactno_model');
        $this->load->model('address_model');

        // get logged in user's detail
        $logged_in_user = $this->session->userdata('logged_in');
        if ($logged_in_user['id']) {
            $this->_uid = $logged_in_user['id'];
        } else {
            $this->_uid = NULL;
        }

    }


    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/


    /**
	 * Profile Editor
     */
	function edit()
	{
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('username', lang('users input username'), 'required|trim|min_length[5]|max_length[30]|callback__check_username');
        $this->form_validation->set_rules('first_name', lang('users input first_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('last_name', lang('users input last_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('birth_date', lang('users input birth_date'), 'trim');
        $this->form_validation->set_rules('gender', lang('users input gender'), 'required|trim|min_length[1]');
        $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[128]|valid_email|callback__check_email');
        $this->form_validation->set_rules('password', lang('users input password'), 'min_length[5]|matches[password_repeat]');
        $this->form_validation->set_rules('password_repeat', lang('users input password_repeat'), '');

        if ($this->form_validation->run() == TRUE)
        {
            // save the changes
            $saved = $this->users_model->edit_profile($this->input->post(), $this->user['id']);

            if ($saved)
            {
                $this->session->set_flashdata('message', lang('users msg edit_profile_success'));

                // reload the new user data and store in session
                $this->user = $this->users_model->get_user($this->user['id']);
                unset($this->user['password']);
                unset($this->user['salt']);
                $this->session->set_userdata('logged_in', $this->user);
            }
            else
            {
                $this->session->set_flashdata('error', lang('users error edit_profile_failed'));
            }

            // reload page and display message
            redirect('profile');
        }

        // setup page header data
		$this->set_title( lang('users title profile') );
		
        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => base_url(),
            'user'              => $this->user,
            'password_required' => FALSE
        );

        // load views
        $data['content'] = $this->load->view('user/profile_form', $content_data, TRUE);
        $this->load->view($this->template, $data);
	}


    /*
     * Displays the logged in user's profile. Redirects to login page if not
     * logged in
     * */
    public function index()
    {
        // display all user information

        if ($this->session->userdata('logged_in'))
        {
            // get user's data and display
            // uses user model
            $userdata = $this->users_model->get_user_by_id($this->_uid); // returning row_array or bool

            // break every CSV data fields and translate into readable info
            $ud = $userdata->row_array();
            // pass con ids array to the private method
            $other_contacts  = $this->_get_other_contacts_of_user(csd_to_array($ud['other_con_ids']));
            $other_addresses = $this->_get_other_contacts_of_user(csd_to_array($ud['other_addr_ids']));
            //$other_educations = $this->_get_other_contacts_of_user(csd_to_array($ud['edu_ids']));
            $followings = $this->_get_follower_or_following_of_user(csd_to_array($ud['following_uids']));
            $followers  = $this->_get_follower_or_following_of_user(csd_to_array($ud['followed_by_uids']));

            //$last_education   = $this->_get_other_contacts_of_user($ud['edu_id']);
            unset($ud['password']);
            unset($ud['salt']);
            unset($ud['validation_code']);
            $primary_contact  = $this->contactno_model->get_only_number_by_id($ud['c_contact_id']);
            $primary_address  = $this->address_model->get_address_by_id($ud['c_addr_id']);
            $ud['sex']  = $this->_get_gender_in_text($ud['gender']);
            $ud['n_following']  = count($followings);
            $ud['n_follower']  = count($followers);

        }
        else {
            // set redirect url in flash, so that user can return here
            $this->session->set_flashdata('redirect', 'profile/index');
            redirect('login');
        }

        // setup page header data
        $this->set_title( lang('profile title welcome') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'usr'              => $ud,
            'primary_contact'    => $primary_contact,
            'other_contacts'    => $other_contacts,
            'primary_address'   => $primary_address,
            'other_addresses'   => $other_addresses,
            'followings'        => $followings,
            'followers'         => $followers,
            'id'                => $this->_uid,
        );


        // load views
        $data['content'] = $this->load->view('profile/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    /**************************************************************************************
     * PRIVATE VALIDATION CALLBACK FUNCTIONS
     **************************************************************************************/

    /*
     * @param array int contact id
     * @return array 2D array containing contacts data, key = type, value = other*/
    private function _get_other_contacts_of_user($cids)
    {
        $other_con_ids = array();
        $this->load->model('contactno_model');
        $this->load->model('keyvalues_model');
        $con_types = $this->keyvalues_model->get_key_values_where_identifier('contact_type');

        foreach ($cids as $cid)
        {
            // check the id valid
            if ($this->contactno_model->is_valid($cid)) {
                $con_res = $this->contactno_model->get_contact_by_id($cid);
                $other_con_ids[$con_types[$con_res['type']]] = $con_res; // settings the type name as key
            }

        }
        return $other_con_ids;
    }

    /*
     * @param array int address id
     * @return array 2D array containing address data, key = type, value = other*/
    private function _get_other_addresses_of_user($aids)
    {
        $other_ids = array();
        $this->load->model('contactno_model');
        $this->load->model('keyvalues_model');
        $types = $this->keyvalues_model->get_key_values_where_identifier('addr_type');

        foreach ($aids as $aid)
        {
            // check the id valid
            if ($this->contactno_model->is_valid($aid)) {
                $con_res = $this->contactno_model->get_contact_by_id($aid);
                $other_ids[$types[$con_res['addr_type']]] = $con_res; // settings the type name as key
            }

        }
        return $other_ids;
    }


    /*
     * @param array int user ids
     * @return array Name of users and their slug/username to make link*/
    private function _get_follower_or_following_of_user($ids)
    {
        $users = array();

        foreach ($ids as $id)
        {
            // check the id valid
            if ($this->users_model->is_valid($id)) {
                $res = $this->users_model->get_username_and_fullname($id);
                $users[] = $res; // settings the type name as key
            }

        }
        return $users;
    }

    /**
     * Make sure username is available
     *
     * @param  string $username
     * @return int|boolean
     */
    function _check_username($username)
    {
        if (trim($username) != $this->user['username'] && $this->users_model->username_exists($username))
        {
            $this->form_validation->set_message('_check_username', sprintf(lang('users error username_exists'), $username));
            return FALSE;
        }
        else
        {
            return $username;
        }
    }


    private function _get_gender_in_text($i)
    {
        switch ($i)
        {
            case 0: $r = "Female"; break;
            case 1: $r = "Male"; break;
            case 2: $r = "Prefer Not To Say"; break;
            default: $r = "Prefer Not To Say";
        }

        return $r;
    }

    /**
     * Make sure email is available
     *
     * @param  string $email
     * @return int|boolean
     */
    function _check_email($email)
    {
        if (trim($email) != $this->user['email'] && $this->users_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email', sprintf(lang('users error email_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }

}
