<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number');
            $table->date('invoice_Date');
            $table->date('due_date'); //dernier date pour payer
            $table->string('product'); // facture de quoi ? internet ?
            $table->string('section'); // la classe de facture
            $table->string('discount'); // pourcentage
            $table->string('rate_vat'); // pourcentage 'ration impot'
            $table->decimal('value_vat',8,2); // valeur ration 'impot'
            $table->decimal('Total',8,2); // total 34,365,20
            $table->string('Status', 55); 
            $table->integer('value_status'); // 1:payé, 2:non payé, 3
            $table->text('note')->nullable();
            $table->string('user');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
