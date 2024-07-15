<?php

namespace App\Tests\Service\Csv;

use App\Service\Csv\ApiDataToCsvFormatter;
use App\Service\Csv\ApiDataToCsvFormatterInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ApiDataToCsvFormatterTest extends KernelTestCase
{
    public function testFromDestinationToCsvFormat(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();

        $apiDataToCsvFormatter = $container->get(ApiDataToCsvFormatterInterface::class);
        $formattedDestinations = $apiDataToCsvFormatter->fromDestinationToCsvFormat($this->getOriginalDestinations());

        $this->assertEquals($this->getFormattedDestinations(), $formattedDestinations);
    }

    public function getOriginalDestinations(): array
    {
        return [
            [
                "id" => 1,
                "name" => "Bin El Ouidiane",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ll.",
                "price" => 1100,
                "duration" => 3,
                "image" => "https://www.shutterstock.com/image-photo/bin-el-quidane-morocco-april-600nw-2417328387.jpg"
            ],
            [
                "id" => 3,
                "name" => "Merzouga",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "price" => 1400,
                "duration" => 1,
                "image" => "https://www.frs.es/fileadmin/_processed_/9/e/csm_csm_frs-iberia-destinos-erfoud-dos_d995027a85.jpg"
            ]
        ];
    }

    public function getFormattedDestinations(): array
    {
        return [
            [
                "name" => "Bin El Ouidiane",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ll.",
                "price" => 1100,
                "duration" => '3 days',
            ],
            [
                "name" => "Merzouga",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "price" => 1400,
                "duration" => '1 day',
            ]
        ];
    }
}
