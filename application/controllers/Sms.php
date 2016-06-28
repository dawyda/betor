<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {

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
		redirect("home");
	}
	
	/**
	* @the url to be accessed on phone
	**/
	public function action_url()
	{
		$action = $this->input->post("action");
		$phone = $this->input->post("phone_number");
		if($phone !== "0721264227")
		{
			$this->output->set_header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
			$this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
			$this->output->set_header("Content-Type: application/json");
			die('{"events":[{"event":"log","message":"Unknown number. Access is denied!"}]}');
		}
		switch($action)
		{
			case "test":
				$this->doTest();
				break;
			case "incoming":
				$this->incoming_sms($this->input->post("message"));
				break;
			case "outgoing":
				$this->outgoing_sms();
				break;
			default:
				$this->output->set_header("Content-Type: application/json");
				echo '{"events":[{"event":"log","message":"Unknown number. Access is denied!"}]}';
				break;
		}
	}
	
	private function outgoing_sms()
	{
		$this->output->set_header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		$this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		$this->output->set_header("Content-Type: application/json");
		echo '{"events":[{"event":"log","message":"No outgoing SMSs found on server."}]}';
	}
	
	private function incoming_sms($message)
	{
		//verify it is from M-PESA and not fraud
		$from = $this->input->post("from");
		if($from != "M-PESA")
		{
			$this->output->set_header("Content-Type: application/json");
			echo '{"events":[{"event":"log","message":"REJECTED. Message not from M-PESA!"}]}';
			exit;
		}
		
		//load all models to be used
		$this->load->model("betor_users");
		$this->load->model("betor_sms");
		$this->load->model("betor_credits");
		$this->load->model("betor_transactions");
		//split sms
		$message_info = $this->betor_sms->get_msg_parts($message);
		//check if duplicate incoming_sms
		$duplicate = $this->betor_sms->is_duplicate($message_info["t_code"]);
		if($duplicate)
		{
			$this->output->set_header("Content-Type: application/json");
			echo '{"events":[{"event":"log","message":"OK. Duplicate."}]}';
			exit;
		}
		//get user who paid
		$user_info = $this->betor_users->get_user_from_num($message_info["sender_num"]);
		if($user_info == NULL || count($user_info) < 1)
		{
			$this->output->set_header("Content-Type: application/json");
			echo '{"events":[{"event":"log","message":"User number not in catalog. Payment declined."}]}';
			//add to payment mismatch
			$this->betor_transactions->add_mismatched($message_info);
			exit;
		}
		//check amount sent then set credits & subscription
		$credits = 1;
		$acc_type = $user_info["m_type"];
		$days = 1;
		
		switch ($message_info["amount"])
		{
			case 1000: //premium weekly
				$credits = 2;
				$acc_type = 4;
				$days = 7;
				break;
			case 1500: //platinum weekly
				$credits = 3;
				$acc_type = 5;
				$days = 7;
				break;
			case 3800: //premium monthly
				$credits = 8;
				$acc_type = 2;
				$days = 31;
				break;
			case 5500: //platinum monthly
				$credits = 14;
				$acc_type = 3;
				$days = 31;
				break;
			case 500: //free user purchasing tip on demand
				$credits = 1;
				$acc_type = 1;
				$days = 3;
			default:
				$credits = 0;
				$acc_type = 0;
				break;
		}
		
		//update user credits and account type
		$this->betor_users->update_member_type($user_info["id"], $acc_type);
		//save sms to db
		$this->betor_transactions->save_payment($message_info);
		//record trans and get trans_id
		$details = array(
			"username" => $user_info["username"],
			"narrative" => ("You purchased ".$credits." tips valid for ".$days." days at KES ".$message_info["amount"]),
			"tips" => $credits,
			"trans_type" => "topup"
		);
		$trans_id = $this->betor_transactions->record_transaction($details);
		//top up user credits as neccesary
		$this->betor_credits->topup($user_info["id"], $credits, $trans_id);
		//send success sms to user.
		$this->betor_sms->add_sms(array("phone" => $message_info["sender_num"], "sms" => "Your subscription has been renewed. ".$credits." tips have been added to your account. Betips.co.ke - best tips in Kenya."));
		$this->output->set_header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		$this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		$this->output->set_header("Content-Type: application/json");
		echo '{"events":[{"event":"log","message":"OK. Message received."}]}';
	}
	
	private function doTest()
	{
		$this->output->set_header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		$this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		$this->output->set_header("Content-Type: application/json");
		echo '{"events":[{"event":"log","message":"Test to payment server is OK!'.$this->input->post("phone_number").'"}]}';
	}
}
