<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

namespace PrestaShop\Module\PrestashopFacebook\DTO;

use JsonSerializable;
use PrestaShop\Module\PrestashopFacebook\DTO\Object\Ad;
use PrestaShop\Module\PrestashopFacebook\DTO\Object\Catalog;
use PrestaShop\Module\PrestashopFacebook\DTO\Object\FacebookBusinessManager;
use PrestaShop\Module\PrestashopFacebook\DTO\Object\Page;
use PrestaShop\Module\PrestashopFacebook\DTO\Object\Pixel;
use PrestaShop\Module\PrestashopFacebook\DTO\Object\User;

class ContextPsFacebook implements JsonSerializable
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var FacebookBusinessManager|null
     */
    private $facebookBusinessManager;

    /**
     * @var Pixel|null
     */
    private $pixel;

    /**
     * @var Page|null
     */
    private $page;

    /**
     * @var Ad|null
     */
    private $ad;

    /**
     * @var Catalog|null
     */
    private $catalog;

    /**
     * @var bool
     */
    private $forcedDisconnect;

    /**
     * ContextPsFacebook constructor.
     *
     * @param User $user
     * @param FacebookBusinessManager|null $facebookBusinessManager
     * @param Pixel|null $pixel
     * @param Page|null $page
     * @param Ad|null $ad
     * @param Catalog|null $catalog
     * @param bool $forcedDisconnect
     */
    public function __construct($user, $facebookBusinessManager, $pixel, $page, $ad, $catalog, $forcedDisconnect)
    {
        $this->user = $user;
        $this->facebookBusinessManager = $facebookBusinessManager;
        $this->pixel = $pixel;
        $this->page = $page;
        $this->ad = $ad;
        $this->catalog = $catalog;
        $this->forcedDisconnect = $forcedDisconnect;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return ContextPsFacebook
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return FacebookBusinessManager|null
     */
    public function getFacebookBusinessManager()
    {
        return $this->facebookBusinessManager;
    }

    /**
     * @param FacebookBusinessManager|null $facebookBusinessManager
     *
     * @return ContextPsFacebook
     */
    public function setFacebookBusinessManager($facebookBusinessManager)
    {
        $this->facebookBusinessManager = $facebookBusinessManager;

        return $this;
    }

    /**
     * @return Pixel|null
     */
    public function getPixel()
    {
        return $this->pixel;
    }

    /**
     * @param Pixel|null $pixel
     *
     * @return ContextPsFacebook
     */
    public function setPixel($pixel)
    {
        $this->pixel = $pixel;

        return $this;
    }

    /**
     * @return Page|null
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param Page|null $page
     *
     * @return ContextPsFacebook
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return Ad|null
     */
    public function getAd()
    {
        return $this->ad;
    }

    /**
     * @param Ad|null $ad
     *
     * @return ContextPsFacebook
     */
    public function setAd($ad)
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * @return Catalog|null
     */
    public function getCatalog()
    {
        return $this->catalog;
    }

    /**
     * @param Catalog|null $catalog
     *
     * @return ContextPsFacebook
     */
    public function setCatalog($catalog)
    {
        $this->catalog = $catalog;

        return $this;
    }

    /**
     * @return bool
     */
    public function isForcedDisconnect()
    {
        return $this->forcedDisconnect;
    }

    /**
     * @param bool $forcedDisconnect
     * @return ContextPsFacebook
     */
    public function setForcedDisconnect($forcedDisconnect)
    {
        $this->forcedDisconnect = $forcedDisconnect;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'user' => $this->getUser(),
            'pixel' => $this->getPixel(),
            'facebookBusinessManager' => $this->getFacebookBusinessManager(),
            'page' => $this->getPage(),
            'ads' => $this->getAd(),
            'catalog' => $this->getCatalog(),
            'forcedDisconnect' => $this->isForcedDisconnect()
        ];
    }
}
