<?php
require_once 'model/LoginLogic.php';
require_once 'model/ChatLogic.php';
require_once 'model/AgendaLogic.php';

//vincent
require_once 'model/AppointmentModel.php';
require_once 'model/AppointmentLogic.php';
require_once 'model/BeheerderLogic.php';

class AfspraakplannerController
{
	public function __construct()
	{
		$this->LoginLogic = new LoginLogic();
		$this->ChatLogic = new ChatLogic();
		$this->AgendaLogic = new AgendaLogic();

		//vincent
		$this->AppointmentLogic = new AppointmentLogic();
		$this->BeheerderLogic = new BeheerderLogic();
		$this->AppointmentModel = new AppointmentModel();
	}

	public function __destruct()
	{ }
	public function handleRequest()
	{
		try {
			$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : NULL;
			switch ($op) {
				 case 'zzp':
				 	$this->collectZzp();
					 break;
				case 'create':
				 	$this->collectCreate();
					 break;
				 case 'klant':
				 	$this->collectKlant();
					 break;
				 case 'loguit':
				 	$this->collectLoguitForm();
					 break;
				 case 'chat':
				 	$this->collectChat();
					 break;
				 case 'agenda':
				 	$this->collectAgenda();
					 break;
				 case 'reads':
					 $this->collectReadProducts();
					 break;
				/*default:
                    $this->collectLoguitForm();
					break;*/
					
					//vincent
					case 'getAppointmentForm':
					$this->collectCreateAppointmentForm();
					break;
				case 'createAppointment':
					$this->collectCreateAppointment();
					break;
				case 'AppointmentDetails':
					$this->collectAppointment($_REQUEST['id']);
					break;
				default:
					$this->collectLoguitForm();
					break;
			}
		} catch (ValidationException $e) {
			$errors = $e->getErrors();
		}
	}
	public function collectLoguitForm()
	{
		$loguit = $this->LoginLogic->loguit();
	}
	public function collectChat()
	{
		include 'chat/chat.php';
		//$chat = $this->ChatLogic->chat();

	}
	public function collectAgenda()
	{
		include 'home.php';
		//$agenda = $this->AgendaLogic->agenda();

	}
	public function collectCreate()
    {
		include 'view/zzp-er/create.php';
        //$products = $this->AgendaLogic->readData();
	}


    public function collectReadProducts()
    {
        $products = $this->AgendaLogic->readData();
        include 'view/zzp-er/home.php';
	}

	// Beheerders pagina vincent
	public function collectZzpers()
	{
		$zzpers = $this->BeheerderLogic->readZzpers();
		include 'view/beheerder/beheerder.php';
	}

	public function SearchZzpers()
	{
		$search = $_REQUEST;
		$zzpers = $this->BeheerderLogic->searchZzpers($search);
		include 'view/beheerder/beheerder.php';
	}

	public function createZzperForm()
	{
		include 'view/beheerder/createZzperForm.php';
	}

	public function createZzper()
	{
		$formData = $_REQUEST;
		$feedback = $this->BeheerderLogic->createZzper($formData);
		include 'view/feedback/feedback.php';
	}

	public function editeZzperForm($id)
	{
		$zzper = $this->BeheerderLogic->readZzper($id);
		include 'view/beheerder/editeZzperForm.php';
	}

	public function editeZzper()
	{
		$formData = $_REQUEST;
		$feedback = $this->BeheerderLogic->updateZzper($formData);
		include 'view/feedback/feedback.php';
	}

	public function deleteZzperAsk($id)
	{
		$zzper = $this->BeheerderLogic->readZzper($id);
		include 'view/beheerder/deleteZzperAsk.php';
	}

	public function deleteZzper($id)
	{
		$feedback = $this->BeheerderLogic->deleteZzper($id);
		include 'view/feedback/feedback.php';
	}
	//klant paginas
	public function collectCreateAppointmentForm()
	{
		include 'view/klant/afsprakenklantform.php';
	}
	public function collectCreateAppointment()
	{
		$formData = $_REQUEST;
		$createAppointment = $this->AppointmentLogic->createAppointment($formData);
		include 'view/klant/createafsprakenklant.php';
	}
	public function collectAppointment($id)
	{
		$AppointmentDetails = $this->AppointmentLogic->readAppointment($id);
		include 'view/klant/afspraakdetails.php';
	}
	public function collectReadAppointments()
	{
		$Appointments = $this->AppointmentLogic->readAppointments();
		// $AppointmentsSearch = $this->AppointmentModel->search();
		$AppointmentsTable = $this->AppointmentModel->createTable($Appointments);
		include 'view/klant/afsprakenklant.php';
	}
	
}