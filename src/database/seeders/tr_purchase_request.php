<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tr_purchase_request extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("
            INSERT INTO p2p.tb_p2p_tr_purchase_request
            (id, pr_number, requestor_name, requestor_dept, branch, date_of_request, date_needed, purpose, ship_to, prefered_supplier, status, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(1, '2026/01/31/IT/001', 'Ahmad Rianto', 'IT', 3, '2026-02-01', '2026-02-07', 'For new Software Engineer hire.', 'Jakarta HQ', 2, 2, NULL, NULL, NULL, 'p2p', 'adrian', '2026-02-01 13:56:40');
            INSERT INTO p2p.tb_p2p_tr_purchase_request
            (id, pr_number, requestor_name, requestor_dept, branch, date_of_request, date_needed, purpose, ship_to, prefered_supplier, status, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(2, '2026/01/31/IT/002', 'John Doe', 'FAT', 2, '2026-02-01', '2026-02-14', NULL, NULL, NULL, NULL, 'p2p', 'adrian', '2026-01-31 08:07:30', 'p2p', 'adrian', '2026-02-01 14:00:11');
            INSERT INTO p2p.tb_p2p_tr_purchase_request
            (id, pr_number, requestor_name, requestor_dept, branch, date_of_request, date_needed, purpose, ship_to, prefered_supplier, status, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(3, '2026/01/31/IT/003', 'Amir Kahn', 'Marketing', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'p2p', 'adrian', '2026-01-31 08:10:52', 'p2p', 'adrian', '2026-02-01 14:02:23');
            INSERT INTO p2p.tb_p2p_tr_purchase_request
            (id, pr_number, requestor_name, requestor_dept, branch, date_of_request, date_needed, purpose, ship_to, prefered_supplier, status, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(4, '2026/01/31/IT/004', 'Sarah Wijaya', 'HR', 3, '2026-02-02', '2026-02-02', NULL, 'Jakarta HQ', 7, 2, 'p2p', 'adrian', '2026-01-31 08:11:39', 'p2p', 'adrian', '2026-02-02 05:34:47');
            INSERT INTO p2p.tb_p2p_tr_purchase_request
            (id, pr_number, requestor_name, requestor_dept, branch, date_of_request, date_needed, purpose, ship_to, prefered_supplier, status, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(5, '2026/01/31/IT/005', 'Kevin Leon', 'IT', 2, '2026-02-02', '2026-02-02', 'For new Software Engineer hire.', '-', 6, 2, 'p2p', 'adrian', '2026-01-31 08:31:10', 'p2p', 'adrian', '2026-02-02 05:35:35');
            INSERT INTO p2p.tb_p2p_tr_purchase_request
            (id, pr_number, requestor_name, requestor_dept, branch, date_of_request, date_needed, purpose, ship_to, prefered_supplier, status, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(8, '2026/01/31/IT/006', 'Budi Rahardjo', 'Operations', 3, '2026-02-02', '2026-02-02', 'habis bos', 'Jakarta HQ', 2, 2, 'p2p', 'adrian', '2026-01-31 08:33:36', 'p2p', 'adrian', '2026-02-02 05:36:14');
            INSERT INTO p2p.tb_p2p_tr_purchase_request
            (id, pr_number, requestor_name, requestor_dept, branch, date_of_request, date_needed, purpose, ship_to, prefered_supplier, status, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(20, 'PR/2026/02/001', 'Budi Santoso', 'Information Technology', 3, '2026-02-01', '2026-02-01', NULL, NULL, NULL, 2, 'p2p', 'adrian', '2026-02-01 05:32:40', 'p2p', 'adrian', '2026-02-01 07:49:20');
        ");
    }
}
