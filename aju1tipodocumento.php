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
    
    
    
    class aju1tipodocumento_clientedocumentosPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Clientedocumentos');
            $this->SetMenuLabel('Clientedocumentos');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`clientedocumentos`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idCliente', true),
                    new IntegerField('idTipoDocumento', true),
                    new StringField('descripcionDocumento', true),
                    new DateField('fechaExpedicion', true),
                    new StringField('documento', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $this->dataset->AddLookupField('idCliente', 'ter1cliente', new IntegerField('id'), new IntegerField('idFilial', false, false, false, false, 'idCliente_idFilial', 'idCliente_idFilial_ter1cliente'), 'idCliente_idFilial_ter1cliente');
            $this->dataset->AddLookupField('idTipoDocumento', 'aju1tipodocumento', new IntegerField('id'), new StringField('tipoDocumento', false, false, false, false, 'idTipoDocumento_tipoDocumento', 'idTipoDocumento_tipoDocumento_aju1tipodocumento'), 'idTipoDocumento_tipoDocumento_aju1tipodocumento');
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
                new FilterColumn($this->dataset, 'idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'Id Tipo Documento'),
                new FilterColumn($this->dataset, 'descripcionDocumento', 'descripcionDocumento', 'Descripcion Documento'),
                new FilterColumn($this->dataset, 'fechaExpedicion', 'fechaExpedicion', 'Fecha Expedicion'),
                new FilterColumn($this->dataset, 'documento', 'documento', 'Documento'),
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
                ->addColumn($columns['idTipoDocumento'])
                ->addColumn($columns['descripcionDocumento'])
                ->addColumn($columns['fechaExpedicion'])
                ->addColumn($columns['documento'])
                ->addColumn($columns['idEstado'])
                ->addColumn($columns['usuarioRegistra'])
                ->addColumn($columns['fechaRegistra']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('idCliente')
                ->setOptionsFor('idTipoDocumento')
                ->setOptionsFor('fechaExpedicion')
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
            $main_editor->SetHandlerName('filter_builder_aju1tipodocumento_clientedocumentos_idCliente_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idCliente', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_aju1tipodocumento_clientedocumentos_idCliente_search');
            
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
            
            $main_editor = new DynamicCombobox('idtipodocumento_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_aju1tipodocumento_clientedocumentos_idTipoDocumento_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idTipoDocumento', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_aju1tipodocumento_clientedocumentos_idTipoDocumento_search');
            
            $text_editor = new TextEdit('idTipoDocumento');
            
            $filterBuilder->addColumn(
                $columns['idTipoDocumento'],
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
            
            $main_editor = new TextEdit('descripciondocumento_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['descripcionDocumento'],
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
            
            $main_editor = new DateTimeEdit('fechaexpedicion_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['fechaExpedicion'],
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
            
            $main_editor = new TextEdit('documento_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['documento'],
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
            $main_editor->SetHandlerName('filter_builder_aju1tipodocumento_clientedocumentos_idEstado_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idEstado', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_aju1tipodocumento_clientedocumentos_idEstado_search');
            
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
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'Id Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for descripcionDocumento field
            //
            $column = new TextViewColumn('descripcionDocumento', 'descripcionDocumento', 'Descripcion Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for fechaExpedicion field
            //
            $column = new DateTimeViewColumn('fechaExpedicion', 'fechaExpedicion', 'Fecha Expedicion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for documento field
            //
            $column = new TextViewColumn('documento', 'documento', 'Documento', $this->dataset);
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
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'Id Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for descripcionDocumento field
            //
            $column = new TextViewColumn('descripcionDocumento', 'descripcionDocumento', 'Descripcion Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fechaExpedicion field
            //
            $column = new DateTimeViewColumn('fechaExpedicion', 'fechaExpedicion', 'Fecha Expedicion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for documento field
            //
            $column = new TextViewColumn('documento', 'documento', 'Documento', $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Id Cliente', 'idCliente', 'idCliente_idFilial', 'edit_aju1tipodocumento_clientedocumentos_idCliente_search', $editor, $this->dataset, $lookupDataset, 'id', 'idFilial', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idTipoDocumento field
            //
            $editor = new DynamicCombobox('idtipodocumento_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Tipo Documento', 'idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'edit_aju1tipodocumento_clientedocumentos_idTipoDocumento_search', $editor, $this->dataset, $lookupDataset, 'id', 'tipoDocumento', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for descripcionDocumento field
            //
            $editor = new TextEdit('descripciondocumento_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Descripcion Documento', 'descripcionDocumento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fechaExpedicion field
            //
            $editor = new DateTimeEdit('fechaexpedicion_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Fecha Expedicion', 'fechaExpedicion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for documento field
            //
            $editor = new TextEdit('documento_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Documento', 'documento', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Id Estado', 'idEstado', 'idEstado_estado', 'edit_aju1tipodocumento_clientedocumentos_idEstado_search', $editor, $this->dataset, $lookupDataset, 'id', 'estado', '');
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
            $editColumn = new DynamicLookupEditColumn('Id Cliente', 'idCliente', 'idCliente_idFilial', 'multi_edit_aju1tipodocumento_clientedocumentos_idCliente_search', $editor, $this->dataset, $lookupDataset, 'id', 'idFilial', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idTipoDocumento field
            //
            $editor = new DynamicCombobox('idtipodocumento_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Tipo Documento', 'idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'multi_edit_aju1tipodocumento_clientedocumentos_idTipoDocumento_search', $editor, $this->dataset, $lookupDataset, 'id', 'tipoDocumento', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for descripcionDocumento field
            //
            $editor = new TextEdit('descripciondocumento_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Descripcion Documento', 'descripcionDocumento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fechaExpedicion field
            //
            $editor = new DateTimeEdit('fechaexpedicion_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Fecha Expedicion', 'fechaExpedicion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for documento field
            //
            $editor = new TextEdit('documento_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Documento', 'documento', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Id Estado', 'idEstado', 'idEstado_estado', 'multi_edit_aju1tipodocumento_clientedocumentos_idEstado_search', $editor, $this->dataset, $lookupDataset, 'id', 'estado', '');
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
            $editColumn = new DynamicLookupEditColumn('Id Cliente', 'idCliente', 'idCliente_idFilial', 'insert_aju1tipodocumento_clientedocumentos_idCliente_search', $editor, $this->dataset, $lookupDataset, 'id', 'idFilial', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idTipoDocumento field
            //
            $editor = new DynamicCombobox('idtipodocumento_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Tipo Documento', 'idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'insert_aju1tipodocumento_clientedocumentos_idTipoDocumento_search', $editor, $this->dataset, $lookupDataset, 'id', 'tipoDocumento', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for descripcionDocumento field
            //
            $editor = new TextEdit('descripciondocumento_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Descripcion Documento', 'descripcionDocumento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fechaExpedicion field
            //
            $editor = new DateTimeEdit('fechaexpedicion_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Fecha Expedicion', 'fechaExpedicion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for documento field
            //
            $editor = new TextEdit('documento_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Documento', 'documento', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Id Estado', 'idEstado', 'idEstado_estado', 'insert_aju1tipodocumento_clientedocumentos_idEstado_search', $editor, $this->dataset, $lookupDataset, 'id', 'estado', '');
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
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'Id Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for descripcionDocumento field
            //
            $column = new TextViewColumn('descripcionDocumento', 'descripcionDocumento', 'Descripcion Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for fechaExpedicion field
            //
            $column = new DateTimeViewColumn('fechaExpedicion', 'fechaExpedicion', 'Fecha Expedicion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for documento field
            //
            $column = new TextViewColumn('documento', 'documento', 'Documento', $this->dataset);
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
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'Id Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for descripcionDocumento field
            //
            $column = new TextViewColumn('descripcionDocumento', 'descripcionDocumento', 'Descripcion Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for fechaExpedicion field
            //
            $column = new DateTimeViewColumn('fechaExpedicion', 'fechaExpedicion', 'Fecha Expedicion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for documento field
            //
            $column = new TextViewColumn('documento', 'documento', 'Documento', $this->dataset);
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
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'Id Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for descripcionDocumento field
            //
            $column = new TextViewColumn('descripcionDocumento', 'descripcionDocumento', 'Descripcion Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for fechaExpedicion field
            //
            $column = new DateTimeViewColumn('fechaExpedicion', 'fechaExpedicion', 'Fecha Expedicion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for documento field
            //
            $column = new TextViewColumn('documento', 'documento', 'Documento', $this->dataset);
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
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_aju1tipodocumento_clientedocumentos_idCliente_search', 'id', 'idFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_aju1tipodocumento_clientedocumentos_idTipoDocumento_search', 'id', 'tipoDocumento', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_aju1tipodocumento_clientedocumentos_idEstado_search', 'id', 'estado', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_aju1tipodocumento_clientedocumentos_idCliente_search', 'id', 'idFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_aju1tipodocumento_clientedocumentos_idTipoDocumento_search', 'id', 'tipoDocumento', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_aju1tipodocumento_clientedocumentos_idEstado_search', 'id', 'estado', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_aju1tipodocumento_clientedocumentos_idCliente_search', 'id', 'idFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_aju1tipodocumento_clientedocumentos_idTipoDocumento_search', 'id', 'tipoDocumento', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_aju1tipodocumento_clientedocumentos_idEstado_search', 'id', 'estado', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_aju1tipodocumento_clientedocumentos_idCliente_search', 'id', 'idFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_aju1tipodocumento_clientedocumentos_idTipoDocumento_search', 'id', 'tipoDocumento', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_aju1tipodocumento_clientedocumentos_idEstado_search', 'id', 'estado', null, 20);
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
    
    
    
    class aju1tipodocumento_filiadocumentosPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Filiadocumentos');
            $this->SetMenuLabel('Filiadocumentos');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`filiadocumentos`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true),
                    new IntegerField('idFilial', true, true),
                    new IntegerField('idTipoDocumento', true, true),
                    new DateField('fechaDocumento', true, true),
                    new StringField('documento', true, true),
                    new StringField('usuarioRegistra', true, true),
                    new DateTimeField('fechaRegistra', true, true)
                )
            );
            $this->dataset->AddLookupField('idFilial', 'ter1filial', new IntegerField('id'), new IntegerField('identificacionFilial', false, false, false, false, 'idFilial_identificacionFilial', 'idFilial_identificacionFilial_ter1filial'), 'idFilial_identificacionFilial_ter1filial');
            $this->dataset->AddLookupField('idTipoDocumento', 'aju1tipodocumento', new IntegerField('id'), new StringField('tipoDocumento', false, false, false, false, 'idTipoDocumento_tipoDocumento', 'idTipoDocumento_tipoDocumento_aju1tipodocumento'), 'idTipoDocumento_tipoDocumento_aju1tipodocumento');
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
                new FilterColumn($this->dataset, 'idFilial', 'idFilial_identificacionFilial', 'Id Filial'),
                new FilterColumn($this->dataset, 'idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'Id Tipo Documento'),
                new FilterColumn($this->dataset, 'fechaDocumento', 'fechaDocumento', 'Fecha Documento'),
                new FilterColumn($this->dataset, 'documento', 'documento', 'Documento'),
                new FilterColumn($this->dataset, 'usuarioRegistra', 'usuarioRegistra', 'Usuario Registra'),
                new FilterColumn($this->dataset, 'fechaRegistra', 'fechaRegistra', 'Fecha Registra')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['idFilial'])
                ->addColumn($columns['idTipoDocumento'])
                ->addColumn($columns['fechaDocumento'])
                ->addColumn($columns['documento'])
                ->addColumn($columns['usuarioRegistra'])
                ->addColumn($columns['fechaRegistra']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('idFilial')
                ->setOptionsFor('idTipoDocumento')
                ->setOptionsFor('fechaDocumento')
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
            
            $main_editor = new DynamicCombobox('idfilial_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_aju1tipodocumento_filiadocumentos_idFilial_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idFilial', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_aju1tipodocumento_filiadocumentos_idFilial_search');
            
            $filterBuilder->addColumn(
                $columns['idFilial'],
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
            
            $main_editor = new DynamicCombobox('idtipodocumento_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_aju1tipodocumento_filiadocumentos_idTipoDocumento_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idTipoDocumento', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_aju1tipodocumento_filiadocumentos_idTipoDocumento_search');
            
            $text_editor = new TextEdit('idTipoDocumento');
            
            $filterBuilder->addColumn(
                $columns['idTipoDocumento'],
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
            
            $main_editor = new DateTimeEdit('fechadocumento_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['fechaDocumento'],
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
            
            $main_editor = new TextEdit('documento_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['documento'],
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
            // View column for identificacionFilial field
            //
            $column = new NumberViewColumn('idFilial', 'idFilial_identificacionFilial', 'Id Filial', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'Id Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for fechaDocumento field
            //
            $column = new DateTimeViewColumn('fechaDocumento', 'fechaDocumento', 'Fecha Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for documento field
            //
            $column = new TextViewColumn('documento', 'documento', 'Documento', $this->dataset);
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
            // View column for identificacionFilial field
            //
            $column = new NumberViewColumn('idFilial', 'idFilial_identificacionFilial', 'Id Filial', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'Id Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fechaDocumento field
            //
            $column = new DateTimeViewColumn('fechaDocumento', 'fechaDocumento', 'Fecha Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for documento field
            //
            $column = new TextViewColumn('documento', 'documento', 'Documento', $this->dataset);
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
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idFilial field
            //
            $editor = new DynamicCombobox('idfilial_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1filial`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('identificacionFilial', true),
                    new IntegerField('dv', true),
                    new StringField('nombreFilial', true),
                    new IntegerField('idRegimen', true),
                    new StringField('representanteLegal', true),
                    new StringField('logo', true),
                    new StringField('direccion', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('identificacionFilial', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Filial', 'idFilial', 'idFilial_identificacionFilial', 'edit_aju1tipodocumento_filiadocumentos_idFilial_search', $editor, $this->dataset, $lookupDataset, 'id', 'identificacionFilial', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idTipoDocumento field
            //
            $editor = new DynamicCombobox('idtipodocumento_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Tipo Documento', 'idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'edit_aju1tipodocumento_filiadocumentos_idTipoDocumento_search', $editor, $this->dataset, $lookupDataset, 'id', 'tipoDocumento', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fechaDocumento field
            //
            $editor = new DateTimeEdit('fechadocumento_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Fecha Documento', 'fechaDocumento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for documento field
            //
            $editor = new TextEdit('documento_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Documento', 'documento', $editor, $this->dataset);
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
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idFilial field
            //
            $editor = new DynamicCombobox('idfilial_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1filial`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('identificacionFilial', true),
                    new IntegerField('dv', true),
                    new StringField('nombreFilial', true),
                    new IntegerField('idRegimen', true),
                    new StringField('representanteLegal', true),
                    new StringField('logo', true),
                    new StringField('direccion', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('identificacionFilial', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Filial', 'idFilial', 'idFilial_identificacionFilial', 'multi_edit_aju1tipodocumento_filiadocumentos_idFilial_search', $editor, $this->dataset, $lookupDataset, 'id', 'identificacionFilial', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idTipoDocumento field
            //
            $editor = new DynamicCombobox('idtipodocumento_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Tipo Documento', 'idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'multi_edit_aju1tipodocumento_filiadocumentos_idTipoDocumento_search', $editor, $this->dataset, $lookupDataset, 'id', 'tipoDocumento', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fechaDocumento field
            //
            $editor = new DateTimeEdit('fechadocumento_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Fecha Documento', 'fechaDocumento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for documento field
            //
            $editor = new TextEdit('documento_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Documento', 'documento', $editor, $this->dataset);
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
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idFilial field
            //
            $editor = new DynamicCombobox('idfilial_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1filial`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('identificacionFilial', true),
                    new IntegerField('dv', true),
                    new StringField('nombreFilial', true),
                    new IntegerField('idRegimen', true),
                    new StringField('representanteLegal', true),
                    new StringField('logo', true),
                    new StringField('direccion', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('identificacionFilial', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Filial', 'idFilial', 'idFilial_identificacionFilial', 'insert_aju1tipodocumento_filiadocumentos_idFilial_search', $editor, $this->dataset, $lookupDataset, 'id', 'identificacionFilial', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idTipoDocumento field
            //
            $editor = new DynamicCombobox('idtipodocumento_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Tipo Documento', 'idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'insert_aju1tipodocumento_filiadocumentos_idTipoDocumento_search', $editor, $this->dataset, $lookupDataset, 'id', 'tipoDocumento', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fechaDocumento field
            //
            $editor = new DateTimeEdit('fechadocumento_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Fecha Documento', 'fechaDocumento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for documento field
            //
            $editor = new TextEdit('documento_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Documento', 'documento', $editor, $this->dataset);
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
            $grid->SetShowAddButton(false && $this->GetSecurityInfo()->HasAddGrant());
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
            // View column for identificacionFilial field
            //
            $column = new NumberViewColumn('idFilial', 'idFilial_identificacionFilial', 'Id Filial', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'Id Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for fechaDocumento field
            //
            $column = new DateTimeViewColumn('fechaDocumento', 'fechaDocumento', 'Fecha Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for documento field
            //
            $column = new TextViewColumn('documento', 'documento', 'Documento', $this->dataset);
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
            // View column for identificacionFilial field
            //
            $column = new NumberViewColumn('idFilial', 'idFilial_identificacionFilial', 'Id Filial', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'Id Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for fechaDocumento field
            //
            $column = new DateTimeViewColumn('fechaDocumento', 'fechaDocumento', 'Fecha Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for documento field
            //
            $column = new TextViewColumn('documento', 'documento', 'Documento', $this->dataset);
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
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for identificacionFilial field
            //
            $column = new NumberViewColumn('idFilial', 'idFilial_identificacionFilial', 'Id Filial', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('idTipoDocumento', 'idTipoDocumento_tipoDocumento', 'Id Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for fechaDocumento field
            //
            $column = new DateTimeViewColumn('fechaDocumento', 'fechaDocumento', 'Fecha Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for documento field
            //
            $column = new TextViewColumn('documento', 'documento', 'Documento', $this->dataset);
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
               $result->SetAllowDeleteSelected(false);
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
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && false);
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
            $this->setAllowedActions(array());
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
                '`ter1filial`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('identificacionFilial', true),
                    new IntegerField('dv', true),
                    new StringField('nombreFilial', true),
                    new IntegerField('idRegimen', true),
                    new StringField('representanteLegal', true),
                    new StringField('logo', true),
                    new StringField('direccion', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('identificacionFilial', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_aju1tipodocumento_filiadocumentos_idFilial_search', 'id', 'identificacionFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_aju1tipodocumento_filiadocumentos_idTipoDocumento_search', 'id', 'tipoDocumento', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1filial`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('identificacionFilial', true),
                    new IntegerField('dv', true),
                    new StringField('nombreFilial', true),
                    new IntegerField('idRegimen', true),
                    new StringField('representanteLegal', true),
                    new StringField('logo', true),
                    new StringField('direccion', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('identificacionFilial', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_aju1tipodocumento_filiadocumentos_idFilial_search', 'id', 'identificacionFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_aju1tipodocumento_filiadocumentos_idTipoDocumento_search', 'id', 'tipoDocumento', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1filial`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('identificacionFilial', true),
                    new IntegerField('dv', true),
                    new StringField('nombreFilial', true),
                    new IntegerField('idRegimen', true),
                    new StringField('representanteLegal', true),
                    new StringField('logo', true),
                    new StringField('direccion', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('identificacionFilial', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_aju1tipodocumento_filiadocumentos_idFilial_search', 'id', 'identificacionFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_aju1tipodocumento_filiadocumentos_idTipoDocumento_search', 'id', 'tipoDocumento', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ter1filial`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('identificacionFilial', true),
                    new IntegerField('dv', true),
                    new StringField('nombreFilial', true),
                    new IntegerField('idRegimen', true),
                    new StringField('representanteLegal', true),
                    new StringField('logo', true),
                    new StringField('direccion', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('identificacionFilial', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_aju1tipodocumento_filiadocumentos_idFilial_search', 'id', 'identificacionFilial', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('tipoDocumento', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_aju1tipodocumento_filiadocumentos_idTipoDocumento_search', 'id', 'tipoDocumento', null, 20);
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
    
    
    
    class aju1tipodocumentoPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Aju1tipodocumento');
            $this->SetMenuLabel('Aju1tipodocumento');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1tipodocumento`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('tipoDocumento', true),
                    new IntegerField('duracionDocumento', true),
                    new IntegerField('idModulo', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $this->dataset->AddLookupField('idModulo', 'aju1modulo', new IntegerField('id'), new StringField('Modulo', false, false, false, false, 'idModulo_Modulo', 'idModulo_Modulo_aju1modulo'), 'idModulo_Modulo_aju1modulo');
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
                new FilterColumn($this->dataset, 'tipoDocumento', 'tipoDocumento', 'Tipo Documento'),
                new FilterColumn($this->dataset, 'duracionDocumento', 'duracionDocumento', 'Duracion Documento'),
                new FilterColumn($this->dataset, 'idModulo', 'idModulo_Modulo', 'Id Modulo'),
                new FilterColumn($this->dataset, 'usuarioRegistra', 'usuarioRegistra', 'Usuario Registra'),
                new FilterColumn($this->dataset, 'fechaRegistra', 'fechaRegistra', 'Fecha Registra')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['tipoDocumento'])
                ->addColumn($columns['duracionDocumento'])
                ->addColumn($columns['idModulo'])
                ->addColumn($columns['usuarioRegistra'])
                ->addColumn($columns['fechaRegistra']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('idModulo')
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
            
            $main_editor = new TextEdit('tipodocumento_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['tipoDocumento'],
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
            
            $main_editor = new TextEdit('duraciondocumento_edit');
            
            $filterBuilder->addColumn(
                $columns['duracionDocumento'],
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
            
            $main_editor = new DynamicCombobox('idmodulo_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_aju1tipodocumento_idModulo_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idModulo', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_aju1tipodocumento_idModulo_search');
            
            $text_editor = new TextEdit('idModulo');
            
            $filterBuilder->addColumn(
                $columns['idModulo'],
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
            if (GetCurrentUserPermissionsForPage('aju1tipodocumento.clientedocumentos')->HasViewGrant() && $withDetails)
            {
            //
            // View column for aju1tipodocumento_clientedocumentos detail
            //
            $column = new DetailColumn(array('id'), 'aju1tipodocumento.clientedocumentos', 'aju1tipodocumento_clientedocumentos_handler', $this->dataset, 'Clientedocumentos');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionsForPage('aju1tipodocumento.filiadocumentos')->HasViewGrant() && $withDetails)
            {
            //
            // View column for aju1tipodocumento_filiadocumentos detail
            //
            $column = new DetailColumn(array('id'), 'aju1tipodocumento.filiadocumentos', 'aju1tipodocumento_filiadocumentos_handler', $this->dataset, 'Filiadocumentos');
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
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('tipoDocumento', 'tipoDocumento', 'Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for duracionDocumento field
            //
            $column = new NumberViewColumn('duracionDocumento', 'duracionDocumento', 'Duracion Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Modulo field
            //
            $column = new TextViewColumn('idModulo', 'idModulo_Modulo', 'Id Modulo', $this->dataset);
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
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('tipoDocumento', 'tipoDocumento', 'Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for duracionDocumento field
            //
            $column = new NumberViewColumn('duracionDocumento', 'duracionDocumento', 'Duracion Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Modulo field
            //
            $column = new TextViewColumn('idModulo', 'idModulo_Modulo', 'Id Modulo', $this->dataset);
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
            // Edit column for tipoDocumento field
            //
            $editor = new TextEdit('tipodocumento_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Tipo Documento', 'tipoDocumento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for duracionDocumento field
            //
            $editor = new TextEdit('duraciondocumento_edit');
            $editColumn = new CustomEditColumn('Duracion Documento', 'duracionDocumento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idModulo field
            //
            $editor = new DynamicCombobox('idmodulo_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1modulo`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Modulo', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('Modulo', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Modulo', 'idModulo', 'idModulo_Modulo', 'edit_aju1tipodocumento_idModulo_search', $editor, $this->dataset, $lookupDataset, 'id', 'Modulo', '');
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
            // Edit column for tipoDocumento field
            //
            $editor = new TextEdit('tipodocumento_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Tipo Documento', 'tipoDocumento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for duracionDocumento field
            //
            $editor = new TextEdit('duraciondocumento_edit');
            $editColumn = new CustomEditColumn('Duracion Documento', 'duracionDocumento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idModulo field
            //
            $editor = new DynamicCombobox('idmodulo_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1modulo`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Modulo', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('Modulo', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Modulo', 'idModulo', 'idModulo_Modulo', 'multi_edit_aju1tipodocumento_idModulo_search', $editor, $this->dataset, $lookupDataset, 'id', 'Modulo', '');
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
            // Edit column for tipoDocumento field
            //
            $editor = new TextEdit('tipodocumento_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Tipo Documento', 'tipoDocumento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for duracionDocumento field
            //
            $editor = new TextEdit('duraciondocumento_edit');
            $editColumn = new CustomEditColumn('Duracion Documento', 'duracionDocumento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idModulo field
            //
            $editor = new DynamicCombobox('idmodulo_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1modulo`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Modulo', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('Modulo', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Modulo', 'idModulo', 'idModulo_Modulo', 'insert_aju1tipodocumento_idModulo_search', $editor, $this->dataset, $lookupDataset, 'id', 'Modulo', '');
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
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('tipoDocumento', 'tipoDocumento', 'Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for duracionDocumento field
            //
            $column = new NumberViewColumn('duracionDocumento', 'duracionDocumento', 'Duracion Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Modulo field
            //
            $column = new TextViewColumn('idModulo', 'idModulo_Modulo', 'Id Modulo', $this->dataset);
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
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('tipoDocumento', 'tipoDocumento', 'Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for duracionDocumento field
            //
            $column = new NumberViewColumn('duracionDocumento', 'duracionDocumento', 'Duracion Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Modulo field
            //
            $column = new TextViewColumn('idModulo', 'idModulo_Modulo', 'Id Modulo', $this->dataset);
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
            // View column for tipoDocumento field
            //
            $column = new TextViewColumn('tipoDocumento', 'tipoDocumento', 'Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for duracionDocumento field
            //
            $column = new NumberViewColumn('duracionDocumento', 'duracionDocumento', 'Duracion Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Modulo field
            //
            $column = new TextViewColumn('idModulo', 'idModulo_Modulo', 'Id Modulo', $this->dataset);
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
            $detailPage = new aju1tipodocumento_clientedocumentosPage('aju1tipodocumento_clientedocumentos', $this, array('idTipoDocumento'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('aju1tipodocumento.clientedocumentos'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('aju1tipodocumento.clientedocumentos'));
            $detailPage->SetHttpHandlerName('aju1tipodocumento_clientedocumentos_handler');
            $handler = new PageHTTPHandler('aju1tipodocumento_clientedocumentos_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new aju1tipodocumento_filiadocumentosPage('aju1tipodocumento_filiadocumentos', $this, array('idTipoDocumento'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('aju1tipodocumento.filiadocumentos'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('aju1tipodocumento.filiadocumentos'));
            $detailPage->SetHttpHandlerName('aju1tipodocumento_filiadocumentos_handler');
            $handler = new PageHTTPHandler('aju1tipodocumento_filiadocumentos_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1modulo`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Modulo', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('Modulo', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_aju1tipodocumento_idModulo_search', 'id', 'Modulo', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1modulo`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Modulo', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('Modulo', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_aju1tipodocumento_idModulo_search', 'id', 'Modulo', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1modulo`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Modulo', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('Modulo', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_aju1tipodocumento_idModulo_search', 'id', 'Modulo', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1modulo`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Modulo', true),
                    new StringField('usuarioRegistro', true),
                    new DateTimeField('fechaRegistro', true)
                )
            );
            $lookupDataset->setOrderByField('Modulo', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_aju1tipodocumento_idModulo_search', 'id', 'Modulo', null, 20);
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
        $Page = new aju1tipodocumentoPage("aju1tipodocumento", "aju1tipodocumento.php", GetCurrentUserPermissionsForPage("aju1tipodocumento"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("aju1tipodocumento"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
