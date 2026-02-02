<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        // Option A: Running a single raw statement
        DB::statement("
            CREATE TABLE `p2p`.`tb_p2p_tr_purchase_request` (
            `id` int NOT NULL AUTO_INCREMENT,
            `pr_number` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `requestor_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `requestor_dept` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `branch` int DEFAULT NULL,
            `date_of_request` date DEFAULT NULL,
            `date_needed` date DEFAULT NULL,
            `purpose` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `ship_to` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `prefered_supplier` int DEFAULT NULL,
            `status` int DEFAULT NULL,
            `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `created_date` datetime DEFAULT NULL,
            `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `modified_date` datetime DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `tb_p2p_tr_purchase_request_tb_p2p_rf_cabang_FK` (`branch`),
            KEY `tb_p2p_tr_purchase_request_tb_p2p_rf_suppliers_FK` (`prefered_supplier`),
            KEY `tb_p2p_tr_purchase_request_tb_p2p_tr_rf_options_FK` (`status`),
            CONSTRAINT `tb_p2p_tr_purchase_request_tb_p2p_rf_cabang_FK` FOREIGN KEY (`branch`) REFERENCES `tb_p2p_rf_cabang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
            CONSTRAINT `tb_p2p_tr_purchase_request_tb_p2p_rf_suppliers_FK` FOREIGN KEY (`prefered_supplier`) REFERENCES `tb_p2p_rf_suppliers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
            CONSTRAINT `tb_p2p_tr_purchase_request_tb_p2p_tr_rf_options_FK` FOREIGN KEY (`status`) REFERENCES `tb_p2p_rf_options` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ");
    }

    public function down(): void {
        // You still need to define how to undo it
        DB::statement("DROP TABLE IF EXISTS p2p.tb_p2p_tr_purchase_request");
    }
};
