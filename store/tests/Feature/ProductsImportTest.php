<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\AdditionalField;
use App\Imports\ProductsImport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsImportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function imports()
    {
        $row = [
            'vnesnii_kod' => '12345',
            'naimenovanie' => 'Test Product',
            'opisanie' => 'This is a test product.',
            'cena_cena_prodazi' => '100,50',
            'soderzit_akciznuyu_marku' => 'да',
            'dop_pole_razmer' => 'Large',
            'dop_pole_cvet' => 'Red',
            'dop_pole_brend' => 'Test Brand',
            'dop_pole_sostav' => '100% Test Material',
            'dop_pole_kol_vo_v_upakovke' => '10',
            'dop_pole_ssylka_na_upakovku' => 'http://example.com/image.jpg',
            'dop_pole_seo_title' => 'Test SEO Title',
            'dop_pole_seo_h1' => 'Test H1',
            'dop_pole_seo_description' => 'Test SEO Description',
            'dop_pole_ves_tovarag' => '200',
            'dop_pole_sirinamm' => '50',
            'dop_pole_vysotamm' => '100',
            'dop_pole_dlinamm' => '150',
            'dop_pole_ves_upakovkig' => '250',
            'dop_pole_sirina_upakovkimm' => '55',
            'dop_pole_vysota_upakovkimm' => '105',
            'dop_pole_dlina_upakovkimm' => '155',
            'dop_pole_kategoriya_tovara' => 'Test Category',
            'dop_pole_ssylki_na_foto' => 'http://example.com/photo1.jpg, http://example.com/photo2.jpg'
        ];

        $import = new ProductsImport();

        $import = $this->getMockBuilder(ProductsImport::class)
            ->onlyMethods(['saveImage'])
            ->getMock();

        $import->method('saveImage')->willReturn('storage/images/fake_image.jpg');

        $import->model($row);

        $this->assertDatabaseHas('products', [
            'external_code' => '12345',
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'price' => 100.50,
            'discount' => 1,
        ]);

        $this->assertDatabaseHas('additional_fields', [
            'external_code' => '12345',
            'name' => 'Large',
            'size' => 'Large',
            'color' => 'Red',
            'brand' => 'Test Brand',
            'composition' => '100% Test Material',
            'quantity_per_pack' => 10,
            'packaging_link' => 'storage/images/fake_image.jpg',
            'seo_title' => 'Test SEO Title',
            'seo_h1' => 'Test H1',
            'seo_description' => 'Test SEO Description',
            'weight' => 200,
            'width' => 50,
            'height' => 100,
            'length' => 150,
            'packaging_weight' => 250,
            'packaging_width' => 55,
            'packaging_height' => 105,
            'packaging_length' => 155,
            'category' => 'Test Category',
        ]);
    }
}
