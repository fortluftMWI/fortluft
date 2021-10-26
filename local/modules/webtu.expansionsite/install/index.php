<?
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config as Conf;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\Base;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);

Class webtu_expansionsite extends CModule
{
    var $exclusionAdminFiles;
	function __construct()
    {
        $arModuleVersion = array();
        include(__DIR__."/version.php");
    
        $this->exclusionAdminFiles=array(
            '..',
            '.',
            'menu.php',
            'operation_description.php',
            'task_description.php'
        );

        $this->MODULE_ID = 'webtu.expansionsite';
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = Loc::getMessage("WEBTU_ES_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("WEBTU_ES_MODULE_DESC");
    
        $this->PARTNER_NAME = Loc::getMessage("WEBTU_ES_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("WEBTU_ES_PARTNER_URI");
    }
    
    public function GetPath($notDocumentRoot=false)
    {
        if($notDocumentRoot)
            return str_ireplace(Application::getDocumentRoot(),'',dirname(__DIR__));
        else
            return dirname(__DIR__);
    }

    public function isVersionD7()
    {
        return CheckVersion(\Bitrix\Main\ModuleManager::getVersion('main'), '14.00.00');
    }

    function InstallDB()
    {

    }

    function UnInstallDB()
    {
        Loader::includeModule($this->MODULE_ID);
        
        #Если есть файл options.php с настройками, то при удалении удаляем эти настройки из БД
        Option::delete($this->MODULE_ID);
    }
    
	function InstallEvents()
	{
        #Вызывается после изменения флага оплаты заказа
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('sale', 'OnSalePayOrder', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnSalePayOrderHandler');

        #Вызывается после изменения флага отмены заказа
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('sale', 'OnSaleCancelOrder', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnSaleCancelOrderHandler');

        #Вызывается до попытки зарегистрировать нового пользователя
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('main', 'OnBeforeUserRegister', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnBeforeUserUpdateHandler');    

        #Вызывается перед изменением параметров пользователя.
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('main', 'OnBeforeUserUpdate', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnBeforeUserUpdateHandler');

        #Вызывается в начале выполняемой части пролога сайта
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('main', 'OnPageStart', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnPageStartHandler');

        #Вызывается в начале визуальной части пролога сайта.
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('main', 'OnProlog', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnPrologHandler');
        
        #Событие "OnEpilog" вызывается в конце визуальной части эпилога сайта.
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('main', 'OnEpilog', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnEpilogHandler');

        #Событие "OnEndBufferContent" вызывается при выводе буферизированного контента.
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('main', 'OnEndBufferContent', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnEndBufferContentHandler', 99999);
    }

	function UnInstallEvents()
	{
        #Вызывается после изменения флага оплаты заказа
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('sale', 'OnSalePayOrder', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnSalePayOrderHandler');

        #Вызывается после изменения флага отмены заказа
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('sale', 'OnSaleCancelOrder', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnSaleCancelOrderHandler');

        #Вызывается до попытки зарегистрировать нового пользователя
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('main', 'OnBeforeUserRegister', $this->MODULE_ID, '\Webtu\ExpansionSite\Even', 'OnBeforeUserUpdateHandler');  
        
        #Вызывается перед изменением параметров пользователя.
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('main', 'OnBeforeUserUpdate', $this->MODULE_ID, '\Webtu\ExpansionSite\Even', 'OnBeforeUserUpdateHandler');

        #Вызывается в начале выполняемой части пролога сайта
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('main', 'OnPageStart', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnPageStartHandler');

        #Вызывается в начале визуальной части пролога сайта.
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('main', 'OnProlog', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnPrologHandler');
    
        #Событие "OnEpilog" вызывается в конце визуальной части эпилога сайта.
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('main', 'OnEpilog', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnEpilogHandler');

        #Событие "OnEndBufferContent" вызывается при выводе буферизированного контента.
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('main', 'OnEndBufferContent', $this->MODULE_ID, '\Webtu\ExpansionSite\Event', 'OnEndBufferContentHandler', 99999);
    }

	function InstallFiles($arParams = array())
	{
        CopyDirFiles($this->GetPath().'/install/js/', $_SERVER['DOCUMENT_ROOT'].'/bitrix/js/', true, true);

/*
        $localPath = getLocalPath($path="",$baseFolder="/bitrix");
        
        #Копируем стандартные шаблоны компонентов
        $pathFrom = $this->GetPath()."/install/components/bitrix/";
        $pathTo = $_SERVER["DOCUMENT_ROOT"].$localPath."templates/.default/components/bitrix/";

        if(\Bitrix\Main\IO\Directory::isDirectoryExists($pathFrom)){
            CopyDirFiles($pathFrom, $pathTo, true, true);
        }else{
            throw new \Bitrix\Main\IO\InvalidPathException($pathFrom);
        }

        #Копируем свои компоненты
        $pathFrom = $this->GetPath()."/install/components/webtu/";
        $pathTo = $_SERVER["DOCUMENT_ROOT"].$localPath."components/webtu/";

        if(\Bitrix\Main\IO\Directory::isDirectoryExists($pathFrom)){
            #Копируем файлы
            CopyDirFiles($pathFrom, $pathTo, true, true);
        }else{
            #Если компонент не найден то выбрасываем исключения InvalidPathException - исключения связанные с неправельным путём
            throw new \Bitrix\Main\IO\InvalidPathException($pathFrom);
        }
*/
	}
    
	function UnInstallFiles()
	{

        DeleteDirFilesEx('/bitrix/js/webtu.expansionsite/');
/*
        $localPath = getLocalPath($path="",$baseFolder="/bitrix");

        #Удаление стандартных шаблонов компонентов
        //DeleteDirFilesEx($localPath.'templates/.default/components/bitrix/catalog/');
        //rmdir($_SERVER["DOCUMENT_ROOT"].$localPath.'templates/.default/components/bitrix/catalog/');

        #Удаление своих компонентов
        $path = $this->GetPath()."/install/components/webtu/";
        $path_deleted = $_SERVER["DOCUMENT_ROOT"].$localPath.'components/webtu/';
        
        if (is_dir($path)) {
            $dir_comp = dir($path);
            while ($entry = $dir_comp->read()) {
        
                if ($entry == '.' || $entry == '..') continue;
        
                if (is_dir($path.$entry.'/')) {
                    $int = dir($path.$entry.'/');
                    while ($dir = $int->read()) {
                        if ($dir == '.' || $dir == '..') continue;
                        \Bitrix\Main\IO\Directory::deleteDirectory($path_deleted.$entry.'/'.$dir.'/');   
                    }
                    $int->close();
                }
                
                #Если директория пустая то удаляем
                rmdir($path_deleted.$entry.'/');
            }
        
            $dir_comp->close();
        }
*/
	}
   /**
     * Установка модуля в один шаг 
     */
	function DoInstall()
	{
		global $APPLICATION;
        if($this->isVersionD7())
        {
            #Говорит системе что есть такой модуль и он установленный
            \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
            
            #Установка бд таблиц и заполнения их демо данными.
            $this->InstallDB();
            
            #Регистрируем обработчики событий которые нам нужны.
            $this->InstallEvents();
            
            #Манипуляция с файлами копирование компонентов в администратиные части.
            $this->InstallFiles();

        }
        else
        {
            $APPLICATION->ThrowException(Loc::getMessage("WEBTU_ES_INSTALL_ERROR_VERSION"));
        }
        
        //Установка в один шаг (подключаеться всегда)
        $APPLICATION->IncludeAdminFile(Loc::getMessage("WEBTU_ES_INSTALL_TITLE"), $this->GetPath()."/install/step.php");
	}

   /**
     * Удаление модуля
     */
 	function DoUninstall()
	{
        global $APPLICATION;
        
        #Получаем данные отправленные пользователем с формы
        $request = \Bitrix\Main\HttpApplication::getInstance()->getContext()->getRequest();

        if($request["step"]<2)
        {
            $APPLICATION->IncludeAdminFile(Loc::getMessage("WEBTU_ES_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep1.php");
        }
        elseif($request["step"]==2)
        {
            #Манипуляция с файлами удалени компонентов в администратиные части.
            $this->UnInstallFiles();
            
            #Удаляем обработчики событий которые нам нужны.
			$this->UnInstallEvents();
            
            #Удаляем бд таблиц, если пользователь не захотел их сохранить
            if($request["savedata"] != "Y"){ $this->UnInstallDB(); }

            #Говорит системе что модуль Был удалён
            \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);

            //Переходим на второй шаг удаления
            $APPLICATION->IncludeAdminFile(Loc::getMessage("WEBTU_ES_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep2.php");
        }
	}

   /**
     * Установим права доступа к модулю
     */
    #Используеться вместе с options.php
    function GetModuleRightList()
    {
        return array(
            "reference_id" => array("D","K","S","W"),
            "reference" => array(
                "[D] ".Loc::getMessage("WEBTU_ES_DENIED"),#Доступ закрыт
                "[K] ".Loc::getMessage("WEBTU_ES_READ_COMPONENT"),#Доступ к компонентам
                "[S] ".Loc::getMessage("WEBTU_ES_WRITE_SETTINGS"),#Изменение настроек модуля
                "[W] ".Loc::getMessage("WEBTU_ES_FULL"))#Полный доступ
        );
    }
}
?>