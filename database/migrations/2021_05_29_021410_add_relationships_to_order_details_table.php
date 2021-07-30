<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->unsignedInteger('order_id')->change();
            $table->foreign('order_id')->references('id')->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('product_id')->unsigned()->change();
            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign('order_details_order_id_foreign');
            $table->dropIndex('order_details_order_id_foreign');
            $table->integer('order_id')->change();
            $table->dropForeign('order_details_product_id_foreign');
            $table->dropIndex('order_details_product_id_foreign');
            $table->integer('product_id')->change();
        });
    }
}