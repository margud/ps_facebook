<?php

namespace PrestaShop\Module\PrestashopFacebook\Provider;

use Category;
use Configuration;
use Context;
use Currency;
use DateTime;
use Manufacturer;
use PrestaShop\Module\PrestashopFacebook\DTO\Object\FacebookProduct;
use PrestaShop\Module\PrestashopFacebook\Repository\ProductRepository;
use PrestaShop\Module\PrestashopFacebook\Utility\DateUtility;
use PrestaShop\PrestaShop\Adapter\Entity\Language;
use Product;
use Shop;
use SpecificPrice;

class ProductProvider implements CatalogProvider
{

    /**
     * @var int
     */
    private $shopId;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param int $shopId
     *
     * @return ProductProvider
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;

        return $this;
    }

    /**
     * @return FacebookProduct
     *
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    public function getProducts()
    {
        $product = $this->productRepository->getMockedBusData();

        $facebookProduct = new FacebookProduct();
        $facebookProduct
            ->setId($this->buildId($product))
            ->setTitle($this->buildTitle($product))
            ->setDescription($this->buildDescription($product))
            ->setAvailability($this->buildAvailability($product))
            ->setInventory($this->buildInventory($product))
            ->setCondition($this->buildCondition($product))
            ->setPrice($this->buildPrice($product))
            ->setLink($this->buildLink($product))
            ->setImageLink($this->buildImageLink($product))
            ->setBrand($this->buildBrand($product))
            ->setAdditionalImageLink($this->buildAdditionalImageLink($product))
            ->setAgeGroup($this->buildAgeGroup($product))
            ->setColor($this->buildColor($product))
            ->setGender($this->buildGender())
            ->setItemGroupId($this->buildItemGroupId($product))
            ->setGoogleProductCategory($this->buildGoogleProductCategory($product))
            ->setCommerceTaxCategory($this->buildCommerceTaxCategory($product))
            ->setMaterial($this->buildMaterial($product))
            ->setPattern($this->buildPattern($product))
            ->setProductType($this->buildProductType($product))
            ->setSalePrice($this->buildSalePrice($product))
            ->setSalePriceEffectiveDate($this->buildSalePriceEffectiveDate($product))
            ->setShipping($this->buildShipping($product))
            ->setShippingWeight($this->buildShippingWeight($product))
            ->setRichTextDescription($this->buildRichTextDescription($product));


        return $facebookProduct;
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildId(array $product)
    {
        return implode(
            '_',
            [
                $product['id'],
            ]
        );
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildTitle(array $product)
    {
        $attributes = self::attributeStringToArray($product['combination']);
        $attributeValues = [];
        foreach ($attributes as $feature => $value) {
            $attributeValues[] = $value;
        }
        $attributes = implode(
            ' ',
            $attributeValues

        );

        return implode(
            ' ',
            [
                $attributes,
                $product['manufacture'],
                $product['name'],
            ]
        );
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildDescription(array $product)
    {
        $description = $product['description_short'] ?: $product['description_short'] ?: $product['description'];

        return htmlspecialchars($description);
    }

    /**
     * @param int $productId
     * @param bool $isOrderOutOfStockAvailable
     *
     * @return string
     */
    private function buildAvailability($product)
    {
        $isOrderOutOfStockAvailable = Configuration::get('PS_ORDER_OUT_OF_STOCK');
        $availableStock = $product['quantity'];
        switch ($isOrderOutOfStockAvailable) {
            case 1:
                if ($availableStock <= 0) {
                    return 'available for order';
                }

                return 'in stock';
            case 0:
                if ($availableStock <= 0) {
                    return 'out of stock';
                }

                return 'in stock';
            default:
                return 'discontinued';
        }
    }

    /**
     * @param int $productId
     *
     * @return int
     */
    private function buildInventory($product)
    {
        return $product['quantity'];
    }


    /**
     * @param array $product
     *
     * @return string
     */
    private function buildCondition(array $product)
    {
        return $product['condition'];
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildPrice($product)
    {
        return str_replace(':', ', ', $product['price']);
    }

    /**
     * @param array $product
     * @return string
     *
     */
    private function buildLink($product)
    {
        return $product['link'];
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildImageLink(array $product)
    {
        return $product['imageLink'];
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildBrand(array $product)
    {
        return $product['brand'];
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildAdditionalImageLink(array $product)
    {
        return str_replace(':', ',', $product['additionalImageLink']);
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildAgeGroup(array $product)
    {
        return '';
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildColor(array $product)
    {
        return '';
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildGender()
    {
        return 'unisex';
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildItemGroupId(array $product)
    {
        return implode(
            '_',
            [
                $product['name'],
                $product['id'],
                $product['attributeId'],
            ]
        );
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildGoogleProductCategory(array $product)
    {
        return $product['category'];
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildCommerceTaxCategory(array $product)
    {
        //todo: do we need to use commerce_tax_category?
        return '??????';
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildMaterial(array $product)
    {
        return $product['material'];
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildPattern(array $product)
    {
        return $product['pattern'];
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildProductType(array $product)
    {
        return $product['category'];
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildSalePrice(array $product)
    {
        return $product['salesPrice'];
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildSalePriceEffectiveDate(array $product)
    {
        return $product['salePriceEffectiveDate'];
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildShipping(array $product)
    {
        return $product['shipping'];
    }

    /**
     * @param array $product
     *
     * @return string
     */
    private function buildShippingWeight(array $product)
    {
        return $product['weight'];
    }

    private function buildRichTextDescription(array $product)
    {
        return $product['shortDescription'] ?: $product['shortDescription'] ?: $product['description'];
    }

    private function buildAdditionalVariantAttribute(array $product)
    {
        return '';
    }

    private static function attributeStringToArray($attributes, $attributesSeparator = ';', $valueSeparator = ':')
    {
        $attributesArray = explode($attributesSeparator, $attributes);
        $return = [];
        foreach ($attributesArray as $attribute) {
            $attribute = explode($valueSeparator, $attribute);
            $return[$attribute[0]] = $attribute[1];
        }

        return $return;
    }
}
