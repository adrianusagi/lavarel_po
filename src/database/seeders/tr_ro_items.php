<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tr_ro_items extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("
            INSERT INTO p2p.tb_p2p_tr_ro_items
            (id, receive_order, po_item, qty, `condition`, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(1, 3, 2, 2, 17, 'p2p', 'adrian', '2026-02-02 05:12:22', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_tr_ro_items
            (id, receive_order, po_item, qty, `condition`, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(2, 3, 3, 1, 17, 'p2p', 'adrian', '2026-02-02 05:12:22', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_tr_ro_items
            (id, receive_order, po_item, qty, `condition`, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(3, 3, 4, 15, 17, 'p2p', 'adrian', '2026-02-02 05:12:22', NULL, NULL, NULL);
        ");
    }
}
