<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since   Version 1.0
 */

use Illuminate\Database\Capsule\Manager as Capsule;

if (!Capsule::schema()->hasTable('table_data')) {
    Capsule::schema()->create('table_data', static function ($table) {
        $table->id();
        $table->string('county');
        $table->string('country');
        $table->string('town');
        $table->longText('description');
        $table->string('address');
        $table->string('image');
        $table->string('thumbnail');
        $table->string('latitude');
        $table->string('longitude');
        $table->string('num_bedrooms');
        $table->string('num_bathrooms');
        $table->string('price');
        $table->longText('property_type');
        $table->string('type');
        $table->timestamps();
        $table->index('county');
        $table->index('country');
        $table->index('town');
        $table->index('address');
        $table->index('num_bedrooms');
        $table->index('num_bathrooms');
        $table->index('price');
        $table->index('type');
    });

    echo "\n=============== Table 'table_data' created ===================\n\n";
} else {
    echo "\nTable 'table_data' already exist\n\n";
}
