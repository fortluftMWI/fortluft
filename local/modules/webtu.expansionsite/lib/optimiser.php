<?

namespace Webtu\ExpansionSite;

use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;

class Optimiser
{
    public static function deleteKernelJs(&$content)
    {
        global $USER, $APPLICATION;
        if ($USER->IsAdmin() || strpos($APPLICATION->GetCurDir(), "/bitrix/") !== false) return;
        if ($APPLICATION->GetProperty("save_kernel") == "Y") return;

        $arPatternsToRemove = array(
            '/<script.+?src=".+?kernel_main_polyfill_promise\/kernel_main_polyfill_promise.*\.js\?\d+"><\/script\>/',
            '/<script.+?src=".+?loadext\/loadext.min\.js\?\d+"><\/script\>/',
            '/<script.+?src=".+?loadext\/extension.min\.js\?\d+"><\/script\>/',
            '/<script.+?src=".+?bitrix\.info\/ba\.js"><\/script\>/',
        );
        $content            = preg_replace($arPatternsToRemove, "", $content);
        $content            = preg_replace("/\n{2,}/", "\n\n", $content);

        $userAgent = Application::getInstance()->getContext()->getRequest()->getUserAgent();

        if (strpos($userAgent, 'Lighthouse')) {
            $arPatternsToRemove = array(
                /*'/(?!<script.*template_home\/template_.*\>\<\/script\>)<script.*\>.*\<\/script\>/',
                '/<script\stype="text\/javascript"\s>(\s.*\s)+<\/script>/',
                '/<script\stype="text\/javascript"\s?>.*<\/script>/',*/
                '/\<script.*?\<\/script\>/'
                /*'~<div\s.*js-page-preloader\s.*>(\s.*)+\<\/div>~U'*/
            );

            $content = preg_replace($arPatternsToRemove, "", $content);
        }
    }

    public static function deleteKernelCss(&$content)
    {
        global $USER, $APPLICATION;
        if ($USER->IsAdmin() || strpos($APPLICATION->GetCurDir(), "/bitrix/") !== false) return;
        if ($APPLICATION->GetProperty("save_kernel") == "Y") return;

        $arPatternsToRemove = array(
            '/<link.+?href=".+?kernel_main\/kernel_main.*\.css\?\d+"[^>]+>/',
            '/<link.+?href=".+?bitrix\/js\/main\/core\/css\/core[^"]+"[^>]+>/',
            '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/styles.css[^"]+"[^>]+>/',
            '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/template_styles.css[^"]+"[^>]+>/',
        );

        $content = preg_replace($arPatternsToRemove, "", $content);
        $content = preg_replace("/\n{2,}/", "\n\n", $content);
    }
}
