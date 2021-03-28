<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('call_id')->unique();
            $table->unsignedBigInteger('site_id');
            $table->integer('col_id')->nullable();
            $table->integer('crm_client_id')->nullable();
            $table->string('date');
            $table->integer('channel_id')->nullable();
            $table->boolean('is_lid');
            $table->string('email')->nullable();
            $table->string('region')->nullable();
            $table->string('name_type')->nullable();
            $table->string('traffic_type')->nullable();
            $table->string('landing_page')->nullable();
            $table->string('lid_landing')->nullable();
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_content')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('link_download')->nullable();
            $table->integer('conversation_number')->nullable();
            $table->integer('duration');
            $table->integer('billsec');
            $table->string('responsible_manager');
            $table->string('name')->nullable();
            $table->string('phone');
            $table->string('status')->nullable();
            $table->string('call_status')->nullable();
            $table->boolean('accurately')->nullable();
            $table->integer('ym_uid')->nullable();
            $table->string('comment')->nullable();
            $table->string('query')->nullable();
            $table->integer('conversations_number')->nullable();
            $table->string('source')->nullable();

            $table->foreign('site_id')->references('id')->on('sites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
}
