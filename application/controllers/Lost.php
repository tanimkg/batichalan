<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Cause
 */
class Lost extends Private_Controller
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
        $this->lang->load('lost');

        // load the model files
        $this->load->model('lost_model');

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

    public function recent($is_ajax = TRUE)
    {

    }


    public function add()
    {
        // validators
        if ($this->validate_form() == TRUE) {

            $saved = $this->lost_model->add($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', lang('lost m saved'));

            } else {
                $this->session->set_flashdata('error', lang('core error save'));
            }
            redirect($this->_redirect_url);
        }

        $data = array(
            'uid' => $this->_uid,
            'page_title' => lang('lost add title'),
            'lost_id' => NULL,    // null in case of new add, int if edit
            'cancel' => $this->_redirect_url,
            'lost' => NULL,
        );

        // load views
        $this->public_view('lost/add', $data);
    }



    public function edit($id = NULL)
    {
        $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : $id;

        // if user is not the creator of this cause, shoot him up
        if ( ! $this->lost_model->is_crud_authorized($this->_uid, $id)) redirect($this->_redirect_url);

        // validators
        if ($this->validate_form() == TRUE) {

            $saved = $this->lost_model->update($this->input->post());

            // set message
            if ($saved) {
                $this->session->set_flashdata('message', lang('cause m updated'));

            } else {
                $this->session->set_flashdata('error', lang('core error save'));
            }
            $this->_redirect_url = base_url('lost/view/' . $saved);
            redirect($this->_redirect_url);
        }

        $data = array(
            'uid' => $this->_uid,
            'lost_id' => $id,
            'cancel' => $this->_redirect_url,
            'lost' => $this->lost_model->get_lost_by_id($id),
            'page_title' => lang('lost edit title')
        );

        // load views
        $this->public_view('lost/add', $data);
    }


    /*
     * Displays recent posts by other users
     * */
    public function index()
    {

        $res_data = $this->lost_model->get_losts_of_user($this->_uid);

        // set content data
        $this->load->model('keyvalues_model'); // prerequisite


        $data = array(
            'uid' => $this->_uid,
            'addresses' => $res_data,
            'addr_types' => $this->keyvalues_model->get_key_values_where_identifier('addr_type'),
            'page_title' => lang('lost list title')
        );

        // load views
        $this->public_view('lost/index', $data);
    }

    public function view( $id = NULL )
    {
        $lost_id = (($id == NULL) OR ($this->uri->segment(3))) ? $this->uri->segment(3) : NULL;

        // make sure we have a numeric id
        if ( !is_null($id) OR is_numeric($id)) {
            $lost = $this->lost_model->get_lost_by_id($lost_id);
        }

        $data = array(
            'uid' => $this->_uid,
            'lost_id' => $lost_id,
            'lost' => $lost,
            'page_title' => $lost['lost_title']
        );

        // load views
        $this->public_view('lost/view', $data);
    }

    private function validate_form()
    {
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('addr_line', lang('lost input addr_line'), 'trim');
        $this->form_validation->set_rules('addr_area', lang('lost input addr_area'), 'trim');
        $this->form_validation->set_rules('addr_city', lang('lost input addr_city'), 'required|trim');
        $this->form_validation->set_rules('addr_country', lang('lost input addr_country'), 'required|trim');

        $this->form_validation->set_rules('item_name', lang('lost input item_name'), 'required|trim');
        $this->form_validation->set_rules('item_desc', lang('lost input item_desc'), 'required|trim');
        $this->form_validation->set_rules('category', lang('lost input category'), 'required|trim');
        $this->form_validation->set_rules('tags', lang('lost input tags'), 'trim');

        if ($this->form_validation->run() == TRUE) return TRUE;

        return FALSE;
    }

    /**
     * Delete an lost
     *
     * @param  int $id
     */
    function delete()
    {
        // TODO: delete is not working. Moving on
        $id = $this->uri->segment(3);
        // make sure we have a numeric id
        if (!is_null($id) OR !is_numeric($id)) {
            // if lost belongs to the user
            if ($this->lost_model->is_created_by_user($this->_uid, $id)) {
                $delete = $this->lost_model->delete_address($id);

                if ($delete) {
                    $this->session->set_flashdata('message', lang('lost msg deleted'));
                } else {
                    $this->session->set_flashdata('error', lang('lost error deletefail'));
                }

            } else {
                $this->session->set_flashdata('error', lang('lost error belong'));
            }
        } else {
            $this->session->set_flashdata('error', lang('lost id required'));
        }


        // return to list and display message
        redirect($this->_redirect_url);
    }


}
