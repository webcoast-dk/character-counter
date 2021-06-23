<?php

namespace WEBcoast\CharacterCounter\Helper;

use TYPO3\CMS\Core\Utility\ArrayUtility;

class Tca
{
    /**
     * Enable character counter for certain table and field. Meant to be used in `Configuration/TCA/Overrides/{table}.php`
     *
     * @param string   $table   The table, e.g. pages
     * @param string   $field   The field, e.g. seo_title
     * @param int      $max     The maximum recommended number of characters (background changes to red, when this is reached)
     * @param int|null $warning The number of characters, when to warning the user (background changes to yellow, when this is reached). Defaults to 80% of `max`
     */
    public static function enableCharacterCounter(string $table, string $field, int $max, int $warning = null)
    {
        if (isset($GLOBALS['TCA'][$table]['columns'][$field])) {
            ArrayUtility::mergeRecursiveWithOverrule(
                $GLOBALS['TCA'][$table]['columns'][$field]['config'],
                [
                    'fieldWizard' => [
                        'characterCounter' => [
                            'renderType' => 'characterCounterWizard'
                        ]
                    ],
                    'characterCounter' => [
                        'warning' => $warning ?? round($max * 0.8),
                        'max' => $max
                    ]
                ]
            );
        }
    }
}
