<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tr_pr_items extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(3, 1, NULL, 'Macbook pro 14', 2.0, 'pcs', 25000000, 'p2p', 'adrian', '2026-02-01 04:26:34', 'p2p', 'adrian', '2026-02-01 13:56:40');
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(5, 1, NULL, 'iphone 14', 1.0, 'pcs', 8000000, 'p2p', 'adrian', '2026-02-01 05:25:03', 'p2p', 'adrian', '2026-02-01 13:56:40');
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(7, 20, NULL, 'MacBook Air M2 13', 1.0, 'unit', 15000000, 'p2p', 'adrian', '2026-02-01 05:32:40', 'p2p', 'adrian', '2026-02-01 07:49:20');
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(8, 20, NULL, 'Magic Mouse 2', 2.0, 'pcs', 1250000, 'p2p', 'adrian', '2026-02-01 05:32:40', 'p2p', 'adrian', '2026-02-01 07:49:20');
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(9, 20, NULL, 'USB-C Hub Adapter', 4.0, 'pcs', 350000, 'p2p', 'adrian', '2026-02-01 05:32:40', 'p2p', 'adrian', '2026-02-01 07:49:20');
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(10, 8, 6, NULL, 5.0, 'lusin', 20000, 'p2p', 'adrian', '2026-02-01 07:32:46', 'p2p', 'adrian', '2026-02-02 05:36:14');
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(11, 1, 4, NULL, 1.0, 'Unit', 4500000, 'p2p', 'adrian', '2026-02-01 13:56:40', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(14, 2, 8, NULL, 1.0, 'Unit', 2200000, 'p2p', 'adrian', '2026-02-01 14:00:11', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(15, 2, 9, NULL, 1.0, 'Standing Desk (Electric)', 5500000, 'p2p', 'adrian', '2026-02-01 14:00:11', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(16, 3, 10, NULL, 20.0, 'Pax', 45000, 'p2p', 'adrian', '2026-02-01 14:02:23', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(17, 4, 8, NULL, 1.0, 'Unit', 2200000, 'p2p', 'adrian', '2026-02-02 05:34:47', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(18, 4, 9, NULL, 2.0, 'Unit', 5500000, 'p2p', 'adrian', '2026-02-02 05:34:47', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_tr_pr_items
            (id, purchase_request, product_catalog, item, qty, uom, est_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(19, 5, 5, NULL, 1.0, 'License', 250000, 'p2p', 'adrian', '2026-02-02 05:35:35', NULL, NULL, NULL);
        ");
    }
}
