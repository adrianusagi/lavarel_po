<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class rf_options extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(1, 'pr_status', 'Waiting', 100.0, '[default-if-null]', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(2, 'pr_status', 'Approved', 200.0, '[allow_po]', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(3, 'pr_status', 'Rejected', 300.0, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(4, 'pr_status', 'Completed', 400.0, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(5, 'product_category', 'IT', NULL, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(6, 'product_category', 'Stationery', NULL, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(7, 'product_category', 'Services', NULL, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(8, 'product_category', 'Packaging', NULL, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(9, 'product_category', 'Raw Material', NULL, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(10, 'product_category', 'Software', NULL, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(11, 'product_category', 'Furniture', NULL, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(12, 'po_status', 'Draft', 100.0, '[default-if-null]', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(13, 'po_status', 'Sent', 200.0, '[allow_po]', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(14, 'po_status', 'Partially Received', 300.0, '[allow_po]', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(15, 'po_status', 'Fulfilled', 400.0, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(16, 'po_status', 'Canceled', 500.0, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(17, 'receive_condition', 'Good', 100.0, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(18, 'receive_condition', 'Damaged', 200.0, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_options
            (id, category, label, `ordering`, tags, configs, is_active, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(19, 'receive_condition', 'Shortage', 300.0, NULL, NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL);
        ");
    }
}
