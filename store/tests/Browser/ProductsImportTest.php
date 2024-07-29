<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Storage;

class FileUploadTest extends DuskTestCase
{
    public function testFileUpload()
    {
        $filePath = base_path('tests/Browser/files/test_import.xlsx');

        $this->browse(function (Browser $browser) use ($filePath) {
            $browser->visit('http://127.0.0.1:8000/upload')
                ->attach('input[name="file"]', $filePath)
                ->press('Загрузить')
                ->waitForText('Данные успешно загружены и импортированы.', 10);
            if ($browser->element('div.alert.alert-success')) {
                $this->assertTrue(true, 'File upload succeeded and success message is present.');
            } else {
                $this->assertFalse($browser->element('div.alert.alert-danger'), 'File upload failed or error message is present.');
            }
        });
    }
}
