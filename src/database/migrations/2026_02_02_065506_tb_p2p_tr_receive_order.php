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
            CREATE TABLE `p2p`.`tb_p2p_tr_receive_order` (
            `id` int NOT NULL AUTO_INCREMENT,
            `purchase_order` int DEFAULT NULL,
            `wo_number` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `receipt_date` date DEFAULT NULL,
            `receipt_by` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `delivery_note` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
            `notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `created_date` datetime DEFAULT NULL,
            `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `modified_date` datetime DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `tb_p2p_tr_receive_order_tb_p2p_tr_purchase_order_FK` (`purchase_order`),
            CONSTRAINT `tb_p2p_tr_receive_order_tb_p2p_tr_purchase_order_FK` FOREIGN KEY (`purchase_order`) REFERENCES `tb_p2p_tr_purchase_order` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ");
    }

    public function down(): void {
        // You still need to define how to undo it
        DB::statement("DROP TABLE IF EXISTS p2p.tb_p2p_tr_receive_order");
    }
};
