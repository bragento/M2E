<?php

/*
 * @copyright  Copyright (c) 2013 by  ESS-UA.
 */

class Ess_M2ePro_Model_Mysql4_Ebay_Template_Shipping
    extends Ess_M2ePro_Model_Mysql4_Abstract
{
    // ########################################

    public function _construct()
    {
        $this->_init('M2ePro/Ebay_Template_Shipping', 'id');
    }

    // ########################################

    public function isDifferent($newData, $oldData)
    {
        $ignoreFields = array(
            'id', 'title',
            'is_custom_template',
            'create_date', 'update_date'
        );

        foreach ($ignoreFields as $ignoreField) {
            unset($newData[$ignoreField],$oldData[$ignoreField]);
        }

        !isset($newData['services']) && $newData['services'] = array();
        !isset($oldData['services']) && $oldData['services'] = array();

        foreach ($newData['services'] as $key => $newService) {
            unset($newData['services'][$key]['id'], $newData['services'][$key]['template_shipping_id']);
        }
        foreach ($oldData['services'] as $key => $oldService) {
            unset($oldData['services'][$key]['id'], $oldData['services'][$key]['template_shipping_id']);
        }

        !isset($newData['calculated_shipping']) && $newData['calculated_shipping'] = array();
        !isset($oldData['calculated_shipping']) && $oldData['calculated_shipping'] = array();

        unset(
            $newData['calculated_shipping']['template_shipping_id'],
            $oldData['calculated_shipping']['template_shipping_id']
        );

        $dataConversions = array(
            array('field' => 'vat_percent', 'type' => 'float'),
            array('field' => 'local_shipping_combined_discount_profile_id', 'type' => 'str'),
            array('field' => 'international_shipping_combined_discount_profile_id', 'type' => 'str'),
        );

        foreach ($dataConversions as $data) {
            $type = $data['type'] . 'val';

            array_key_exists($data['field'],$newData) && $newData[$data['field']] = $type($newData[$data['field']]);
            array_key_exists($data['field'],$oldData) && $oldData[$data['field']] = $type($oldData[$data['field']]);
        }

        ksort($newData);
        ksort($oldData);
        ksort($newData['calculated_shipping']);
        ksort($oldData['calculated_shipping']);
        array_walk($newData['services'],'ksort');
        array_walk($oldData['services'],'ksort');

        return md5(json_encode($newData)) !== md5(json_encode($oldData));
    }

    // ########################################
}