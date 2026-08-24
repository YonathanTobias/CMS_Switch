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
        // 1. Settings Table (For Division Identity & Branding)
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        // 2. Categories Table
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type')->default('post'); // post, document
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 3. Posts Table (News & Announcements)
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('type', ['berita', 'pengumuman'])->default('berita');
            $table->text('summary')->nullable();
            $table->longText('content');
            $table->string('thumbnail')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->dateTime('published_at')->nullable();
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamps();
        });

        // 4. Events / Agenda Table
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('location')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->text('description')->nullable();
            $table->string('poster')->nullable();
            $table->string('registration_link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 5. Services Table (Layanan Divisi)
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon')->default('fas fa-concierge-bell');
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->longText('requirements')->nullable();
            $table->longText('procedure')->nullable();
            $table->string('download_form_link')->nullable();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 6. Team Members / Struktur Organisasi Table
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title_degree')->nullable();
            $table->string('identifier')->nullable(); // NIP / NIDN
            $table->string('position'); // Jabatan (e.g. Kepala Divisi, Staf Administrasi)
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        // 7. Documents / Download Center Table
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('file_path');
            $table->string('file_type')->nullable(); // pdf, docx, xlsx, etc.
            $table->string('file_size')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('downloads_count')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // 8. Galleries Table
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('Kegiatan');
            $table->string('image_path');
            $table->text('caption')->nullable();
            $table->timestamps();
        });

        // 9. Custom Dynamic Pages Table
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('banner_image')->nullable();
            $table->boolean('is_published')->default(true);
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        // 10. Messages / Contact Inbox Table
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('services');
        Schema::dropIfExists('events');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('settings');
    }
};
