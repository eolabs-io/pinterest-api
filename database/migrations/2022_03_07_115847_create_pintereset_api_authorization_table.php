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
        Schema::create('pinterest_api_authorizations', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->unique();
            $table->string('scope');
            $table->text('refresh_token');
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
        Schema::dropIfExists('pinterest_api_authorizations');
    }
};
