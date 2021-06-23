# Character Counter - TYPO3 CMS extension

## What does it do?
This extension allows you to display a character counter in the form of `23 / 60` below input fields,
text areas and RTE fields. This is most useful for SEO related fields, so that editors get a hint,
if their title or description matches the requirement.

This does not limit the number of characters, that can be entered. This counter is for informational
purpose only.

## Installation & configuration
The extension is available from packagist.org
```sh
composer require webcoast/character-counter
```
or from [TYPO3 extension repository](https://extensions.typo3.org/extension/character_counter).

## Usage
To enable the character counter for a certain field, use the TCA helper method in your TCA/Overrides files.

**Pages: seo_title**

In `Configuration/TCA/Overrides/pages.php` add:
```php
\WEBcoast\CharacterCounter\Helper\Tca::enableCharacterCounter('pages', 'seo_title', 60, 40);
```
The last argument `warning` is optional and defaults to 80% of the third argument `max`.

You can also adjust your TCA manually by adding the follow to the field's `config` section:
```php
\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule($GLOBALS['TCA']['pages']['columns']['seo_title']['config'], [
    'fieldWizard' => [
        'characterCount' => [
                'renderType' => 'characterCountWizard'
            ]
        ],
        'characterCount' => [
            'warning' => 120, // Optional: Defaults to 80% of `max`
            'max' => 160
        ]
    ]
);
```

## Contributing
Feel free to fork and provide a PR or open an issue.
