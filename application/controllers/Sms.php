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
		if($this->input->post("action") !== NULL)
		{
			$phone = $this->input->post("phone_number");
			$action = $this->input->post("action");
			if($phone !== null && $phone == "0712594022")
			{
				//now check action
				if($action == "incoming"){
					$from = $this->input->post("from");
					$type = $this->input->post("message_type");
					$msg = $this->input->post("message");
					if($from !== NULL && $from == "M-PESA" && $msg !== "")
					{
						$this->load->model("betor_sms");
						$msg_info = $this->betor_sms->get_msg_parts($msg);
						if($msg_info["amount"] >= 500)
						{
							$credits = $msg_info["amount"] / 500;
							$made = $this->betor_sms->save_payment($msg_info);
							if($made)
							{
								//update user credit and create transaction with narration.
								//get username and id from number sent
								$this->load->model("betor_users");
								$user_info = $this->betor_users->get_user_from_num($msg_info["sender_num"]);
								//ensure user exists
								if($user_info !== NULL)
								{
									$trans_data = array(
										"username" => $user_info["username"],
										"narrative" => "You purchased ".$credits." credits for Ksh ".$msg_info["amount"],
										"tips" => $credits,
										"trans_type" => "topup"
									);
									$credit_data = array(
										"user_id" => $user_info["id"],
										"credits" => $credits
									);
									
									$trans_id = $this->betor_sms->record_transaction($trans_data, $credit_data);
									//top up user credits + trans ^^
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
							$this->betor_sms->add_sms(array("phone" => $msg_info["sender_num"], "sms" => "You send an amount below the 1 tip limit. Reverse the transaction and send again. Min. is Ksh 500"));
						}
					}
					else{
						$this->output->set_header("Content-Type: application/json");
						echo '{"error":{"message:"Client error: MIssing items in message parts."}}';
					}
				}
				else if($action == "test")
				{
					$this->output->set_header("Content-Type: application/json");
					echo '{"events":[{"event":"log","message":"Test to payment server is OK!"}]}';
				}
				else if($action == "outgoing")
				{
					
				}
				else if($action == "device_status")
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
