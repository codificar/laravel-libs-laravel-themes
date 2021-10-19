<template>
    <div class="card card-outline-info">
        <div class="card-header">
            <h4 class="m-b-0 text-white">{{ trans('themes.options') }}</h4>
        </div>
        <div class="card-block">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label> {{ trans('themes.select_options') }} :</label>
                        <select v-model="is_enabled" class="form-control">
                            <option value="1" selected>{{ trans('themes.yes') }}</option>
                            <option value="0" >{{ trans('themes.no') }}</option>
                        </select>
                    </div>
                </div>

                <div v-if="is_enabled == 1" class="col-md-4">
                    <div class="form-group">
                        <label> {{ trans('themes.menu_name') }} :</label>
                        <input v-model="menu_name" type="text" class="form-control" :placeholder="trans('themes.menu_name')" maxlength="255">
                    </div>
                </div>

                <div v-if="is_enabled == 1" class="col-md-4">
                    <div class="form-group">
                        <label> {{ trans('themes.menu_frase') }} :</label>
                        <input v-model="menu_frase" type="text" class="form-control" :placeholder="trans('themes.menu_frase')" maxlength="255">
                    </div>
                </div>
            </div>

            <div class="box-footer pull-right">
                <button @click="saveSettings()" class="btn btn-success right" type="button">
                    {{ trans('themes.save') }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            is_enabled: 0,
            menu_name: '',
            menu_frase: ''
        }
    },
    methods: {
        async getSettings() {
            try {
                const { data } = await axios.get('/api/themes/settings');

                if (data.success) {
                    const { is_enabled, menu_name, menu_frase } = data;
                    this.is_enabled = is_enabled;
                    this.menu_name = menu_name;
                    this.menu_frase  = menu_frase;
                }
            } catch (error) {
                console.log('getSettings', error);
            }
        },

        async saveSettings() {
            try {
                const { data } = await axios.post('/api/themes/settings', {
                    is_enabled: this.is_enabled,
                    menu_name: this.menu_name,
                    menu_frase: this.menu_frase
                });

                if (data.success)
                    window.location.reload();
            } catch (error) {
                console.log('saveSettings', error);
            }
        }
    },
    mounted() {
        this.getSettings();
    }
}
</script>

<style>

</style>