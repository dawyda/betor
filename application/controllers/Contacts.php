<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if($this->input->post("submit") !== null)
		{
			$this->load->library('email');
			$this->email->to("support@betips.co.ke");
			$this->email->from("betipsco@betips.co.ke");
			$this->email->subject($this->input->post("subject"));
			$this->email->message($this->input->post("content") . " <br />Sent by" . $this->input->post("email"));
			$this->email->mail_type("html");
			$send = $this->email->send();
			if($send){
				$this->email->clear();
				//send email to user
				$config = Array(
					    'protocol' => 'smtp',
					    'smtp_host' => 'ssl://root.server-ke138.com',
					    'smtp_port' => 465,
					    'smtp_user' => 'no-reply@betips.co.ke',
					    'smtp_pass' => 'betips1234#!',
					    'mailtype'  => 'html', 
					    'charset'   => 'iso-8859-1'
					);
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");

				$this->email->from('no-reply@betips.co.ke');
				$this->email->to($this->input->post("email"));
				$this->email->subject('We have recieved your feedback. Thank you.');
				$text = 'Hi '.$this->input->post("names").',<br/><br/>';
				$text .= 'Thanks for letting us kow what you think about our site and services. We have received the following from you.<br /><b>';
				$text .= $this->input->post("content");
				$text .= '</b><br /><br />Kind Regards,<br /><b>Betips.co.ke,</b> <br />www.betips.co.ke <br />Terms and conditions apply.';
				$this->email->message($text);
				$this->email->reply_to('no-reply@betips.co.ke');
				
				$send = $this->email->send();
				
				$this->load->view("contacts", array("display_msg" => "Your quest has been received."));
			}
			else{
				$this->load->view("contacts", array("display_msg" => "We are sorry. A server error occured. Please try again later."));
			}
		}
		else {
			$this->load->view('contacts');
		}
	}
}
