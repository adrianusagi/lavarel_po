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
            CREATE TABLE `p2p`.`tb_p2p_tr_purchase_order` (
            `id` int NOT NULL AUTO_INCREMENT,
            `purchase_request` int DEFAULT NULL,
            `po_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `po_date` date DEFAULT NULL,
            `purchasing_agent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `supplier` int DEFAULT NULL,
            `shipping_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `ship_via` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `payment_due` date DEFAULT NULL,
            `sub_total` int DEFAULT NULL,
            `vat_percent` int DEFAULT NULL,
            `vat` int DEFAULT NULL,
            `ship_cost` int DEFAULT NULL,
            `grand_total` int DEFAULT NULL,
            `other_cost` int DEFAULT NULL,
            `note_instruction` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `status` int DEFAULT NULL,
            `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `created_date` datetime DEFAULT NULL,
            `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `modified_date` datetime DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `tb_p2p_tr_purchase_order_tb_p2p_tr_purchase_request_FK` (`purchase_request`),
            KEY `tb_p2p_tr_purchase_order_tb_p2p_rf_suppliers_FK` (`supplier`),
            KEY `tb_p2p_tr_purchase_order_tb_p2p_rf_options_FK` (`status`),
            CONSTRAINT `tb_p2p_tr_purchase_order_tb_p2p_rf_options_FK` FOREIGN KEY (`status`) REFERENCES `tb_p2p_rf_options` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
            CONSTRAINT `tb_p2p_tr_purchase_order_tb_p2p_rf_suppliers_FK` FOREIGN KEY (`supplier`) REFERENCES `tb_p2p_rf_suppliers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
            CONSTRAINT `tb_p2p_tr_purchase_order_tb_p2p_tr_purchase_request_FK` FOREIGN KEY (`purchase_request`) REFERENCES `tb_p2p_tr_purchase_request` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ");
    }

    public function down(): void {
        // You still need to define how to undo it
        DB::statement("DROP TABLE IF EXISTS p2p.tb_p2p_tr_purchase_order");
    }
};
