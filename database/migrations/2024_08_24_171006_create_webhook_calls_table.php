<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('webhook_calls', function (Blueprint $table): void {
            $table->id();
            $table->string('external_id')->nullable()->index();
            $table->string('url')->nullable();
            $table->json('headers')->nullable();
            $table->string('name');
            $table->json('payload')->nullable();
            $table->text('exception')->nullable();
            $table->timestamp('processed_at')->nullable();

            $table->timestamps();
        });
    }
};
