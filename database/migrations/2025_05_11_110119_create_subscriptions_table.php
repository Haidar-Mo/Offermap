<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('plan_id')->constrained('plans')->cascadeOnDelete();
            $table->decimal('afford_price');
            $table->string('status');
            $table->integer('number_of_remaining_ads');
            $table->date('starts_at');
            $table->date('ends_at');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
