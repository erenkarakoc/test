<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds the countries table with data from a JSON file.';

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @var array
     */
    protected $countries = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('countries')->delete();
        DB::statement('ALTER TABLE countries AUTO_INCREMENT = 1');

        $countries = $this->getList();

        foreach ($countries as $countryId => $country) {
            DB::table('countries')->insert([
                'name' => $country['name'],
                'iso3' => $country['iso3'], // ISO 3166-3
                'iso2' => $country['iso2'], // ISO 3166-2
                'numeric_code' => $country['numeric_code'], // Numeric country code
                'phone_code' => $country['phone_code'], // Phone code
                'capital' => $country['capital'], // Capital city
                'currency' => $country['currency'], // Currency code
                'currency_name' => $country['currency_name'], // Currency name
                'currency_symbol' => $country['currency_symbol'], // Currency symbol
                'tld' => $country['tld'], // Top-level domain
                'native' => $country['native'], // Native name
                'region' => $country['region'], // Region
                'region_id' => $country['region_id'], // Region ID
                'subregion' => $country['subregion'], // Subregion
                'subregion_id' => $country['subregion_id'], // Subregion ID
                'nationality' => $country['nationality'], // Nationality
                'timezones' => json_encode($country['timezones']), // Timezones as JSON
                'translations' => json_encode($country['translations']), // Translations as JSON
                'latitude' => $country['latitude'], // Latitude
                'longitude' => $country['longitude'], // Longitude
                'emoji' => $country['emoji'], // Emoji flag
                'emojiU' => $country['emojiU'], // Unicode emoji
            ]);
        }

        $this->info('Countries seeded successfully!');
    }

    /**
     * Get the countries from the JSON file, if it hasn't already been loaded.
     *
     * @return array
     */
    protected function getCountries()
    {
        // Get the countries from the JSON file
        if (is_null($this->countries) || empty($this->countries)) {
            $this->countries = json_decode(file_get_contents(__DIR__.'/countries.json'), true);
        }

        // Return the countries
        return $this->countries;
    }

    /**
     * Returns a list of countries
     *
     * @param string sort
     * @return array
     */
    private function getList($sort = null)
    {
        // Get the countries list
        $countries = $this->getCountries();

        // Sorting
        $validSorts = [
            'name',
            'iso3',
            'iso2',
            'numeric_code',
            'phone_code',
            'capital',
            'currency',
            'currency_name',
            'currency_symbol',
            'tld',
            'native',
            'region',
            'region_id',
            'subregion',
            'subregion_id',
            'nationality',
            'timezones',
            'translations',
            'latitude',
            'longitude',
            'emoji',
            'emojiU',
        ];

        if (! is_null($sort) && in_array($sort, $validSorts)) {
            uasort($countries, function ($a, $b) use ($sort) {
                if (! isset($a[$sort]) && ! isset($b[$sort])) {
                    return 0;
                } elseif (! isset($a[$sort])) {
                    return -1;
                } elseif (! isset($b[$sort])) {
                    return 1;
                } else {
                    return strcasecmp($a[$sort], $b[$sort]);
                }
            });
        }

        return $countries;
    }
}
