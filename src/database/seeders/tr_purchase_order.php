<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tr_purchase_order extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("
            INSERT INTO p2p.tb_p2p_tr_purchase_order
            (id, purchase_request, po_number, po_date, purchasing_agent, supplier, shipping_address, ship_via, payment_due, sub_total, vat_percent, vat, ship_cost, grand_total, other_cost, note_instruction, status, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(7, 1, 'PO-2026-02-001', '2026-02-02', 'Procurement Dept', 2, 'Jl. Jendral Sudirman No. 1, Jakarta', 'JNE Truck', '2026-02-25', 35037500, 11, 3854125, 150000, 39291625, 250000, 'Handle with care', 13, 'p2p', 'adrian', '2026-02-01 18:53:49', 'p2p', 'adrian', '2026-02-02 04:08:09');
            INSERT INTO p2p.tb_p2p_tr_purchase_order
            (id, purchase_request, po_number, po_date, purchasing_agent, supplier, shipping_address, ship_via, payment_due, sub_total, vat_percent, vat, ship_cost, grand_total, other_cost, note_instruction, status, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(8, 4, 'PO-2026-02-003', '2026-02-02', 'Procurement Dept', 7, 'Kantor', 'JNE Truck', '2026-02-12', 13200000, NULL, 0, NULL, 13200000, NULL, 'Dirakit sekalian di kantor', 13, 'p2p', 'adrian', '2026-02-02 05:37:43', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_tr_purchase_order
            (id, purchase_request, po_number, po_date, purchasing_agent, supplier, shipping_address, ship_via, payment_due, sub_total, vat_percent, vat, ship_cost, grand_total, other_cost, note_instruction, status, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(9, 5, 'PO-2026-02-003', '2026-02-02', 'Procurement Dept', 6, '-', 'License only', '2026-02-02', 250000, NULL, 0, NULL, 250000, NULL, NULL, 13, 'p2p', 'adrian', '2026-02-02 05:38:10', NULL, NULL, NULL);
        ");
    }
}
