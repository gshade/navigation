<?php
namespace verbb\navigation\fields;

use verbb\navigation\Navigation;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Json;

use yii\db\Schema;

class NavigationField extends Field
{
    // Static
    // =========================================================================

    public static function displayName(): string
    {
        return Craft::t('navigation', 'Navigation');
    }

    public static function defaultSelectionLabel(): string
    {
        return Craft::t('navigation', 'Select a navigation');
    }

    public function getContentColumnType(): string
    {
        return Schema::TYPE_TEXT;
    }

    protected function optionsSettingLabel(): string
    {
        return Craft::t('navigation', 'Navigation Options');
    }


    // Public Methods
    // =========================================================================

    public function getInputHtml($value, ElementInterface $element = null): string
    {
        $navs = Navigation::$plugin->getNavs()->getAllNavs();

        $options = [
            '' => Craft::t('navigation', 'Select a navigation'),
        ];

        foreach ($navs as $nav) {
            $options[$nav->handle] = $nav->name;
        }

        $id = Craft::$app->getView()->formatInputId($this->handle);
        $nameSpacedId = Craft::$app->getView()->namespaceInputId($id);

        return Craft::$app->getView()->renderTemplate('navigation/_field/input', [
            'id' => $id,
            'name' => $this->handle,
            'value' => $value,
            'options' => $options,
        ]);
    }

    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('navigation/_field/settings', [

        ]);
    }
}
