<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Setting;

class SettingTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$settings = array(
			array(
				'name'  => 'Company Address',
				'code'  => 'address',
				'type'  => Setting::USER,
				'value' => 'No 43-2, Jalan Temenggung 21/9,<br/> Bandar Mahkota Cheras, 43200 Batu Cheras 9 Cheras, Selangor',
			),
			array(
				'name'  => 'Company Phone Number',
				'code'  => 'phone',
				'type'  => Setting::USER,
				'value' => '+603 9010 9882',
			),
			array(
				'name'  => 'Company Fax Number',
				'code'  => 'fax',
				'type'  => Setting::USER,
				'value' => '+603 9075 9882',
			),
			array(
				'name'  => 'Company Email',
				'code'  => 'email',
				'type'  => Setting::USER,
				'value' => 'enquire@cubeevo.com',
			),
			array(
				'name'  => 'Facebook Link',
				'code'  => 'facebook_link',
				'type'  => Setting::USER,
				'value' => 'https://www.facebook.com/CubeEvo',
			),
			array(
				'name'  => 'Youtube Link',
				'code'  => 'youtube_link',
				'type'  => Setting::USER,
				'value' => 'https://www.youtube.com/user/cubeevo/videos',
			),
			array(
				'name'  => 'Instagram Link',
				'code'  => 'instagram_link',
				'type'  => Setting::USER,
				'value' => 'https://instagram.com/cubeevo_advertising/',
			),
			array(
				'name'  => 'Google Analytics Key',
				'code'  => 'ga_key',
				'type'  => Setting::SITE,
				'value' => '',
			),
			array(
				'name'  => 'Google Maps Latitude',
				'code'  => 'gmaps_lat',
				'type'  => Setting::SITE,
				'value' => '3.0542421',
			),
			array(
				'name'  => 'Google Maps Longitude',
				'code'  => 'gmaps_lng',
				'type'  => Setting::SITE,
				'value' => '101.78809419999993',
			),
			array(
				'name'  => 'Site Title',
				'code'  => 'site_title',
				'type'  => Setting::SITE,
				'value' => 'CUBEevo | 形立方',
			),
			array(
				'name'  => 'Meta Keyword',
				'code'  => 'meta_keyword',
				'type'  => Setting::SITE,
				'value' => '',
			),
			array(
				'name'  => 'Meta Description',
				'code'  => 'meta_desc',
				'type'  => Setting::SITE,
				'value' => '',
			),
			array(
				'name'  => 'Meta Image',
				'code'  => 'meta_img_id',
				'type'  => Setting::SITE,
				'value' => '',
			),
		);

		foreach ($settings as $setting)
		{
			Setting::create($setting);
		}
	}

}
