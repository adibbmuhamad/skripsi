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
        Schema::table('health_reports', function (Blueprint $table) {
            $table->date('report_date')->nullable()->after('student_id');
            $table->string('health_status')->after('report');
            $table->text('symptoms')->nullable()->after('health_status');
            $table->text('doctors_notes')->nullable()->after('symptoms');
            $table->string('attachments')->nullable()->after('doctors_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('health_reports', function (Blueprint $table) {
            $table->dropColumn('report_date');
            $table->dropColumn('health_status');
            $table->dropColumn('symptoms');
            $table->dropColumn('doctors_notes');
            $table->dropColumn('attachments');
        });
    }
};
