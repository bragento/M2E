<?php

/*
 * @copyright  Copyright (c) 2013 by  ESS-UA.
 */

abstract class Ess_M2ePro_Model_Connector_Server_Amazon_Requester extends Ess_M2ePro_Model_Connector_Server_Requester
{
    const COMPONENT = 'Amazon';
    const COMPONENT_VERSION = 2;

    /**
     * @var Ess_M2ePro_Model_Marketplace|null
     */
    protected $marketplace = NULL;

    /**
     * @var Ess_M2ePro_Model_Account|null
     */
    protected $account = NULL;

    // ########################################

    public function __construct(array $params = array(),
                                Ess_M2ePro_Model_Marketplace $marketplace = NULL,
                                Ess_M2ePro_Model_Account $account = NULL)
    {
        $this->marketplace = $marketplace;
        $this->account = $account;
        parent::__construct($params);
    }

    // ########################################

    protected function getComponent()
    {
        return self::COMPONENT;
    }

    protected function getComponentVersion()
    {
        return self::COMPONENT_VERSION;
    }

    // ########################################

    public function process()
    {
        if (!is_null($this->account)) {
            $this->requestExtraData['account'] = $this->account->getChildObject()->getServerHash();
        }

        parent::process();
    }

    // ########################################
}