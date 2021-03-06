<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Cause
 */
class Cause extends Private_Controller
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
        $this->lang->load('cause');

        // load the model files
        $this->load->model('cause_model');

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

    public function add_step_1()
    {
        // validators
        if ($this->validate_form_step_1() == TRUE) {

            $saved = $this->cause_model->add_step_1($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', lang('cause m saved'));

            } else {
                $this->session->set_flashdata('error', lang('core error save'));
            }
            $this->_redirect_url = base_url('cause/edit_step_2/' . $saved);
            redirect($this->_redirect_url);
        }

        $data = array(
            'uid' => $this->_uid,
            'page_title' => lang('cause add title'),
            'cause_id' => NULL,    // null in case of new add, int if edit
            'cancel' => $this->_redirect_url,
            'cause' => NULL,
        );

        // load views
        $this->public_view('cause/add_step_1', $data);
    }

    public function edit_step_2( $id = NULL )
    {
        $cause_id = ($id == NULL) ? $this->uri->segment(3) : $id;
        // if user is not the creator of this cause, shoot him up
        if ( ! $this->cause_model->is_crud_authorized($this->_uid, $cause_id)) redirect($this->_redirect_url);

        // validators
        if ($this->validate_form_step_2() == TRUE) {

            $saved = $this->cause_model->update($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', lang('cause m updated'));

            } else {
                $this->session->set_flashdata('error', lang('core error save'));
            }
            $this->_redirect_url = base_url('cause/edit_step_3/' . $saved);
            redirect($this->_redirect_url);
        }

        $data = array(
            'uid' => $this->_uid,
            'cause_id' => $cause_id,
            'cancel' => $this->_redirect_url,
            'cause' => $this->cause_model->get_cause_by_id($cause_id),
            'page_title' => lang('cause edit title')
        );

        // load views
        $this->public_view('cause/add_step_2', $data);

    }

    public function edit_step_3($id = NULL)
    {
        $cause_id = ($id == NULL) ? $this->uri->segment(3) : $id;

        // if user is not the creator of this cause, shoot him up
        if ( ! $this->cause_model->is_crud_authorized($this->_uid, $cause_id)) redirect($this->_redirect_url);

        // validators
        if ($this->validate_form_step_3() == TRUE) {

            $saved = $this->cause_model->update($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', lang('cause m updated'));

            } else {
                $this->session->set_flashdata('error', lang('core error save'));
            }
            $this->_redirect_url = base_url('cause/view/' . $saved);
            redirect($this->_redirect_url);
        }

        $data = array(
            'uid' => $this->_uid,
            'cause_id' => $cause_id,
            'cancel' => $this->_redirect_url,
            'cause' => $this->cause_model->get_cause_by_id($cause_id),
            'page_title' => lang('cause edit title')
        );

        // load views
        $this->public_view('cause/add_step_3', $data);
    }

    /*
     * Displays recent posts by other users
     * */
    public function recent($last_id = NULL)
    {
        $last_id = (($last_id == NULL) OR ($this->uri->segment(3))) ? $this->uri->segment(3) : NULL;

        $res_data = $this->cause_model->get_recents($last_id);
        // make the result array cleaner by stripping away the last id and assigning it to another var
        $last_id = $res_data['last_id']; // initial last id val changed here
        unset($res_data['last_id']);

        $data['causes'] = $res_data;
        $data['last_id'] = $last_id;
        $this->load->view('cause/single_entry', $data);

    }


    public function index()
    {
        $data['page_title'] = 'Apply for a Cause';
        $this->public_view('cause/index', $data);
    }

    public function view( $id = NULL )
    {
        $cause_id = (($id == NULL) OR ($this->uri->segment(3))) ? $this->uri->segment(3) : NULL;

        // make sure we have a numeric id
        if ( !is_null($id) OR is_numeric($id)) {
            $cause = $this->cause_model->get_cause_by_id($cause_id);
        }

        $data = array(
            'uid' => $this->_uid,
            'cause_id' => $cause_id,
            'cause' => $cause,
            'page_title' => $cause['cause_title']
        );

        // load views
        $this->public_view('cause/view', $data);
    }

    // TODO: Not implemented yet
    public function supporters($id = NULL)
    {
        $cause_id = (($id == NULL) OR ($this->uri->segment(3))) ? $this->uri->segment(3) : NULL;

        // make sure we have a numeric id
        if ( !is_null($id) OR is_numeric($id)) {
            $cause = $this->cause_model->get_cause_by_id($cause_id);


        }

        $data = array(
            'uid' => $this->_uid,
            'cause_id' => $cause_id,
            'cause' => $cause,
            'page_title' => $cause['cause_title'],
        );

        // load views
        $this->public_view('cause/supporters', $data);
    }


    private function validate_form_step_1()
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

    private function validate_form_step_2()
    {
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('to_addr_line', lang('cause input addr_line_1'), 'trim');
        $this->form_validation->set_rules('to_addr_area', lang('cause input to_addr_area'), 'trim');
        $this->form_validation->set_rules('to_addr_city', lang('cause input to_addr_city'), 'required|trim');
        $this->form_validation->set_rules('to_addr_state', lang('cause input to_addr_state'), 'trim');
        $this->form_validation->set_rules('to_addr_country', lang('cause input to_addr_country'), 'required|trim');

        $this->form_validation->set_rules('to_apt', lang('cause input to_apt'), 'trim');
        $this->form_validation->set_rules('to_name', lang('cause input to_name'), 'trim');
        $this->form_validation->set_rules('to_sec', lang('cause input to_sec'), 'trim');
        $this->form_validation->set_rules('to_org', lang('cause input to_org'), 'required|trim');
        $this->form_validation->set_rules('cause_id', 'Cause ID', 'required|numeric');

        if ($this->form_validation->run() == TRUE) return TRUE;

        return FALSE;
    }

    private function validate_form_step_3()
    {
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));

        $this->form_validation->set_rules('tags', lang('cause input tags'), 'trim');


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
