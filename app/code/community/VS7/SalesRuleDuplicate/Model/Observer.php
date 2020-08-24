<?php

class VS7_SalesRuleDuplicate_Model_Observer
{
    public function addDuplicateButton($observer)
    {
        if ($observer->getBlock()->getType() != 'adminhtml/promo_quote_edit') {
            return;
        }

        $rule = Mage::registry('current_promo_quote_rule');
        if (!$rule->getId()) {
            return;
        }

        $location = Mage::helper('adminhtml')->getUrl(
            'adminhtml/vs7_salesruleduplicate/duplicate',
            array('id' => $rule->getId())
        );
        $data = array(
            'label' => 'Duplicate',
            'onclick' => 'setLocation(\''.$location.'\')',
        );
        $observer->getBlock()->addButton('duplicate_button', $data);
    }
}