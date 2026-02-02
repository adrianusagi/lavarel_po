<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tr_receive_order extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("
            INSERT INTO p2p.tb_p2p_tr_receive_order
            (id, purchase_order, wo_number, receipt_date, receipt_by, delivery_note, notes, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(3, 7, 'GR-2026-02-12', '2026-02-02', 'Aris Munandar (Warehouse Team)', 'SJ-GTS-9981', NULL, 'p2p', 'adrian', '2026-02-02 05:12:22', NULL, NULL, NULL);
        ");
    }
}
