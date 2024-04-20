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
    
    
    
    class aju1_impuesto_negserviciosPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Negservicios');
            $this->SetMenuLabel('Negservicios');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`negservicios`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('idCat', true),
                    new StringField('codigoServicio', true),
                    new StringField('nombreServicio', true),
                    new StringField('descripcionServicio', true),
                    new StringField('IVA', true),
                    new IntegerField('precioVenta1', true),
                    new IntegerField('precioVenta2', true),
                    new IntegerField('idGrupoInventario', true),
                    new StringField('gravado', true),
                    new StringField('excento', true),
                    new StringField('excluido', true),
                    new IntegerField('idimpuesto', true),
                    new StringField('requiereUnidadMedida', true),
                    new IntegerField('idUnidadMedida', true),
                    new StringField('requiereCodigoBarras', true),
                    new StringField('codigoBarras', true),
                    new StringField('requiereCodigoarancelario', true),
                    new StringField('CodigoArancelarios', true),
                    new StringField('requiereInventario', true),
                    new StringField('productoServicio', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $this->dataset->AddLookupField('idCat', 'neg1negociacion', new IntegerField('id'), new StringField('nombreCatalogo', false, false, false, false, 'idCat_nombreCatalogo', 'idCat_nombreCatalogo_neg1negociacion'), 'idCat_nombreCatalogo_neg1negociacion');
            $this->dataset->AddLookupField('idGrupoInventario', 'aju1grupoinventario', new IntegerField('id'), new StringField('grupoInventarios', false, false, false, false, 'idGrupoInventario_grupoInventarios', 'idGrupoInventario_grupoInventarios_aju1grupoinventario'), 'idGrupoInventario_grupoInventarios_aju1grupoinventario');
            $this->dataset->AddLookupField('idimpuesto', 'aju1_impuesto', new IntegerField('id'), new StringField('nombreImpuesto', false, false, false, false, 'idimpuesto_nombreImpuesto', 'idimpuesto_nombreImpuesto_aju1_impuesto'), 'idimpuesto_nombreImpuesto_aju1_impuesto');
            $this->dataset->AddLookupField('idUnidadMedida', 'aju1unidadmedida', new IntegerField('id'), new StringField('unidadMedida', false, false, false, false, 'idUnidadMedida_unidadMedida', 'idUnidadMedida_unidadMedida_aju1unidadmedida'), 'idUnidadMedida_unidadMedida_aju1unidadmedida');
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
                new FilterColumn($this->dataset, 'idCat', 'idCat_nombreCatalogo', 'Id Cat'),
                new FilterColumn($this->dataset, 'codigoServicio', 'codigoServicio', 'Codigo Servicio'),
                new FilterColumn($this->dataset, 'nombreServicio', 'nombreServicio', 'Nombre Servicio'),
                new FilterColumn($this->dataset, 'descripcionServicio', 'descripcionServicio', 'Descripcion Servicio'),
                new FilterColumn($this->dataset, 'IVA', 'IVA', 'IVA'),
                new FilterColumn($this->dataset, 'precioVenta1', 'precioVenta1', 'Precio Venta1'),
                new FilterColumn($this->dataset, 'precioVenta2', 'precioVenta2', 'Precio Venta2'),
                new FilterColumn($this->dataset, 'idGrupoInventario', 'idGrupoInventario_grupoInventarios', 'Id Grupo Inventario'),
                new FilterColumn($this->dataset, 'gravado', 'gravado', 'Gravado'),
                new FilterColumn($this->dataset, 'excento', 'excento', 'Excento'),
                new FilterColumn($this->dataset, 'excluido', 'excluido', 'Excluido'),
                new FilterColumn($this->dataset, 'idimpuesto', 'idimpuesto_nombreImpuesto', 'Idimpuesto'),
                new FilterColumn($this->dataset, 'requiereUnidadMedida', 'requiereUnidadMedida', 'Requiere Unidad Medida'),
                new FilterColumn($this->dataset, 'idUnidadMedida', 'idUnidadMedida_unidadMedida', 'Id Unidad Medida'),
                new FilterColumn($this->dataset, 'requiereCodigoBarras', 'requiereCodigoBarras', 'Requiere Codigo Barras'),
                new FilterColumn($this->dataset, 'codigoBarras', 'codigoBarras', 'Codigo Barras'),
                new FilterColumn($this->dataset, 'requiereCodigoarancelario', 'requiereCodigoarancelario', 'Requiere Codigoarancelario'),
                new FilterColumn($this->dataset, 'CodigoArancelarios', 'CodigoArancelarios', 'Codigo Arancelarios'),
                new FilterColumn($this->dataset, 'requiereInventario', 'requiereInventario', 'Requiere Inventario'),
                new FilterColumn($this->dataset, 'productoServicio', 'productoServicio', 'Producto Servicio'),
                new FilterColumn($this->dataset, 'usuarioRegistra', 'usuarioRegistra', 'Usuario Registra'),
                new FilterColumn($this->dataset, 'fechaRegistra', 'fechaRegistra', 'Fecha Registra')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['idCat'])
                ->addColumn($columns['codigoServicio'])
                ->addColumn($columns['nombreServicio'])
                ->addColumn($columns['descripcionServicio'])
                ->addColumn($columns['IVA'])
                ->addColumn($columns['precioVenta1'])
                ->addColumn($columns['precioVenta2'])
                ->addColumn($columns['idGrupoInventario'])
                ->addColumn($columns['gravado'])
                ->addColumn($columns['excento'])
                ->addColumn($columns['excluido'])
                ->addColumn($columns['idimpuesto'])
                ->addColumn($columns['requiereUnidadMedida'])
                ->addColumn($columns['idUnidadMedida'])
                ->addColumn($columns['requiereCodigoBarras'])
                ->addColumn($columns['codigoBarras'])
                ->addColumn($columns['requiereCodigoarancelario'])
                ->addColumn($columns['CodigoArancelarios'])
                ->addColumn($columns['requiereInventario'])
                ->addColumn($columns['productoServicio'])
                ->addColumn($columns['usuarioRegistra'])
                ->addColumn($columns['fechaRegistra']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('idCat')
                ->setOptionsFor('idGrupoInventario')
                ->setOptionsFor('idimpuesto')
                ->setOptionsFor('idUnidadMedida')
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
            
            $main_editor = new DynamicCombobox('idcat_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_aju1_impuesto_negservicios_idCat_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idCat', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_aju1_impuesto_negservicios_idCat_search');
            
            $text_editor = new TextEdit('idCat');
            
            $filterBuilder->addColumn(
                $columns['idCat'],
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
            
            $main_editor = new TextEdit('codigoservicio_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['codigoServicio'],
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
            
            $main_editor = new TextEdit('nombreservicio_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['nombreServicio'],
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
            
            $main_editor = new TextEdit('descripcionServicio');
            
            $filterBuilder->addColumn(
                $columns['descripcionServicio'],
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
            
            $main_editor = new TextEdit('iva_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['IVA'],
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
            
            $main_editor = new TextEdit('precioventa1_edit');
            
            $filterBuilder->addColumn(
                $columns['precioVenta1'],
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
            
            $main_editor = new TextEdit('precioventa2_edit');
            
            $filterBuilder->addColumn(
                $columns['precioVenta2'],
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
            
            $main_editor = new DynamicCombobox('idgrupoinventario_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_aju1_impuesto_negservicios_idGrupoInventario_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idGrupoInventario', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_aju1_impuesto_negservicios_idGrupoInventario_search');
            
            $text_editor = new TextEdit('idGrupoInventario');
            
            $filterBuilder->addColumn(
                $columns['idGrupoInventario'],
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
            
            $main_editor = new TextEdit('gravado_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['gravado'],
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
            
            $main_editor = new TextEdit('excento_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['excento'],
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
            
            $main_editor = new TextEdit('excluido_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['excluido'],
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
            
            $main_editor = new DynamicCombobox('idimpuesto_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_aju1_impuesto_negservicios_idimpuesto_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idimpuesto', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_aju1_impuesto_negservicios_idimpuesto_search');
            
            $text_editor = new TextEdit('idimpuesto');
            
            $filterBuilder->addColumn(
                $columns['idimpuesto'],
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
            
            $main_editor = new TextEdit('requiereunidadmedida_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['requiereUnidadMedida'],
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
            
            $main_editor = new DynamicCombobox('idunidadmedida_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_aju1_impuesto_negservicios_idUnidadMedida_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idUnidadMedida', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_aju1_impuesto_negservicios_idUnidadMedida_search');
            
            $text_editor = new TextEdit('idUnidadMedida');
            
            $filterBuilder->addColumn(
                $columns['idUnidadMedida'],
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
            
            $main_editor = new TextEdit('requierecodigobarras_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['requiereCodigoBarras'],
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
            
            $main_editor = new TextEdit('codigobarras_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['codigoBarras'],
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
            
            $main_editor = new TextEdit('requierecodigoarancelario_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['requiereCodigoarancelario'],
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
            
            $main_editor = new TextEdit('codigoarancelarios_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['CodigoArancelarios'],
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
            
            $main_editor = new TextEdit('requiereinventario_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['requiereInventario'],
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
            
            $main_editor = new TextEdit('productoservicio_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['productoServicio'],
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
            $column = new TextViewColumn('idCat', 'idCat_nombreCatalogo', 'Id Cat', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for codigoServicio field
            //
            $column = new TextViewColumn('codigoServicio', 'codigoServicio', 'Codigo Servicio', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for nombreServicio field
            //
            $column = new TextViewColumn('nombreServicio', 'nombreServicio', 'Nombre Servicio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for descripcionServicio field
            //
            $column = new TextViewColumn('descripcionServicio', 'descripcionServicio', 'Descripcion Servicio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for IVA field
            //
            $column = new TextViewColumn('IVA', 'IVA', 'IVA', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for precioVenta1 field
            //
            $column = new NumberViewColumn('precioVenta1', 'precioVenta1', 'Precio Venta1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for precioVenta2 field
            //
            $column = new NumberViewColumn('precioVenta2', 'precioVenta2', 'Precio Venta2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for grupoInventarios field
            //
            $column = new TextViewColumn('idGrupoInventario', 'idGrupoInventario_grupoInventarios', 'Id Grupo Inventario', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for gravado field
            //
            $column = new TextViewColumn('gravado', 'gravado', 'Gravado', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for excento field
            //
            $column = new TextViewColumn('excento', 'excento', 'Excento', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for excluido field
            //
            $column = new TextViewColumn('excluido', 'excluido', 'Excluido', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for nombreImpuesto field
            //
            $column = new TextViewColumn('idimpuesto', 'idimpuesto_nombreImpuesto', 'Idimpuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for requiereUnidadMedida field
            //
            $column = new TextViewColumn('requiereUnidadMedida', 'requiereUnidadMedida', 'Requiere Unidad Medida', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for unidadMedida field
            //
            $column = new TextViewColumn('idUnidadMedida', 'idUnidadMedida_unidadMedida', 'Id Unidad Medida', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for requiereCodigoBarras field
            //
            $column = new TextViewColumn('requiereCodigoBarras', 'requiereCodigoBarras', 'Requiere Codigo Barras', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for codigoBarras field
            //
            $column = new TextViewColumn('codigoBarras', 'codigoBarras', 'Codigo Barras', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for requiereCodigoarancelario field
            //
            $column = new TextViewColumn('requiereCodigoarancelario', 'requiereCodigoarancelario', 'Requiere Codigoarancelario', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for CodigoArancelarios field
            //
            $column = new TextViewColumn('CodigoArancelarios', 'CodigoArancelarios', 'Codigo Arancelarios', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for requiereInventario field
            //
            $column = new TextViewColumn('requiereInventario', 'requiereInventario', 'Requiere Inventario', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for productoServicio field
            //
            $column = new TextViewColumn('productoServicio', 'productoServicio', 'Producto Servicio', $this->dataset);
            $column->SetOrderable(true);
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
            $column = new TextViewColumn('idCat', 'idCat_nombreCatalogo', 'Id Cat', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for codigoServicio field
            //
            $column = new TextViewColumn('codigoServicio', 'codigoServicio', 'Codigo Servicio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nombreServicio field
            //
            $column = new TextViewColumn('nombreServicio', 'nombreServicio', 'Nombre Servicio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for descripcionServicio field
            //
            $column = new TextViewColumn('descripcionServicio', 'descripcionServicio', 'Descripcion Servicio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for IVA field
            //
            $column = new TextViewColumn('IVA', 'IVA', 'IVA', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for precioVenta1 field
            //
            $column = new NumberViewColumn('precioVenta1', 'precioVenta1', 'Precio Venta1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for precioVenta2 field
            //
            $column = new NumberViewColumn('precioVenta2', 'precioVenta2', 'Precio Venta2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for grupoInventarios field
            //
            $column = new TextViewColumn('idGrupoInventario', 'idGrupoInventario_grupoInventarios', 'Id Grupo Inventario', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for gravado field
            //
            $column = new TextViewColumn('gravado', 'gravado', 'Gravado', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for excento field
            //
            $column = new TextViewColumn('excento', 'excento', 'Excento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for excluido field
            //
            $column = new TextViewColumn('excluido', 'excluido', 'Excluido', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nombreImpuesto field
            //
            $column = new TextViewColumn('idimpuesto', 'idimpuesto_nombreImpuesto', 'Idimpuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for requiereUnidadMedida field
            //
            $column = new TextViewColumn('requiereUnidadMedida', 'requiereUnidadMedida', 'Requiere Unidad Medida', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for unidadMedida field
            //
            $column = new TextViewColumn('idUnidadMedida', 'idUnidadMedida_unidadMedida', 'Id Unidad Medida', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for requiereCodigoBarras field
            //
            $column = new TextViewColumn('requiereCodigoBarras', 'requiereCodigoBarras', 'Requiere Codigo Barras', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for codigoBarras field
            //
            $column = new TextViewColumn('codigoBarras', 'codigoBarras', 'Codigo Barras', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for requiereCodigoarancelario field
            //
            $column = new TextViewColumn('requiereCodigoarancelario', 'requiereCodigoarancelario', 'Requiere Codigoarancelario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for CodigoArancelarios field
            //
            $column = new TextViewColumn('CodigoArancelarios', 'CodigoArancelarios', 'Codigo Arancelarios', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for requiereInventario field
            //
            $column = new TextViewColumn('requiereInventario', 'requiereInventario', 'Requiere Inventario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for productoServicio field
            //
            $column = new TextViewColumn('productoServicio', 'productoServicio', 'Producto Servicio', $this->dataset);
            $column->SetOrderable(true);
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
            // Edit column for idCat field
            //
            $editor = new DynamicCombobox('idcat_edit', $this->CreateLinkBuilder());
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
            $editColumn = new DynamicLookupEditColumn('Id Cat', 'idCat', 'idCat_nombreCatalogo', 'edit_aju1_impuesto_negservicios_idCat_search', $editor, $this->dataset, $lookupDataset, 'id', 'nombreCatalogo', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for codigoServicio field
            //
            $editor = new TextEdit('codigoservicio_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Codigo Servicio', 'codigoServicio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for nombreServicio field
            //
            $editor = new TextEdit('nombreservicio_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Servicio', 'nombreServicio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for descripcionServicio field
            //
            $editor = new TextAreaEdit('descripcionservicio_edit', 50, 8);
            $editColumn = new CustomEditColumn('Descripcion Servicio', 'descripcionServicio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for IVA field
            //
            $editor = new TextEdit('iva_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('IVA', 'IVA', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for precioVenta1 field
            //
            $editor = new TextEdit('precioventa1_edit');
            $editColumn = new CustomEditColumn('Precio Venta1', 'precioVenta1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for precioVenta2 field
            //
            $editor = new TextEdit('precioventa2_edit');
            $editColumn = new CustomEditColumn('Precio Venta2', 'precioVenta2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idGrupoInventario field
            //
            $editor = new DynamicCombobox('idgrupoinventario_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1grupoinventario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoInventarios', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoInventarios', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Grupo Inventario', 'idGrupoInventario', 'idGrupoInventario_grupoInventarios', 'edit_aju1_impuesto_negservicios_idGrupoInventario_search', $editor, $this->dataset, $lookupDataset, 'id', 'grupoInventarios', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for gravado field
            //
            $editor = new TextEdit('gravado_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Gravado', 'gravado', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for excento field
            //
            $editor = new TextEdit('excento_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Excento', 'excento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for excluido field
            //
            $editor = new TextEdit('excluido_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Excluido', 'excluido', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idimpuesto field
            //
            $editor = new DynamicCombobox('idimpuesto_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1_impuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreImpuesto', true),
                    new IntegerField('porcentajeImpuesto', true),
                    new IntegerField('idNaturalezaImpuesto', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true),
                    new IntegerField('idPUC', true)
                )
            );
            $lookupDataset->setOrderByField('nombreImpuesto', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Idimpuesto', 'idimpuesto', 'idimpuesto_nombreImpuesto', 'edit_aju1_impuesto_negservicios_idimpuesto_search', $editor, $this->dataset, $lookupDataset, 'id', 'nombreImpuesto', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for requiereUnidadMedida field
            //
            $editor = new TextEdit('requiereunidadmedida_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Requiere Unidad Medida', 'requiereUnidadMedida', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idUnidadMedida field
            //
            $editor = new DynamicCombobox('idunidadmedida_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1unidadmedida`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('unidadMedida', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('unidadMedida', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Unidad Medida', 'idUnidadMedida', 'idUnidadMedida_unidadMedida', 'edit_aju1_impuesto_negservicios_idUnidadMedida_search', $editor, $this->dataset, $lookupDataset, 'id', 'unidadMedida', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for requiereCodigoBarras field
            //
            $editor = new TextEdit('requierecodigobarras_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Requiere Codigo Barras', 'requiereCodigoBarras', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for codigoBarras field
            //
            $editor = new TextEdit('codigobarras_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Codigo Barras', 'codigoBarras', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for requiereCodigoarancelario field
            //
            $editor = new TextEdit('requierecodigoarancelario_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Requiere Codigoarancelario', 'requiereCodigoarancelario', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for CodigoArancelarios field
            //
            $editor = new TextEdit('codigoarancelarios_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Codigo Arancelarios', 'CodigoArancelarios', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for requiereInventario field
            //
            $editor = new TextEdit('requiereinventario_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Requiere Inventario', 'requiereInventario', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for productoServicio field
            //
            $editor = new TextEdit('productoservicio_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Producto Servicio', 'productoServicio', $editor, $this->dataset);
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
            // Edit column for idCat field
            //
            $editor = new DynamicCombobox('idcat_edit', $this->CreateLinkBuilder());
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
            $editColumn = new DynamicLookupEditColumn('Id Cat', 'idCat', 'idCat_nombreCatalogo', 'multi_edit_aju1_impuesto_negservicios_idCat_search', $editor, $this->dataset, $lookupDataset, 'id', 'nombreCatalogo', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for codigoServicio field
            //
            $editor = new TextEdit('codigoservicio_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Codigo Servicio', 'codigoServicio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for nombreServicio field
            //
            $editor = new TextEdit('nombreservicio_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Servicio', 'nombreServicio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for descripcionServicio field
            //
            $editor = new TextAreaEdit('descripcionservicio_edit', 50, 8);
            $editColumn = new CustomEditColumn('Descripcion Servicio', 'descripcionServicio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for IVA field
            //
            $editor = new TextEdit('iva_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('IVA', 'IVA', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for precioVenta1 field
            //
            $editor = new TextEdit('precioventa1_edit');
            $editColumn = new CustomEditColumn('Precio Venta1', 'precioVenta1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for precioVenta2 field
            //
            $editor = new TextEdit('precioventa2_edit');
            $editColumn = new CustomEditColumn('Precio Venta2', 'precioVenta2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idGrupoInventario field
            //
            $editor = new DynamicCombobox('idgrupoinventario_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1grupoinventario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoInventarios', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoInventarios', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Grupo Inventario', 'idGrupoInventario', 'idGrupoInventario_grupoInventarios', 'multi_edit_aju1_impuesto_negservicios_idGrupoInventario_search', $editor, $this->dataset, $lookupDataset, 'id', 'grupoInventarios', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for gravado field
            //
            $editor = new TextEdit('gravado_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Gravado', 'gravado', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for excento field
            //
            $editor = new TextEdit('excento_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Excento', 'excento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for excluido field
            //
            $editor = new TextEdit('excluido_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Excluido', 'excluido', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idimpuesto field
            //
            $editor = new DynamicCombobox('idimpuesto_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1_impuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreImpuesto', true),
                    new IntegerField('porcentajeImpuesto', true),
                    new IntegerField('idNaturalezaImpuesto', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true),
                    new IntegerField('idPUC', true)
                )
            );
            $lookupDataset->setOrderByField('nombreImpuesto', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Idimpuesto', 'idimpuesto', 'idimpuesto_nombreImpuesto', 'multi_edit_aju1_impuesto_negservicios_idimpuesto_search', $editor, $this->dataset, $lookupDataset, 'id', 'nombreImpuesto', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for requiereUnidadMedida field
            //
            $editor = new TextEdit('requiereunidadmedida_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Requiere Unidad Medida', 'requiereUnidadMedida', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idUnidadMedida field
            //
            $editor = new DynamicCombobox('idunidadmedida_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1unidadmedida`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('unidadMedida', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('unidadMedida', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Unidad Medida', 'idUnidadMedida', 'idUnidadMedida_unidadMedida', 'multi_edit_aju1_impuesto_negservicios_idUnidadMedida_search', $editor, $this->dataset, $lookupDataset, 'id', 'unidadMedida', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for requiereCodigoBarras field
            //
            $editor = new TextEdit('requierecodigobarras_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Requiere Codigo Barras', 'requiereCodigoBarras', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for codigoBarras field
            //
            $editor = new TextEdit('codigobarras_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Codigo Barras', 'codigoBarras', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for requiereCodigoarancelario field
            //
            $editor = new TextEdit('requierecodigoarancelario_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Requiere Codigoarancelario', 'requiereCodigoarancelario', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for CodigoArancelarios field
            //
            $editor = new TextEdit('codigoarancelarios_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Codigo Arancelarios', 'CodigoArancelarios', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for requiereInventario field
            //
            $editor = new TextEdit('requiereinventario_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Requiere Inventario', 'requiereInventario', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for productoServicio field
            //
            $editor = new TextEdit('productoservicio_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Producto Servicio', 'productoServicio', $editor, $this->dataset);
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
            // Edit column for idCat field
            //
            $editor = new DynamicCombobox('idcat_edit', $this->CreateLinkBuilder());
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
            $editColumn = new DynamicLookupEditColumn('Id Cat', 'idCat', 'idCat_nombreCatalogo', 'insert_aju1_impuesto_negservicios_idCat_search', $editor, $this->dataset, $lookupDataset, 'id', 'nombreCatalogo', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for codigoServicio field
            //
            $editor = new TextEdit('codigoservicio_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Codigo Servicio', 'codigoServicio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for nombreServicio field
            //
            $editor = new TextEdit('nombreservicio_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Servicio', 'nombreServicio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for descripcionServicio field
            //
            $editor = new TextAreaEdit('descripcionservicio_edit', 50, 8);
            $editColumn = new CustomEditColumn('Descripcion Servicio', 'descripcionServicio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for IVA field
            //
            $editor = new TextEdit('iva_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('IVA', 'IVA', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for precioVenta1 field
            //
            $editor = new TextEdit('precioventa1_edit');
            $editColumn = new CustomEditColumn('Precio Venta1', 'precioVenta1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for precioVenta2 field
            //
            $editor = new TextEdit('precioventa2_edit');
            $editColumn = new CustomEditColumn('Precio Venta2', 'precioVenta2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idGrupoInventario field
            //
            $editor = new DynamicCombobox('idgrupoinventario_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1grupoinventario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoInventarios', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoInventarios', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Grupo Inventario', 'idGrupoInventario', 'idGrupoInventario_grupoInventarios', 'insert_aju1_impuesto_negservicios_idGrupoInventario_search', $editor, $this->dataset, $lookupDataset, 'id', 'grupoInventarios', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for gravado field
            //
            $editor = new TextEdit('gravado_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Gravado', 'gravado', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for excento field
            //
            $editor = new TextEdit('excento_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Excento', 'excento', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for excluido field
            //
            $editor = new TextEdit('excluido_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Excluido', 'excluido', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idimpuesto field
            //
            $editor = new DynamicCombobox('idimpuesto_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1_impuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreImpuesto', true),
                    new IntegerField('porcentajeImpuesto', true),
                    new IntegerField('idNaturalezaImpuesto', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true),
                    new IntegerField('idPUC', true)
                )
            );
            $lookupDataset->setOrderByField('nombreImpuesto', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Idimpuesto', 'idimpuesto', 'idimpuesto_nombreImpuesto', 'insert_aju1_impuesto_negservicios_idimpuesto_search', $editor, $this->dataset, $lookupDataset, 'id', 'nombreImpuesto', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for requiereUnidadMedida field
            //
            $editor = new TextEdit('requiereunidadmedida_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Requiere Unidad Medida', 'requiereUnidadMedida', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idUnidadMedida field
            //
            $editor = new DynamicCombobox('idunidadmedida_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1unidadmedida`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('unidadMedida', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('unidadMedida', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Unidad Medida', 'idUnidadMedida', 'idUnidadMedida_unidadMedida', 'insert_aju1_impuesto_negservicios_idUnidadMedida_search', $editor, $this->dataset, $lookupDataset, 'id', 'unidadMedida', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for requiereCodigoBarras field
            //
            $editor = new TextEdit('requierecodigobarras_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Requiere Codigo Barras', 'requiereCodigoBarras', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for codigoBarras field
            //
            $editor = new TextEdit('codigobarras_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Codigo Barras', 'codigoBarras', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for requiereCodigoarancelario field
            //
            $editor = new TextEdit('requierecodigoarancelario_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Requiere Codigoarancelario', 'requiereCodigoarancelario', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for CodigoArancelarios field
            //
            $editor = new TextEdit('codigoarancelarios_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Codigo Arancelarios', 'CodigoArancelarios', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for requiereInventario field
            //
            $editor = new TextEdit('requiereinventario_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Requiere Inventario', 'requiereInventario', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for productoServicio field
            //
            $editor = new TextEdit('productoservicio_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Producto Servicio', 'productoServicio', $editor, $this->dataset);
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
            $column = new TextViewColumn('idCat', 'idCat_nombreCatalogo', 'Id Cat', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for codigoServicio field
            //
            $column = new TextViewColumn('codigoServicio', 'codigoServicio', 'Codigo Servicio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for nombreServicio field
            //
            $column = new TextViewColumn('nombreServicio', 'nombreServicio', 'Nombre Servicio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for descripcionServicio field
            //
            $column = new TextViewColumn('descripcionServicio', 'descripcionServicio', 'Descripcion Servicio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for IVA field
            //
            $column = new TextViewColumn('IVA', 'IVA', 'IVA', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for precioVenta1 field
            //
            $column = new NumberViewColumn('precioVenta1', 'precioVenta1', 'Precio Venta1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for precioVenta2 field
            //
            $column = new NumberViewColumn('precioVenta2', 'precioVenta2', 'Precio Venta2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for grupoInventarios field
            //
            $column = new TextViewColumn('idGrupoInventario', 'idGrupoInventario_grupoInventarios', 'Id Grupo Inventario', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for gravado field
            //
            $column = new TextViewColumn('gravado', 'gravado', 'Gravado', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for excento field
            //
            $column = new TextViewColumn('excento', 'excento', 'Excento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for excluido field
            //
            $column = new TextViewColumn('excluido', 'excluido', 'Excluido', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for nombreImpuesto field
            //
            $column = new TextViewColumn('idimpuesto', 'idimpuesto_nombreImpuesto', 'Idimpuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for requiereUnidadMedida field
            //
            $column = new TextViewColumn('requiereUnidadMedida', 'requiereUnidadMedida', 'Requiere Unidad Medida', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for unidadMedida field
            //
            $column = new TextViewColumn('idUnidadMedida', 'idUnidadMedida_unidadMedida', 'Id Unidad Medida', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for requiereCodigoBarras field
            //
            $column = new TextViewColumn('requiereCodigoBarras', 'requiereCodigoBarras', 'Requiere Codigo Barras', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for codigoBarras field
            //
            $column = new TextViewColumn('codigoBarras', 'codigoBarras', 'Codigo Barras', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for requiereCodigoarancelario field
            //
            $column = new TextViewColumn('requiereCodigoarancelario', 'requiereCodigoarancelario', 'Requiere Codigoarancelario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for CodigoArancelarios field
            //
            $column = new TextViewColumn('CodigoArancelarios', 'CodigoArancelarios', 'Codigo Arancelarios', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for requiereInventario field
            //
            $column = new TextViewColumn('requiereInventario', 'requiereInventario', 'Requiere Inventario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for productoServicio field
            //
            $column = new TextViewColumn('productoServicio', 'productoServicio', 'Producto Servicio', $this->dataset);
            $column->SetOrderable(true);
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
            $column = new TextViewColumn('idCat', 'idCat_nombreCatalogo', 'Id Cat', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for codigoServicio field
            //
            $column = new TextViewColumn('codigoServicio', 'codigoServicio', 'Codigo Servicio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for nombreServicio field
            //
            $column = new TextViewColumn('nombreServicio', 'nombreServicio', 'Nombre Servicio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for descripcionServicio field
            //
            $column = new TextViewColumn('descripcionServicio', 'descripcionServicio', 'Descripcion Servicio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for IVA field
            //
            $column = new TextViewColumn('IVA', 'IVA', 'IVA', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for precioVenta1 field
            //
            $column = new NumberViewColumn('precioVenta1', 'precioVenta1', 'Precio Venta1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for precioVenta2 field
            //
            $column = new NumberViewColumn('precioVenta2', 'precioVenta2', 'Precio Venta2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for grupoInventarios field
            //
            $column = new TextViewColumn('idGrupoInventario', 'idGrupoInventario_grupoInventarios', 'Id Grupo Inventario', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for gravado field
            //
            $column = new TextViewColumn('gravado', 'gravado', 'Gravado', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for excento field
            //
            $column = new TextViewColumn('excento', 'excento', 'Excento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for excluido field
            //
            $column = new TextViewColumn('excluido', 'excluido', 'Excluido', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for nombreImpuesto field
            //
            $column = new TextViewColumn('idimpuesto', 'idimpuesto_nombreImpuesto', 'Idimpuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for requiereUnidadMedida field
            //
            $column = new TextViewColumn('requiereUnidadMedida', 'requiereUnidadMedida', 'Requiere Unidad Medida', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for unidadMedida field
            //
            $column = new TextViewColumn('idUnidadMedida', 'idUnidadMedida_unidadMedida', 'Id Unidad Medida', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for requiereCodigoBarras field
            //
            $column = new TextViewColumn('requiereCodigoBarras', 'requiereCodigoBarras', 'Requiere Codigo Barras', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for codigoBarras field
            //
            $column = new TextViewColumn('codigoBarras', 'codigoBarras', 'Codigo Barras', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for requiereCodigoarancelario field
            //
            $column = new TextViewColumn('requiereCodigoarancelario', 'requiereCodigoarancelario', 'Requiere Codigoarancelario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for CodigoArancelarios field
            //
            $column = new TextViewColumn('CodigoArancelarios', 'CodigoArancelarios', 'Codigo Arancelarios', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for requiereInventario field
            //
            $column = new TextViewColumn('requiereInventario', 'requiereInventario', 'Requiere Inventario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for productoServicio field
            //
            $column = new TextViewColumn('productoServicio', 'productoServicio', 'Producto Servicio', $this->dataset);
            $column->SetOrderable(true);
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
            $column = new TextViewColumn('idCat', 'idCat_nombreCatalogo', 'Id Cat', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for codigoServicio field
            //
            $column = new TextViewColumn('codigoServicio', 'codigoServicio', 'Codigo Servicio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for nombreServicio field
            //
            $column = new TextViewColumn('nombreServicio', 'nombreServicio', 'Nombre Servicio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for descripcionServicio field
            //
            $column = new TextViewColumn('descripcionServicio', 'descripcionServicio', 'Descripcion Servicio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for IVA field
            //
            $column = new TextViewColumn('IVA', 'IVA', 'IVA', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for precioVenta1 field
            //
            $column = new NumberViewColumn('precioVenta1', 'precioVenta1', 'Precio Venta1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for precioVenta2 field
            //
            $column = new NumberViewColumn('precioVenta2', 'precioVenta2', 'Precio Venta2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for grupoInventarios field
            //
            $column = new TextViewColumn('idGrupoInventario', 'idGrupoInventario_grupoInventarios', 'Id Grupo Inventario', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for gravado field
            //
            $column = new TextViewColumn('gravado', 'gravado', 'Gravado', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for excento field
            //
            $column = new TextViewColumn('excento', 'excento', 'Excento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for excluido field
            //
            $column = new TextViewColumn('excluido', 'excluido', 'Excluido', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for nombreImpuesto field
            //
            $column = new TextViewColumn('idimpuesto', 'idimpuesto_nombreImpuesto', 'Idimpuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for requiereUnidadMedida field
            //
            $column = new TextViewColumn('requiereUnidadMedida', 'requiereUnidadMedida', 'Requiere Unidad Medida', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for unidadMedida field
            //
            $column = new TextViewColumn('idUnidadMedida', 'idUnidadMedida_unidadMedida', 'Id Unidad Medida', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for requiereCodigoBarras field
            //
            $column = new TextViewColumn('requiereCodigoBarras', 'requiereCodigoBarras', 'Requiere Codigo Barras', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for codigoBarras field
            //
            $column = new TextViewColumn('codigoBarras', 'codigoBarras', 'Codigo Barras', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for requiereCodigoarancelario field
            //
            $column = new TextViewColumn('requiereCodigoarancelario', 'requiereCodigoarancelario', 'Requiere Codigoarancelario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for CodigoArancelarios field
            //
            $column = new TextViewColumn('CodigoArancelarios', 'CodigoArancelarios', 'Codigo Arancelarios', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for requiereInventario field
            //
            $column = new TextViewColumn('requiereInventario', 'requiereInventario', 'Requiere Inventario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for productoServicio field
            //
            $column = new TextViewColumn('productoServicio', 'productoServicio', 'Producto Servicio', $this->dataset);
            $column->SetOrderable(true);
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
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_aju1_impuesto_negservicios_idCat_search', 'id', 'nombreCatalogo', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1grupoinventario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoInventarios', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoInventarios', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_aju1_impuesto_negservicios_idGrupoInventario_search', 'id', 'grupoInventarios', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1_impuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreImpuesto', true),
                    new IntegerField('porcentajeImpuesto', true),
                    new IntegerField('idNaturalezaImpuesto', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true),
                    new IntegerField('idPUC', true)
                )
            );
            $lookupDataset->setOrderByField('nombreImpuesto', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_aju1_impuesto_negservicios_idimpuesto_search', 'id', 'nombreImpuesto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1unidadmedida`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('unidadMedida', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('unidadMedida', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_aju1_impuesto_negservicios_idUnidadMedida_search', 'id', 'unidadMedida', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_aju1_impuesto_negservicios_idCat_search', 'id', 'nombreCatalogo', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1grupoinventario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoInventarios', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoInventarios', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_aju1_impuesto_negservicios_idGrupoInventario_search', 'id', 'grupoInventarios', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1_impuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreImpuesto', true),
                    new IntegerField('porcentajeImpuesto', true),
                    new IntegerField('idNaturalezaImpuesto', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true),
                    new IntegerField('idPUC', true)
                )
            );
            $lookupDataset->setOrderByField('nombreImpuesto', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_aju1_impuesto_negservicios_idimpuesto_search', 'id', 'nombreImpuesto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1unidadmedida`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('unidadMedida', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('unidadMedida', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_aju1_impuesto_negservicios_idUnidadMedida_search', 'id', 'unidadMedida', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_aju1_impuesto_negservicios_idCat_search', 'id', 'nombreCatalogo', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1grupoinventario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoInventarios', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoInventarios', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_aju1_impuesto_negservicios_idGrupoInventario_search', 'id', 'grupoInventarios', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1_impuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreImpuesto', true),
                    new IntegerField('porcentajeImpuesto', true),
                    new IntegerField('idNaturalezaImpuesto', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true),
                    new IntegerField('idPUC', true)
                )
            );
            $lookupDataset->setOrderByField('nombreImpuesto', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_aju1_impuesto_negservicios_idimpuesto_search', 'id', 'nombreImpuesto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1unidadmedida`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('unidadMedida', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('unidadMedida', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_aju1_impuesto_negservicios_idUnidadMedida_search', 'id', 'unidadMedida', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_aju1_impuesto_negservicios_idCat_search', 'id', 'nombreCatalogo', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1grupoinventario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('grupoInventarios', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('grupoInventarios', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_aju1_impuesto_negservicios_idGrupoInventario_search', 'id', 'grupoInventarios', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1_impuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreImpuesto', true),
                    new IntegerField('porcentajeImpuesto', true),
                    new IntegerField('idNaturalezaImpuesto', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true),
                    new IntegerField('idPUC', true)
                )
            );
            $lookupDataset->setOrderByField('nombreImpuesto', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_aju1_impuesto_negservicios_idimpuesto_search', 'id', 'nombreImpuesto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1unidadmedida`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('unidadMedida', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('unidadMedida', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_aju1_impuesto_negservicios_idUnidadMedida_search', 'id', 'unidadMedida', null, 20);
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
    
    
    
    class aju1_impuestoPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Aju1 Impuesto');
            $this->SetMenuLabel('Aju1 Impuesto');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1_impuesto`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nombreImpuesto', true),
                    new IntegerField('porcentajeImpuesto', true),
                    new IntegerField('idNaturalezaImpuesto', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true),
                    new IntegerField('idPUC', true)
                )
            );
            $this->dataset->AddLookupField('idNaturalezaImpuesto', 'aju1naturalezaimpuesto', new IntegerField('id'), new StringField('Naturaleza', false, false, false, false, 'idNaturalezaImpuesto_Naturaleza', 'idNaturalezaImpuesto_Naturaleza_aju1naturalezaimpuesto'), 'idNaturalezaImpuesto_Naturaleza_aju1naturalezaimpuesto');
            $this->dataset->AddLookupField('idPUC', 'aju1cuentaspuc', new IntegerField('id'), new IntegerField('codigoCuentaPUC', false, false, false, false, 'idPUC_codigoCuentaPUC', 'idPUC_codigoCuentaPUC_aju1cuentaspuc'), 'idPUC_codigoCuentaPUC_aju1cuentaspuc');
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
                new FilterColumn($this->dataset, 'nombreImpuesto', 'nombreImpuesto', 'Nombre Impuesto'),
                new FilterColumn($this->dataset, 'porcentajeImpuesto', 'porcentajeImpuesto', 'Porcentaje Impuesto'),
                new FilterColumn($this->dataset, 'idNaturalezaImpuesto', 'idNaturalezaImpuesto_Naturaleza', 'Id Naturaleza Impuesto'),
                new FilterColumn($this->dataset, 'usuarioRegistra', 'usuarioRegistra', 'Usuario Registra'),
                new FilterColumn($this->dataset, 'fechaRegistra', 'fechaRegistra', 'Fecha Registra'),
                new FilterColumn($this->dataset, 'idPUC', 'idPUC_codigoCuentaPUC', 'Id PUC')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['nombreImpuesto'])
                ->addColumn($columns['porcentajeImpuesto'])
                ->addColumn($columns['idNaturalezaImpuesto'])
                ->addColumn($columns['usuarioRegistra'])
                ->addColumn($columns['fechaRegistra'])
                ->addColumn($columns['idPUC']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('idNaturalezaImpuesto')
                ->setOptionsFor('fechaRegistra')
                ->setOptionsFor('idPUC');
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
            
            $main_editor = new TextEdit('nombreimpuesto_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['nombreImpuesto'],
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
            
            $main_editor = new TextEdit('porcentajeimpuesto_edit');
            
            $filterBuilder->addColumn(
                $columns['porcentajeImpuesto'],
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
            
            $main_editor = new DynamicCombobox('idnaturalezaimpuesto_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_aju1_impuesto_idNaturalezaImpuesto_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idNaturalezaImpuesto', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_aju1_impuesto_idNaturalezaImpuesto_search');
            
            $text_editor = new TextEdit('idNaturalezaImpuesto');
            
            $filterBuilder->addColumn(
                $columns['idNaturalezaImpuesto'],
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
            
            $main_editor = new DynamicCombobox('idpuc_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_aju1_impuesto_idPUC_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('idPUC', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_aju1_impuesto_idPUC_search');
            
            $filterBuilder->addColumn(
                $columns['idPUC'],
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
            if (GetCurrentUserPermissionsForPage('aju1_impuesto.negservicios')->HasViewGrant() && $withDetails)
            {
            //
            // View column for aju1_impuesto_negservicios detail
            //
            $column = new DetailColumn(array('id'), 'aju1_impuesto.negservicios', 'aju1_impuesto_negservicios_handler', $this->dataset, 'Negservicios');
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
            // View column for nombreImpuesto field
            //
            $column = new TextViewColumn('nombreImpuesto', 'nombreImpuesto', 'Nombre Impuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for porcentajeImpuesto field
            //
            $column = new NumberViewColumn('porcentajeImpuesto', 'porcentajeImpuesto', 'Porcentaje Impuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            //
            // View column for Naturaleza field
            //
            $column = new TextViewColumn('idNaturalezaImpuesto', 'idNaturalezaImpuesto_Naturaleza', 'Id Naturaleza Impuesto', $this->dataset);
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
            //
            // View column for codigoCuentaPUC field
            //
            $column = new NumberViewColumn('idPUC', 'idPUC_codigoCuentaPUC', 'Id PUC', $this->dataset);
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
            // View column for nombreImpuesto field
            //
            $column = new TextViewColumn('nombreImpuesto', 'nombreImpuesto', 'Nombre Impuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for porcentajeImpuesto field
            //
            $column = new NumberViewColumn('porcentajeImpuesto', 'porcentajeImpuesto', 'Porcentaje Impuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Naturaleza field
            //
            $column = new TextViewColumn('idNaturalezaImpuesto', 'idNaturalezaImpuesto_Naturaleza', 'Id Naturaleza Impuesto', $this->dataset);
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
            
            //
            // View column for codigoCuentaPUC field
            //
            $column = new NumberViewColumn('idPUC', 'idPUC_codigoCuentaPUC', 'Id PUC', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for nombreImpuesto field
            //
            $editor = new TextEdit('nombreimpuesto_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Impuesto', 'nombreImpuesto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for porcentajeImpuesto field
            //
            $editor = new TextEdit('porcentajeimpuesto_edit');
            $editColumn = new CustomEditColumn('Porcentaje Impuesto', 'porcentajeImpuesto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for idNaturalezaImpuesto field
            //
            $editor = new DynamicCombobox('idnaturalezaimpuesto_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1naturalezaimpuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Naturaleza', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('Naturaleza', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Naturaleza Impuesto', 'idNaturalezaImpuesto', 'idNaturalezaImpuesto_Naturaleza', 'edit_aju1_impuesto_idNaturalezaImpuesto_search', $editor, $this->dataset, $lookupDataset, 'id', 'Naturaleza', '');
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
            
            //
            // Edit column for idPUC field
            //
            $editor = new DynamicCombobox('idpuc_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1cuentaspuc`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('codigoCuentaPUC', true),
                    new StringField('descripcionCuenta', true),
                    new IntegerField('grupo', true),
                    new IntegerField('subcuenta', true),
                    new IntegerField('auxiliar', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('codigoCuentaPUC', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id PUC', 'idPUC', 'idPUC_codigoCuentaPUC', 'edit_aju1_impuesto_idPUC_search', $editor, $this->dataset, $lookupDataset, 'id', 'codigoCuentaPUC', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for nombreImpuesto field
            //
            $editor = new TextEdit('nombreimpuesto_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Impuesto', 'nombreImpuesto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for porcentajeImpuesto field
            //
            $editor = new TextEdit('porcentajeimpuesto_edit');
            $editColumn = new CustomEditColumn('Porcentaje Impuesto', 'porcentajeImpuesto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for idNaturalezaImpuesto field
            //
            $editor = new DynamicCombobox('idnaturalezaimpuesto_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1naturalezaimpuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Naturaleza', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('Naturaleza', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Naturaleza Impuesto', 'idNaturalezaImpuesto', 'idNaturalezaImpuesto_Naturaleza', 'multi_edit_aju1_impuesto_idNaturalezaImpuesto_search', $editor, $this->dataset, $lookupDataset, 'id', 'Naturaleza', '');
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
            
            //
            // Edit column for idPUC field
            //
            $editor = new DynamicCombobox('idpuc_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1cuentaspuc`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('codigoCuentaPUC', true),
                    new StringField('descripcionCuenta', true),
                    new IntegerField('grupo', true),
                    new IntegerField('subcuenta', true),
                    new IntegerField('auxiliar', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('codigoCuentaPUC', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id PUC', 'idPUC', 'idPUC_codigoCuentaPUC', 'multi_edit_aju1_impuesto_idPUC_search', $editor, $this->dataset, $lookupDataset, 'id', 'codigoCuentaPUC', '');
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
            // Edit column for nombreImpuesto field
            //
            $editor = new TextEdit('nombreimpuesto_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Impuesto', 'nombreImpuesto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for porcentajeImpuesto field
            //
            $editor = new TextEdit('porcentajeimpuesto_edit');
            $editColumn = new CustomEditColumn('Porcentaje Impuesto', 'porcentajeImpuesto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for idNaturalezaImpuesto field
            //
            $editor = new DynamicCombobox('idnaturalezaimpuesto_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1naturalezaimpuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Naturaleza', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('Naturaleza', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Naturaleza Impuesto', 'idNaturalezaImpuesto', 'idNaturalezaImpuesto_Naturaleza', 'insert_aju1_impuesto_idNaturalezaImpuesto_search', $editor, $this->dataset, $lookupDataset, 'id', 'Naturaleza', '');
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
            
            //
            // Edit column for idPUC field
            //
            $editor = new DynamicCombobox('idpuc_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1cuentaspuc`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('codigoCuentaPUC', true),
                    new StringField('descripcionCuenta', true),
                    new IntegerField('grupo', true),
                    new IntegerField('subcuenta', true),
                    new IntegerField('auxiliar', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('codigoCuentaPUC', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id PUC', 'idPUC', 'idPUC_codigoCuentaPUC', 'insert_aju1_impuesto_idPUC_search', $editor, $this->dataset, $lookupDataset, 'id', 'codigoCuentaPUC', '');
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
            // View column for nombreImpuesto field
            //
            $column = new TextViewColumn('nombreImpuesto', 'nombreImpuesto', 'Nombre Impuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for porcentajeImpuesto field
            //
            $column = new NumberViewColumn('porcentajeImpuesto', 'porcentajeImpuesto', 'Porcentaje Impuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Naturaleza field
            //
            $column = new TextViewColumn('idNaturalezaImpuesto', 'idNaturalezaImpuesto_Naturaleza', 'Id Naturaleza Impuesto', $this->dataset);
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
            
            //
            // View column for codigoCuentaPUC field
            //
            $column = new NumberViewColumn('idPUC', 'idPUC_codigoCuentaPUC', 'Id PUC', $this->dataset);
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
            // View column for nombreImpuesto field
            //
            $column = new TextViewColumn('nombreImpuesto', 'nombreImpuesto', 'Nombre Impuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for porcentajeImpuesto field
            //
            $column = new NumberViewColumn('porcentajeImpuesto', 'porcentajeImpuesto', 'Porcentaje Impuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Naturaleza field
            //
            $column = new TextViewColumn('idNaturalezaImpuesto', 'idNaturalezaImpuesto_Naturaleza', 'Id Naturaleza Impuesto', $this->dataset);
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
            
            //
            // View column for codigoCuentaPUC field
            //
            $column = new NumberViewColumn('idPUC', 'idPUC_codigoCuentaPUC', 'Id PUC', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for nombreImpuesto field
            //
            $column = new TextViewColumn('nombreImpuesto', 'nombreImpuesto', 'Nombre Impuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for porcentajeImpuesto field
            //
            $column = new NumberViewColumn('porcentajeImpuesto', 'porcentajeImpuesto', 'Porcentaje Impuesto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Naturaleza field
            //
            $column = new TextViewColumn('idNaturalezaImpuesto', 'idNaturalezaImpuesto_Naturaleza', 'Id Naturaleza Impuesto', $this->dataset);
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
            
            //
            // View column for codigoCuentaPUC field
            //
            $column = new NumberViewColumn('idPUC', 'idPUC_codigoCuentaPUC', 'Id PUC', $this->dataset);
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
            $detailPage = new aju1_impuesto_negserviciosPage('aju1_impuesto_negservicios', $this, array('idimpuesto'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('aju1_impuesto.negservicios'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('aju1_impuesto.negservicios'));
            $detailPage->SetHttpHandlerName('aju1_impuesto_negservicios_handler');
            $handler = new PageHTTPHandler('aju1_impuesto_negservicios_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1naturalezaimpuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Naturaleza', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('Naturaleza', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_aju1_impuesto_idNaturalezaImpuesto_search', 'id', 'Naturaleza', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1cuentaspuc`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('codigoCuentaPUC', true),
                    new StringField('descripcionCuenta', true),
                    new IntegerField('grupo', true),
                    new IntegerField('subcuenta', true),
                    new IntegerField('auxiliar', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('codigoCuentaPUC', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'insert_aju1_impuesto_idPUC_search', 'id', 'codigoCuentaPUC', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1naturalezaimpuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Naturaleza', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('Naturaleza', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_aju1_impuesto_idNaturalezaImpuesto_search', 'id', 'Naturaleza', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1cuentaspuc`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('codigoCuentaPUC', true),
                    new StringField('descripcionCuenta', true),
                    new IntegerField('grupo', true),
                    new IntegerField('subcuenta', true),
                    new IntegerField('auxiliar', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('codigoCuentaPUC', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'filter_builder_aju1_impuesto_idPUC_search', 'id', 'codigoCuentaPUC', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1naturalezaimpuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Naturaleza', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('Naturaleza', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_aju1_impuesto_idNaturalezaImpuesto_search', 'id', 'Naturaleza', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1cuentaspuc`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('codigoCuentaPUC', true),
                    new StringField('descripcionCuenta', true),
                    new IntegerField('grupo', true),
                    new IntegerField('subcuenta', true),
                    new IntegerField('auxiliar', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('codigoCuentaPUC', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'edit_aju1_impuesto_idPUC_search', 'id', 'codigoCuentaPUC', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1naturalezaimpuesto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('Naturaleza', true),
                    new StringField('usuarioRegistra', true),
                    new DateTimeField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('Naturaleza', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_aju1_impuesto_idNaturalezaImpuesto_search', 'id', 'Naturaleza', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`aju1cuentaspuc`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('codigoCuentaPUC', true),
                    new StringField('descripcionCuenta', true),
                    new IntegerField('grupo', true),
                    new IntegerField('subcuenta', true),
                    new IntegerField('auxiliar', true),
                    new IntegerField('idEstado', true),
                    new IntegerField('usuarioRegistra', true),
                    new IntegerField('fechaRegistra', true)
                )
            );
            $lookupDataset->setOrderByField('codigoCuentaPUC', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, 'multi_edit_aju1_impuesto_idPUC_search', 'id', 'codigoCuentaPUC', null, 20);
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
        $Page = new aju1_impuestoPage("aju1_impuesto", "aju1_impuesto.php", GetCurrentUserPermissionsForPage("aju1_impuesto"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("aju1_impuesto"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
