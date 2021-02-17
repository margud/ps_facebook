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
import { configure, addDecorator } from '@storybook/vue';
import Vue from 'vue';

// import vue plugins
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue';
import VueI18n from 'vue-i18n';

// import css style
import 'bootstrap-vue/dist/bootstrap-vue';
import 'prestakit/dist/css/bootstrap-prestashop-ui-kit.css';
Vue.use(BootstrapVue, BootstrapVueIcons);

// PsAccounts default mock
window.contextPsAccounts = {
  psIs17: true,
  currentShop: {
    id: 1,
    name: 'PrestaShop',
    url: 'http://my-domain.com/admin-dev/blabla',
    domain: 'my-domain.com',
    domainSsl: 'my-secure-domain.com',
  },
  shops: [
    {
      id: 1,
      name: 'Default',
      shops: [
        {
          id: 1,
          name: 'PrestaShop',
          url: 'http://my-domain.com/admin-dev/blabla',
          domain: 'my-domain.com',
          domainSsl: 'my-secure-domain.com',
        }
      ],
    }
  ],
  user: { email: 'him@prestashop.com', emailIsValidated: true, isSuperAdmin: true },
  onboardingLink: 'https://perdu.com',
  superAdminEmail: 'nobody@prestashop.com',
  ssoResendVerificationEmail: null,
  manageAccountLink: 'https://perdu.com',
};

// i18n and store
Vue.use(VueI18n);
addDecorator(() => ({
  template: '<story/>',
  i18n: new VueI18n({
    locale: 'en',
    messages: require('./translations.json'),
  }),
  store: require('../src/store'),
}));

configure(require.context('../src', true, /\.stories\.(ts|js|md)x?$/), module);

export const parameters = {
  actions: { argTypesRegex: "^on[A-Z].*" },
  backgrounds: {
    default: 'backOffice',
    values: [
      {
        name: 'backOffice',
        value: '#F1F1F1'
      },
      {
        name: 'white',
        value: '#ffffff'
      },
      {
        name: 'black',
        value: '#000000'
      },
    ],
  }
}
