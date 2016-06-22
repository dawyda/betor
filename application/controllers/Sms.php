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
	
	public function payments()
	{
		//check if action is set.
		if($this->input->post("action") !== NULL)
		{
			$phone = $this->input->post("phone_number");
			$action = $this->input->post("action");
			if(($phone !== null) && ($phone == "0712594022"))
			{
				/*
				*@ now check which action? incoming, outgoing,etc.
				*/
				
				//action incoming
				if($action == "incoming"){
					$from = $this->input->post("from");
					$type = $this->input->post("message_type");
					$msg = $this->input->post("message");
					if($from !== NULL && $from == "M-PESA" && $msg !== "" && $type == "sms")
					{
						$this->load->model("betor_sms");
						$msg_info = $this->betor_sms->get_msg_parts($msg);
						if($msg_info["amount"] >= 1000)
						{
							
							$credits = 0;
							if($msg_info["amount"] == 2800)
							{
								$credits = 6;
							}
							else if($msg_info["amount"] == 1000)
							{
								$credits = 2;
							}
							else if($msg_info["amount"] == 5500)
							{
								$credits = 13;
							}
							else{//to be set later.
							}
							$this->load->model("betor_transactions");
							$made = $this->betor_transactions->save_payment($msg_info);
							if($made)
							{
								//update user credit and create transaction with narration.
								//get username and id from number sent
								$this->load->model("betor_users");
								$user_info = $this->betor_users->get_user_from_num($msg_info["sender_num"]);
								//ensure user exists
								if($user_info !== NULL)
								{
									//user exists. Now update m_type
									$this->betor_users->update_member_type($user_info["id"],$msg_info["amount"]);
									//update credits then record transaction
									$this->load->model("betor_credits");
									$this->betor_credits->topup($user_info["id"], $credits);
									$narr = "Purchased ".$credits." tips for 31 days. KES ".$msg_info["amount"];
									$data = array(
									"username" => $user_info["username"],
									"narrative" => ("Purchased ".$credits." tips for 31 days. KES ".$msg_info["amount"]),
									"tips" => $credits,
									"trans_type" => "topup"
									);
									$this->betor_transactions->record_transaction($data);
									
									//all succeeded
									$this->betor_sms->add_sms(array("phone" => $msg_info["sender_num"], "sms" => "Your subscription was renewed. ".$credits." tips have been added to your account."));
									$this->output->set_header("Content-Type: application/json");
									echo '{"events":[{"event":"log","message":"OK. Message received."}]}';
								}
								else {
									$this->betor_sms->add_sms(array("phone" => $msg_info["sender_num"], "sms" => "We are sorry.Your user details were not found.Reverse payment. Use betips.co.ke/signup to register"));
								}
							}
							else {
								$this->output->set_header("Content-Type: application/json");
								echo '{"events":[{"event":"log","message":"Payment failed to be added. Message: '.$msg.'"}]}';
							}
						}
						else{
							$this->betor_sms->add_sms(array("phone" => $msg_info["sender_num"], "sms" => "You send an amount below the 1 tip limit. Reverse the transaction and send again. Min. subscription is Ksh 2,800"));
						}
					}
					else{
						$this->output->set_header("Content-Type: application/json");
						echo '{"error":{"message:"Client error: Missing items in message parts."}}';
					}
				}
				elseif($action == "test")
				{
					$this->output->set_header("Content-Type: application/json");
					echo '{"events":[{"event":"log","message":"Test to payment server is OK!"}]}';
				}
				elseif($action == "outgoing")
				{
					//get pending sms
					$this->load->model("betor_sms");
					$SMSs = $this->betor_sms->get_pending_sms();
					$resp = '{"events":[{"event":"send","messages":[';
					foreach($SMSs->result() as $SMS)
					{
						$resp .= '{"id":"'.$SMS->id.'", "to":"'.$SMS->phone.'", "message":"'.$SMS->sms.'"},';
					}
					$resp .= ']}]}';
					$this->output->set_header("Content-Type: application/json");
					echo $resp;
				}
				elseif($action == "send_status")
				{
					$this->load->model("betor_sms");
					$this->betor_sms->update_sms_status($this->input->post("id"), $this->input->post("status"));
					$this->output->set_header('Content-Type: application/json');
					echo '{"events":[{"event":"log", "message":"Status for SMS with id '.$this->input->post("id").' was updated successfully on the server."}]}';
				}
				elseif($action == "device_status")
				{
					
				}
				else {
					$this->output->set_header("Content-Type: application/json");
					echo '{"error":{"message:"Client error: Request could not be completed."}}';
				}
			}
			else {
				$this->output->set_header("Content-Type: application/json");
				echo '{"error":{"message:"Client error: Unauthenticated request."}}';
			}
		}
		else{
			$this->output->set_header("Content-Type: application/json");
			echo '{"error":{"message:"Client error: Action is not defined."}}';
		}		
	}
}
