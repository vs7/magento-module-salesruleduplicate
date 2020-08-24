<?php

class VS7_SalesRuleDuplicate_Adminhtml_Vs7_SalesruleduplicateController extends Mage_Adminhtml_Controller_Action
{
    public function duplicateAction()
    {
        $rule = Mage::getModel('salesrule/rule')->load($this->getRequest()->getParam('id'));
        if (!$rule->getId()) {
            Mage::getSingleton('core/session')->addError('No rule ID provided.');
            $this->_redirect('adminhtml/dashboard/index');
            return;
        }


        $newRule = Mage::getModel('salesrule/rule')
            ->setData($rule->getData())
            ->setId(null);
        $newRule->save();

        $this->_redirect('adminhtml/promo_quote/edit', array('id' => $newRule->getId()));
        Mage::getSingleton('core/session')->addSuccess('SalesRule has been successfully duplicated.');
        return;
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('vs7_salesruleduplicate');
    }
}