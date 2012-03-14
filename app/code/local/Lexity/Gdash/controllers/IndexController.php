<?php class Lexity_Gdash_IndexController extends Mage_Adminhtml_Controller_Action 
{ 
        public function indexAction()
        {
                $this->_title('Lexity');
                $this->loadLayout();        
		$this->_addContent($this->getLayout()->createBlock('gdash/index'));
                $this->getLayout();
		$this->_setActiveMenu('Lexity');
                $this->renderLayout();
        }
        
        
	public function allsetAction()
	{
     
            $post = $this->getRequest()->getPost();
        try {
            if (empty($post)) {
                Mage::throwException($this->__('Invalid form data.'));
            }
            
            /* here's your form processing */
           $api_key = $post['myform']['api_key'];
            $some = Mage::getModel('gdash/index')->adduser($api_key);
            $params  =  array( 'url' => $_SERVER['SERVER_NAME'] );
            $url_path = Mage::getModel('gdash/index')->lexity_inc_path('url.txt');
            $url = @file_get_contents($url_path);
            if($url)
                {
                Mage::getModel('gdash/index')->rest_helper($url,$params);
                }
            Mage::getModel('gdash/index')->addmisc();
            
            $message = $this->__('You  signed in successfully.');
            Mage::getSingleton('adminhtml/session')->addSuccess($message);
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        

         $this->_redirect('*/index/index');
	}
	
	public function miscsetAction()
	{	
          Mage::getModel('gdash/index')->addmisc();
          $message = $this->__('Lexity script is now set.');
          Mage::getSingleton('adminhtml/session')->addSuccess($message);
             $this->_redirect('*/index/index');
	}
	
	public function usersetAction()
	{       	
                $params  =  array( 'url' => $_SERVER['SERVER_NAME'] );
                $url_path = Mage::getModel('gdash/index')->lexity_inc_path('url.txt');
                $url = @file_get_contents($url_path);
                if($url)
                    {
                    Mage::getModel('gdash/index')->rest_helper($url,$params);
                    }
		$post = $this->getRequest()->getPost();
        try {
            if (empty($post)) {
                Mage::throwException($this->__('Invalid form data.'));
            }
            
            /* here's your form processing */
           $api_key = $post['myform']['api_key'];
            $some = Mage::getModel('gdash/index')->adduser($api_key);
            
            $message = $this->__('Lexity extension activated .');
            Mage::getSingleton('adminhtml/session')->addSuccess($message);
            
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        
        $this->_redirect('*/index/index');
	
	}
       public function apiupdateAction()
       {
           $post = $this->getRequest()->getPost();
           try{
               if(empty($post))
               {
                 Mage::throwException($this->__('Please enter New api key.'));  
               }
                $api_key = $post['myform']['api_key'];
               $apiUser = Mage::getModel('api/user')->load('support@lexity.com', 'email');
               $apiUser->setApiKey($api_key);
               $apiUser->save();
               $message = $this->__('New Api key saved .');
            Mage::getSingleton('adminhtml/session')->addSuccess($message);
           }catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }

        $this->_redirect('*/index/index');  
       }
}
?>