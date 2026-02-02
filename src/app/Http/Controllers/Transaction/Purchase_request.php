<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction\Purchase_request_md;
use App\Models\Master\Cabang_md;
use App\Models\Master\Supplier_md;
use App\Models\Master\Product_catalog_md;
use Illuminate\View\View;

class Purchase_request extends Controller
{
    
    public function index(): View
    {
        $data = [
            'page' => [
                'title' => 'Purchase Request'
            ],
            'table' => [
                'columns' => queryToCol(Purchase_request_md::get_query()),
                'data' => Purchase_request_md::get_all(),
                'key_cols' => ['id', 'PR Number'],
                'formatting_cols' => ['Estimated Budget' => 'money']
            ],
            'extensions' => ['datatable', 'select2', 'datepicker'],
            'scripts' => [
                'js/transaction/purchase_request.js'
            ],
            'modals' => [
                draw_modal(['id'=> 'modal_input', 'size' => 'modal-full', 'buttons' => ['close', 'save']]),
                draw_modal(['id'=> 'modal_lihat', 'size' => 'modal-full', 'buttons' => ['close']])
            ],
        ];

        $data['content'] = view('transaction/purchase_request/table', $data)->render();

        return view('frame/main', $data);
    }

    public function table()
    {
        $table = [
            'columns' => queryToCol(Purchase_request_md::get_query()),
            'data' => Purchase_request_md::get_all(),
            'key_cols' => ['id', 'PR Number'],
            'formatting_cols' => ['Estimated Budget' => 'money']
        ];

        echo draw_table($table);
    }

    public function view(Request $request): View
    {
        $query = $request->query();

        $data = [
            'data' => Purchase_request_md::get_one_formatted($query['id']),
            'table' => Purchase_request_md::get_items_formatted($query['id']),
        ];
        
        return view('transaction/purchase_request/view', $data);
    }

    public function form(Request $request): View
    {
        $query = $request->query();

        $data = [
            'options' => [
                'branch' => get_htmlSelectOptions(Cabang_md::get_options()),
                'supplier' => get_htmlSelectOptions(Supplier_md::get_options()),
                'status' => get_htmlSelectOptions(Purchase_request_md::get_status_options()),
                'product_catalog' => get_htmlSelectOptions(Product_catalog_md::get_options()),
            ]
        ];

        if(!empty($query['id'])){
            $data['form_data'] = Purchase_request_md::get_one($query['id']);
            $data['items'] = Purchase_request_md::get_items($query['id']);
        }
        
        return view('transaction/purchase_request/form', $data);
    }

    public function store(Request $request)
    {
        $form_data = $request->all();
        
        $result = Purchase_request_md::set_data($form_data);
        echo json_encode($result);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $result = Purchase_request_md::set_delete($id);
        echo json_encode($result);
    }
}