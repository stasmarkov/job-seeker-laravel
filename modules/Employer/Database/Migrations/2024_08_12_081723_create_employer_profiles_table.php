<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Auth\Models\User;

return new class extends Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('employer_profiles', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(User::class);
      $table->string('name');
      $table->string('logo');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('employer_profiles');
  }

};
