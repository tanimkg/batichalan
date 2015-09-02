<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Cause
 */
class Category extends Public_Controller
{


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the model files
        $this->load->model('category_model');
    }


    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/

    public function get_categories( $is_ajax = TRUE )
    {
        $r = $this->category_model->get_categories();

        if ($is_ajax)
        {
            echo json_encode($r);
        }


    }


    public function add()
    {

        // validators
        if ($this->validate_form() == TRUE) {

            $saved = $this->cause_model->add($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', 'Address has been saved');

            } else {
                $this->session->set_flashdata('error', 'There was a problem while saving');
            }

            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title(lang('cause add title'));

        $data = $this->includes;

        // set content data
        $this->load->model('keyvalues_model'); // prerequisite

        $profile_related = ($this->is_profile_related()) ? 1 : 0;

        $content_data = array(
            'uid' => $this->_uid,
            'addr_id' => NULL,
            'profile_related' => $profile_related,
            'cancel' => $this->_redirect_url,
            'cause' => NULL,
            'addr_types' => $this->keyvalues_model->get_key_values_where_identifier('addr_type'),
        );

        // load views
        $data['content'] = $this->load->view('cause/add', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }



    public function edit($id = NULL)
    {
        $cause_id = (($id == NULL) OR ($this->uri->segment(3))) ? $this->uri->segment(3) : NULL;

        // declare $cause = Null, if something is there it will be changed midway
        $cause = NULL;

        // make sure we have a numeric id
        if ( !is_null($id) OR is_numeric($id)) {
            // if user is not the creator of this cause, shoot him up
            if ( ! $this->cause_model->is_crud_authorized($this->_uid, $id)) redirect($this->_redirect_url);
            $cause = $this->cause_model->get_cause_by_id($cause_id);
        }

        // validators
        if ($this->validate_form_step_1() == TRUE) {

            $saved = $this->cause_model->update($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', lang('cause m saved'));

            } else {
                $this->session->set_flashdata('error', lang('core error save'));
            }
            $this->_redirect_url = base_url('cause/edit_step_2/' . $saved);
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title(lang('cause edit title'));

        $data = $this->includes;

        $content_data = array(
            'uid' => $this->_uid,
            'cause_id' => $cause_id,    // null in case of new add, int if edit
            'cancel' => $this->_redirect_url,
            'cause' => $cause,
        );

        // load views
        $data['content'] = $this->load->view('cause/add_step_1', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    public function index()
    {

        $res_data = $this->cause_model->get_causes_of_user($this->_uid);


        // setup page header data
        $this->set_title(lang('cause list title'));

        $data = $this->includes;

        // set content data
        $this->load->model('keyvalues_model'); // prerequisite


        $content_data = array(
            'uid' => $this->_uid,
            'addresses' => $res_data,
            'addr_types' => $this->keyvalues_model->get_key_values_where_identifier('addr_type'),
        );

        // load views
        $data['content'] = $this->load->view('cause/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    public function view( $id = NULL )
    {
        $cause_id = (($id == NULL) OR ($this->uri->segment(3))) ? $this->uri->segment(3) : NULL;

        // make sure we have a numeric id
        if ( !is_null($id) OR is_numeric($id)) {
            $cause = $this->cause_model->get_cause_by_id($cause_id);
        }

        // setup page header data
        $this->set_title($cause['cause_title']);

        $data = $this->includes;

        $content_data = array(
            'uid' => $this->_uid,
            'cause_id' => $cause_id,
            'cause' => $cause,
        );

        // load views
        $data['content'] = $this->load->view('cause/view', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    private function validate_form()
    {
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('cause_addr_line', lang('cause input addr_line_1'), 'trim');
        $this->form_validation->set_rules('cause_addr_area', lang('cause input cause_addr_area'), 'trim');
        $this->form_validation->set_rules('cause_addr_city', lang('cause input cause_addr_city'), 'required|trim');
        $this->form_validation->set_rules('cause_addr_state', lang('cause input cause_addr_state'), 'trim');
        $this->form_validation->set_rules('cause_addr_country', lang('cause input cause_addr_country'), 'required|trim');

        $this->form_validation->set_rules('cause_title', lang('cause input cause_title'), 'required|trim');
        $this->form_validation->set_rules('cause_desc', lang('cause input cause_desc'), 'required|trim');

        if ($this->form_validation->run() == TRUE) return TRUE;

        return FALSE;
    }

    /**
     * Delete an cause
     *
     * @param  int $id
     */
    function delete()
    {
        // TODO: delete is not working. Moving on
        $id = $this->uri->segment(3);
        // make sure we have a numeric id
        if (!is_null($id) OR !is_numeric($id)) {
            // if cause belongs to the user
            if ($this->cause_model->is_created_by_user($this->_uid, $id)) {
                $delete = $this->cause_model->delete_address($id);

                if ($delete) {
                    $this->session->set_flashdata('message', lang('cause msg deleted'));
                } else {
                    $this->session->set_flashdata('error', lang('cause error deletefail'));
                }

            } else {
                $this->session->set_flashdata('error', lang('cause error belong'));
            }
        } else {
            $this->session->set_flashdata('error', lang('cause id required'));
        }


        // return to list and display message
        redirect($this->_redirect_url);
    }


}
