<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("task_statuses", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name");
            $table->timestamps();
        });

        Schema::create("tasks", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name");
            $table->text("description")->nullable();
            $table->bigInteger("status_id")->unsigned();
            $table->bigInteger("created_by_id")->unsigned();
            $table->bigInteger("assigned_to_id")->unsigned()->nullable();
            $table->foreign("status_id")->references("id")->on("task_statuses");
            $table->foreign("created_by_id")->references("id")->on("users")->onDelete("restrict");
            $table->foreign("assigned_to_id")->references("id")->on("users")->onDelete("restrict");
            $table->timestamps();
        });

        Schema::create("labels", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name");
            $table->text("description")->nullable();
            $table->timestamps();
        });

        Schema::create("task_label", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("task_id")->unsigned();
            $table->bigInteger("label_id")->unsigned();
            $table->foreign("task_id")->references("id")->on("tasks")->onDelete("restrict");
            $table->foreign("label_id")->references("id")->on("labels")->onDelete("restrict");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("task_statuses");
        Schema::dropIfExists("tasks");
        Schema::dropIfExists("labels");
        Schema::dropIfExists("task_label");
    }
};
