<?php
namespace Webtu\ExpansionSite;

use \Bitrix\Main;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Application;


Loc::loadMessages(__FILE__);

class Event
{
    /**
     * @brief Событие "OnSalePayOrder" вызывается после изменения флага оплаты заказа
     **/
    static public function OnSalePayOrderHandler($ID, $VAL)
    {
        
    }

    /**
     * @brief Событие "OnSaleCancelOrder" вызывается после изменения флага отмены заказа
     **/
    static public function OnSaleCancelOrderHandler($orderId, $value, $description)
    {
        
    }

    /**
     * @brief Событие "OnBeforeUserUpdate" вызывается перед обновлением регистрации полей пользователя
     **/
    static public function OnBeforeUserUpdateHandler(&$arFields)
    {
        
    }

    /**
     * @brief Событие "OnPageStartHandler" вызывается в начале выполняемой части пролога сайта.
     **/
    static public function OnPageStartHandler()
    {
        
    }

    /**
     * @brief Событие "OnProlog" вызывается в начале визуальной части пролога сайта.
     **/
    static public function OnPrologHandler()
    {

    }

    /**
     * @brief Событие "OnEpilog" вызывается в конце визуальной части эпилога сайта.
     **/
    static public function OnEpilogHandler()
    {

    }

    /**
     * @brief Событие "OnEndBufferContent" вызывается при выводе буферизированного контента.
     **/
    static public function OnEndBufferContentHandler(&$content)
    {
        Optimiser::deleteKernelCss($content);
        Optimiser::deleteKernelJs($content);
    }
}
?>