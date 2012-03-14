<?php 
class Lexity_Gdash_Block_Index extends Mage_Adminhtml_Block_Template
{
    public function _construct()
        {
         parent::_construct();
        $this->setTemplate('gdash/index.phtml');
        }
    public function checking_both()
    {
        return Mage::getModel('gdash/index')->checking_both();
    }
}

?>