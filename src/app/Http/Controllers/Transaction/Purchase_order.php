<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction\Purchase_request_md;
use App\Models\Transaction\Purchase_order_md;
use App\Models\Master\Cabang_md;
use App\Models\Master\Supplier_md;
use App\Models\Master\Product_catalog_md;
use Illuminate\View\View;

class Purchase_order extends Controller
{
    
    public function index(): View
    {
        $data = [
            'page' => [
                'title' => 'Purchase Order'
            ],
            'table' => [
                'columns' => queryToCol(Purchase_order_md::get_query()),
                'data' => Purchase_order_md::get_all(),
                'key_cols' => ['id', 'PO Number'],
                'formatting_cols' => ['Grand Total' => 'money']
            ],
            'extensions' => ['datatable', 'select2', 'datepicker'],
            'scripts' => [
                'js/transaction/purchase_order.js'
            ],
            'modals' => [
                draw_modal(['id'=> 'modal_input', 'size' => 'modal-full', 'buttons' => ['close', 'save']]),
                draw_modal(['id'=> 'modal_lihat', 'size' => 'modal-full', 'buttons' => ['close']])
            ],
        ];

        $data['content'] = view('transaction/purchase_order/table', $data)->render();

        return view('frame/main', $data);
    }

    public function table()
    {
        $table = [
            'columns' => queryToCol(Purchase_order_md::get_query()),
            'data' => Purchase_order_md::get_all(),
            'key_cols' => ['id', 'PO Number'],
            'formatting_cols' => ['Grand Total' => 'money']
        ];

        echo draw_table($table);
    }

    public function view(Request $request): View
    {
        $query = $request->query();

        $data = [
            'raw' => Purchase_order_md::get_one($query['id']),
            'data' => Purchase_order_md::get_one_formatted($query['id']),
            'table' => Purchase_order_md::get_items_formatted($query['id']),
        ];
        
        return view('transaction/purchase_order/view', $data);
    }

    public function form_select_pr(Request $request): View
    {
        $query = $request->query();

        $data = [
            'options' => [
                'purchase_request' => get_htmlSelectOptions(Purchase_request_md::get_options()),
            ]
        ];

        if(!empty($query['id'])){
            $data['form_data'] = Purchase_order_md::get_one($query['id']);
            $data['purchase_request'] = Purchase_request_md::get_one_formatted($data['form_data']->purchase_request);
        }
        
        return view('transaction/purchase_order/form_select_pr', $data);
    }
    
    public function form(Request $request): View
    {
        $query = $request->query();

        if(empty($query['purchase_request'])) return false;

        $data = [
            'purchase_request' => Purchase_request_md::get_one_formatted($query['purchase_request']),
            'items' => Purchase_request_md::get_items($query['purchase_request']),
            'options' => [
                'supplier' => get_htmlSelectOptions(Supplier_md::get_options()),
                'status' => get_htmlSelectOptions(Purchase_order_md::get_status_options()),
                'product_catalog' => get_htmlSelectOptions(Product_catalog_md::get_options()),
            ]
        ];

        if(!empty($query['id'])){
            $data['form_data'] = Purchase_order_md::get_one($query['id']);
            $data['items'] = Purchase_order_md::get_items($query['id']);
        }
        
        return view('transaction/purchase_order/form', $data);
    }

    public function store(Request $request)
    {
        $form_data = $request->all();
        
        $result = Purchase_order_md::set_data($form_data);
        echo json_encode($result);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $result = Purchase_order_md::set_delete($id);
        echo json_encode($result);
    }
}