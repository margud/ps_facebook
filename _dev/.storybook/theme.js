/**
 * 2007-2021 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2021 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
import { create } from '@storybook/theming/create';

export default create({
    base: 'light',

    colorPrimary: '#DF0067',
    colorSecondary: '#251B5B',
    appBg: '#E5E1F9',
    appBorderRadius: 5,
    fontBase: '"Open Sans", Helvetica, Verdana, sans-serif',

    brandTitle: 'PS Facebook Components',
    brandImage: 'https://www.shareicon.net/data/256x256/2015/10/06/112712_development_512x512.png',
});
