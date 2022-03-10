<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\PinterestApi\Domain\Shared\Migrations\PinterestApiMigration;

return new class extends PinterestApiMigration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinterest_cost_insights', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ad_account_id');
            $table->bigInteger('ad_id');
            $table->bigInteger('campaign_id');
            $table->bigInteger('ad_group_id');
            $table->date('date');
            $table->string('total_clickthrough');
            $table->float('spend')->default(0.0);
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
        Schema::dropIfExists('pinterest_cost_insights');
    }
};
