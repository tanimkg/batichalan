<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Promote extends Private_Controller
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
        $this->lang->load('promote');

        // load the model files
        $this->load->model('promote_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('address'));

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


    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/

    public function add()
    {
        // validators
        if ($this->validate_form() == TRUE) {

            $saved = $this->promote_model->add($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', lang('promote m saved'));

            } else {
                $this->session->set_flashdata('error', lang('core error save'));
            }

            redirect('promote/view/'.$saved);
        }

        $data = array(
            'uid' => $this->_uid,
            'promote_id' => NULL,
            'cancel' => $this->_redirect_url,
            'promote' => NULL,
            'page_title' => lang('promote add title')
        );

        // load views
        $this->public_view('promote/add', $data);
    }

    public function edit($id = NULL)
    {
        $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : $id;

        // make sure we have a numeric id
        if (is_null($id) OR !is_numeric($id)) {
            redirect($this->_redirect_url);
        }

        // get the data
        $promote = $this->promote_model->get_promote_by_id($id);

        // if empty results, return to list
        if (!$promote) {
            redirect($this->_redirect_url);
        }

        // check whether user owns the promote or anyhow associated with it. Otherwise do not let user edit
        if (!$this->promote_model->is_crud_authorized($this->_uid, $id)) {

            $this->session->set_flashdata('error', lang('promote error not found'));
            redirect($this->_redirect_url);
        }

        // validators

        if ($this->validate_form() == TRUE) {

            $saved = $this->promote_model->update($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', lang('promote m update'));

            } else {
                $this->session->set_flashdata('error', lang('promote e savefail'));
            }

            redirect('promote/view/'.$saved);
        }

        $data = array(
            'uid' => $this->_uid,
            'promote_id' => $id,
            'cancel' => $this->_redirect_url,
            'promote' => $promote,
            'page_title' => lang('promote edit title')
        );

        // load views
        $this->public_view('promote/add', $data);
    }


    public function index()
    {

        $res_data = $this->promote_model->get_addresses_of_user($this->_uid);

        // set content data
        $this->load->model('keyvalues_model'); // prerequisite


        $data = array(
            'uid' => $this->_uid,
            'addresses' => $res_data,
            'addr_types' => $this->keyvalues_model->get_key_values_where_identifier('addr_type'),
            'page_title' => lang('address list title')
        );

        // load views
        $this->public_view('address/index', $data);
    }

    public function view($id = NULL)
    {
        $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : $id;

        // make sure we have a numeric id
        if (is_null($id) OR !is_numeric($id)) {
            redirect($this->_redirect_url);
        }

        // get the data
        $promote = $this->promote_model->get_promote_by_id($id);

        // if empty results, return to list
        if (!$promote) {
            redirect($this->_redirect_url);
        }

        // send creator's details
        $this->load->model('users_model');
        $this->load->model('contactno_model');
        $creator = $this->users_model->get_user($promote['created_by_uid']);
        $creator_contact = $this->contactno_model->get_contact_by_id($creator['c_contact_id']);

        $data = array(
            'creator' => $creator,
            'contact' => $creator_contact,
            'promote_id' => $id,
            'cancel' => $this->_redirect_url,
            'promote' => $promote,
            'page_title' => $promote['title']
        );

        // load views
        $this->public_view('promote/view', $data);

    }

    /**
     * Delete an address
     *
     * @param  int $id
     */
    function delete()
    {
        $id = $this->input->post('delete_id', TRUE);
        $redir = $this->input->post('redir', TRUE);
        // make sure we have a numeric id
        if (!is_null($id) OR !is_numeric($id)) {
            // if address belongs to the user
            if ($this->promote_model->is_created_by_user($this->_uid, $id)) {
                $delete = $this->promote_model->delete_address($id);

                if ($delete) {
                    $this->session->set_flashdata('message', lang('address msg deleted'));
                } else {
                    $this->session->set_flashdata('error', lang('address error deletefail'));
                }

            } else {
                $this->session->set_flashdata('error', lang('address error belong'));
            }
        } else {
            $this->session->set_flashdata('error', lang('address id required'));
        }


        // return to list and display message
        redirect($this->_redirect_url);
    }


    /**************************************************************************************
     * PRIVATE FUNCTIONS
     **************************************************************************************/

    private function validate_form()
    {
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('addr_line', lang('promote input addr_line'), 'trim');
        $this->form_validation->set_rules('addr_area', lang('promote input addr_area'), 'trim');
        $this->form_validation->set_rules('addr_city', lang('promote input addr_city'), 'required|trim');
        $this->form_validation->set_rules('addr_country', lang('promote input addr_country'), 'required|trim');
        $this->form_validation->set_rules('title', lang('promote input title'), 'required|trim');
        //$this->form_validation->set_rules('category', lang('core input category'), 'required|trim');
        $this->form_validation->set_rules('description', lang('promote input description'), 'required|trim');
        $this->form_validation->set_rules('conditions', lang('promote input conditions'), 'trim');
        $this->form_validation->set_rules('tags', lang('promote input tags'), 'trim');
        $this->form_validation->set_rules('promotable_space', lang('promote input promotable_space'), 'numeric|min_length[0]|max_length[3]|trim');

        if ($this->form_validation->run() == TRUE) return TRUE;

        return FALSE;
    }


}
