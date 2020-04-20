<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_produk');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('administrator/templates/adm_header');
        $this->load->view('administrator/templates/adm_sidebar');
        $this->load->view('produk/tb_produk_list');
        $this->load->view('administrator/templates/adm_footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->M_produk->json();
    }

    public function read($id) 
    {
        $row = $this->M_produk->get_by_id($id);
        if ($row) {
            $data = array(
            'id_produk' => $row->id_produk,
            'namaBarang' => $row->namaBarang,
            'stok' => $row->stok,
            'harga' => $row->harga,
            'deskripsi' => $row->deskripsi,
            'tgl_stok' => $row->tgl_stok,
            'gambar' => $row->gambar,
	    );
            $this->load->view('produk/tb_produk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('produk/create_action'),
            'id_produk' => set_value('id_produk'),
            'namaBarang' => set_value('namaBarang'),
            'stok' => set_value('stok'),
            'harga' => set_value('harga'),
            'deskripsi' => set_value('deskripsi'),
            'tgl_stok' => set_value('tgl_stok'),
            'gambar' => set_value('gambar'),
	);
        $this->load->view('produk/tb_produk_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'namaBarang' => $this->input->post('namaBarang',TRUE),
		'stok' => $this->input->post('stok',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'tgl_stok' => $this->input->post('tgl_stok',TRUE),
		'gambar' => $this->input->post('gambar',TRUE),
	    );

            $this->M_produk->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('produk'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_produk->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('produk/update_action'),
		'id_produk' => set_value('id_produk', $row->id_produk),
		'namaBarang' => set_value('namaBarang', $row->namaBarang),
		'stok' => set_value('stok', $row->stok),
		'harga' => set_value('harga', $row->harga),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'tgl_stok' => set_value('tgl_stok', $row->tgl_stok),
		'gambar' => set_value('gambar', $row->gambar),
	    );
            $this->load->view('produk/tb_produk_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_produk', TRUE));
        } else {
            $data = array(
		'namaBarang' => $this->input->post('namaBarang',TRUE),
		'stok' => $this->input->post('stok',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'tgl_stok' => $this->input->post('tgl_stok',TRUE),
		'gambar' => $this->input->post('gambar',TRUE),
	    );

            $this->M_produk->update($this->input->post('id_produk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('produk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_produk->get_by_id($id);

        if ($row) {
            $this->M_produk->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('produk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('namaBarang', 'namabarang', 'trim|required');
	$this->form_validation->set_rules('stok', 'stok', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	$this->form_validation->set_rules('tgl_stok', 'tgl stok', 'trim|required');
	$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');

	$this->form_validation->set_rules('id_produk', 'id_produk', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-15 21:12:31 */
/* http://harviacode.com */