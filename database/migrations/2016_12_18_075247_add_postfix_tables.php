<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostfixTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_transports', function (Blueprint $table) {
            $table->string('domain')->index();
            $table->string('transport');
            $table->timestamps();
            $table->softDeletes();

            $table->primary('domain');
        });

        Schema::create('virtual_mailboxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('virtual_address');
            $table->integer('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->primary('virtual_address');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('uid')->default(1002);
            $table->integer('gid')->default(1002);
            $table->string('mail_directory')->default('');
        });

        DB::statement('
            CREATE VIEW postfix_mailboxes AS
            SELECT
             virtual_mailboxes.virtual_address AS address,
             users.home||\'/\' AS mailbox
            FROM
             users
             JOIN virtual_mailboxes ON virtual_mailboxes.user_id = users.id
            UNION ALL
             SELECT
              domain AS address,
              \'dummy\' AS mailbox
             FROM
              mail_transports
        ');

        DB::statement('
            CREATE VIEW postfix_virtual AS
            SELECT
             users.email,
             virtual_mailboxes.virtual_address AS address
            FROM
             users
             JOIN virtual_mailboxes ON virtual_mailboxes.user_id = users.id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mail_transports');
        Schema::drop('virtual_mailboxes');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('uid');
            $table->dropColumn('gid');
            $table->dropColumn('mail_directory');
        });

        DB::statement('DROP VIEW postfix_mailboxes');
        DB::statement('DROP VIEW postfix_virtual');
    }
}
