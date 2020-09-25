window.vue = require('vue');

require('lodash');

import Vue from 'vue';

import ThemeList from './components/theme_list.vue';

//Recupera as configurações definidas em resources/assets/js/settings.php
Vue.prototype.settings = (key) => {
	return window.settings[key];
}

//Allows localization using trans()
Vue.prototype.trans = (key) => {
	return _.get(window.lang, key, key);
};
//Tells if an JSON parsed object is empty
Vue.prototype.isEmpty = (obj) => {
	return _.isEmpty(obj);
};
//Works like php number_format
Vue.prototype.number_format = (number, decimals, dec_point, thousands_point) => {

	if (number == null || !isFinite(number)) {
		throw new TypeError("number is not valid");
	}

	if (!decimals) {
		var len = number.toString().split('.').length;
		decimals = len > 1 ? len : 0;
	}

	if (!dec_point) {
		dec_point = '.';
	}

	if (!thousands_point) {
		thousands_point = ',';
	}

	number = parseFloat(number).toFixed(decimals);

	number = number.replace(".", dec_point);

	var splitNum = number.split(dec_point);
	splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
	number = splitNum.join(dec_point);

	return number;
}

Vue.prototype.currency_format = (number, currency) => {
	if (!currency) currency = window.settings.currency;

	return currency + ' ' + Vue.prototype.number_format(number, 2, ',', '.');
}


//Main vue instance
new Vue({
	el: '#ThemeVue',

	components: {
		ThemeList
	},

	created: function () {
	}
})