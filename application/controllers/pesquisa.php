<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesquisa extends CI_Controller {
	
	
	public function __construct() 
	{
	parent::__construct();
	$this->load->helper('url');
	$this->load->helper('form');
	$this->load->helper('array');
	$this->load->helper('form');
	$this->load->library('form_validation');	
	$this->load->library('session');
	$this->load->library('table');
	//$this->load->library('MY_Form_validation');
	$this->load->model('filmes','filmesmodel');
	$this->load->model('user','usermodel');
	}
	
	
	
	
	public function index (){



		

		
		$pesquisaquery = $this->filmesmodel->pesquisa1($this->input->post('PESQUISA'));
		$pesquisa = $pesquisaquery->result();
		$quantos = $pesquisaquery->num_rows();
		$dadospesqisa = array ('data'=>$pesquisa);	
			
			
			
		if($this->input->post('PESQUISA')=='')
			redirect(base_url());
			
			
			
		$this->load->view('includes/header');
		$session_id = $this->session->userdata('session_id');
		$IDUTILIZADOR = $this->usermodel->getuser($session_id);
		
		if ($IDUTILIZADOR ==FALSE){
			$this->load->view('includes/navbar_base');
			$this->load->view('includes/navbar_direitaLOGIN');	
		}
		else {
			$this->load->view('includes/navbar_base');	
			$this->load->view('includes/navbar_direitaLOGOUT');	
		}
		$this->load->view('pesquisa.php',$dadospesqisa);
		
		
		
		echo "post = ";
		var_dump($this->input->post());
		echo "-------------------------<p>Pesquisa = ";
		var_dump($pesquisa);
		echo "-------------------------<p> Quantos = ";
		var_dump($quantos);
		
		$this->load->view('includes/footer');	
	}
		
			
			
} ?>