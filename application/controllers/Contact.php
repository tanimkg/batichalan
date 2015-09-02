<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Public_Controller
{

    private $_redirect_url;
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('contact');

        // load the model files
        $this->load->model('contact_model');

        $this->load->model('contactno_model');

        // load the captcha helper
        $this->load->helper('captcha');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('contact'));

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

    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/

    public function add()
    {
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('no', lang('contact input no'), 'required|trim|min_length[3]');

        if ($this->form_validation->run() == TRUE) {

            $saved = $this->contactno_model->add($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', 'Contact has been saved');

            } else {
                $this->session->set_flashdata('error', 'There was a problem while saving');
            }

            redirect('contact/index');
        }

        $logged_in_user = $this->session->userdata('logged_in');
        $_uid = $logged_in_user['id'];



        // setup page header data
        $this->set_title(lang('contact add title'));

        $data = $this->includes;

        // set content data
        $this->load->model('keyvalues_model'); // prerequisite


        $content_data = array(
            'uid' => $_uid,
            'contact_id' => NULL,
            'redirect' => $this->_redirect_url,
            'contact' => NULL,
            'privacies' => $this->keyvalues_model->get_privacy_types(),
            'contact_types' => $this->keyvalues_model->get_contact_types(),
        );

        // load views
        $data['content'] = $this->load->view('contact/add', $content_data, TRUE);
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
        $contact = $this->contactno_model->get_contact_by_id($id);

        // if empty results, return to list
        if ( ! $contact)
        {
            redirect($this->_redirect_url);
        }

        $logged_in_user = $this->session->userdata('logged_in');
        $_uid = $logged_in_user['id'];

        // check whether user owns the number or anyhow associated with it. Otherwise do not let user edit
        //$_cid = $this->uri->segment(3, NULL);  // if segment fails/does not exist then return NULL
        if ( ! $this->contactno_model->check_contact_belongs_to_user($_uid, $id)) {

            $this->session->set_flashdata('error', lang('contact edit error'));
            redirect($this->_redirect_url);
        }

        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('no', lang('contact input no'), 'required|trim|min_length[3]');

        if ($this->form_validation->run() == TRUE) {

            $updated = $this->contactno_model->update($this->input->post());

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

        $contacts = $this->contactno_model->get_contacts_of_user($uid);


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
        $data['content'] = $this->load->view('contact/index', $content_data, TRUE);
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
            $c = $this->contactno_model->get_contact_by_id($id);

            if ($c)
            {
                // soft-delete the user
                $delete = $this->contactno_model->soft_delete_contact($id);

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


    /**************************************************************************************
     * PRIVATE VALIDATION CALLBACK FUNCTIONS
     **************************************************************************************/


    /**
     * Verifies correct CAPTCHA value
     *
     * @param  string $captcha
     * @return string|boolean
     */
    function _check_captcha($captcha)
    {
        $verified = $this->contact_model->verify_captcha($captcha);

        if ($verified == FALSE) {
            $this->form_validation->set_message('_check_captcha', lang('contact error captcha'));
            return FALSE;
        } else {
            return $captcha;
        }
    }

}
