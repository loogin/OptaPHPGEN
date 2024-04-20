<?php

//  define('SHOW_VARIABLES', 1);
//  define('DEBUG_LEVEL', 1);

//  error_reporting(E_ALL ^ E_NOTICE);
//  ini_set('display_errors', 'On');

set_include_path('.' . PATH_SEPARATOR . get_include_path());


include_once dirname(__FILE__) . '/' . 'components/utils/system_utils.php';
include_once dirname(__FILE__) . '/' . 'components/mail/mailer.php';
include_once dirname(__FILE__) . '/' . 'components/mail/phpmailer_based_mailer.php';
require_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';

//  SystemUtils::DisableMagicQuotesRuntime();

SystemUtils::SetTimeZoneIfNeed('America/New_York');

function GetGlobalConnectionOptions()
{
    return
        array(
          'server' => 'localhost',
          'port' => '3306',
          'username' => 'root',
          'database' => 'dev_opta',
          'client_encoding' => 'utf8'
        );
}

function HasAdminPage()
{
    return true;
}

function HasHomePage()
{
    return true;
}

function GetHomeURL()
{
    return 'index.php';
}

function GetHomePageBanner()
{
    return '';
}

function GetPageGroups()
{
    $result = array();
    $result[] = array('caption' => '&#x1F6C4; TERCEROS', 'description' => '');
    $result[] = array('caption' => '&#9881; AJUSTES', 'description' => '');
    return $result;
}

function GetPageInfos()
{
    $result = array();
    $result[] = array('caption' => 'Aju1ciudad', 'short_caption' => 'Aju1ciudad', 'filename' => 'aju1ciudad.php', 'name' => 'aju1ciudad', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Aju1estado', 'short_caption' => 'Aju1estado', 'filename' => 'aju1estado.php', 'name' => 'aju1estado', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Aju1formatoscontrato', 'short_caption' => 'Aju1formatoscontrato', 'filename' => 'aju1formatoscontrato.php', 'name' => 'aju1formatoscontrato', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Aju1grupoinventario', 'short_caption' => 'Aju1grupoinventario', 'filename' => 'aju1grupoinventario.php', 'name' => 'aju1grupoinventario', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Aju1gruponotificacion', 'short_caption' => 'Aju1gruponotificacion', 'filename' => 'aju1gruponotificacion.php', 'name' => 'aju1gruponotificacion', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Aju1modulo', 'short_caption' => 'Aju1modulo', 'filename' => 'aju1modulo.php', 'name' => 'aju1modulo', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Aju1naturalezaimpuesto', 'short_caption' => 'Aju1naturalezaimpuesto', 'filename' => 'aju1naturalezaimpuesto.php', 'name' => 'aju1naturalezaimpuesto', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Aju1regimen', 'short_caption' => 'Aju1regimen', 'filename' => 'aju1regimen.php', 'name' => 'aju1regimen', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Aju1tipocliente', 'short_caption' => 'Aju1tipocliente', 'filename' => 'aju1tipocliente.php', 'name' => 'aju1tipocliente', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Aju1tipodocumento', 'short_caption' => 'Aju1tipodocumento', 'filename' => 'aju1tipodocumento.php', 'name' => 'aju1tipodocumento', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Aju1unidadmedida', 'short_caption' => 'Aju1unidadmedida', 'filename' => 'aju1unidadmedida.php', 'name' => 'aju1unidadmedida', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Aju1 Impuesto', 'short_caption' => 'Aju1 Impuesto', 'filename' => 'aju1_impuesto.php', 'name' => 'aju1_impuesto', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Aju1cuentaspuc', 'short_caption' => 'Aju1cuentaspuc', 'filename' => 'aju1cuentaspuc.php', 'name' => 'aju1cuentaspuc', 'group_name' => '&#9881; AJUSTES', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => '&#x2714; FILIAL', 'short_caption' => 'Ter1filial', 'filename' => 'ter1filial.php', 'name' => 'ter1filial', 'group_name' => '&#x1F6C4; TERCEROS', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => '&#x2714; CLIENTE', 'short_caption' => 'Ter1cliente', 'filename' => 'ter1cliente.php', 'name' => 'ter1cliente', 'group_name' => '&#x1F6C4; TERCEROS', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => '&#x2714; ASESOR COMERCIAL', 'short_caption' => 'Ter1asesorcomercial', 'filename' => 'ter1asesorcomercial.php', 'name' => 'ter1asesorcomercial', 'group_name' => '&#x1F6C4; TERCEROS', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => '&#x2714; ALIADO DE NEGOCIO', 'short_caption' => 'Ter1aliadonegocio', 'filename' => 'ter1aliadonegocio.php', 'name' => 'ter1aliadonegocio', 'group_name' => '&#x1F6C4; TERCEROS', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => '&#x2714; NEGOCIACIÓN', 'short_caption' => 'Neg1negociacion', 'filename' => 'neg1negociacion.php', 'name' => 'neg1negociacion', 'group_name' => '&#x1F6C4; TERCEROS', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => '&#x2714; PRODUCTOS', 'short_caption' => 'Cat1productos', 'filename' => 'cat1productos.php', 'name' => 'cat1productos', 'group_name' => '&#x1F6C4; TERCEROS', 'add_separator' => false, 'description' => '');
    return $result;
}

function GetPagesHeader()
{
    return
        '';
}

function GetPagesFooter()
{
    return
        '';
}

function ApplyCommonPageSettings(Page $page, Grid $grid)
{
    $page->SetShowUserAuthBar(true);
    $page->setShowNavigation(true);
    $page->OnGetCustomExportOptions->AddListener('Global_OnGetCustomExportOptions');
    $page->getDataset()->OnGetFieldValue->AddListener('Global_OnGetFieldValue');
    $page->getDataset()->OnGetFieldValue->AddListener('OnGetFieldValue', $page);
    $grid->BeforeUpdateRecord->AddListener('Global_BeforeUpdateHandler');
    $grid->BeforeDeleteRecord->AddListener('Global_BeforeDeleteHandler');
    $grid->BeforeInsertRecord->AddListener('Global_BeforeInsertHandler');
    $grid->AfterUpdateRecord->AddListener('Global_AfterUpdateHandler');
    $grid->AfterDeleteRecord->AddListener('Global_AfterDeleteHandler');
    $grid->AfterInsertRecord->AddListener('Global_AfterInsertHandler');
}

function GetAnsiEncoding() { return 'windows-1252'; }

function Global_AddEnvironmentVariablesHandler(&$variables)
{

}

function Global_CustomHTMLHeaderHandler($page, &$customHtmlHeaderText)
{
    $customHtmlHeaderText = '<link rel="stylesheet" href="asset/style.css">';
}

function Global_GetCustomTemplateHandler($type, $part, $mode, &$result, &$params, CommonPage $page = null)
{

}

function Global_OnGetCustomExportOptions($page, $exportType, $rowData, &$options)
{

}

function Global_OnGetFieldValue($fieldName, &$value, $tableName)
{

}

function Global_GetCustomPageList(CommonPage $page, PageList $pageList)
{

}

function Global_BeforeInsertHandler($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_BeforeUpdateHandler($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_BeforeDeleteHandler($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_AfterInsertHandler($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function Global_AfterUpdateHandler($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function Global_AfterDeleteHandler($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function GetDefaultDateFormat()
{
    return 'Y-m-d';
}

function GetFirstDayOfWeek()
{
    return 0;
}

function GetPageListType()
{
    return PageList::TYPE_SIDEBAR;
}

function GetNullLabel()
{
    return null;
}

function UseMinifiedJS()
{
    return true;
}

function GetOfflineMode()
{
    return false;
}

function GetInactivityTimeout()
{
    return 600;
}

function GetMailer()
{
    $mailerOptions = new MailerOptions(MailerType::Sendmail, '', '');
    
    return PHPMailerBasedMailer::getInstance($mailerOptions);
}

function sendMailMessage($recipients, $messageSubject, $messageBody, $attachments = '', $cc = '', $bcc = '')
{
    GetMailer()->send($recipients, $messageSubject, $messageBody, $attachments, $cc, $bcc);
}

function createConnection()
{
    $connectionOptions = GetGlobalConnectionOptions();
    $connectionOptions['client_encoding'] = 'utf8';

    $connectionFactory = MySqlIConnectionFactory::getInstance();
    return $connectionFactory->CreateConnection($connectionOptions);
}

/**
 * @param string $pageName
 * @return IPermissionSet
 */
function GetCurrentUserPermissionsForPage($pageName) 
{
    return GetApplication()->GetCurrentUserPermissionSet($pageName);
}
