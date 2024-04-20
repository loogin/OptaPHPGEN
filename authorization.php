<?php

include_once dirname(__FILE__) . '/' . 'phpgen_settings.php';
include_once dirname(__FILE__) . '/' . 'components/application.php';
include_once dirname(__FILE__) . '/' . 'components/security/permission_set.php';
include_once dirname(__FILE__) . '/' . 'components/security/user_authentication/table_based_user_authentication.php';
include_once dirname(__FILE__) . '/' . 'components/security/grant_manager/table_based_user_grant_manager.php';
include_once dirname(__FILE__) . '/' . 'components/security/table_based_user_manager.php';
include_once dirname(__FILE__) . '/' . 'components/security/user_identity_storage/user_identity_session_storage.php';
include_once dirname(__FILE__) . '/' . 'components/security/recaptcha.php';
include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';



$dataSourceRecordPermissions = array();

$tableCaptions = array('aju1ciudad' => 'Aju1ciudad',
'aju1ciudad.clientesucursal' => 'Aju1ciudad->Clientesucursal',
'aju1ciudad.filialsucursal' => 'Aju1ciudad->Filialsucursal',
'aju1estado' => 'Aju1estado',
'aju1formatoscontrato' => 'Aju1formatoscontrato',
'aju1grupoinventario' => 'Aju1grupoinventario',
'aju1grupoinventario.negservicios' => 'Aju1grupoinventario->Negservicios',
'aju1gruponotificacion' => 'Aju1gruponotificacion',
'aju1gruponotificacion.clienteactas' => 'Aju1gruponotificacion->Clienteactas',
'aju1gruponotificacion.clientecontacto' => 'Aju1gruponotificacion->Clientecontacto',
'aju1modulo' => 'Aju1modulo',
'aju1modulo.aju1tipodocumento' => 'Aju1modulo->Aju1tipodocumento',
'aju1naturalezaimpuesto' => 'Aju1naturalezaimpuesto',
'aju1naturalezaimpuesto.aju1_impuesto' => 'Aju1naturalezaimpuesto->Aju1 Impuesto',
'aju1regimen' => 'Aju1regimen',
'aju1tipocliente' => 'Aju1tipocliente',
'aju1tipocliente.ter1cliente' => 'Aju1tipocliente->Ter1cliente',
'aju1tipodocumento' => 'Aju1tipodocumento',
'aju1tipodocumento.clientedocumentos' => 'Aju1tipodocumento->Clientedocumentos',
'aju1tipodocumento.filiadocumentos' => 'Aju1tipodocumento->Filiadocumentos',
'aju1unidadmedida' => 'Aju1unidadmedida',
'aju1unidadmedida.negservicios' => 'Aju1unidadmedida->Negservicios',
'aju1_impuesto' => 'Aju1 Impuesto',
'aju1_impuesto.negservicios' => 'Aju1 Impuesto->Negservicios',
'aju1cuentaspuc' => 'Aju1cuentaspuc',
'aju1cuentaspuc.aju1_impuesto' => 'Aju1cuentaspuc->Aju1 Impuesto',
'clienteactas' => 'Clienteactas',
'clientecontacto' => 'Clientecontacto',
'clientecontrato' => 'Clientecontrato',
'clientedocumentos' => 'Clientedocumentos',
'clientelimitescontrato' => 'Clientelimitescontrato',
'clientesucursal' => 'Clientesucursal',
'clientesucursal.clientecontacto' => 'Clientesucursal->Clientecontacto',
'clienteusuariospc' => 'Clienteusuariospc',
'filiadocumentos' => 'Filiadocumentos',
'filialfacturacion' => 'Filialfacturacion',
'filialsucursal' => 'Filialsucursal',
'negservicios' => 'Negservicios',
'ter1filial' => '&#x2714; FILIAL',
'ter1filial.filiadocumentos' => '&#x2714; FILIAL->Filiadocumentos',
'ter1filial.filialfacturacion' => '&#x2714; FILIAL->Filialfacturacion',
'ter1filial.filialsucursal' => '&#x2714; FILIAL->Filialsucursal',
'ter1filial.ter1cliente' => '&#x2714; FILIAL->Ter1cliente',
'ter1cliente' => '&#x2714; CLIENTE',
'ter1cliente.clienteactas' => '&#x2714; CLIENTE->Clienteactas',
'ter1cliente.clientecontacto' => '&#x2714; CLIENTE->Clientecontacto',
'ter1cliente.clientedocumentos' => '&#x2714; CLIENTE->Clientedocumentos',
'ter1cliente.clientesucursal' => '&#x2714; CLIENTE->Clientesucursal',
'ter1cliente.clienteusuariospc' => '&#x2714; CLIENTE->Clienteusuariospc',
'ter1asesorcomercial' => '&#x2714; ASESOR COMERCIAL',
'ter1asesorcomercial.ter1cliente' => '&#x2714; ASESOR COMERCIAL->Ter1cliente',
'ter1aliadonegocio' => '&#x2714; ALIADO DE NEGOCIO',
'ter1aliadonegocio.ter1cliente' => '&#x2714; ALIADO DE NEGOCIO->Ter1cliente',
'neg1negociacion' => '&#x2714; NEGOCIACIÓN',
'neg1negociacion.clientelimitescontrato' => '&#x2714; NEGOCIACIÓN->Clientelimitescontrato',
'neg1negociacion.negservicios' => '&#x2714; NEGOCIACIÓN->Negservicios',
'cat1productos' => '&#x2714; PRODUCTOS');

$usersTableInfo = array(
    'TableName' => 'phpgen_users',
    'UserId' => 'user_id',
    'UserName' => 'user_name',
    'Password' => 'user_password',
    'Email' => 'user_email',
    'UserToken' => 'user_token',
    'UserStatus' => 'user_status'
);

function EncryptPassword($password, &$result)
{

}

function VerifyPassword($enteredPassword, $encryptedPassword, &$result)
{

}

function BeforeUserRegistration($userName, $email, $password, &$allowRegistration, &$errorMessage)
{

}    

function AfterUserRegistration($userName, $email)
{

}    

function PasswordResetRequest($userName, $email)
{

}

function PasswordResetComplete($userName, $email)
{

}

function VerifyPasswordStrength($password, &$result, &$passwordRuleMessage) 
{

}

function CreatePasswordHasher()
{
    $hasher = CreateHasher('SHA256');
    if ($hasher instanceof CustomStringHasher) {
        $hasher->OnEncryptPassword->AddListener('EncryptPassword');
        $hasher->OnVerifyPassword->AddListener('VerifyPassword');
    }
    return $hasher;
}

function CreateGrantManager() 
{
    global $tableCaptions;
    global $usersTableInfo;
    
    $userPermsTableInfo = array('TableName' => 'phpgen_user_perms', 'UserId' => 'user_id', 'PageName' => 'page_name', 'Grant' => 'perm_name');
    
    return new TableBasedUserGrantManager(MySqlIConnectionFactory::getInstance(), GetGlobalConnectionOptions(),
        $usersTableInfo, $userPermsTableInfo, $tableCaptions, false);
}

function CreateTableBasedUserManager() 
{
    global $usersTableInfo;

    $userManager = new TableBasedUserManager(MySqlIConnectionFactory::getInstance(), GetGlobalConnectionOptions(), 
        $usersTableInfo, CreatePasswordHasher(), true);
    $userManager->OnVerifyPasswordStrength->AddListener('VerifyPasswordStrength');

    return $userManager;
}

function GetReCaptcha($formId) 
{
    return null;
}

function SetUpUserAuthorization() 
{
    global $dataSourceRecordPermissions;

    $hasher = CreatePasswordHasher();

    $grantManager = CreateGrantManager();

    $userAuthentication = new TableBasedUserAuthentication(new UserIdentitySessionStorage(), false, $hasher, CreateTableBasedUserManager(), true, false, true);

    GetApplication()->SetUserAuthentication($userAuthentication);
    GetApplication()->SetUserGrantManager($grantManager);
    GetApplication()->SetDataSourceRecordPermissionRetrieveStrategy(new HardCodedDataSourceRecordPermissionRetrieveStrategy($dataSourceRecordPermissions));
}
