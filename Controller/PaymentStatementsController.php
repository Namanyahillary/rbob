<?php
App::uses('AppController', 'Controller');
/**
 * PaymentStatements Controller
 *
 * @property PaymentStatement $PaymentStatement
 */
class PaymentStatementsController extends AppController {
	public $uses=array('PaymentStatement','Payment','User','Booking');

/**
 * confirm_transactions method
 *
 * @return void
 */
	public function confirm_transactions($id) {
		
		if($this->Auth->User('role')!='super_admin'){
			$this->Session->setFlash(__('Access Denied!', true));
			$this->redirect($this->Auth->logout());
		}
		
		if (!$this->PaymentStatement->exists($id)) {
			throw new NotFoundException(__('Invalid payment statement'));
		}
		
		$payment_statements=$this->PaymentStatement->find('all',array(
			'limit'=>1,
			'recursive'=>-1,
			'fields'=>array(
				'id','file_name','year','bank_id'
			),
			'conditions'=>array(
				'PaymentStatement.id'=>$id
			)
		));
		
		//set fetched data
		$_file_name	=	$payment_statements[0]['PaymentStatement']['file_name'];
		$_year		=	$payment_statements[0]['PaymentStatement']['year'];
		$_bank_id	=	$payment_statements[0]['PaymentStatement']['bank_id'];
		
		//generate file url to be opened
		$file_url="statements/bank_".($_bank_id)."/".($_year)."/$_file_name";
		
		$results=$this->readExcel($file_url);
		$response=array(
			'TRefsNotFound'			=> array(),
			'AmountNotMatching'		=> array(),
			'IsAlreadyConfirmed'	=> array(),
			'HasBeenConfirmed'		=> array(),
			'HasFailedConfirmation'	=> array(),
			'Data'					=> $results['Transactions']['Data'],
			'Errors'				=> $results['Transactions']['Errors']
		);
		$booking_ids=array();
		if(isset($results['Transactions']['Data'])){		
			if(count($results['Transactions']['Data'])){//If there  are records read from the file
			
				foreach($results['Transactions']['Data'] as $transaction){					
					$transaction_ref	=	$transaction['Transaction']['TransactionRef'];
					$amount				=	$transaction['Transaction']['Amount'];	
					
					$payments=$this->Payment->find('all',array(
						'limit'		=>	1,
						'recursive'	=>	-1,
						'order'		=>	'date DESC',
						'fields'	=>	array(
							'id','is_confirmed','amount_paid','booking_id'
						),
						'conditions'=>array(
							'Payment.bank_id'				=>	$_bank_id,
							'Payment.transaction_reference' =>	$transaction_ref
						)
					));
					
					if(!count($payments)){//Check whether a record with the current transaction reference was found
						array_push($response['TRefsNotFound'],$transaction_ref);continue;
					}
					
					if(((double)$payments[0]['Payment']['amount_paid']) != ((double)$amount)){
						array_push($response['AmountNotMatching'],array(
							'tref'			=> $transaction_ref,
							'db_amount'		=> ((double)$payments[0]['Payment']['amount_paid']),
							'excel_amount'	=> ((double)$amount)
						));continue;
					}
					
					if($payments[0]['Payment']['is_confirmed']){
						array_push($response['IsAlreadyConfirmed'],$transaction_ref);continue;
					}
					
					$this->Payment->id=$payments[0]['Payment']['id'];
					$this->request->data['Payment']['is_confirmed']=1;
					if($this->Payment->save($this->request->data)){
						array_push($response['HasBeenConfirmed'],$transaction_ref);
						array_push($booking_ids,($payments[0]['Payment']['booking_id']));
					}else{
						array_push($response['HasFailedConfirmation'],$transaction_ref);
					}
					
					
				}
				
				//indicate the payment statement as processed
				$this->PaymentStatement->query("	
					UPDATE 	payment_statements
					SET 	payment_statements.is_processed=1
					WHERE	payment_statements.id='".($payment_statements[0]['PaymentStatement']['id'])."'");
				
			}
		}
		$this->updateBookingStatus(array_unique($booking_ids));
		$this->set(compact('response'));
	}
	
/**
 * updateBookingStatus method
 *
 *Changes the status of each booking from waiting payment to payment completed if payments total to amount required from client
 *
 * @return array
 */
	public function updateBookingStatus($booking_ids) {
		foreach($booking_ids as $booking_id){
			$this->Booking->query("	
					UPDATE 	bookings
					SET 	bookings.current_status='Payment Completed', 
							bookings.status_history=concat(bookings.status_history, ',Payment Completed'),
							bookings.status='1'
					WHERE	bookings.id='".($booking_id)."'
					AND	(SELECT SUM(payments.amount_paid) FROM payments WHERE payments.booking_id='".($booking_id)."')>=bookings.amount");
		}
	}	
	

/**
 * readExcel method
 *
 * @return array
 */
	public function readExcel($file_url, $page=1) {
		//*** Get Document Path ***//
		$strPath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"]))); // C:/AppServ/www/myphp
		$OpenFile = $file_url;
		
		//*** Connect to ADO ***//
		$strConn = new COM("ADODB.Connection");
		$strConn->Open("DRIVER={Microsoft Excel Driver (*.xls)}; IMEX=1; 
		HDR=NO; Excel 8.0; DBQ=".$strPath."/".$OpenFile.";");
		// DBQ=realpath($OpenFile)

		//*** Select Sheet ***//
		$strSQL = "SELECT * FROM [Sheet1$]";
		$objRec = new COM("ADODB.Recordset");
		$objRec->Open($strSQL, $strConn, 1,3);
		
		$result['Transactions']=array('Data'=>array(),'Errors'=>array());

		If($objRec->EOF)
		{
			$result['Transactions']['Errors']=array(" Not found record.");
			return $result;
		}
		else
		{

			$PageLen = 100;
			$PageNo = $page;
			if(!$PageNo)
			{
			$PageNo = 1;
			}
			$TotalRecord = $objRec->RecordCount();
			$objRec->PageSize = $PageLen;
			$TotalPage = $objRec->PageCount();
			$objRec->AbsolutePage = $PageNo;
			
			
			
				$No=0;
				While (!($objRec->EOF) and $No < $PageLen)
				{
					array_push($result['Transactions']['Data'],
						array('Transaction'=>array(
								'TransactionRef'=>$objRec->Fields["TransactionRef"]->Value,
								'Amount'=>$objRec->Fields["Amount"]->Value
							)
						)
					);
			
				$No = $No + 1;
				$objRec->MoveNext();
				}
			return $result;
		}
	}	

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PaymentStatement->recursive = 0;
		
		if($this->Auth->User('role')!='super_admin'){
			$this->paginate=array('conditions'=>array('PaymentStatement.bank_id'=>$this->Auth->User('bank_id')),'order'=>'PaymentStatement.date desc, PaymentStatement.time desc');
		}else{
			$this->paginate=array('order'=>'PaymentStatement.date desc, PaymentStatement.time desc');
		}
		
		$this->set('paymentStatements', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PaymentStatement->exists($id)) {
			throw new NotFoundException(__('Invalid payment statement'));
		}
		$options = array('conditions' => array('PaymentStatement.' . $this->PaymentStatement->primaryKey => $id));
		$this->set('paymentStatement', $this->PaymentStatement->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			$func=$this->Func;
			
			$this->request->data['PaymentStatement']['id']=$func->getUID1();
			$this->request->data['PaymentStatement']['user_id']=$this->Auth->User('id');
			$this->request->data['PaymentStatement']['bank_id']=$this->Auth->User('bank_id');
			$this->request->data['PaymentStatement']['year']=date('Y');
			$this->request->data['PaymentStatement']['date']=date('Y-m-d');
			$this->request->data['PaymentStatement']['time']=date('H:i:s');
		
			
			$file_name='';
			if(isset($_FILES['fileField']['name']) and !empty($_FILES['fileField']['name'])){//getting the file extension and testing it
				$fileExtension=pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION);
				$FileExtensionAllowed=false;
				switch(strtolower($fileExtension)){
					case 'xls':
						$FileExtensionAllowed=true;
						break;
					default:
						$FileExtensionAllowed=false;
				}
				
				//redirect the user if the file is not accepted to be uploaded
				if(!$FileExtensionAllowed){
					$this->Session->setFlash(__('Only Excel.xls files are accepted. Thanks', true));
					$this->redirect(array('action' => 'add'));					
				}else{
					//create filename if the image type is alowed
					$file_name=($func->getUID1()).'.'.(pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION));
				}
				
				//uploading the file
				if(move_uploaded_file($_FILES['fileField']['tmp_name'],"statements/bank_".($this->Auth->User('bank_id'))."/".(date("Y"))."/$file_name")){
					$this->request->data['PaymentStatement']['file_name']=$file_name;//filename to use for submitted file
						
					$this->PaymentStatement->create();
					if ($this->PaymentStatement->save($this->request->data)) {
						$this->Session->setFlash(__('The payment statement has been saved'));
						
						//Notification To super_admins
						foreach(Configure::read('super_admins') as $super_admin){
							$this->User->Notification->msg(
								$super_admin," has booked sent an excel file for user payments.",
								null,(Configure::read('domainAddress')).'/payment_statements/view/'.$this->PaymentStatement->getInsertID(),$this->Auth->User('id')
							);
						}
						
						$this->redirect(array('action' => 'index','controller'=>'dashboards'));
					} else {
						@unlink("statements/bank_".($this->Auth->User('bank_id'))."/".(date("Y"))."/$file_name");
						$this->Session->setFlash(__('The payment statement could not be saved. Please, try again.'));
						$this->redirect(array('action' => 'index','controller'=>'dashboards'));
					}
					
				}else{
					$this->Session->setFlash(__('File could not be saved. Please, try again.', true));
					//$this->redirect(array('action' => 'admin_index'));
					$this->redirect(array('action' => 'index','controller'=>'dashboards'));
				}
			}else{
				$this->Session->setFlash(__('File missing. Please, try again.'));
				$this->redirect(array('action' => 'index','controller'=>'dashboards'));
			}
			
		}
		$users = $this->PaymentStatement->User->find('list');
		$this->set(compact('users'));
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PaymentStatement->id = $id;
		if (!$this->PaymentStatement->exists()) {
			throw new NotFoundException(__('Invalid payment statement'));
		}
		
		$f=$this->PaymentStatement->find('all',array(
				'limit'=>1,
				'recursive'=>-1,
				'conditions'=>array(
					'PaymentStatement.id'=>$id
				)
		));
		
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentStatement->delete()) {
			$this->Session->setFlash(__('Payment statement deleted'));
			
			if(file_exists("statements/bank_".($f[0]['PaymentStatement']['bank_id'])."/".($f[0]['PaymentStatement']['year'])."/".($f[0]['PaymentStatement']['file_name']))){
				@unlink("statements/bank_".($f[0]['PaymentStatement']['bank_id'])."/".($f[0]['PaymentStatement']['year'])."/".($f[0]['PaymentStatement']['file_name']));
			}
			
			$this->redirect(array('action' => 'index','controller'=>'dashboards'));
		}
		$this->Session->setFlash(__('Payment statement was not deleted'));
		$this->redirect(array('action' => 'index','controller'=>'dashboards'));
	}
}
