<?php

class Lexity_Gdash_Model_Order_Api extends Mage_Sales_Model_Order_Api_V2 
{
		
       public function getMisc()
        {
          $js = Mage::getStoreConfig('design/head/includes');
          
          if(empty($js))
          {
              return "No data found";
          }
          else
          {
              return $js;
          }
        }
        public function setMisc($js)
        {
            Mage::getModel('core/config')->saveConfig('design/head/includes', $js );	
        
           return  "updated";
        }
}
?>