<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tr_po_items extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("
            INSERT INTO p2p.tb_p2p_tr_po_items
            (id, purchase_order, pr_item, product_catalog, qty, uom, price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(2, 7, 3, 2, 2.0, 'Unit', 15000000, 'p2p', 'adrian', '2026-02-01 18:53:52', 'p2p', 'adrian', '2026-02-02 04:08:09');
            INSERT INTO p2p.tb_p2p_tr_po_items
            (id, purchase_order, pr_item, product_catalog, qty, uom, price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(3, 7, 11, 4, 1.0, 'Unit', 5000000, 'p2p', 'adrian', '2026-02-01 18:53:52', 'p2p', 'adrian', '2026-02-02 04:08:09');
            INSERT INTO p2p.tb_p2p_tr_po_items
            (id, purchase_order, pr_item, product_catalog, qty, uom, price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(4, 7, NULL, 3, 15.0, 'pcs', 2500, 'p2p', 'adrian', '2026-02-01 18:54:50', 'p2p', 'adrian', '2026-02-02 04:08:09');
            INSERT INTO p2p.tb_p2p_tr_po_items
            (id, purchase_order, pr_item, product_catalog, qty, uom, price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(5, 8, 17, 8, 1.0, 'Unit', 2200000, 'p2p', 'adrian', '2026-02-02 05:37:43', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_tr_po_items
            (id, purchase_order, pr_item, product_catalog, qty, uom, price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(6, 8, 18, 9, 2.0, 'Unit', 5500000, 'p2p', 'adrian', '2026-02-02 05:37:43', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_tr_po_items
            (id, purchase_order, pr_item, product_catalog, qty, uom, price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(7, 9, 19, 5, 1.0, 'License', 250000, 'p2p', 'adrian', '2026-02-02 05:38:10', NULL, NULL, NULL);
        ");
    }
}
