<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends Public_Controller
{

    private $_redirect_url;
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('address');

        // load the model files
        $this->load->model('address_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('address'));

        // use the url in session (if available) to return to the previous filter/sorted/paginated list
        if ($this->session->userdata(REFERRER))
        {
            $this->_redirect_url = $this->session->userdata(REFERRER);
        }
        else
        {
            $this->_redirect_url = THIS_URL;
        }
    }


    public function test ()
    {
        $this->load->library('user_agent');  // load user agent library
        // save the redirect_back data from referral url (where user first was prior to login)
        $this->session->set_userdata('redirect_back', $this->agent->referrer() );


        print_r($this->session->userdata('redirect_back'));
    }

    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/

    public function add()
    {
        // use referer to note whether the address is profile related or not

        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('addr_line_1', lang('address input addr_line_1'), 'trim');
        $this->form_validation->set_rules('addr_line_2', lang('address input addr_line_2'), 'trim');
        $this->form_validation->set_rules('city', lang('address input city'), 'required|trim');
        $this->form_validation->set_rules('country', lang('address input country'), 'required|trim');

        if ($this->form_validation->run() == TRUE) {

            $saved = $this->address_model->add($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', 'Address has been saved');

            } else {
                $this->session->set_flashdata('error', 'There was a problem while saving');
            }

            redirect($this->_redirect_url);
        }

        $logged_in_user = $this->session->userdata('logged_in');
        $_uid = $logged_in_user['id'];


        // setup page header data
        $this->set_title(lang('address add title'));

        $data = $this->includes;

        // set content data
        $this->load->model('keyvalues_model'); // prerequisite
        $this->load->library('user_agent');  // load user agent library
        // save the redirect_back data from referral url (where user first was prior to login)
        $this->session->set_userdata('redirect_back', $this->agent->referrer() );

        // split at /, if referrer url does not contain 'profile', then it is not profile related
        // so set profile related to 0
        $_dirty = explode('/', $this->session->userdata('redirect_back'));
        $profile_related = 0;
        if (in_array('profile', $_dirty) || in_array('dashboard', $_dirty)) $profile_related = 1;

        $content_data = array(
            'uid' => $_uid,
            'addr_id' => NULL,
            'profile_related' => $profile_related,
            'cancel' => $this->_redirect_url,
            'address' => NULL,
            'addr_types' => $this->keyvalues_model->get_key_values_where_identifier('addr_type'),
        );

        // load views
        $data['content'] = $this->load->view('address/add', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }




    public function edit($id = NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $contact = $this->address_model->get_contact_by_id($id);

        // if empty results, return to list
        if ( ! $contact)
        {
            redirect($this->_redirect_url);
        }

        $logged_in_user = $this->session->userdata('logged_in');
        $_uid = $logged_in_user['id'];

        // check whether user owns the number or anyhow associated with it. Otherwise do not let user edit
        //$_cid = $this->uri->segment(3, NULL);  // if segment fails/does not exist then return NULL
        if ( ! $this->address_model->check_contact_belongs_to_user($_uid, $id)) {

            $this->session->set_flashdata('error', lang('contact edit error'));
            redirect($this->_redirect_url);
        }

        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('no', lang('contact input no'), 'required|trim|min_length[3]');

        if ($this->form_validation->run() == TRUE) {

            $updated = $this->address_model->update($this->input->post());

            // set message
            if ($updated) {
                $this->session->set_flashdata('message', 'Contact has been updated');

            } else {
                $this->session->set_flashdata('error', 'There was a problem while saving');
            }

            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title(lang('contact edit title'));

        $data = $this->includes;

        // set content data
        $this->load->model('keyvalues_model'); // prerequisite


        $content_data = array(
            'uid' => $_uid,
            'contact_id' => $id,
            'contact' => $contact,
            'redirect' => $this->_redirect_url,
            'privacies' => $this->keyvalues_model->get_privacy_types(),
            'contact_types' => $this->keyvalues_model->get_contact_types(),
        );

        // load views
        $data['content'] = $this->load->view('contact/add', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }




    public function index()
    {
        $logged_in_user = $this->session->userdata('logged_in');
        $uid = $logged_in_user['id'];

        $contacts = $this->address_model->get_addresses_of_user($uid);


        // setup page header data
        $this->set_title(lang('contact list title'));

        $data = $this->includes;

        // set content data
        $this->load->model('keyvalues_model'); // prerequisite


        $content_data = array(
            'uid' => $uid,
            'contacts' => $contacts,
            'privacies' => $this->keyvalues_model->get_privacy_types(),
            'contact_types' => $this->keyvalues_model->get_contact_types(),
        );

        // load views
        $data['content'] = $this->load->view('address/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    public function view()
    {
    }

    /**
     * Delete a contact
     *
     * @param  int $id
     */
    function delete($id = NULL)
    {
        // make sure we have a numeric id
        if ( ! is_null($id) OR ! is_numeric($id))
        {
            // get contact details
            $c = $this->address_model->get_contact_by_id($id);

            if ($c)
            {
                // soft-delete the user
                $delete = $this->address_model->soft_delete_contact($id);

                if ($delete)
                {
                    $this->session->set_flashdata('message', 'Contact deleted');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Failed to delete. Try again!');
                }
            }
            else
            {
                $this->session->set_flashdata('error', lang('contact not exist'));
            }
        }
        else
        {
            $this->session->set_flashdata('error', lang('contact id required'));
        }

        // return to list and display message
        redirect($this->_redirect_url);
    }


    public function list_all()
    {
    }

    /**
     * Default
     */
    public function contact_us()
    {
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('name', lang('contact input name'), 'required|trim|max_length[64]');
        $this->form_validation->set_rules('email', lang('contact input email'), 'required|trim|valid_email|min_length[10]|max_length[256]');
        $this->form_validation->set_rules('title', lang('contact input title'), 'required|trim|max_length[128]');
        $this->form_validation->set_rules('message', lang('contact input message'), 'required|trim|min_length[10]');
        $this->form_validation->set_rules('captcha', lang('contact input captcha'), 'required|trim|callback__check_captcha');

        if ($this->form_validation->run() == TRUE) {
            // attempt to save and send the message
            $post_data = $this->security->xss_clean($this->input->post());
            $saved_and_sent = $this->contact_model->save_and_send_message($post_data, $this->settings);

            if ($saved_and_sent) {
                // redirect to home page
                $this->session->set_flashdata('message', sprintf(lang('contact msg send_success'), $this->input->post('name', TRUE)));
                redirect(base_url());
            } else {
                // stay on contact page
                $this->error = sprintf(lang('contact error send_failed'), $this->input->post('name', TRUE));
            }
        }

        // create captcha image
        $captcha = create_captcha(array(
            'img_path' => "./captcha/",
            'img_url' => base_url('/captcha') . "/",
            'font_path' => BASEPATH . "fonts/Bromine.ttf",
            'img_width' => 170,
            'img_height' => 50
        ));

        $captcha_data = array(
            'captcha_time' => $captcha['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $captcha['word']
        );

        // store captcha image
        $this->contact_model->save_captcha($captcha_data);

        // setup page header data
        $this->set_title(lang('contact title'));

        $data = $this->includes;

        // set content data
        $content_data = array(
            'captcha_image' => $captcha['image']
        );

        // load views
        $data['content'] = $this->load->view('contact/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


}
