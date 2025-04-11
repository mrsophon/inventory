<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('item_desc')->nullable()->after('quantity');
            $table->string('dimension')->nullable()->after('item_desc');
            $table->text('stn_desc')->nullable()->after('dimension');
            $table->text('item_set')->nullable()->after('stn_desc');
            $table->integer('brand_id')->nullable()->after('item_set');
            $table->integer('type_id')->nullable()->after('brand_id');
            $table->double('cost')->default('0')->after('type_id');
            $table->double('price')->default('0')->after('cost');
            $table->double('price_baht')->default('0')->after('price');
            $table->string('price_range')->nullable()->after('price_baht');
            $table->integer('vattype_id')->nullable()->after('price_range');
            $table->double('metal_wgt')->default('0')->after('vattype_id');
            $table->double('gold_wgt')->default('0')->after('metal_wgt');
            $table->double('net_wgt')->default('0')->after('gold_wgt');
            $table->date('date')->nullable()->after('net_wgt');
            $table->text('note')->nullable()->after('date');
            $table->string('product_image')->nullable()->after('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
