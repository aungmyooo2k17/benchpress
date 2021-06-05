<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->integer('price')->default(0);
            $table->string('payment_type')->default('onetime');
            $table->string('billing_period')->default('monthly')->nullable();
            $table->text('description')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->json('dimensions')->nullable();
            $table->json('metadata')->nullable();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->datetime('reserved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
