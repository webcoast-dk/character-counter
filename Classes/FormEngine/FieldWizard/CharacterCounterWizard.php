<?php

namespace WEBcoast\CharacterCounter\FormEngine\FieldWizard;

use TYPO3\CMS\Backend\Form\AbstractNode;

/**
 * Class CharacterCountWizard
 *
 * To enable the counter add the following to the fields TCA:
 * 'config' => [
 *     'fieldWizard' => [
 *         'characterCount' => [
 *             'renderType' => 'characterCountWizard'
 *          ]
 *     ],
 *     'characterCount' => [
 *         'warning' => 120 // Defaults to 80% of `max`, if not defined
 *         'max' => 160
 *     ]
 * ]
 */
class CharacterCounterWizard extends AbstractNode
{
    public function render()
    {
        $resultData = $this->initializeResultArray();

        $charCountConfig = $this->data['processedTca']['columns'][$this->data['fieldName']]['config']['characterCounter'];
        if (($recommendMaxCharacters = (int) $charCountConfig['max']) > 0) {
            $warningChars = $charCountConfig['warning'] ?? round($recommendMaxCharacters * 0.8);
            $resultData['html'] = '<span class="label js-character-counter-wizard" data-field-name="' . $this->data['parameterArray']['itemFormElName'] . '" data-max-chars="' . $recommendMaxCharacters . '" data-warning-chars="' . $warningChars . '"></span>';
            $resultData['requireJsModules'] = ['TYPO3/CMS/CharacterCounter/CharacterCounter'];

            return $resultData;
        }

        return $resultData;
    }
}
