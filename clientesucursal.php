<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class clientesucursal_clientecontactoPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Clientecontacto');
            $this->SetMenuLabel('Clientecontacto');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`clientecontacto`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idCliente', true),
                    new StringField('nombreContacto', true),
                    new StringField('email', true),
                    new StringField('telefono1', true),
                    new StringField('telefono2', true),
                    new StringField('cargo', true),
                    new IntegerField('idClienteSucursal', true),
                    new StringField('observacionesContacto', true),
                    new StringField('rl', true),
                    new StringField('usuarioSistema', true),
                    new IntegerField('usuarioFacturacion', true),
                    new IntegerField('idGrupoNotificacion', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $this->dataset->AddLookupField('idCliente', 'ter1cliente', new IntegerField('id'), new IntegerField('idFilial', false, false, false, false, 'idCliente_idFilial', 'idCliente_idFilial_ter1cliente'), 'idCliente_idFilial_ter1cliente');
            $this->dataset->AddLookupField('idClienteSucursal', 'clientesucursal', new IntegerField('id'), new IntegerField('idCliente', false, false, false, false, 'idClienteSucursal_idCliente', 'idClienteSucursal_idCliente_clientesucursal'), 'idClienteSucursal_idCliente_clientesucursal');
            $this->dataset->AddLookupField('idGrupoNotificacion', 'aju1gruponotificacion', new IntegerField('id'), new StringField('grupoNegociacion', false, false, false, false, 'idGrupoNotificacion_grupoNegociacion', 'idGrupoNotificacion_grupoNegociacion_aju1gruponotificacion'), 'idGrupoNotificacion_grupoNegociacion_aju1gruponotificacion');
            $this->dataset->AddLookupField('idEstado', 'aju1estado', new IntegerField('id'), new StringField('estado', false, false, false, false, 'idEstado_estado', 'idEstado_estado_aju1estado'), 'idEstado_estado_aju1estado');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'idCliente', 'idCliente_idFilial', 'Id Cliente'),
                new FilterColumn($this->dataset, 'nombreContacto', 'nombreContacto', 'Nombre Contacto'),
                new FilterColumn($this->dataset, 'email', 'email', 'Email'),
                new FilterColumn($this->dataset, 'telefono1', 'telefono1', 'Telefono1'),
                new FilterColumn($this->dataset, 'telefono2', 'telefono2', 'Telefono2'),
                new FilterColumn($this->dataset, 'cargo', 'cargo', 'Cargo'),
                new FilterColumn($this->dataset, 'idClienteSucursal', 'idClienteSucursal_idCliente', 'Id Cliente Sucursal'),
                new FilterColumn($this->dataset, 'observacionesContacto', 'observacionesContacto', 'Observaciones Contacto'),
                new FilterColumn($this->dataset, 'rl', 'rl', 'Rl'),
                new FilterColumn($this->dataset, 'usuarioSistema', 'usuarioSistema', 'Usuario Sistema'),
                new FilterColumn($this->dataset, 'usuarioFacturacion', 'usuarioFacturacion', 'Usuario Facturacion'),
                new FilterColumn($this->dataset, 'idGrupoNotificacion', 'idGrupoNotificacion_grupoNegociacion', 'Id Grupo Notificacion'),
                new FilterColumn($this->dataset, 'idEstado', 'idEstado_estado', 'Id Estado'),
                new FilterColumn($this->dataset, 'usuarioRegistra', 'usuarioRegistra', 'Usuario Registra'),
                new FilterColumn($this->dataset, 'fechaRegistra', 'fechaRegistra', 'Fecha Registra')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['idCliente'])
                ->addColumn($columns['nombreContacto'])
                ->addColumn($columns['email'])
                ->addColumn($columns['telefono1'])
                ->addColumn($columns['telefono2'])
                ->addColumn($columns['cargo'])
                ->addColumn($columns['idClienteSucursal'])
                ->addColumn($columns['observacionesContacto'])
                ->addColumn($columns['rl'])
                ->addColumn($columns['usuarioSistema'])
                ->addColumn($columns['usuarioFacturacion'])
                ->addColumn($columns['idGrupoNotificacion'])
                ->addColumn($columns['idEstado'])
                ->addColumn($columns['usuarioRegistra'])
                ->addColumn($columns['fechaRegistra']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('idCliente')
                ->setOptionsFor('idClienteSucursal')
                ->setOptionsFor('idGrupoNotificacion')
                ->setOptionsFor('idEstado')
                ->setOptionsFor('fechaRegistra');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('idcliente_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_clientesucursal_clientecontacto_idCliente_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idCliente', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_clientesucursal_clientecontacto_idCliente_search');
            
            $filterBuilder->addColumn(
                $columns['idCliente'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('nombrecontacto_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['nombreContacto'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('email_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['email'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('telefono1_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['telefono1'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('telefono2_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['telefono2'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('cargo_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['cargo'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('idclientesucursal_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_clientesucursal_clientecontacto_idClienteSucursal_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idClienteSucursal', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_clientesucursal_clientecontacto_idClienteSucursal_search');
            
            $filterBuilder->addColumn(
                $columns['idClienteSucursal'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('observacionesContacto');
            
            $filterBuilder->addColumn(
                $columns['observacionesContacto'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('rl_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['rl'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('usuariosistema_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['usuarioSistema'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('usuariofacturacion_edit');
            
            $filterBuilder->addColumn(
                $columns['usuarioFacturacion'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('idgruponotificacion_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_clientesucursal_clientecontacto_idGrupoNotificacion_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idGrupoNotificacion', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_clientesucursal_clientecontacto_idGrupoNotificacion_search');
            
            $text_editor = new TextEdit('idGrupoNotificacion');
            
            $filterBuilder->addColumn(
                $columns['idGrupoNotificacion'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('idestado_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_clientesucursal_clientecontacto_idEstado_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idEstado', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_clientesucursal_clientecontacto_idEstado_search');
            
            $text_editor = new TextEdit('idEstado');
            
            $filterBuilder->addColumn(
                $columns['idEstado'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('usuarioregistra_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['usuarioRegistra'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('fecharegistra_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['fechaRegistra'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->deleteOperationIsAllowed()) {
                $operation = new AjaxOperation(OPERATION_DELETE,
                    $this->GetLocalizerCaptions()->GetMessageString('Delete'),
                    $this->GetLocalizerCaptions()->GetMessageString('Delete'), $this->dataset,
                    $this->GetModalGridDeleteHandler(), $grid
                );
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
            }
            
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for idFilial field
            //
            $column = new NumberViewColumn('idCliente', 'idCliente_idFilial', 'Id Cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for nombreContacto field
            //
            $column = new TextViewColumn('nombreContacto', 'nombreContacto', 'Nombre Contacto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for telefono1 field
            //
            $column = new TextViewColumn('telefono1', 'telefono1', 'Telefono1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for telefono2 field
            //
            $column = new TextViewColumn('telefono2', 'telefono2', 'Telefono2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for cargo field
            //
            $column = new TextViewColumn('cargo', 'cargo', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for idCliente field
            //
            $column = new NumberViewColumn('idClienteSucursal', 'idClienteSucursal_idCliente', 'Id Cliente Sucursal', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for observacionesContacto field
            //
            $column = new TextViewColumn('observacionesContacto', 'observacionesContacto', 'Observaciones Contacto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for rl field
            //
            $column = new TextViewColumn('rl', 'rl', 'Rl', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for usuarioSistema field
            //
            $column = new TextViewColumn('usuarioSistema', 'usuarioSistema', 'Usuario Sistema', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for usuarioFacturacion field
            //
            $column = new NumberViewColumn('usuarioFacturacion', 'usuarioFacturacion', 'Usuario Facturacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for grupoNegociacion field
            //
            $column = new TextViewColumn('idGrupoNotificacion', 'idGrupoNotificacion_grupoNegociacion', 'Id Grupo Notificacion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for estado field
            //
            $column = new TextViewColumn('idEstado', 'idEstado_estado', 'Id Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for usuarioRegistra field
            //
            $column = new TextViewColumn('usuarioRegistra', 'usuarioRegistra', 'Usuario Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for fechaRegistra field
            //
            $column = new DateTimeViewColumn('fechaRegistra', 'fechaRegistra', 'Fecha Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for idFilial field
            //
            $column = new NumberViewColumn('idCliente', 'idCliente_idFilial', 'Id Cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nombreContacto field
            //
            $column = new TextViewColumn('nombreContacto', 'nombreContacto', 'Nombre Contacto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for telefono1 field
            //
            $column = new TextViewColumn('telefono1', 'telefono1', 'Telefono1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for telefono2 field
            //
            $column = new TextViewColumn('telefono2', 'telefono2', 'Telefono2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for cargo field
            //
            $column = new TextViewColumn('cargo', 'cargo', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for idCliente field
            //
            $column = new NumberViewColumn('idClienteSucursal', 'idClienteSucursal_idCliente', 'Id Cliente Sucursal', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for observacionesContacto field
            //
            $column = new TextViewColumn('observacionesContacto', 'observacionesContacto', 'Observaciones Contacto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for rl field
            //
            $column = new TextViewColumn('rl', 'rl', 'Rl', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for usuarioSistema field
            //
            $column = new TextViewColumn('usuarioSistema', 'usuarioSistema', 'Usuario Sistema', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for usuarioFacturacion field
            //
            $column = new NumberViewColumn('usuarioFacturacion', 'usuarioFacturacion', 'Usuario Facturacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for grupoNegociacion field
            //
            $column = new TextViewColumn('idGrupoNotificacion', 'idGrupoNotificacion_grupoNegociacion', 'Id Grupo Notificacion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for estado field
            //
            $column = new TextViewColumn('idEstado', 'idEstado_estado', 'Id Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for usuarioRegistra field
            //
            $column = new TextViewColumn('usuarioRegistra', 'usuarioRegistra', 'Usuario Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fechaRegistra field
            //
            $column = new DateTimeViewColumn('fechaRegistra', 'fechaRegistra', 'Fecha Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for idCliente field
            //
            $editor = new DynamicCombobox('idcliente_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Cliente', 'idCliente', 'idCliente_idFilial', 'edit_clientesucursal_clientecontacto_idCliente_search', $editor, $this->dataset, $lookupDataset, 'id', 'idFilial', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for nombreContacto field
            //
            $editor = new TextEdit('nombrecontacto_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Contacto', 'nombreContacto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for telefono1 field
            //
            $editor = new TextEdit('telefono1_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Telefono1', 'telefono1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for telefono2 field
            //
            $editor = new TextEdit('telefono2_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Telefono2', 'telefono2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for cargo field
            //
            $editor = new TextEdit('cargo_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Cargo', 'cargo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idClienteSucursal field
            //
            $editor = new DynamicCombobox('idclientesucursal_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`clientesucursal`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idCliente', true),
                    new IntegerField('idCiudad', true),
                    new IntegerField('descripcionSucursal', true),
                    new StringField('principal', true),
                    new IntegerField('Direccion', true),
                    new StringField('infoFacturacion', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('idCliente', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Cliente Sucursal', 'idClienteSucursal', 'idClienteSucursal_idCliente', 'edit_clientesucursal_clientecontacto_idClienteSucursal_search', $editor, $this->dataset, $lookupDataset, 'id', 'idCliente', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for observacionesContacto field
            //
            $editor = new TextAreaEdit('observacionescontacto_edit', 50, 8);
            $editColumn = new CustomEditColumn('Observaciones Contacto', 'observacionesContacto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for rl field
            //
            $editor = new TextEdit('rl_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Rl', 'rl', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for usuarioSistema field
            //
            $editor = new TextEdit('usuariosistema_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Usuario Sistema', 'usuarioSistema', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for usuarioFacturacion field
            //
            $editor = new TextEdit('usuariofacturacion_edit');
            $editColumn = new CustomEditColumn('Usuario Facturacion', 'usuarioFacturacion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idGrupoNotificacion field
            //
            $editor = new DynamicCombobox('idgruponotificacion_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1gruponotificacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoNegociacion', true),
                    new StringField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoNegociacion', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Grupo Notificacion', 'idGrupoNotificacion', 'idGrupoNotificacion_grupoNegociacion', 'edit_clientesucursal_clientecontacto_idGrupoNotificacion_search', $editor, $this->dataset, $lookupDataset, 'id', 'grupoNegociacion', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idEstado field
            //
            $editor = new DynamicCombobox('idestado_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Estado', 'idEstado', 'idEstado_estado', 'edit_clientesucursal_clientecontacto_idEstado_search', $editor, $this->dataset, $lookupDataset, 'id', 'estado', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for usuarioRegistra field
            //
            $editor = new TextEdit('usuarioregistra_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Usuario Registra', 'usuarioRegistra', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fechaRegistra field
            //
            $editor = new DateTimeEdit('fecharegistra_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Fecha Registra', 'fechaRegistra', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for idCliente field
            //
            $editor = new DynamicCombobox('idcliente_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Cliente', 'idCliente', 'idCliente_idFilial', 'multi_edit_clientesucursal_clientecontacto_idCliente_search', $editor, $this->dataset, $lookupDataset, 'id', 'idFilial', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for nombreContacto field
            //
            $editor = new TextEdit('nombrecontacto_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Contacto', 'nombreContacto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for telefono1 field
            //
            $editor = new TextEdit('telefono1_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Telefono1', 'telefono1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for telefono2 field
            //
            $editor = new TextEdit('telefono2_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Telefono2', 'telefono2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for cargo field
            //
            $editor = new TextEdit('cargo_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Cargo', 'cargo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idClienteSucursal field
            //
            $editor = new DynamicCombobox('idclientesucursal_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`clientesucursal`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idCliente', true),
                    new IntegerField('idCiudad', true),
                    new IntegerField('descripcionSucursal', true),
                    new StringField('principal', true),
                    new IntegerField('Direccion', true),
                    new StringField('infoFacturacion', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('idCliente', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Cliente Sucursal', 'idClienteSucursal', 'idClienteSucursal_idCliente', 'multi_edit_clientesucursal_clientecontacto_idClienteSucursal_search', $editor, $this->dataset, $lookupDataset, 'id', 'idCliente', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for observacionesContacto field
            //
            $editor = new TextAreaEdit('observacionescontacto_edit', 50, 8);
            $editColumn = new CustomEditColumn('Observaciones Contacto', 'observacionesContacto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for rl field
            //
            $editor = new TextEdit('rl_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Rl', 'rl', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for usuarioSistema field
            //
            $editor = new TextEdit('usuariosistema_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Usuario Sistema', 'usuarioSistema', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for usuarioFacturacion field
            //
            $editor = new TextEdit('usuariofacturacion_edit');
            $editColumn = new CustomEditColumn('Usuario Facturacion', 'usuarioFacturacion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idGrupoNotificacion field
            //
            $editor = new DynamicCombobox('idgruponotificacion_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1gruponotificacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoNegociacion', true),
                    new StringField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoNegociacion', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Grupo Notificacion', 'idGrupoNotificacion', 'idGrupoNotificacion_grupoNegociacion', 'multi_edit_clientesucursal_clientecontacto_idGrupoNotificacion_search', $editor, $this->dataset, $lookupDataset, 'id', 'grupoNegociacion', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idEstado field
            //
            $editor = new DynamicCombobox('idestado_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Estado', 'idEstado', 'idEstado_estado', 'multi_edit_clientesucursal_clientecontacto_idEstado_search', $editor, $this->dataset, $lookupDataset, 'id', 'estado', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for usuarioRegistra field
            //
            $editor = new TextEdit('usuarioregistra_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Usuario Registra', 'usuarioRegistra', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fechaRegistra field
            //
            $editor = new DateTimeEdit('fecharegistra_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Fecha Registra', 'fechaRegistra', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddToggleEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for idCliente field
            //
            $editor = new DynamicCombobox('idcliente_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Cliente', 'idCliente', 'idCliente_idFilial', 'insert_clientesucursal_clientecontacto_idCliente_search', $editor, $this->dataset, $lookupDataset, 'id', 'idFilial', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for nombreContacto field
            //
            $editor = new TextEdit('nombrecontacto_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Contacto', 'nombreContacto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for telefono1 field
            //
            $editor = new TextEdit('telefono1_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Telefono1', 'telefono1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for telefono2 field
            //
            $editor = new TextEdit('telefono2_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Telefono2', 'telefono2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for cargo field
            //
            $editor = new TextEdit('cargo_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Cargo', 'cargo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idClienteSucursal field
            //
            $editor = new DynamicCombobox('idclientesucursal_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`clientesucursal`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idCliente', true),
                    new IntegerField('idCiudad', true),
                    new IntegerField('descripcionSucursal', true),
                    new StringField('principal', true),
                    new IntegerField('Direccion', true),
                    new StringField('infoFacturacion', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('idCliente', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Cliente Sucursal', 'idClienteSucursal', 'idClienteSucursal_idCliente', 'insert_clientesucursal_clientecontacto_idClienteSucursal_search', $editor, $this->dataset, $lookupDataset, 'id', 'idCliente', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for observacionesContacto field
            //
            $editor = new TextAreaEdit('observacionescontacto_edit', 50, 8);
            $editColumn = new CustomEditColumn('Observaciones Contacto', 'observacionesContacto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for rl field
            //
            $editor = new TextEdit('rl_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Rl', 'rl', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for usuarioSistema field
            //
            $editor = new TextEdit('usuariosistema_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Usuario Sistema', 'usuarioSistema', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for usuarioFacturacion field
            //
            $editor = new TextEdit('usuariofacturacion_edit');
            $editColumn = new CustomEditColumn('Usuario Facturacion', 'usuarioFacturacion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idGrupoNotificacion field
            //
            $editor = new DynamicCombobox('idgruponotificacion_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1gruponotificacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoNegociacion', true),
                    new StringField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoNegociacion', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Grupo Notificacion', 'idGrupoNotificacion', 'idGrupoNotificacion_grupoNegociacion', 'insert_clientesucursal_clientecontacto_idGrupoNotificacion_search', $editor, $this->dataset, $lookupDataset, 'id', 'grupoNegociacion', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idEstado field
            //
            $editor = new DynamicCombobox('idestado_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Estado', 'idEstado', 'idEstado_estado', 'insert_clientesucursal_clientecontacto_idEstado_search', $editor, $this->dataset, $lookupDataset, 'id', 'estado', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for usuarioRegistra field
            //
            $editor = new TextEdit('usuarioregistra_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Usuario Registra', 'usuarioRegistra', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fechaRegistra field
            //
            $editor = new DateTimeEdit('fecharegistra_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Fecha Registra', 'fechaRegistra', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for idFilial field
            //
            $column = new NumberViewColumn('idCliente', 'idCliente_idFilial', 'Id Cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for nombreContacto field
            //
            $column = new TextViewColumn('nombreContacto', 'nombreContacto', 'Nombre Contacto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for telefono1 field
            //
            $column = new TextViewColumn('telefono1', 'telefono1', 'Telefono1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for telefono2 field
            //
            $column = new TextViewColumn('telefono2', 'telefono2', 'Telefono2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for cargo field
            //
            $column = new TextViewColumn('cargo', 'cargo', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for idCliente field
            //
            $column = new NumberViewColumn('idClienteSucursal', 'idClienteSucursal_idCliente', 'Id Cliente Sucursal', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for observacionesContacto field
            //
            $column = new TextViewColumn('observacionesContacto', 'observacionesContacto', 'Observaciones Contacto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for rl field
            //
            $column = new TextViewColumn('rl', 'rl', 'Rl', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for usuarioSistema field
            //
            $column = new TextViewColumn('usuarioSistema', 'usuarioSistema', 'Usuario Sistema', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for usuarioFacturacion field
            //
            $column = new NumberViewColumn('usuarioFacturacion', 'usuarioFacturacion', 'Usuario Facturacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for grupoNegociacion field
            //
            $column = new TextViewColumn('idGrupoNotificacion', 'idGrupoNotificacion_grupoNegociacion', 'Id Grupo Notificacion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for estado field
            //
            $column = new TextViewColumn('idEstado', 'idEstado_estado', 'Id Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for usuarioRegistra field
            //
            $column = new TextViewColumn('usuarioRegistra', 'usuarioRegistra', 'Usuario Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for fechaRegistra field
            //
            $column = new DateTimeViewColumn('fechaRegistra', 'fechaRegistra', 'Fecha Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for idFilial field
            //
            $column = new NumberViewColumn('idCliente', 'idCliente_idFilial', 'Id Cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for nombreContacto field
            //
            $column = new TextViewColumn('nombreContacto', 'nombreContacto', 'Nombre Contacto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for telefono1 field
            //
            $column = new TextViewColumn('telefono1', 'telefono1', 'Telefono1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for telefono2 field
            //
            $column = new TextViewColumn('telefono2', 'telefono2', 'Telefono2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for cargo field
            //
            $column = new TextViewColumn('cargo', 'cargo', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for idCliente field
            //
            $column = new NumberViewColumn('idClienteSucursal', 'idClienteSucursal_idCliente', 'Id Cliente Sucursal', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for observacionesContacto field
            //
            $column = new TextViewColumn('observacionesContacto', 'observacionesContacto', 'Observaciones Contacto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for rl field
            //
            $column = new TextViewColumn('rl', 'rl', 'Rl', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for usuarioSistema field
            //
            $column = new TextViewColumn('usuarioSistema', 'usuarioSistema', 'Usuario Sistema', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for usuarioFacturacion field
            //
            $column = new NumberViewColumn('usuarioFacturacion', 'usuarioFacturacion', 'Usuario Facturacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for grupoNegociacion field
            //
            $column = new TextViewColumn('idGrupoNotificacion', 'idGrupoNotificacion_grupoNegociacion', 'Id Grupo Notificacion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for estado field
            //
            $column = new TextViewColumn('idEstado', 'idEstado_estado', 'Id Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for usuarioRegistra field
            //
            $column = new TextViewColumn('usuarioRegistra', 'usuarioRegistra', 'Usuario Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for fechaRegistra field
            //
            $column = new DateTimeViewColumn('fechaRegistra', 'fechaRegistra', 'Fecha Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for idFilial field
            //
            $column = new NumberViewColumn('idCliente', 'idCliente_idFilial', 'Id Cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for nombreContacto field
            //
            $column = new TextViewColumn('nombreContacto', 'nombreContacto', 'Nombre Contacto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for telefono1 field
            //
            $column = new TextViewColumn('telefono1', 'telefono1', 'Telefono1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for telefono2 field
            //
            $column = new TextViewColumn('telefono2', 'telefono2', 'Telefono2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for cargo field
            //
            $column = new TextViewColumn('cargo', 'cargo', 'Cargo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for idCliente field
            //
            $column = new NumberViewColumn('idClienteSucursal', 'idClienteSucursal_idCliente', 'Id Cliente Sucursal', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for observacionesContacto field
            //
            $column = new TextViewColumn('observacionesContacto', 'observacionesContacto', 'Observaciones Contacto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for rl field
            //
            $column = new TextViewColumn('rl', 'rl', 'Rl', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for usuarioSistema field
            //
            $column = new TextViewColumn('usuarioSistema', 'usuarioSistema', 'Usuario Sistema', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for usuarioFacturacion field
            //
            $column = new NumberViewColumn('usuarioFacturacion', 'usuarioFacturacion', 'Usuario Facturacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for grupoNegociacion field
            //
            $column = new TextViewColumn('idGrupoNotificacion', 'idGrupoNotificacion_grupoNegociacion', 'Id Grupo Notificacion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for estado field
            //
            $column = new TextViewColumn('idEstado', 'idEstado_estado', 'Id Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for usuarioRegistra field
            //
            $column = new TextViewColumn('usuarioRegistra', 'usuarioRegistra', 'Usuario Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for fechaRegistra field
            //
            $column = new DateTimeViewColumn('fechaRegistra', 'fechaRegistra', 'Fecha Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddToggleEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setAllowedActions(array('view', 'insert', 'copy', 'edit', 'multi-edit', 'delete', 'multi-delete'));
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_clientesucursal_clientecontacto_idCliente_search', 'id', 'idFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`clientesucursal`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idCliente', true),
                    new IntegerField('idCiudad', true),
                    new IntegerField('descripcionSucursal', true),
                    new StringField('principal', true),
                    new IntegerField('Direccion', true),
                    new StringField('infoFacturacion', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('idCliente', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_clientesucursal_clientecontacto_idClienteSucursal_search', 'id', 'idCliente', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1gruponotificacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoNegociacion', true),
                    new StringField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoNegociacion', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_clientesucursal_clientecontacto_idGrupoNotificacion_search', 'id', 'grupoNegociacion', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_clientesucursal_clientecontacto_idEstado_search', 'id', 'estado', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_clientesucursal_clientecontacto_idCliente_search', 'id', 'idFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`clientesucursal`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idCliente', true),
                    new IntegerField('idCiudad', true),
                    new IntegerField('descripcionSucursal', true),
                    new StringField('principal', true),
                    new IntegerField('Direccion', true),
                    new StringField('infoFacturacion', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('idCliente', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_clientesucursal_clientecontacto_idClienteSucursal_search', 'id', 'idCliente', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`clientesucursal`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idCliente', true),
                    new IntegerField('idCiudad', true),
                    new IntegerField('descripcionSucursal', true),
                    new StringField('principal', true),
                    new IntegerField('Direccion', true),
                    new StringField('infoFacturacion', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('idCliente', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_clientesucursal_clientecontacto_idClienteSucursal_search', 'id', 'idCliente', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1gruponotificacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoNegociacion', true),
                    new StringField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoNegociacion', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_clientesucursal_clientecontacto_idGrupoNotificacion_search', 'id', 'grupoNegociacion', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_clientesucursal_clientecontacto_idEstado_search', 'id', 'estado', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_clientesucursal_clientecontacto_idCliente_search', 'id', 'idFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`clientesucursal`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idCliente', true),
                    new IntegerField('idCiudad', true),
                    new IntegerField('descripcionSucursal', true),
                    new StringField('principal', true),
                    new IntegerField('Direccion', true),
                    new StringField('infoFacturacion', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('idCliente', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_clientesucursal_clientecontacto_idClienteSucursal_search', 'id', 'idCliente', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1gruponotificacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoNegociacion', true),
                    new StringField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoNegociacion', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_clientesucursal_clientecontacto_idGrupoNotificacion_search', 'id', 'grupoNegociacion', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_clientesucursal_clientecontacto_idEstado_search', 'id', 'estado', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_clientesucursal_clientecontacto_idCliente_search', 'id', 'idFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`clientesucursal`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idCliente', true),
                    new IntegerField('idCiudad', true),
                    new IntegerField('descripcionSucursal', true),
                    new StringField('principal', true),
                    new IntegerField('Direccion', true),
                    new StringField('infoFacturacion', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('idCliente', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_clientesucursal_clientecontacto_idClienteSucursal_search', 'id', 'idCliente', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1gruponotificacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoNegociacion', true),
                    new StringField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoNegociacion', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_clientesucursal_clientecontacto_idGrupoNotificacion_search', 'id', 'grupoNegociacion', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_clientesucursal_clientecontacto_idEstado_search', 'id', 'estado', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }
    
    // OnBeforePageExecute event handler
    
    
    
    class clientesucursalPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Clientesucursal');
            $this->SetMenuLabel('Clientesucursal');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`clientesucursal`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idCliente', true),
                    new IntegerField('idCiudad', true),
                    new IntegerField('descripcionSucursal', true),
                    new StringField('principal', true),
                    new IntegerField('Direccion', true),
                    new StringField('infoFacturacion', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $this->dataset->AddLookupField('idCliente', 'ter1cliente', new IntegerField('id'), new IntegerField('idFilial', false, false, false, false, 'idCliente_idFilial', 'idCliente_idFilial_ter1cliente'), 'idCliente_idFilial_ter1cliente');
            $this->dataset->AddLookupField('idCiudad', 'aju1ciudad', new IntegerField('id'), new StringField('sucursal', false, false, false, false, 'idCiudad_sucursal', 'idCiudad_sucursal_aju1ciudad'), 'idCiudad_sucursal_aju1ciudad');
            $this->dataset->AddLookupField('idEstado', 'aju1estado', new IntegerField('id'), new StringField('estado', false, false, false, false, 'idEstado_estado', 'idEstado_estado_aju1estado'), 'idEstado_estado_aju1estado');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'idCliente', 'idCliente_idFilial', 'Id Cliente'),
                new FilterColumn($this->dataset, 'idCiudad', 'idCiudad_sucursal', 'Id Ciudad'),
                new FilterColumn($this->dataset, 'descripcionSucursal', 'descripcionSucursal', 'Descripcion Sucursal'),
                new FilterColumn($this->dataset, 'principal', 'principal', 'Principal'),
                new FilterColumn($this->dataset, 'Direccion', 'Direccion', 'Direccion'),
                new FilterColumn($this->dataset, 'infoFacturacion', 'infoFacturacion', 'Info Facturacion'),
                new FilterColumn($this->dataset, 'idEstado', 'idEstado_estado', 'Id Estado'),
                new FilterColumn($this->dataset, 'usuarioRegistra', 'usuarioRegistra', 'Usuario Registra'),
                new FilterColumn($this->dataset, 'fechaRegistra', 'fechaRegistra', 'Fecha Registra')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['idCliente'])
                ->addColumn($columns['idCiudad'])
                ->addColumn($columns['descripcionSucursal'])
                ->addColumn($columns['principal'])
                ->addColumn($columns['Direccion'])
                ->addColumn($columns['infoFacturacion'])
                ->addColumn($columns['idEstado'])
                ->addColumn($columns['usuarioRegistra'])
                ->addColumn($columns['fechaRegistra']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('idCliente')
                ->setOptionsFor('idCiudad')
                ->setOptionsFor('idEstado');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('idcliente_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_clientesucursal_idCliente_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idCliente', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_clientesucursal_idCliente_search');
            
            $filterBuilder->addColumn(
                $columns['idCliente'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('idciudad_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_clientesucursal_idCiudad_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idCiudad', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_clientesucursal_idCiudad_search');
            
            $text_editor = new TextEdit('idCiudad');
            
            $filterBuilder->addColumn(
                $columns['idCiudad'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('descripcionsucursal_edit');
            
            $filterBuilder->addColumn(
                $columns['descripcionSucursal'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('principal_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['principal'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('direccion_edit');
            
            $filterBuilder->addColumn(
                $columns['Direccion'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('infofacturacion_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['infoFacturacion'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('idestado_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_clientesucursal_idEstado_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idEstado', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_clientesucursal_idEstado_search');
            
            $text_editor = new TextEdit('idEstado');
            
            $filterBuilder->addColumn(
                $columns['idEstado'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('usuarioregistra_edit');
            
            $filterBuilder->addColumn(
                $columns['usuarioRegistra'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('fecharegistra_edit');
            
            $filterBuilder->addColumn(
                $columns['fechaRegistra'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->deleteOperationIsAllowed()) {
                $operation = new AjaxOperation(OPERATION_DELETE,
                    $this->GetLocalizerCaptions()->GetMessageString('Delete'),
                    $this->GetLocalizerCaptions()->GetMessageString('Delete'), $this->dataset,
                    $this->GetModalGridDeleteHandler(), $grid
                );
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
            }
            
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            if (GetCurrentUserPermissionsForPage('clientesucursal.clientecontacto')->HasViewGrant() && $withDetails)
            {
            //
            // View column for clientesucursal_clientecontacto detail
            //
            $column = new DetailColumn(array('id'), 'clientesucursal.clientecontacto', 'clientesucursal_clientecontacto_handler', $this->dataset, 'Clientecontacto');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for idFilial field
            //
            $column = new NumberViewColumn('idCliente', 'idCliente_idFilial', 'Id Cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for sucursal field
            //
            $column = new TextViewColumn('idCiudad', 'idCiudad_sucursal', 'Id Ciudad', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for descripcionSucursal field
            //
            $column = new NumberViewColumn('descripcionSucursal', 'descripcionSucursal', 'Descripcion Sucursal', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for principal field
            //
            $column = new TextViewColumn('principal', 'principal', 'Principal', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Direccion field
            //
            $column = new NumberViewColumn('Direccion', 'Direccion', 'Direccion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for infoFacturacion field
            //
            $column = new TextViewColumn('infoFacturacion', 'infoFacturacion', 'Info Facturacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for estado field
            //
            $column = new TextViewColumn('idEstado', 'idEstado_estado', 'Id Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for usuarioRegistra field
            //
            $column = new NumberViewColumn('usuarioRegistra', 'usuarioRegistra', 'Usuario Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for fechaRegistra field
            //
            $column = new NumberViewColumn('fechaRegistra', 'fechaRegistra', 'Fecha Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for idFilial field
            //
            $column = new NumberViewColumn('idCliente', 'idCliente_idFilial', 'Id Cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sucursal field
            //
            $column = new TextViewColumn('idCiudad', 'idCiudad_sucursal', 'Id Ciudad', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for descripcionSucursal field
            //
            $column = new NumberViewColumn('descripcionSucursal', 'descripcionSucursal', 'Descripcion Sucursal', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for principal field
            //
            $column = new TextViewColumn('principal', 'principal', 'Principal', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Direccion field
            //
            $column = new NumberViewColumn('Direccion', 'Direccion', 'Direccion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for infoFacturacion field
            //
            $column = new TextViewColumn('infoFacturacion', 'infoFacturacion', 'Info Facturacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for estado field
            //
            $column = new TextViewColumn('idEstado', 'idEstado_estado', 'Id Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for usuarioRegistra field
            //
            $column = new NumberViewColumn('usuarioRegistra', 'usuarioRegistra', 'Usuario Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fechaRegistra field
            //
            $column = new NumberViewColumn('fechaRegistra', 'fechaRegistra', 'Fecha Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for idCliente field
            //
            $editor = new DynamicCombobox('idcliente_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Cliente', 'idCliente', 'idCliente_idFilial', 'edit_clientesucursal_idCliente_search', $editor, $this->dataset, $lookupDataset, 'id', 'idFilial', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idCiudad field
            //
            $editor = new DynamicCombobox('idciudad_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1ciudad`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('sucursal', true),
                    new StringField('usuarioRegistra', true),
                    new DateField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('sucursal', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Ciudad', 'idCiudad', 'idCiudad_sucursal', 'edit_clientesucursal_idCiudad_search', $editor, $this->dataset, $lookupDataset, 'id', 'sucursal', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for descripcionSucursal field
            //
            $editor = new TextEdit('descripcionsucursal_edit');
            $editColumn = new CustomEditColumn('Descripcion Sucursal', 'descripcionSucursal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for principal field
            //
            $editor = new TextEdit('principal_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Principal', 'principal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Direccion field
            //
            $editor = new TextEdit('direccion_edit');
            $editColumn = new CustomEditColumn('Direccion', 'Direccion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for infoFacturacion field
            //
            $editor = new TextEdit('infofacturacion_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Info Facturacion', 'infoFacturacion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idEstado field
            //
            $editor = new DynamicCombobox('idestado_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Estado', 'idEstado', 'idEstado_estado', 'edit_clientesucursal_idEstado_search', $editor, $this->dataset, $lookupDataset, 'id', 'estado', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for usuarioRegistra field
            //
            $editor = new TextEdit('usuarioregistra_edit');
            $editColumn = new CustomEditColumn('Usuario Registra', 'usuarioRegistra', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fechaRegistra field
            //
            $editor = new TextEdit('fecharegistra_edit');
            $editColumn = new CustomEditColumn('Fecha Registra', 'fechaRegistra', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for idCliente field
            //
            $editor = new DynamicCombobox('idcliente_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Cliente', 'idCliente', 'idCliente_idFilial', 'multi_edit_clientesucursal_idCliente_search', $editor, $this->dataset, $lookupDataset, 'id', 'idFilial', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idCiudad field
            //
            $editor = new DynamicCombobox('idciudad_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1ciudad`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('sucursal', true),
                    new StringField('usuarioRegistra', true),
                    new DateField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('sucursal', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Ciudad', 'idCiudad', 'idCiudad_sucursal', 'multi_edit_clientesucursal_idCiudad_search', $editor, $this->dataset, $lookupDataset, 'id', 'sucursal', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for descripcionSucursal field
            //
            $editor = new TextEdit('descripcionsucursal_edit');
            $editColumn = new CustomEditColumn('Descripcion Sucursal', 'descripcionSucursal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for principal field
            //
            $editor = new TextEdit('principal_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Principal', 'principal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Direccion field
            //
            $editor = new TextEdit('direccion_edit');
            $editColumn = new CustomEditColumn('Direccion', 'Direccion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for infoFacturacion field
            //
            $editor = new TextEdit('infofacturacion_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Info Facturacion', 'infoFacturacion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idEstado field
            //
            $editor = new DynamicCombobox('idestado_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Estado', 'idEstado', 'idEstado_estado', 'multi_edit_clientesucursal_idEstado_search', $editor, $this->dataset, $lookupDataset, 'id', 'estado', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for usuarioRegistra field
            //
            $editor = new TextEdit('usuarioregistra_edit');
            $editColumn = new CustomEditColumn('Usuario Registra', 'usuarioRegistra', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fechaRegistra field
            //
            $editor = new TextEdit('fecharegistra_edit');
            $editColumn = new CustomEditColumn('Fecha Registra', 'fechaRegistra', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddToggleEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for idCliente field
            //
            $editor = new DynamicCombobox('idcliente_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Cliente', 'idCliente', 'idCliente_idFilial', 'insert_clientesucursal_idCliente_search', $editor, $this->dataset, $lookupDataset, 'id', 'idFilial', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idCiudad field
            //
            $editor = new DynamicCombobox('idciudad_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1ciudad`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('sucursal', true),
                    new StringField('usuarioRegistra', true),
                    new DateField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('sucursal', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Ciudad', 'idCiudad', 'idCiudad_sucursal', 'insert_clientesucursal_idCiudad_search', $editor, $this->dataset, $lookupDataset, 'id', 'sucursal', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for descripcionSucursal field
            //
            $editor = new TextEdit('descripcionsucursal_edit');
            $editColumn = new CustomEditColumn('Descripcion Sucursal', 'descripcionSucursal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for principal field
            //
            $editor = new TextEdit('principal_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Principal', 'principal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Direccion field
            //
            $editor = new TextEdit('direccion_edit');
            $editColumn = new CustomEditColumn('Direccion', 'Direccion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for infoFacturacion field
            //
            $editor = new TextEdit('infofacturacion_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Info Facturacion', 'infoFacturacion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idEstado field
            //
            $editor = new DynamicCombobox('idestado_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Estado', 'idEstado', 'idEstado_estado', 'insert_clientesucursal_idEstado_search', $editor, $this->dataset, $lookupDataset, 'id', 'estado', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for usuarioRegistra field
            //
            $editor = new TextEdit('usuarioregistra_edit');
            $editColumn = new CustomEditColumn('Usuario Registra', 'usuarioRegistra', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fechaRegistra field
            //
            $editor = new TextEdit('fecharegistra_edit');
            $editColumn = new CustomEditColumn('Fecha Registra', 'fechaRegistra', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for idFilial field
            //
            $column = new NumberViewColumn('idCliente', 'idCliente_idFilial', 'Id Cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for sucursal field
            //
            $column = new TextViewColumn('idCiudad', 'idCiudad_sucursal', 'Id Ciudad', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for descripcionSucursal field
            //
            $column = new NumberViewColumn('descripcionSucursal', 'descripcionSucursal', 'Descripcion Sucursal', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for principal field
            //
            $column = new TextViewColumn('principal', 'principal', 'Principal', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Direccion field
            //
            $column = new NumberViewColumn('Direccion', 'Direccion', 'Direccion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for infoFacturacion field
            //
            $column = new TextViewColumn('infoFacturacion', 'infoFacturacion', 'Info Facturacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for estado field
            //
            $column = new TextViewColumn('idEstado', 'idEstado_estado', 'Id Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for usuarioRegistra field
            //
            $column = new NumberViewColumn('usuarioRegistra', 'usuarioRegistra', 'Usuario Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for fechaRegistra field
            //
            $column = new NumberViewColumn('fechaRegistra', 'fechaRegistra', 'Fecha Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for idFilial field
            //
            $column = new NumberViewColumn('idCliente', 'idCliente_idFilial', 'Id Cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for sucursal field
            //
            $column = new TextViewColumn('idCiudad', 'idCiudad_sucursal', 'Id Ciudad', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for descripcionSucursal field
            //
            $column = new NumberViewColumn('descripcionSucursal', 'descripcionSucursal', 'Descripcion Sucursal', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for principal field
            //
            $column = new TextViewColumn('principal', 'principal', 'Principal', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Direccion field
            //
            $column = new NumberViewColumn('Direccion', 'Direccion', 'Direccion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for infoFacturacion field
            //
            $column = new TextViewColumn('infoFacturacion', 'infoFacturacion', 'Info Facturacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for estado field
            //
            $column = new TextViewColumn('idEstado', 'idEstado_estado', 'Id Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for usuarioRegistra field
            //
            $column = new NumberViewColumn('usuarioRegistra', 'usuarioRegistra', 'Usuario Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for fechaRegistra field
            //
            $column = new NumberViewColumn('fechaRegistra', 'fechaRegistra', 'Fecha Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for idFilial field
            //
            $column = new NumberViewColumn('idCliente', 'idCliente_idFilial', 'Id Cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for sucursal field
            //
            $column = new TextViewColumn('idCiudad', 'idCiudad_sucursal', 'Id Ciudad', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for descripcionSucursal field
            //
            $column = new NumberViewColumn('descripcionSucursal', 'descripcionSucursal', 'Descripcion Sucursal', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for principal field
            //
            $column = new TextViewColumn('principal', 'principal', 'Principal', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Direccion field
            //
            $column = new NumberViewColumn('Direccion', 'Direccion', 'Direccion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for infoFacturacion field
            //
            $column = new TextViewColumn('infoFacturacion', 'infoFacturacion', 'Info Facturacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for estado field
            //
            $column = new TextViewColumn('idEstado', 'idEstado_estado', 'Id Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for usuarioRegistra field
            //
            $column = new NumberViewColumn('usuarioRegistra', 'usuarioRegistra', 'Usuario Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for fechaRegistra field
            //
            $column = new NumberViewColumn('fechaRegistra', 'fechaRegistra', 'Fecha Registra', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function CreateMasterDetailRecordGrid()
        {
            $result = new Grid($this, $this->dataset);
            
            $this->AddFieldColumns($result, false);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $this->setupGridColumnGroup($result);
            $this->attachGridEventHandlers($result);
            
            return $result;
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddToggleEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setAllowedActions(array('view', 'insert', 'copy', 'edit', 'multi-edit', 'delete', 'multi-delete'));
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            $detailPage = new clientesucursal_clientecontactoPage('clientesucursal_clientecontacto', $this, array('idClienteSucursal'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('clientesucursal.clientecontacto'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('clientesucursal.clientecontacto'));
            $detailPage->SetHttpHandlerName('clientesucursal_clientecontacto_handler');
            $handler = new PageHTTPHandler('clientesucursal_clientecontacto_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_clientesucursal_idCliente_search', 'id', 'idFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1ciudad`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('sucursal', true),
                    new StringField('usuarioRegistra', true),
                    new DateField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('sucursal', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_clientesucursal_idCiudad_search', 'id', 'sucursal', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_clientesucursal_idEstado_search', 'id', 'estado', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_clientesucursal_idCliente_search', 'id', 'idFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1ciudad`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('sucursal', true),
                    new StringField('usuarioRegistra', true),
                    new DateField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('sucursal', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_clientesucursal_idCiudad_search', 'id', 'sucursal', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_clientesucursal_idEstado_search', 'id', 'estado', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_clientesucursal_idCliente_search', 'id', 'idFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1ciudad`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('sucursal', true),
                    new StringField('usuarioRegistra', true),
                    new DateField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('sucursal', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_clientesucursal_idCiudad_search', 'id', 'sucursal', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_clientesucursal_idEstado_search', 'id', 'estado', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1cliente`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idFilial', true),
                    new IntegerField('idTipoCliente', true),
                    new IntegerField('identificacion', true),
                    new IntegerField('dv', true),
                    new StringField('nombreCliente', true),
                    new IntegerField('idRegimen', true),
                    new StringField('direccionPrincipal', true),
                    new StringField('telefono', true),
                    new StringField('email', true),
                    new IntegerField('idAsesorComercial', true),
                    new IntegerField('idAliadoNegocios', true),
                    new StringField('creacionERP', true),
                    new StringField('fechaCierre', true),
                    new StringField('logo', true),
                    new StringField('ObservacionCliente', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('idFilial', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_clientesucursal_idCliente_search', 'id', 'idFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1ciudad`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('sucursal', true),
                    new StringField('usuarioRegistra', true),
                    new DateField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('sucursal', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_clientesucursal_idCiudad_search', 'id', 'sucursal', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1estado`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('estado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('estado', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_clientesucursal_idEstado_search', 'id', 'estado', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new clientesucursalPage("clientesucursal", "clientesucursal.php", GetCurrentUserPermissionsForPage("clientesucursal"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("clientesucursal"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
