<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class rf_cabang extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("
            INSERT INTO p2p.tb_p2p_rf_cabang
            (id, name, address, phone, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(1, 'Surabaya', '570-9196 Torquent Road, Surabaya', '1-823-762-4132', 'p2p', 'adrian', '2026-01-31 14:43:09', 'p2p', 'adrian', '2026-01-31 14:45:15');
            INSERT INTO p2p.tb_p2p_rf_cabang
            (id, name, address, phone, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(2, 'Malang', 'Ap #774-4951 In Road', '1-734-925-8528', 'p2p', 'adrian', '2026-01-31 14:44:39', NULL, NULL, NULL);
            INSERT INTO p2p.tb_p2p_rf_cabang
            (id, name, address, phone, created_app, created_by, created_date, modified_app, modified_by, modified_date)
            VALUES(3, 'Jakarta', '548-4582 Amet Road', '1-354-267-3074', 'p2p', 'adrian', '2026-01-31 14:45:03', NULL, NULL, NULL);
        ");
    }
}
