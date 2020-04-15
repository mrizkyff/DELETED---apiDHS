<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('user/tb_user_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->M_user->json();
    }

    public function read($id) 
    {
        $row = $this->M_user->get_by_id($id);
        if ($row) {
            $data = array(
		'id_user' => $row->id_user,
		'nama' => $row->nama,
		'username' => $row->username,
		'password' => $row->password,
		'email' => $row->email,
		'hp' => $row->hp,
		'foto' => $row->foto,
		'alamat' => $row->alamat,
		'created_at' => $row->created_at,
	    );
            $this->load->view('user/tb_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('user/create_action'),
	    'id_user' => set_value('id_user'),
	    'nama' => set_value('nama'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'email' => set_value('email'),
	    'hp' => set_value('hp'),
	    'foto' => set_value('foto'),
	    'alamat' => set_value('alamat'),
	    'created_at' => set_value('created_at'),
	);
        $this->load->view('user/tb_user_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'email' => $this->input->post('email',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'foto' => $this->input->post('foto',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
	    );

            $this->M_user->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_user->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('user/update_action'),
		'id_user' => set_value('id_user', $row->id_user),
		'nama' => set_value('nama', $row->nama),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'email' => set_value('email', $row->email),
		'hp' => set_value('hp', $row->hp),
		'foto' => set_value('foto', $row->foto),
		'alamat' => set_value('alamat', $row->alamat),
		'created_at' => set_value('created_at', $row->created_at),
	    );
            $this->load->view('user/tb_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'email' => $this->input->post('email',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'foto' => $this->input->post('foto',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
	    );

            $this->M_user->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_user->get_by_id($id);

        if ($row) {
            $this->M_user->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('hp', 'hp', 'trim|required');
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');

	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-15 21:12:49 */
/* http://harviacode.com */