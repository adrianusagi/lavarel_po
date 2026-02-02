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
            CREATE TABLE `p2p`.`tb_p2p_tr_po_items` (
            `id` int NOT NULL AUTO_INCREMENT,
            `purchase_order` int DEFAULT NULL,
            `pr_item` int DEFAULT NULL,
            `product_catalog` int DEFAULT NULL,
            `qty` float DEFAULT NULL,
            `uom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `price` int DEFAULT NULL,
            `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `created_date` datetime DEFAULT NULL,
            `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
            `modified_date` datetime DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `tb_p2p_tr_po_items_tb_p2p_tr_purchase_order_FK` (`purchase_order`),
            KEY `tb_p2p_tr_po_items_tb_p2p_rf_product_catalog_FK` (`product_catalog`),
            KEY `tb_p2p_tr_po_items_tb_p2p_tr_[r_items_FK` (`pr_item`),
            CONSTRAINT `tb_p2p_tr_po_items_tb_p2p_rf_product_catalog_FK` FOREIGN KEY (`product_catalog`) REFERENCES `tb_p2p_rf_product_catalog` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
            CONSTRAINT `tb_p2p_tr_po_items_tb_p2p_tr_[r_items_FK` FOREIGN KEY (`pr_item`) REFERENCES `tb_p2p_tr_pr_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            CONSTRAINT `tb_p2p_tr_po_items_tb_p2p_tr_purchase_order_FK` FOREIGN KEY (`purchase_order`) REFERENCES `tb_p2p_tr_purchase_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ");
    }

    public function down(): void {
        // You still need to define how to undo it
        DB::statement("DROP TABLE IF EXISTS p2p.tb_p2p_tr_po_items");
    }
};
