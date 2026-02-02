<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction\Purchase_request_md;
use App\Models\Transaction\Purchase_order_md;
use App\Models\Transaction\Receive_order_md;
use App\Models\Master\Cabang_md;
use App\Models\Master\Supplier_md;
use App\Models\Master\Product_catalog_md;
use Illuminate\View\View;

class Receive_order extends Controller
{
    
    public function index(): View
    {
        $data = [
            'page' => [
                'title' => 'Receive Order'
            ],
            'table' => [
                'columns' => queryToCol(Receive_order_md::get_query()),
                'data' => Receive_order_md::get_all(),
                'key_cols' => ['id', 'Work Order Number'],
            ],
            'extensions' => ['datatable', 'select2', 'datepicker'],
            'scripts' => [
                'js/transaction/receive_order.js'
            ],
            'modals' => [
                draw_modal(['id'=> 'modal_input', 'size' => 'modal-full', 'buttons' => ['close', 'save']]),
                draw_modal(['id'=> 'modal_lihat', 'size' => 'modal-full', 'buttons' => ['close']]),
            ],
        ];

        $data['content'] = view('transaction/receive_order/table', $data)->render();

        return view('frame/main', $data);
    }

    public function table()
    {
        $table = [
            'columns' => queryToCol(Receive_order_md::get_query()),
            'data' => Receive_order_md::get_all(),
            'key_cols' => ['id', 'Work Order Number'],
            'formatting_cols' => ['Grand Total' => 'money']
        ];

        echo draw_table($table);
    }

    public function view(Request $request): View
    {
        $query = $request->query();

        $data = [
            'data' => Receive_order_md::get_one_formatted($query['id']),
            'table' => Receive_order_md::get_items_formatted($query['id']),
        ];
        
        return view('transaction/purchase_request/view', $data);
    }

    public function form_select_po(Request $request): View
    {
        $query = $request->query();

        $data = [
            'options' => [
                'purchase_order' => get_htmlSelectOptions(Purchase_order_md::get_options()),
            ]
        ];

        if(!empty($query['id'])){
            $data['form_data'] = Receive_order_md::get_one($query['id']);
            $data['purchase_order'] = Purchase_order_md::get_one_formatted($data['form_data']->purchase_order);
        }
        
        return view('transaction/receive_order/form_select_po', $data);
    }
    
    public function form(Request $request): View
    {
        $query = $request->query();

        if(empty($query['purchase_order'])) return false;

        $data = [
            'purchase_order' => Purchase_order_md::get_one_formatted($query['purchase_order']),
            'items' => Receive_order_md::get_items($query['purchase_order'], !empty($query['id']) ? $query['id'] : null),
            'options' => [
                'condition' => get_htmlSelectOptions(Receive_order_md::get_condition_options()),
            ]
        ];

        if(!empty($query['id'])){
            $data['form_data'] = Receive_order_md::get_one($query['id']);
        }
        
        return view('transaction/receive_order/form', $data);
    }

    public function store(Request $request)
    {
        $form_data = $request->all();
        
        $result = Receive_order_md::set_data($form_data);
        echo json_encode($result);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $result = Receive_order_md::set_delete($id);
        echo json_encode($result);
    }
}