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
        // Tabel untuk percakapan/conversations
        Schema::create('conversations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable(); // Untuk group chat
            $table->enum('type', ['direct', 'group'])->default('direct');
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();
        });
        // Tabel untuk peserta dalam percakapan
        Schema::create('participants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('conversation_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('last_read_at')->nullable();
            $table->boolean('is_muted')->default(false);
            $table->timestamps();
            
            // Memastikan user hanya bisa menjadi peserta sekali dalam satu percakapan
            $table->unique(['conversation_id', 'user_id']);
        });
        // Tabel untuk pesan
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('conversation_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained()->comment('Pengirim pesan');
            $table->text('content');
            $table->enum('type', ['text', 'image', 'file', 'audio', 'video'])->default('text');
            $table->string('file_path')->nullable(); // Untuk pesan dengan lampiran
            $table->boolean('is_system_message')->default(false); // Untuk pesan sistem
            $table->timestamp('deleted_at')->nullable(); // Soft delete
            $table->timestamps();
        });
        // Tabel untuk status baca pesan
        Schema::create('message_reads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('message_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('read_at');
            $table->timestamps();
            
            // Memastikan satu pesan hanya bisa dibaca sekali oleh satu user
            $table->unique(['message_id', 'user_id']);
        }); 
        // Tabel untuk online status
        Schema::create('user_online_statuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_online')->default(false);
            $table->timestamp('last_active_at')->nullable();
            $table->timestamps();
        });

        // Tabel CCTV
        Schema::create('cameras', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('ip_address');
            $table->integer('port')->default(80);
            $table->string('rtsp_url')->nullable();
            $table->string('http_url')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('location');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->enum('status', ['online', 'offline', 'maintenance'])->default('offline');
            $table->foreignUuid('branch_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
        // Tabel untuk riwayat rekaman CCTV
        Schema::create('camera_recordings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('camera_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->boolean('is_archived')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
        // Tabel untuk catatan akses ke CCTV
        Schema::create('camera_access_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('camera_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('accessed_at');
            $table->string('action');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel percakapan dan relasinya
        Schema::dropIfExists('message_reads');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('participants');
        Schema::dropIfExists('conversations');
        Schema::dropIfExists('user_online_statuses');

        // Menghapus tabel CCTV dan relasinya
        Schema::dropIfExists('camera_access_logs');
        Schema::dropIfExists('camera_recordings');
        Schema::dropIfExists('cameras');
    }
};
