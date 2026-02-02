<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class rf_product_catalog extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("
            INSERT INTO p2p.tb_p2p_rf_product_catalog
            (id, code, name, category, default_uom, last_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(1, 'IT-0001', 'Macbook Air M1', 5, 'Unit', 13000000, 'p2p', 'adrian', '2026-02-01 08:38:27', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_product_catalog
            (id, code, name, category, default_uom, last_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(2, 'IT-0002', 'Macbook Pro 13 M1', 5, 'Unit', 15000000, 'p2p', 'adrian', '2026-02-01 08:42:41', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_product_catalog
            (id, code, name, category, default_uom, last_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(3, 'PKG-0001', 'Card Board 10x30x20', 8, 'pcs', 2500, 'p2p', 'adrian', '2026-02-01 08:44:07', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_product_catalog
            (id, code, name, category, default_uom, last_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(4, 'IT-003', 'Dell 24\" Monitor - UltraSharp', 5, 'Unit', 4500000, 'p2p', 'adrian', '2026-02-01 08:46:39', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_product_catalog
            (id, code, name, category, default_uom, last_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(5, 'SW-001', 'Microsoft 365 Business License', 10, 'License', 250000, 'p2p', 'adrian', '2026-02-01 08:48:10', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_product_catalog
            (id, code, name, category, default_uom, last_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(6, 'OF-001', 'A4 Paper 80gsm (Sinar Dunia)', 6, 'Box', 285000, 'p2p', 'adrian', '2026-02-01 08:48:42', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_product_catalog
            (id, code, name, category, default_uom, last_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(7, 'OF-002', 'Standard Ballpoint Pen (Black)', 6, 'Pack', 25000, 'p2p', 'adrian', '2026-02-01 08:49:12', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_product_catalog
            (id, code, name, category, default_uom, last_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(8, 'FN-001', 'Ergonomic Office Chair - Mesh', 11, 'Unit', 2200000, 'p2p', 'adrian', '2026-02-01 08:49:52', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_product_catalog
            (id, code, name, category, default_uom, last_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(9, 'FN-002', 'Standing Desk (Electric)', 11, 'Unit', 5500000, 'p2p', 'adrian', '2026-02-01 08:50:19', 'p2p', 'adrian', '2026-02-01 14:01:35');
            INSERT INTO p2p.tb_p2p_rf_product_catalog
            (id, code, name, category, default_uom, last_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(10, 'SV-001', 'Daily Catering (Lunch Box)', 7, 'Pax', 45000, 'p2p', 'adrian', '2026-02-01 08:50:48', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_product_catalog
            (id, code, name, category, default_uom, last_price, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(11, 'SV-002', 'Express Courier Service (Jabodetabek)', 7, 'Trip', 15000, 'p2p', 'adrian', '2026-02-01 08:51:23', NULL, NULL, NULL);
        ");
    }
}
