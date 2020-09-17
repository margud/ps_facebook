<?php

namespace PrestaShop\Module\PrestashopFacebook\Repository;

use Db;
use DbQuery;

class ProductRepository
{
    /**
     * @param int $langId
     *
     * @return array|bool|\mysqli_result|\PDOStatement|resource|null
     *
     * @throws \PrestaShopDatabaseException
     */
    public function getProductsForFacebook($langId)
    {
        $sql = new DbQuery();
        $sql->select('p.*');
        $sql->select('pl.name as `product_name`, pl.description_short as `product_description_short`');
        $sql->select('pl.description as `product_description`');
        $sql->select('m.name as `manufacturer_name`');
        $sql->innerJoin('product_lang', 'pl', 'pl.id_product = p.id_product AND pl.id_lang = ' . (int)$langId);
        $sql->leftJoin('manufacturer', 'm', 'm.id_manufacturer = p.id_manufacturer');
        $sql->from('product', 'p');

        return Db::getInstance()->executeS($sql);
    }

    public function getMockerData()
    {
        return [
            'id' => '1',
            'name' => 'Hummingbird printed t-shirt',
            'combination' => 'Size:S;Color:White',
            'features' => 'Composition:Cotton;Property:Short sleeves',
            'brand' => 'Studio Design',
            'description' => 'description',
            'shortDescription' => 'shortDescription',
            'availability' => 'in stock',
            'inventory' => '75',
            'condition' => 'new',
            'price' => '9.99 USD:25.00 EUR',
            'link' => 'http://localhost/facebookModule/en/men/1-hummingbird-printed-t-shirt.html',
            'imageLink' => 'http://localhost/facebookModule/1-large_default/hummingbird-printed-t-shirt.jpg',
            'additionalImageLink' => 'http://localhost/facebookModule/2-large_default/hummingbird-printed-t-shirt.jpg;http://localhost/facebookModule/5-large_default/today-is-a-good-day-framed-poster.jpg',
            'ageGroup' => 'all ages',
            'color' => 'royal blue',
            'gender' => 'unisex',
            'category' => 'Apparel & Accessories > Clothing > Shirts & Tops',
            'commerce_tax_category' => '??????',
            'material' => 'cotton',// todo: supported cotton, denim, leather
            'pattern' => 'Flannel, Gingham, Polka dots, stripes',
            'salesPrice' => '7.99 USD',
            'salePriceEffectiveDate' => '2020-04-30T09:30-08:00/2020-05-30T23:59-08:00',
            'shipping' => 'SG::Air:14.99 SGD',
            'shippingWeight' => '10 kg',
            'size' => 'Large',
            'gtin' => '',
            'mpn' => '',
            'return_policy_info' => '???',
            'launch_date' => '???',
            'expiration_date' => '2021-01-01',
            'visibility' => '???',
            'mobile_link' => '???',
            'applink' => '???'
        ];
    }

    public function getMockedBusData()
    {
        return
            [
                'id' => "1-1-en",
                "id_product" => "1",
                "id_attribute" => "1",
                "name" => "Hummingbird printed t-shirt",
                'combination' => 'Size:S;Color:White',
                "description" => '<p><span style="font-size:10pt;font-style:normal;"><span style="font-size:10pt;font-style:normal;">Symbol of lightness and delicacy, the hummingbird evokes curi ▶',
                "description_short" => '
      <p><span style="font-size:10pt;font-style:normal;">Regular fit, round neckline, short sleeves. Made of extra long staple pima cotton. </span></p>\r\n<p></p>',
                "lang" => "en",
                "default_category" => "Men",
                "manufacture" => "test",
                "reference" => "demo_1",
                "upc" => "",
                "ean" => "",
                "isbn" => "",
                "condition" => "new",
                "visibility" => "both",
                "active" => "1",
                "quantity" => "300",
                'price' => '19,49 EUR'
            ];
    }
}
