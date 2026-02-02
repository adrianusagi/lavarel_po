<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Supplier_md;
use Illuminate\View\View;

class Supplier extends Controller
{
    
    public function index(): View
    {
        $data = [
            'page' => [
                'title' => 'Suppliers'
            ],
            'table' => [
                'columns' => queryToCol(Supplier_md::get_query()),
                'data' => Supplier_md::get_all(),
                'key_cols' => ['id', 'Name']
            ],
            'extensions' => ['datatable', 'select2'],
            'scripts' => [
                'js/master/supplier.js'
            ],
            'modals' => [
                draw_modal(['id'=> 'modal_input', 'size' => 'modal-xl', 'buttons' => ['close', 'save']]),
                draw_modal(['id'=> 'modal_lihat', 'size' => 'modal-lg', 'buttons' => ['close']])
            ],
        ];

        $data['content'] = view('master/supplier/table', $data)->render();

        return view('frame/main', $data);
    }

    public function table()
    {
        $table = [
            'columns' => queryToCol(Supplier_md::get_query()),
            'data' => Supplier_md::get_all(),
            'key_cols' => ['id', 'Name']
        ];

        echo draw_table($table);
    }

    public function view(Request $request): View
    {
        $query = $request->query();

        $data = [
            'data' => Supplier_md::get_one_formatted($query['id']),
        ];
        
        return view('master/cabang/view', $data);
    }


    public function form(Request $request): View
    {
        $query = $request->query();

        $data = [];

        if(!empty($query['id'])){
            $data['form_data'] = Supplier_md::get_one($query['id']);
        }
        
        return view('master/supplier/form', $data);
    }

    public function store(Request $request)
    {
        $form_data = $request->all();
        
        $result = Supplier_md::set_data($form_data);
        echo json_encode($result);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $result = Supplier_md::set_delete($id);
        echo json_encode($result);
    }
}