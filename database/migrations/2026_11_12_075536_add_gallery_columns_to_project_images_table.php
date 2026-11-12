<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_images', function (Blueprint $table) {
            $table->foreignId('project_id')
                  ->after('id')
                  ->constrained('projects')
                  ->cascadeOnDelete();

            $table->string('image')->after('project_id');

            $table->string('caption')->nullable()->after('image');

            $table->unsignedInteger('sort_order')
                  ->default(0)
                  ->after('caption');
        });
    }

    public function down(): void
    {
        Schema::table('project_images', function (Blueprint $table) {
            $table->dropForeign(['project_id']);

            $table->dropColumn([
                'project_id',
                'image',
                'caption',
                'sort_order',
            ]);
        });
    }
};
