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
    
    
    
    class clientelimitescontratoPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Clientelimitescontrato');
            $this->SetMenuLabel('Clientelimitescontrato');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`clientelimitescontrato`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idNegociacion', true),
                    new IntegerField('numeroEquipos', true),
                    new IntegerField('numeroServidores', true),
                    new IntegerField('numeroMantenimientoAnos', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $this->dataset->AddLookupField('idNegociacion', 'neg1negociacion', new IntegerField('id'), new StringField('nombreCatalogo', false, false, false, false, 'idNegociacion_nombreCatalogo', 'idNegociacion_nombreCatalogo_neg1negociacion'), 'idNegociacion_nombreCatalogo_neg1negociacion');
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
                new FilterColumn($this->dataset, 'idNegociacion', 'idNegociacion_nombreCatalogo', 'Id Negociacion'),
                new FilterColumn($this->dataset, 'numeroEquipos', 'numeroEquipos', 'Numero Equipos'),
                new FilterColumn($this->dataset, 'numeroServidores', 'numeroServidores', 'Numero Servidores'),
                new FilterColumn($this->dataset, 'numeroMantenimientoAnos', 'numeroMantenimientoAnos', 'Numero Mantenimiento Anos'),
                new FilterColumn($this->dataset, 'usuarioRegistra', 'usuarioRegistra', 'Usuario Registra'),
                new FilterColumn($this->dataset, 'fechaRegistra', 'fechaRegistra', 'Fecha Registra')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['idNegociacion'])
                ->addColumn($columns['numeroEquipos'])
                ->addColumn($columns['numeroServidores'])
                ->addColumn($columns['numeroMantenimientoAnos'])
                ->addColumn($columns['usuarioRegistra'])
                ->addColumn($columns['fechaRegistra']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('idNegociacion')
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
            
            $main_editor = new DynamicCombobox('idnegociacion_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_clientelimitescontrato_idNegociacion_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idNegociacion', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_clientelimitescontrato_idNegociacion_search');
            
            $text_editor = new TextEdit('idNegociacion');
            
            $filterBuilder->addColumn(
                $columns['idNegociacion'],
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
            
            $main_editor = new TextEdit('numeroequipos_edit');
            
            $filterBuilder->addColumn(
                $columns['numeroEquipos'],
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
            
            $main_editor = new TextEdit('numeroservidores_edit');
            
            $filterBuilder->addColumn(
                $columns['numeroServidores'],
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
            
            $main_editor = new TextEdit('numeromantenimientoanos_edit');
            
            $filterBuilder->addColumn(
                $columns['numeroMantenimientoAnos'],
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
            // View column for nombreCatalogo field
            //
            $column = new TextViewColumn('idNegociacion', 'idNegociacion_nombreCatalogo', 'Id Negociacion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for numeroEquipos field
            //
            $column = new NumberViewColumn('numeroEquipos', 'numeroEquipos', 'Numero Equipos', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for numeroServidores field
            //
            $column = new NumberViewColumn('numeroServidores', 'numeroServidores', 'Numero Servidores', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for numeroMantenimientoAnos field
            //
            $column = new NumberViewColumn('numeroMantenimientoAnos', 'numeroMantenimientoAnos', 'Numero Mantenimiento Anos', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
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
            // View column for nombreCatalogo field
            //
            $column = new TextViewColumn('idNegociacion', 'idNegociacion_nombreCatalogo', 'Id Negociacion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for numeroEquipos field
            //
            $column = new NumberViewColumn('numeroEquipos', 'numeroEquipos', 'Numero Equipos', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for numeroServidores field
            //
            $column = new NumberViewColumn('numeroServidores', 'numeroServidores', 'Numero Servidores', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for numeroMantenimientoAnos field
            //
            $column = new NumberViewColumn('numeroMantenimientoAnos', 'numeroMantenimientoAnos', 'Numero Mantenimiento Anos', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
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
            // Edit column for idNegociacion field
            //
            $editor = new DynamicCombobox('idnegociacion_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`neg1negociacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreCatalogo', true),
                    new DateField('fechaInicioVigencia', true),
                    new DateField('fechaFinVigencia', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fecharegistra', true)
                )
            );
            $lookupDataset->setOrderByField('nombreCatalogo', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Negociacion', 'idNegociacion', 'idNegociacion_nombreCatalogo', 'edit_clientelimitescontrato_idNegociacion_search', $editor, $this->dataset, $lookupDataset, 'id', 'nombreCatalogo', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for numeroEquipos field
            //
            $editor = new TextEdit('numeroequipos_edit');
            $editColumn = new CustomEditColumn('Numero Equipos', 'numeroEquipos', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for numeroServidores field
            //
            $editor = new TextEdit('numeroservidores_edit');
            $editColumn = new CustomEditColumn('Numero Servidores', 'numeroServidores', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for numeroMantenimientoAnos field
            //
            $editor = new TextEdit('numeromantenimientoanos_edit');
            $editColumn = new CustomEditColumn('Numero Mantenimiento Anos', 'numeroMantenimientoAnos', $editor, $this->dataset);
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
            // Edit column for idNegociacion field
            //
            $editor = new DynamicCombobox('idnegociacion_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`neg1negociacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreCatalogo', true),
                    new DateField('fechaInicioVigencia', true),
                    new DateField('fechaFinVigencia', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fecharegistra', true)
                )
            );
            $lookupDataset->setOrderByField('nombreCatalogo', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Negociacion', 'idNegociacion', 'idNegociacion_nombreCatalogo', 'multi_edit_clientelimitescontrato_idNegociacion_search', $editor, $this->dataset, $lookupDataset, 'id', 'nombreCatalogo', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for numeroEquipos field
            //
            $editor = new TextEdit('numeroequipos_edit');
            $editColumn = new CustomEditColumn('Numero Equipos', 'numeroEquipos', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for numeroServidores field
            //
            $editor = new TextEdit('numeroservidores_edit');
            $editColumn = new CustomEditColumn('Numero Servidores', 'numeroServidores', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for numeroMantenimientoAnos field
            //
            $editor = new TextEdit('numeromantenimientoanos_edit');
            $editColumn = new CustomEditColumn('Numero Mantenimiento Anos', 'numeroMantenimientoAnos', $editor, $this->dataset);
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
            // Edit column for idNegociacion field
            //
            $editor = new DynamicCombobox('idnegociacion_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`neg1negociacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreCatalogo', true),
                    new DateField('fechaInicioVigencia', true),
                    new DateField('fechaFinVigencia', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fecharegistra', true)
                )
            );
            $lookupDataset->setOrderByField('nombreCatalogo', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Negociacion', 'idNegociacion', 'idNegociacion_nombreCatalogo', 'insert_clientelimitescontrato_idNegociacion_search', $editor, $this->dataset, $lookupDataset, 'id', 'nombreCatalogo', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for numeroEquipos field
            //
            $editor = new TextEdit('numeroequipos_edit');
            $editColumn = new CustomEditColumn('Numero Equipos', 'numeroEquipos', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for numeroServidores field
            //
            $editor = new TextEdit('numeroservidores_edit');
            $editColumn = new CustomEditColumn('Numero Servidores', 'numeroServidores', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for numeroMantenimientoAnos field
            //
            $editor = new TextEdit('numeromantenimientoanos_edit');
            $editColumn = new CustomEditColumn('Numero Mantenimiento Anos', 'numeroMantenimientoAnos', $editor, $this->dataset);
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
            // View column for nombreCatalogo field
            //
            $column = new TextViewColumn('idNegociacion', 'idNegociacion_nombreCatalogo', 'Id Negociacion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for numeroEquipos field
            //
            $column = new NumberViewColumn('numeroEquipos', 'numeroEquipos', 'Numero Equipos', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for numeroServidores field
            //
            $column = new NumberViewColumn('numeroServidores', 'numeroServidores', 'Numero Servidores', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for numeroMantenimientoAnos field
            //
            $column = new NumberViewColumn('numeroMantenimientoAnos', 'numeroMantenimientoAnos', 'Numero Mantenimiento Anos', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
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
            // View column for nombreCatalogo field
            //
            $column = new TextViewColumn('idNegociacion', 'idNegociacion_nombreCatalogo', 'Id Negociacion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for numeroEquipos field
            //
            $column = new NumberViewColumn('numeroEquipos', 'numeroEquipos', 'Numero Equipos', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for numeroServidores field
            //
            $column = new NumberViewColumn('numeroServidores', 'numeroServidores', 'Numero Servidores', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for numeroMantenimientoAnos field
            //
            $column = new NumberViewColumn('numeroMantenimientoAnos', 'numeroMantenimientoAnos', 'Numero Mantenimiento Anos', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
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
            // View column for nombreCatalogo field
            //
            $column = new TextViewColumn('idNegociacion', 'idNegociacion_nombreCatalogo', 'Id Negociacion', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for numeroEquipos field
            //
            $column = new NumberViewColumn('numeroEquipos', 'numeroEquipos', 'Numero Equipos', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for numeroServidores field
            //
            $column = new NumberViewColumn('numeroServidores', 'numeroServidores', 'Numero Servidores', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for numeroMantenimientoAnos field
            //
            $column = new NumberViewColumn('numeroMantenimientoAnos', 'numeroMantenimientoAnos', 'Numero Mantenimiento Anos', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
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
                '`neg1negociacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreCatalogo', true),
                    new DateField('fechaInicioVigencia', true),
                    new DateField('fechaFinVigencia', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fecharegistra', true)
                )
            );
            $lookupDataset->setOrderByField('nombreCatalogo', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_clientelimitescontrato_idNegociacion_search', 'id', 'nombreCatalogo', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`neg1negociacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreCatalogo', true),
                    new DateField('fechaInicioVigencia', true),
                    new DateField('fechaFinVigencia', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fecharegistra', true)
                )
            );
            $lookupDataset->setOrderByField('nombreCatalogo', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_clientelimitescontrato_idNegociacion_search', 'id', 'nombreCatalogo', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`neg1negociacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreCatalogo', true),
                    new DateField('fechaInicioVigencia', true),
                    new DateField('fechaFinVigencia', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fecharegistra', true)
                )
            );
            $lookupDataset->setOrderByField('nombreCatalogo', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_clientelimitescontrato_idNegociacion_search', 'id', 'nombreCatalogo', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`neg1negociacion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreCatalogo', true),
                    new DateField('fechaInicioVigencia', true),
                    new DateField('fechaFinVigencia', true),
                    new IntegerField('idEstado', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fecharegistra', true)
                )
            );
            $lookupDataset->setOrderByField('nombreCatalogo', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_clientelimitescontrato_idNegociacion_search', 'id', 'nombreCatalogo', null, 20);
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
        $Page = new clientelimitescontratoPage("clientelimitescontrato", "clientelimitescontrato.php", GetCurrentUserPermissionsForPage("clientelimitescontrato"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("clientelimitescontrato"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
