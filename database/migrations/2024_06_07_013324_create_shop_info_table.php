<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('shop_info', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });

        // Insert initial data directly in the migration
        DB::table('shop_info')->insert([
            [
                'title' => 'Disclaimer',
                'content' => '<p>Debitis dolores earum qui aliquid neque iure at. Deserunt nobis ea reprehenderit. Nobis tempore illum neque tenetur similique consectetur accusantium molestiae sed. Et voluptatem voluptate nobis doloremque consequuntur blanditiis aut quam et. Sed dolor et autem voluptatibus minima et eligendi ducimus.</p>',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'FAQs',
                'content' => '<ul>
                                <li>FAQ Question 1: Answer to question 1</li>
                                <li>FAQ Question 2: Answer to question 2</li>
                                <li>FAQ Question 3: Answer to question 3</li>
                              </ul>',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('shop_info');
    }
};
