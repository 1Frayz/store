<?php

namespace App\Imports;

use Exception;
use App\Models\Image;
use App\Models\Product;
use App\Models\AdditionalField;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        ini_set('max_execution_time', 180);
        $existingProduct = Product::where('external_code', $row['vnesnii_kod'])->first();

        if ($existingProduct) {
            return null;
        }

        Product::create([
            'external_code' => $row['vnesnii_kod'],
            'name' => $row['naimenovanie'],
            'description' => $row['opisanie'],
            'price' => $this->parsePrice($row['cena_cena_prodazi']),
            'discount' => $row['soderzit_akciznuyu_marku'] === 'нет' ? 0 : 1,
        ]);


        AdditionalField::create([
            'external_code' => $row['vnesnii_kod'],
            'name' => $row['dop_pole_razmer'],
            'size' => $row['dop_pole_razmer'],
            'color' => $row['dop_pole_cvet'],
            'brand' => $row['dop_pole_brend'],
            'composition' => $row['dop_pole_sostav'],
            'quantity_per_pack' => $row['dop_pole_kol_vo_v_upakovke'],
            'packaging_link' => $this->saveImage($row['dop_pole_ssylka_na_upakovku']),
            'seo_title' => $row['dop_pole_seo_title'],
            'seo_h1' => $row['dop_pole_seo_h1'],
            'seo_description' => $row['dop_pole_seo_description'],
            'weight' => $row['dop_pole_ves_tovarag'],
            'width' => $row['dop_pole_sirinamm'],
            'height' => $row['dop_pole_vysotamm'],
            'length' => $row['dop_pole_dlinamm'],
            'packaging_weight' => $row['dop_pole_ves_upakovkig'],
            'packaging_width' => $row['dop_pole_sirina_upakovkimm'],
            'packaging_height' => $row['dop_pole_vysota_upakovkimm'],
            'packaging_length' => $row['dop_pole_dlina_upakovkimm'],
            'category' => $row['dop_pole_kategoriya_tovara'],
        ]);

        $photoLinks = explode(', ', $row['dop_pole_ssylki_na_foto']);
        $images = [];

        foreach ($photoLinks as $link) {
            $path = $this->saveImage($link);

            $images[] = Image::create([
                'external_code' => $row['vnesnii_kod'],
                'link' => $link,
                'path' => $path,
            ]);
        }
    }

    private function parsePrice($price)
    {
        return (float)str_replace(',', '.', $price);
    }

    private function saveImage($link)
    {
        try {
            $client = new Client();
            $response = $client->get($link);
            $imageContent = $response->getBody()->getContents();
            $filename = 'image_' . time() . '.' . pathinfo($link, PATHINFO_EXTENSION);
            Storage::put('images/' . $filename, $imageContent);
            return 'storage/images/' . $filename;
        } catch (Exception $e) {
            return "storage/site/no-photo.jpg";
        }
    }
}
