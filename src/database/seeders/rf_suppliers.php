<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class rf_suppliers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("
            INSERT INTO p2p.tb_p2p_rf_suppliers
            (id, name, code, tax_id, category, payment_terms, contact_person, email, phone, office_address, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(2, 'CV. Alat Tulis Makmur', 'VEND-002', NULL, 'Office Supplies', 'COD', 'Ani Wijaya', 'orders@atkmakmur.com', '+62 31 888 4321', 'Jl. Raya Manyar No. 45, Surabaya', 'p2p', 'adrian', '2026-01-31 20:32:50', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_suppliers
            (id, name, code, tax_id, category, payment_terms, contact_person, email, phone, office_address, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(3, 'PT. Katering Sejahtera', 'VEND-003', NULL, 'F&B / Services', 'Net 15', 'Siti Aminah', 'info@kateringsejahtera.id', '+62 21 777 9900', 'Kawasan Industri Pulogadung Block C, Jakarta Timur', 'p2p', 'adrian', '2026-01-31 20:34:23', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_suppliers
            (id, name, code, tax_id, category, payment_terms, contact_person, email, phone, office_address, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(6, 'PT. Global Teknologi Solusi', 'VEND-001', NULL, 'IT Hardware	sale', 'Net 7', NULL, 'sales@globaltek.co.id', NULL, NULL, 'p2p', 'adrian', '2026-02-02 05:32:08', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_suppliers
            (id, name, code, tax_id, category, payment_terms, contact_person, email, phone, office_address, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(7, 'Surya Furniture & Interior', 'VEND-004', NULL, 'Furniture', 'Net 30', 'marketing@surya-furni.com', NULL, NULL, NULL, 'p2p', 'adrian', '2026-02-02 05:32:46', 'p2p', 'adrian', '2026-02-02 05:32:57');
            INSERT INTO p2p.tb_p2p_rf_suppliers
            (id, name, code, tax_id, category, payment_terms, contact_person, email, phone, office_address, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(8, 'PT. Logistik Cepat Indonesia', 'VEND-005', NULL, 'Courier/Logistics', 'Net 7', NULL, 'cs@logistikcepat.id', NULL, NULL, 'p2p', 'adrian', '2026-02-02 05:33:27', NULL, NULL, NULL);
        ");
    }
}
