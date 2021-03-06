<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Education extends Public_Controller
{

    private $_redirect_url;
    private $_uid;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('education');

        // load the model files
        $this->load->model('education_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('education'));

        // use the url in session (if available) to return to the previous filter/sorted/paginated list
        if ($this->session->userdata(REFERRER)) {
            $this->_redirect_url = $this->session->userdata(REFERRER);
        } else {
            $this->_redirect_url = THIS_URL;
        }

        // get logged in user's detail
        $logged_in_user = $this->session->userdata('logged_in');
        if ($logged_in_user['id']) {
            $this->_uid = $logged_in_user['id'];
        } else {
            $this->_uid = NULL;
        }

    }


    public function test()
    {

    }

    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/

    public function add()
    {
        // use referer to note whether the education is profile related or not

        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('addr_line_1', lang('education input addr_line_1'), 'trim');
        $this->form_validation->set_rules('addr_line_2', lang('education input addr_line_2'), 'trim');
        $this->form_validation->set_rules('city', lang('education input city'), 'required|trim');
        $this->form_validation->set_rules('country', lang('education input country'), 'required|trim');

        if ($this->form_validation->run() == TRUE) {

            $saved = $this->education_model->add($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', 'Address has been saved');

            } else {
                $this->session->set_flashdata('error', 'There was a problem while saving');
            }

            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title(lang('education add title'));

        $data = $this->includes;

        // set content data
        $this->load->model('keyvalues_model'); // prerequisite

        $profile_related = ($this->is_profile_related()) ? 1 : 0;

        $content_data = array(
            'uid' => $this->_uid,
            'addr_id' => NULL,
            'profile_related' => $profile_related,
            'cancel' => $this->_redirect_url,
            'education' => NULL,
            'addr_types' => $this->keyvalues_model->get_key_values_where_identifier('addr_type'),
        );

        // load views
        $data['content'] = $this->load->view('education/add', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    private function is_profile_related()
    {
        $this->load->library('user_agent');  // load user agent library
        // save the redirect_back data from referral url (where user first was prior to login)
        $this->session->set_userdata('redirect_back', $this->agent->referrer());

        // split at /, if referrer url does not contain 'profile', then it is not profile related
        // so set profile related to 0
        $_dirty = explode('/', $this->session->userdata('redirect_back'));
        $profile_related = FALSE;
        if (in_array('profile', $_dirty) || in_array('dashboard', $_dirty)) $profile_related = TRUE;

        return $profile_related;
    }


    public function edit($id = NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR !is_numeric($id)) {
            redirect($this->_redirect_url);
        }

        // get the data
        $address = $this->education_model->get_address_by_id($id);

        // if empty results, return to list
        if (!$address) {
            redirect($this->_redirect_url);
        }

        // check whether user owns the education or anyhow associated with it. Otherwise do not let user edit
        //$_cid = $this->uri->segment(3, NULL);  // if segment fails/does not exist then return NULL
        if (!$this->education_model->check_address_belongs_to_user($this->_uid, $id)) {

            $this->session->set_flashdata('error', lang('contact edit error'));
            redirect($this->_redirect_url);
        }

        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('addr_line_1', lang('education input addr_line_1'), 'trim');
        $this->form_validation->set_rules('addr_line_2', lang('education input addr_line_2'), 'trim');
        $this->form_validation->set_rules('city', lang('education input city'), 'required|trim');
        $this->form_validation->set_rules('country', lang('education input country'), 'required|trim');

        if ($this->form_validation->run() == TRUE) {

            $saved = $this->education_model->update($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', lang('education msg update'));

            } else {
                $this->session->set_flashdata('error', lang('education error savefail'));
            }

            redirect($this->_redirect_url);
        }

        $profile_related = ($this->is_profile_related()) ? 1 : 0;

        // setup page header data
        $this->set_title(lang('education edit title'));

        $data = $this->includes;

        // set content data
        $this->load->model('keyvalues_model'); // prerequisite
        $content_data = array(
            'uid' => $this->_uid,
            'addr_id' => $id,
            'profile_related' => $profile_related,
            'cancel' => $this->_redirect_url,
            'education' => $address,
            'addr_types' => $this->keyvalues_model->get_key_values_where_identifier('addr_type'),   // array
        );

        // load views
        $data['content'] = $this->load->view('education/add', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    public function index()
    {

        $res_data = $this->education_model->get_addresses_of_user($this->_uid);


        // setup page header data
        $this->set_title(lang('education list title'));

        $data = $this->includes;

        // set content data
        $this->load->model('keyvalues_model'); // prerequisite


        $content_data = array(
            'uid' => $this->_uid,
            'addresses' => $res_data,
            'addr_types' => $this->keyvalues_model->get_key_values_where_identifier('addr_type'),
        );

        // load views
        $data['content'] = $this->load->view('education/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    public function view()
    {
    }

    /**
     * Delete an education
     *
     * @param  int $id
     */
    function delete()
    {
        // TODO: delete is not working. Moving on
        $id = $this->uri->segment(3);
        // make sure we have a numeric id
        if (!is_null($id) OR !is_numeric($id)) {
            // if education belongs to the user
            if ($this->education_model->is_created_by_user($this->_uid, $id)) {
                $delete = $this->education_model->delete_address($id);

                if ($delete) {
                    $this->session->set_flashdata('message', lang('education msg deleted'));
                } else {
                    $this->session->set_flashdata('error', lang('education error deletefail'));
                }

            } else {
                $this->session->set_flashdata('error', lang('education error belong'));
            }
        } else {
            $this->session->set_flashdata('error', lang('education id required'));
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


}
