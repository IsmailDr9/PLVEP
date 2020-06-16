<?php

namespace App\DataTables;

use App\Model\Size;
use App\User;
use App\Model\Mall;
use App\helper\Useful;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Services\DataTable;

class SizeDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('edit', 'admin.sizes.btn.edit')
            ->addColumn('delete', 'admin.sizes.btn.delete')
            ->addColumn('checkbox', 'admin.sizes.btn.checkbox')
            ->rawColumns([
                'edit',
                'delete',
                'checkbox',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param User
     * @return
     */
    public function query()
    {
        return Size::query()->with('department');
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [[50, 25, 10, 100, -1], [50, 25, 10, 'All Record']],
                'buttons' => [
                    ['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file"></i> Export CSV'],
                    ['extend' => 'excel', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-file"></i> Export EXCEL'],
                    [
                        'text' => '<i class="fa fa-plus"></i>Create',
                        'className' => 'btn btn-info', "action" =>"function(){
                            window.location.href = '".URL::current()."/create'
                        }"],
                    [
                        'text' => '<i class="fa fa-trash"></i>Delete All',
                        'className' => 'btn btn-danger delBt'
                    ],

                    ['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fa fa-refresh"></i>'],
                ],

                'initComplete' => "function () {
                        this.api().columns([2,3]).every(function () {
                            var column = this;
                            var input = document.createElement(\"input\");
                            $(input).appendTo($(column.footer()).empty())
                            .on('keyup', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                        });
                    }",
                'language' => Useful::lang(),
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => 'checkbox',
                'data' => 'checkbox',
                'title' => '<input type="checkbox" class="check_all" onclick="check_all()"/>',
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ],[
                'name' => 'id',
                'data' => 'id',
                'title' => '#',
            ], [
                'name' => 'name_ar',
                'data' => 'name_ar',
                'title' => 'Name Ar',
            ], [
                'name' => 'name_en',
                'data' => 'name_en',
                'title' => 'Name En',
            ], [
                'name' => 'department.dep_name_'.session('lang'),
                'data' => 'department.dep_name_'.session('lang'),
                'title' => 'Department',
            ], [
                'name' => 'is_public',
                'data' => 'is_public',
                'title' => 'Is Public',
            ],[
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => 'Created At',
            ], [
                'name' => 'updated_at',
                'data' => 'updated_at',
                'title' => 'Updated At',
            ], [
                'name' => 'edit',
                'data' => 'edit',
                'title' => 'Edit',
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ], [
                'name' => 'delete',
                'data' => 'delete',
                'title' => 'Delete',
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'sizes_' . date('YmdHis');
    }
}
