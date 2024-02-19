<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatingTableRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('nameEs')->nullable();
            $table->string('photo')->nullable();
            $table->string('categorie')->nullable();
            $table->text('instructions')->nullable();
            $table->text('instructionsEs')->nullable();
            $table->integer('delete')->default(0);
            $table->integer('preparation_time')->nullable();
            $table->integer('cook_time')->nullable();
            $table->integer('calories')->default(0);
            $table->integer('fat')->default(0);
            $table->integer('carbs')->default(0);
            $table->integer('protein')->default(0);
            $table->integer('planID')->nullable();
            $table->text('ingredients')->nullable();
            $table->text('ingredientsEs')->nullable();
            $table->integer('create_id');
            $table->integer('update_id');
            $table->integer('delete_id');
        });

        $recipes = array(
            array('id' => '1','name' => 'Tostadas de yogur y plátano','photo' => 'https://cdn.britannica.com/36/123536-050-95CB0C6E/Variety-fruits-vegetables.jpg','instructions' => '1. Extiende el yogur encima de las rebanadas de pan y cubre con las rodajas de plátano.&nbsp;<div>2. Espolvorea canela por encima y sirve.</div>','delete' => '0','create_id' => '3254327','delete_id' => '3255606','update_id' => '3254329','preparation_time' => NULL,'cook_time'=>'5','calories'=>'100','fat'=>'400','carbs'=>'50','categorie'=>'breakfast','ingredients'=>NULL),
            array('id' => '2','name' => 'Batido proteico de almendras y moca','photo' => 'https://dc693.4shared.com/img/771ZMcQOjq/s24/184877ef7e0/food?async&rand=0.33972955884403233.jpg','instructions' => '1. Pela el plátano.<div>2. Coloca todos ingredientes (la menta, plátano, leche de almendras, mantequilla de almendras, proteína en polvo) en el vaso de la batidora y bate hasta obtener una textura suave.</div><div>3. Disfrútalo de inmediato o para llevar.</div>','delete' => '0','create_id' => '3254377','delete_id' => '3254377','update_id' => '3829029','preparation_time' => '8','cook_time'=>'5','calories'=>'100','fat'=>'400','carbs'=>'50','categorie'=>'breakfast','ingredients'=>NULL),
            array('id' => '3','name' => 'Muffin de almendras','photo' => 'https://dc693.4shared.com/img/771ZMcQOjq/s24/184877ef7e0/food?async&rand=0.33972955884403233.jpg','instructions' => '1. Coloca todos los ingredientes secos en una taza. Remueve para mezclarlos bien.<div>2. Tritura el plátano con un tenedor y mezcla bien con los huevos. Incorpora el resto de los ingredientes secos y remueve hasta que la mezcla quede homogénea.&nbsp;</div><div>3. Continua con el paso 4 si no tienes microondas. En caso contrario: cocina en microondas a máxima potencia durante 2 minutos. Si tras los 2 minutos todavía no esta hecha, cocinar durante 1-2 minutos mas. Utiliza un cuchillo si es necesario para extraer el muffin de la taza. Sirve y distruta!</div><div>4. Si no tienes microondas: Precalienta el horno a 180 C (350 F<span style="color: inherit; font-family: inherit;">). Vierte mezcla en un molde para pastel o muffins. Hornea de 25 a 30 minutos. Si crees que el pastel ya esta listo, clava un palillo o cuchillo y comprueba si sale limpio. Sirve y disfruta!</span></div><div><div><br></div></div>','delete' => '0','create_id' => '3254753','delete_id' => '3254753','update_id' => '3572761','preparation_time' => NULL,'cook_time'=>'5','calories'=>'100','fat'=>'400','carbs'=>'50','categorie'=>'breakfast','ingredients'=>NULL),
            array('id' => '4','name' => 'Tostada de Palta(aguacate) y jamón','photo' => 'https://dc693.4shared.com/img/771ZMcQOjq/s24/184877ef7e0/food?async&rand=0.33972955884403233.jpg','instructions' => '1. Corta el pan en rebanadas.<div>2. Aplasta la palta (aguacate) con un tenedor y salpimienta.</div><div>3. Extiende la palta (aguacate) sobre el pan.</div><div>4. Limpia el tomate(también se puede reemplazar por pepino)<span style="color: inherit; font-family: inherit;">&nbsp;y córtalo en rodajas.</span></div><div>5. Anade las rodajas de tomate y jamón al pan con aguacate.</div>','delete' => '0','create_id' => '3254834','delete_id' => '3254834','update_id' => '3572349','preparation_time' => NULL,'cook_time'=>'5','calories'=>'100','fat'=>'400','carbs'=>'50','categorie'=>'breakfast','ingredients'=>NULL),
            array('id' => '5','name' => 'Sándwich de Palta (aguacate) pepino y pollo','photo' => 'https://dc693.4shared.com/img/771ZMcQOjq/s24/184877ef7e0/food?async&rand=0.33972955884403233.jpg','instructions' => '1. Lava el pepino y córtalo a tiras finas.<div>2. Corta la palta (aguacate) por la mitad, descarta el hueso y retira la pulpa con una cuchara.</div><div>3. Extiende el aguacate sobre el pan. Anade el pollo y el pepino (si te sobra, puedes servirlo como acompañamiento). Espolvorea con pimienta y disfruta!</div>','delete' => '0','create_id' => '3255122','delete_id' => '3255122','update_id' => '3572360','preparation_time' => NULL,'cook_time'=>'5','calories'=>'100','fat'=>'400','carbs'=>'50','plan'=>'Vegetarian Plan','categorie'=>'breakfast','ingredients'=>NULL),
            array('id' => '6','name' => 'Sandwich de Palta (aguacate) pepino y jamon','photo' => 'https://dc693.4shared.com/img/771ZMcQOjq/s24/184877ef7e0/food?async&rand=0.33972955884403233.jpg','instructions' => '1. Lava el pepino y córtalo a rodajas finas.<div>2. Pela el aguacate, descarta el hueso. En un bol, tritura el aguacate con zumo de limón, sal y pimienta al gusto.</div><div>3. Extiende el aguacate sobre el pan. Cubre con el pepino y jamón, disfruta!</div>','delete' => '0','create_id' => '3255367','delete_id' => '3255367','update_id' => '3572363','preparation_time' => NULL,'cook_time'=>'5','calories'=>'100','fat'=>'400','carbs'=>'50','categorie'=>'breakfast','ingredients'=>NULL),
            array('id' => '7','name' => 'Tortilla con huevo y palta(aguacate)','photo' => 'https://dc693.4shared.com/img/771ZMcQOjq/s24/184877ef7e0/food?async&rand=0.33972955884403233.jpg','instructions' => '1. Corta el aguacate por la mitad, descarta el hueso y tritura la pulpa en un bol mediano. Anade cilantro, zumo de limón y sal al gusto, triturar hasta tener una mezcla homogénea. Opcional: anade trozos de cebolla y pimiento al gusto.<div>2. Calienta las tortillas en una sarten a fuego medio-alto durante 2 minutos.</div><div><span style="color: inherit; font-family: inherit;">3. Extiende la mezcla sobre la tortilla.</span></div><div>4.Calienta aceite de olvida en<span style="color: inherit; font-family: inherit;">&nbsp;una sarten y fríe los huevos a tu gusto y agrégalos sobre la tortilla, disfruta!</span></div><div><br></div>.','delete' => '0','create_id' => '3255560','delete_id' => '3255560','update_id' => '3572041','preparation_time' => NULL,'cook_time'=>'5','calories'=>'100','fat'=>'400','carbs'=>'50','categorie'=>'breakfast','ingredients'=>NULL),
            array('id' => '8','name' => 'Huevos al horno sobre aguacate','photo' => 'https://dc693.4shared.com/img/771ZMcQOjq/s24/184877ef7e0/food?async&rand=0.33972955884403233.jpg','instructions' => '1. Precalienta el horno a 220 C (425 F).<div>2. Lava y corta en tomate en rodajas o en cuadrado como gustes y reserva.</div><div>3. Corta el aguacate (palta) por la mitad, desecha el hueso, coloca las mitades en una fuente para horno y apoyalas bien para que no se vuelquen.</div><div>4. Rompe los huevos sobre las mitades de aguacate utilizandolas como fuentes, cuidado de no romper las yemas.</div><div>5. Anade los tomates cherry o italiano sobre el aguacate.</div><div>6. Hornea unos 20 minutos hasta que los huevos estén hechos, anade sal al gusto y disfruta!</div>','delete' => '0','create_id' => '3256192','delete_id' => '3256192','update_id' => '3805043','preparation_time' => '25','cook_time'=>'5','calories'=>'100','fat'=>'400','carbs'=>'50','categorie'=>'breakfast','ingredients'=>NULL),
            array('id' => '9','name' => 'Tostadas con platano yogurt y almendras','photo' => 'https://dc693.4shared.com/img/771ZMcQOjq/s24/184877ef7e0/food?async&rand=0.33972955884403233.jpg','instructions' => '1. Mezcla mantequilla de almendra y yogur griego en un bol<div>2. Extiende la mezcla sobre el pan.</div><div>3. Cubre con rodajas de plátano, espolvorea canela y disfruta!</div>','delete' => '1','create_id' => '3256382','delete_id' => '3895541','update_id' => '3395448','preparation_time' => NULL,'cook_time'=>'5','calories'=>'100','fat'=>'400','carbs'=>'50','categorie'=>'breakfast','ingredients'=>NULL),
            array('id' => '10','name' => 'Magdalenas de plátano y frejoles(alubias)','photo' => '1https://dc693.4shared.com/img/771ZMcQOjq/s24/184877ef7e0/food?async&rand=0.33972955884403233.jpg','instructions' => '1. Precalienta el horno a 180 C (350 F). Forra un molde de magdalenas o muffins.<div>2. Enjuaga bien, escurre y seca las alubias (frejoles o garbanzos).</div><div>3. Coloca todos los ingredientes en una batidora o procesador de alimentos para obtener una mezcla homogénea. Vierte la mezcla en el molde y hornea durante 20 minutos, no se verán esponjosas, sino mas bien un poco hechas.</div><div>4. Deja enfriar durante 20 minutos y disfruta!&nbsp;</div>','delete' => '1','create_id' => '3256592','delete_id' => '3895718','update_id' => '3847759','preparation_time' => NULL,'cook_time'=>'5','calories'=>'100','fat'=>'400','carbs'=>'50','categorie'=>'breakfast','ingredients'=>NULL),
        );


        foreach ($recipes as $recipe){
            \Illuminate\Support\Facades\DB::table('recipes')->insert([
                'id' => $recipe['id'],
                'name' => $recipe['name'],
                'photo' => $recipe['photo'],
                'preparation_time' => $recipe['preparation_time'],
                'delete' => $recipe['delete'],
                'cook_time'=>$recipe['cook_time'],
                'calories'=>$recipe['calories'],
                'fat'=>$recipe['fat'],
                'carbs'=>$recipe['carbs'],
                'create_id' => 1,
                'update_id' => 1,
                'delete_id' => 1,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
