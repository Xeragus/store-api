<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryCompanyToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'delivery_company_id')) {
                $table->unsignedBigInteger('delivery_company_id')->nullable();
                $table->index('delivery_company_id');
                $table->foreign('delivery_company_id')
                    ->references('id')->on('companies')
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            if (Schema::hasColumn('companies', 'delivery_company_id')) {
                $table->dropForeign(['delivery_company_id']);
                $table->dropColumn('delivery_company_id');
            }
        });
    }
}
