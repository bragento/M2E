<?php

/*
 * @copyright  Copyright (c) 2013 by  ESS-UA.
 */

class Ess_M2ePro_Model_Play_Search_Manual_Responser
{
    protected $params = array();

    /**
     * @var Ess_M2ePro_Model_Marketplace|null
     */
    protected $marketplace = NULL;

    /**
     * @var Ess_M2ePro_Model_Account|null
     */
    protected $account = NULL;

    // ########################################

    protected $currentQuery = '';

    /**
     * @var Ess_M2ePro_Model_Listing_Product
     */
    protected $listingProduct = NULL;

    // ########################################

    public function initialize(array $params = array(),
                               Ess_M2ePro_Model_Marketplace $marketplace = NULL,
                               Ess_M2ePro_Model_Account $account = NULL)
    {
        $this->params = $params;
        $this->marketplace = $marketplace;
        $this->account = $account;

        $this->currentQuery = (string)$this->params['query'];

        $this->listingProduct = Mage::helper('M2ePro/Component_Play')
                ->getObject('Listing_Product',$this->params['listing_product_id']);
    }

    // ########################################

    public function processSucceededResponseData($receivedItems)
    {
        Mage::helper('M2ePro/Data_Global')->setValue('temp_play_manual_search_SKU_result', $receivedItems);
    }

    // ########################################

    /**
     * @return Ess_M2ePro_Model_Account
     */
    protected function getAccount()
    {
        return $this->account;
    }

    /**
     * @return Ess_M2ePro_Model_Marketplace
     */
    protected function getMarketplace()
    {
        return $this->marketplace;
    }

    // ########################################
}